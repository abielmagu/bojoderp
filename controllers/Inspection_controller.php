<?php

class Inspection extends Controller
{
	private $folder = 'inspections';
	
  public function __construct()
	{
		parent::__construct();
	}

	public function home()
	{
		Service::relocation($this->folder);
	}

	public function index($params)
	{
		$data['date'] = isset($_GET['date']) ? $_GET['date'] : DATE_NOW;
		$data['inspections'] = $this->model->getInspections($data['date']);
		$data['pendings'] = $this->model->getInspectionsPendings();
		$this->view->render($this->folder.'/index', $data);
	}
	
	public function pending()
	{
		$data['pendings'] = $this->model->getInspectionsPendings();
		$this->view->render($this->folder.'/pending', $data);
	}

  public function add($params)
  {
    $id = $params ? (int) $params[0] : null;
    $data['work'] = $this->model->getWorkAddInspection($id);
    $this->view->render($this->folder.'/add', $data);
  }

  public function create()
  {
    $post = Tool::sanitizer($_POST);
		$post['neelde'] = (int) $post['needle'];
		if( $this->model->createInspection($post) )
		{
			Message::create('success', 'Inspection has been created');
			$this->home();
		}
		Message::create('danger', 'Check again the information');
		Service::referer();
  }

  public function edit($params)
  {
    $id = $params ? (int) $params[0] : null;
    $data['inspection'] = $this->model->getInspection($id);
    $this->view->render($this->folder.'/edit', $data);
  }

  public function update()
  {
    $post = Tool::sanitizer($_POST);
		$id = (int) $post['needle'];
		if( $this->model->updateInspection($id, $post) )
		{
			$status = 'success';
			$text 	= 'Inspection has been updated';
		}
		else
		{
			$status = 'warning';
			$text 	= 'Check again the information';		
		}
		Message::create($status, $text);
		Service::referer();
  }

}
