<?php

class Work extends Controller
{
	private $folder = 'works';

  public function __construct(){ parent::__construct(); }

	public function home()
	{
		Service::relocation($this->folder);
	}

	public function index($params)
	{
		$data['date']  = isset($_GET['date']) ? $_GET['date'] : DATE_NOW;
		$data['works'] = $this->model->getWorks($data['date']);
		$data['pendings'] = $this->model->getWorksPendings();
		$this->view->render($this->folder.'/index', $data);
	}

	public function pending()
	{
		$data['pendings'] = $this->model->getWorksPendings();
		$this->view->render($this->folder.'/pending', $data);
	}

  public function add($params)
  {
		$id = $params ? (int) $params[0] : null;

		$modelClient = Getter::model('client');
		$data['client'] = $modelClient->getClient($id);

		$modelCrew = Getter::model('crew');
		$data['crews'] = $modelCrew->getCrewsEnabled();

		$modelInterm = Getter::model('intermediary');
		$data['interms'] = $modelInterm->getIntermsAvailable();

    $this->view->render($this->folder.'/add', $data);
  }

  public function create()
  {
		$post = Tool::sanitizer($_POST);
		$post['iduser'] = Session::get('id');
		$post['idclient'] = (int) $post['needle'];
		$post['idinterm'] = (int) $post['intermediary'];
        $post['idcrew'] = (int) $post['crew'];

		$modelWorker = Getter::model('worker');
		$workers = $modelWorker->getWorkersCrew($post['idcrew']);
		$post['workers'] = $modelWorker->stringifyWorkers($workers);

		if( $result = $this->model->createWork($post) )
		{
			#$idwork = $this->model->getWorkLastInsert(); return 0 ...?
			$idwork = $this->model->getWorkMaxId();
			if( $result = $this->callKindAction($post['kindwork'], 'create', $idwork, $post) )
			{
				Event::set($result, 'Work type created');
				$path = "{$post['idclient']}".DS."{$idwork}";
				if( $result = Explorer::createGallery($path) )
				{
					Message::create('success', 'Work has been created');
					$url = 'clients/casefile/'.$post['idclient'];
					Service::relocation($url);
				}
				else
				{
					Event::set($result, 'Work created but not work gallery, contact your support');
					Event::log('Error to create work folder['.$path.']');
				}
			}
			else
			{
				$this->model->deleteWork($idwork);
				Event::set(false, 'Work type and details');
			}
		}
		else
		{
			Event::set(false, 'Information work');
		}
		$generated = Message::generate(Event::get('created'), 'Work');
		Message::create($generated['status'], $generated['text']);
		Service::referer();
  }

  public function edit($params)
  {
    $id = $params ? (int) $params[0] : null;
		if(!$data['work'] = $this->model->getWork($id))
		{
			$this->home();
		}

		$data['details'] = $this->callKindAction($data['work']['kind'], 'read', $id);

		$modelCrew = Getter::model('crew');
		$data['crews'] 	 = $modelCrew->getCrewsEnabled();

		$modelInterm = Getter::model('intermediary');
		$data['interms'] = $modelInterm->getIntermsAvailable();

		$idclient = $data['work']['id_client'];
		$data['gallery'] = Explorer::getGallery($idclient, $id);
		$this->view->render($this->folder.'/edit', $data);
  }

	public function read($params)
	{
		$id = $params ? (int) $params[0] : null;
		if(!$data['work'] = $this->model->getWork($id))
		{
			Service::referer();
		}
		$kind = $data['work']['kind'];
		$data['work']['details'] = $this->callKindAction($kind, 'read', $id);

		$idclient = $data['work']['id_client'];
		$data['work']['gallery'] = Explorer::getGallery($idclient, $id);

		$this->view->render($this->folder.'/read', $data);
	}

	public function update()
	{
		$post = Tool::sanitizer($_POST);
		$id = (int) $post['needle'];
		
		$adminsArray = ['admin', 'coord'];
		if( in_array(Session::get('kind'), $adminsArray) )
		{
			$events = $this->updateByAdmin($id, $post);
		}
		else
		{
			$events = $this->updateByCrew($id, $post);
		}
		$generated = Message::generate($events, 'Work');
		Message::create($generated['status'], $generated['text']);
		Service::referer();
	}

