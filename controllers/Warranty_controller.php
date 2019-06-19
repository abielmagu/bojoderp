<?php

class Warranty extends Controller
{
	private $folder = 'guarantees';
	
  public function __construct(){ parent::__construct();	}

	public function home()
	{
		Service::relocation($this->folder);
	}

	public function index($params)
	{
		$data['date'] = isset($_GET['date']) ? $_GET['date'] : DATE_NOW;
		$data['guarantees'] = $this->model->getGuarantees($data['date']);
		$data['pendings'] = $this->model->getGuaranteesPendings();
		$this->view->render($this->folder.'/index', $data);
	}
	
	public function pending()
	{
		$data['pendings'] = $this->model->getGuaranteesPendings();
		$this->view->render($this->folder.'/pending', $data);
	}

  public function add($params)
  {
    $id = $params ? (int) $params[0] : false;
		$data['work'] = $this->model->getWorkAddWarranty($id);
    $this->view->render($this->folder.'/add', $data);
  }

  public function create()
  {
    $post = Tool::sanitizer($_POST);
		$post['needle'] = (int) $post['needle'];
		if( $this->model->createWarranty($post) )
		{
			Message::create('success', 'Warranty has been created');
			$this->home();
		}
		Message::create('danger', 'Check again the information');
		Service::referer();
  }

  public function edit($params)
  {
    $id = (int) $params[0];
    $data['warranty'] = $this->model->getWarranty($id);
    $this->view->render($this->folder.'/edit', $data);
  }
	
	public function update()
	{
		$post = Tool::sanitizer($_POST);
		$id = (int) $post['needle'];
		if($this->model->updateWarranty($id, $post))
		{
			$status = 'success';
			$text = 'Warranty has been updated';
		}
		else
		{
			$status = 'warning';
			$text = 'Check the information again';		
		}
		Message::create($status, $text);
		Service::referer();
	}
}
