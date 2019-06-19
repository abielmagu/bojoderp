<?php

class Worker extends Controller
{
	private $folder = 'workers';
	
  public function __construct(){ parent::__construct(); }
  
	public function home()
	{
		Service::relocation($this->folder);
	}
	
	public function index($params)
	{
		$data['workers'] = $this->model->getWorkers();
		$this->view->render($this->folder.'/index', $data);
	}
	
	public function add()
	{
		$this->view->render($this->folder.'/add');
	}
	
	public function edit($params)
	{
		$id = (int) $params[0] ?: null;
		$data['worker'] = $this->model->getWorker($id);
		$this->view->render($this->folder.'/edit', $data);
	}
	
	public function preremove($params)
	{
		$id = (int) $params[0] ?: null;
		$data['worker'] = $this->model->getWorker($id);
		$this->view->render($this->folder.'/preremove', $data);
	}
	
	public function create()
	{
		$post = Tool::sanitizer($_POST);
		if( $this->model->createWorker($post) )
		{
			Message::create('success', $post['name'].' '.$post['lastname'].' has been created');
			$this->home();
		}
		else
		{
			Message::create('warning', 'Check again the information');
			Service::referer();
		}
	}
	
	public function update()
	{
		$post = Tool::sanitizer($_POST);
		$id = (int) $post['needle'];
		if( $this->model->updateWorker($id, $post) )
		{
			Message::create('success', $post['name'].' '.$post['lastname'].' has been updated');
		}
		else
		{
			Message::create('warning', 'Check again the information');
		}
		Service::referer();
	}
	
	public function remove()
	{
		$post = Tool::sanitizer($_POST);
		$id = (int) $post['needle'];

		if( $this->model->removeWorker($id) )
		{
			Message::create('success', $post['fullname'].' has been removed');
			$this->home();
		}
		else
		{
			Message::create('danger', $post['fullname'].' worker could not remove');
			Service::referer();
		}
	}
}