	private function updateByAdmin($id, $post)
	{
		// If crew was changed
		if($post['precrew'] != $post['crew'])
		{
			$idcrew = (int) $post['crew'];
			$modelWorker = Getter::model('worker');
			$arrayWorkers = $modelWorker->getWorkersCrew($idcrew);
			$post['workers'] = $modelWorker::stringifyWorkers($arrayWorkers);
		}

		// Update general work
		$post['iduser'] = Session::get('id');
		$result = $this->model->updateWork($id, $post);
		Event::set($result, 'General');

		// Alter process work: Working(started) or done working(finished)
		if( !empty($post['started']['date']) || !empty($post['finished']['date']) )
		{
			$started  = empty($post['started']['date'])  ? DATETIME_ZERO : $post['started']['date'].' '.$post['started']['time'];
			$finished = empty($post['finished']['date']) ? DATETIME_ZERO : $post['finished']['date'].' '.$post['finished']['time'];
			$result = $this->model->alterWorkStatusProcess($id, $started, $finished);
			Event::set($result, 'Start or done work');
		}

		// Alter status work: completed(closed), cancelled or pending
		if($post['status'] !== 'dontchange')
		{
			if($post['status'] !== 'pending')
			{
				$result = $this->model->alterWorkStatus($id, $post['status']);
			}
			else
			{
				$result = $this->model->alterWorkStatusPending($id);
			}
			Event::set($result, 'Status');
		}

		// Update kind work
		$idkind = (int) $post['needleKind'];
		$result = $this->callKindAction($post['kind'], 'update', $idkind, $post);
		Event::set($result, 'Details of '.$GLOBALS['works'][ $post['kind'] ]);

		return Event::get('updated');
	}

	private function updateByCrew($id, $post)
	{
		$started  = ($post['status'] === 'start') ? DATETIME_NOW : $post['started'];
		$finished = ($post['status'] === 'finish') ? DATETIME_NOW : DATETIME_ZERO;
		$result = $this->model->alterWorkStatusProcess($id, $started, $finished);
		Event::set($result, 'work');
		return Event::get('updated');
	}

  public function prioritize()
  {
    $post = Tool::sanitizer($_POST);
		if($this->model->prioritizeWorks($post))
		{
			$status = 'success';
			$text = 'Works ordered';
		}
		else
		{
			$status = 'warning';
			$text = 'Check again the works order';
		}
		Message::create($status, $text);
		Service::referer();
  }

	private function callKindAction($kind, $action, $id, $params = false)
	{
		$modelKind = Getter::modelKind($kind);
		$objAction = array($modelKind, $action);
		$objParams = $params ? array($id, $params) : array($id);
		return call_user_func_array($objAction, $objParams);
	}

	public function kind($params)
	{
		$kind = $params[0];
		$path = VIEWS.'kinds'.DS.$kind.DS.'add.php';
		if( file_exists($path) )
		{
			require_once $path;
			return;
		}

		echo 'Does not have a work template.';
		return;

		#$this->view->renderTemplate($path);
	}

	public function upload()
	{
		$extensions = array('image/jpeg', 'image/jpg');
		$formatsSize = array('kb' => 1000, 'mb' => 1000000);
		$maxSize = 5;

		$post = Tool::sanitizer($_POST);
		$photo = $_FILES['photofile'];

		if( !$photo['error'] )
		{
			$needles = array('client' => $post['needleClient'], 'work' => $post['needle']);
			$photoSize = $photo['size'] / $formatsSize['mb'];
      $photoSizeRound = round($photoSize, 2);

			if( $photoSizeRound > $maxSize )
			{
				$status = 'warning';
				$text   = 'Photo must be max 5MB';
			}
			elseif( !in_array($photo['type'], $extensions) )
			{
				$status = 'warning';
				$text   = 'Photo must be .jpg extension';
			}
			elseif( !Explorer::uploadToGallery($photo['tmp_name'], $post['photoname'], $needles) )
			{
				$status = 'warning';
				$text   = 'Hmm... try again or contact with your administrator';
			}
			else{
				$status = 'success';
				$text   = 'Photo has been uploaded';
			}
		}
		else
		{
			$status = 'danger';
			$text   = 'Upload photo error, try again...';
		}
		Message::create($status, $text);
		Service::referer();
	}
}
