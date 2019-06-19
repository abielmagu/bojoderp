<?php

class Crew extends Controller
{
	private $folder = 'crews';

  public function __construct(){ parent::__construct();	}

	public function home()
	{
		Service::relocation($this->folder);
	}

	public function index($params)
	{
		$data['internal'] = array();
		$data['external'] = array();
		$data['options']  = array();

		$modelWorker  = Getter::model('worker');
		$workers 			= $modelWorker->getWorkersNoFree();
		$data['free'] = $modelWorker->getWorkersFree();

		$crews   = $this->model->getCrews();
		foreach($crews as $crew)
		{
			if($crew['kind'] === 'internal')
			{
				// Save crews for options select
				if($crew['enabled'])
				{
					array_push($data['options'], $crew);
				}

				// Save workers in your crew
				$crew['workers'] = array();
				foreach($workers as $key => $worker)
				{
					if($crew['id'] === $worker['id_crew'])
					{
						array_push($crew['workers'], $worker);
						unset($workers[$key]);
					}
				}

				// Order first crews with workers
				if( count($crew['workers']) )
				{
					array_unshift($data['internal'], $crew);
				}
				else
				{
					array_push($data['internal'], $crew);
				}
			}
			else
			{
				array_push($data['external'], $crew);
			}
		}
		$this->view->render($this->folder.'/index', $data);
	}

	public function add()
	{
		$this->view->render($this->folder.'/add');
	}

	public function create()
	{
		$post = Tool::sanitizer($_POST);
		if( !$this->model->getCrewBy('nick', $post['nickname']) )
		{
			$post['kind'] = 'crew';
			$modelUser = Getter::model('user');
			if( $modelUser->createUser($post) )
			{
				$iduser = $modelUser->getUserLastInsertId();
				$post['iduser'] = $iduser;
				if( $this->model->createCrew($post) )
				{
					Message::create('success', $post['nickname'].' has been created');
					$this->home();
				}
				else
				{
					$modelUser->deleteUser($iduser);
					$status = 'danger';
					$text 	= 'Check again the information';
				}
			}
			else
			{
				$status = 'warning';
				$text 	= 'Try with anoher: <b>username</b>';
			}
		}
		else
		{
			$status = 'warning';
			$text 	= 'Try with anoher: <b>nickname</b>';
		}
		Message::create($status, $text);
		Service::referer();
	}

	public function edit($params)
	{
		$id = (int) $params[0] ?: null;
		$data['crew'] = $this->model->getCrew($id);
		$this->view->render($this->folder.'/edit', $data);
	}

	public function update()
	{
		$post = Tool::sanitizer($_POST);
		$id['crew'] = (int) $post['needle'][0];
		$id['user'] = (int) $post['needle'][1];

		if(!isset($post['disabled']))
		{
			$result = $this->model->updateCrew($id['crew'], $post);
			Event::set($result, 'nickname');

			if(	$post['kindname'] === 'external' )
			{
				$this->model->setCrewLeader($id['crew'], 0);
				$modelWorker = Getter::model('worker');
				$modelWorker->freedomWorkers($id['crew']);
			}

			$modelUser = Getter::model('user');
			$result = $modelUser->updateEnable($id['user'], 1);
			Event::set($result, 'disabled');

			if($post['username'] !== $post['usernamePrev'])
			{
				$result = $modelUser->updateUsername($id['user'], $post['username']);
				Event::set($result, 'username');
			}

			if(!empty($post['passwordNew']))
			{
				$result = $modelUser->updatePassword($id['user'], $post['passwordNew']);
				Event::set($result, 'new password');
			}
		}
		else
		{
			$result = $this->model->disableCrew($id['crew']);
			Event::set($result, 'disable crew');

			$modelUser = Getter::model('user');
			$result = $modelUser->updateEnable($id['user'], 0);
			Event::set($result, 'disable login');

			$modelWorker = Getter::model('worker');
			$modelWorker->freedomWorkers($id['crew']);
		}

		$generated = Message::generate(Event::get('updated'), 'Crew');
		Message::create($generated['status'], $generated['text']);
		Service::referer();
	}

	public function reorganize()
	{
		$post = Tool::sanitizer($_POST);
		$id 	= (int) $post['needle'];

		if( isset($post['leader']) )
		{
			$idworker = (int) $post['leader'];
			$result = $this->model->setCrewLeader($id, $idworker);
			Event::set($result, 'leader');
		}

		if( isset($post['crew'], $post['emigrates']) )
		{
			$idcrew = (int) $post['crew'];
			$modelWorker = Getter::model('worker');
			$result = $modelWorker->emigrateWorkers($idcrew, $post['emigrates']);
			Event::set($result, 'workers moved');
		}

		// free(md5) = aa2d6e4f578eb0cfaba23beef76c2194
		$postcrew = ( $post['nick'] === 'aa2d6e4f578eb0cfaba23beef76c2194' )? 'Free' : $post['nick'];
		$generated = Message::generate(Event::get('reorganized'), $postcrew);
		Message::create($generated['status'], $generated['text']);

		if($generated['status'] === 'success')
		{
			$this->home();
		}
		Service::referer();
	}
}
