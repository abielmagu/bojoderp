<?php

class Client extends Controller
{
	private $folder = 'clients';
	private $entity = 'Client';
	
  public function __construct(){ parent::__construct();	}

	public function home()
	{
		Service::relocation($this->folder);
	}

	public function index($params)
	{
		$clientsCount = $this->model->getClientsCount();
		$data['pagination']['count'] = (int) $clientsCount[0]['count'];
		$data['pagination']['about'] = 'clients';
		
		$page = ($params && $params[0] > 0) ? (int) $params[0] : 1;
		$data['pagination']['page']  = $page;
		
		$start = ($page - 1) * LIMIT_ROWS;
		$data['pagination']['start'] = $start + 1;
		
		$clients = $this->model->getClientsPagination($start, LIMIT_ROWS);
		$data['clients'] = ( empty($clients) && !empty($params) ) ? null : $clients;
		
		$this->view->render($this->folder.'/index', $data);
	}
	
	public function search()
	{
		$post = Tool::sanitizer($_POST);
		
		if( $this->searchInputsValidate($post) )
		{
			$data['field']   = $post['field'];
			$data['content'] = $post['content'];
			$data['results'] = $this->model->searchClient($post['content'], $post['field']);
			if( count($data['results']) == 1 )
			{
				$idClient = $data['results'][0]['id'];
				Service::relocation('clients/casefile/'.$idClient);
			}
			$this->view->render($this->folder.'/found', $data);
		}
		else
		{
			$this->home();
		}
	}
	
	private function searchInputsValidate($form)
	{
		$inputs = ['field', 'content'];
		foreach( $inputs as $input )
		{
			if( !array_key_exists($input, $form) || empty( trim( $form[ $input ] ) ) )
			{
				return false;
			}
		}
		return true;
	}
	  
	public function add()
	{	
		$this->view->render($this->folder.'/add');
	}
	
	public function create()
	{
		Middleware::checkpoint(Session::get('kind'), ['admin','coord']);
		$post = Tool::sanitizer($_POST);
		if( $this->model->createClient($post) )
		{
			$idClient = $this->model->getClientLastInsert();
			if( Explorer::createGallery($idClient) )
			{
				Message::create('success', 'Client has been created');
				$this->home();
			}
			else
			{
				$status = 'warning';
				$text 	= 'Client created, but his gallery not: '.$idClient;
			}
		}
		else
		{
			$status = 'danger';
			$text 	= 'Check again the information';
		}
		Message::create($status, $text);
		Service::referer();
	}
	
	public function casefile($params)
  {
    $id = (int) $params[0] ?: null;
    $data['client'] = $this->model->getClient($id);

		$modelWork = Getter::model('work');
		$data['works'] = $modelWork->getWorksClient($id);
		
		if($data['works'])
		{
			foreach($data['works'] as $key => $work)
			{
				$idwork = (int) $work['id'];
				
				$modelInspection = Getter::model('inspection');
				$inspections = $modelInspection->getInspectionsWork($idwork);
				$data['works'][$key]['inspections'] = $inspections;
				
				$modelWarranty = Getter::model('warranty');
				$guarantees = $modelWarranty->getGuaranteesWork($idwork);
				$data['works'][$key]['guarantees'] = $guarantees;
			}
		}
		$this->view->render($this->folder.'/casefile', $data);
  }
	
	public function edit($params)
  {
    $id = (int) $params[0] ?: null;
    $data['client'] = $this->model->getClient($id);
    $this->view->render($this->folder.'/edit', $data);
  }
	
  public function update()
  {
		$post = Tool::sanitizer($_POST);
		$id = (int) $post['needle'];
		if( $this->model->updateClient($id, $post) )
		{
			$status = 'success';
			$text = 'Client has been updated';
		}
		else
		{
			$status = 'warning';
			$text = 'Check again the information';	
		}
		Message::create($status, $text);
		Service::referer();
  }
}
