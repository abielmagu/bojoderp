<?php

class Intermediary extends Controller
{
	private $folder = 'intermediaries';

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
		$data['interms'] = $this->model->getIntermsAvailable();
		$this->view->render($this->folder.'/index', $data);
	}

	public function add()
	{
		$this->view->render($this->folder.'/add');
	}

	public function edit($params)
	{
		$id = (int) $params[0];
		$data['interm'] = $this->model->getInterm($id);
		$this->view->render($this->folder.'/edit', $data);
	}

	public function create()
	{
		$post = Tool::sanitizer($_POST);

		$post['nick'] = strtoupper($post['nick']);

		if( !$this->model->getIntermBy('nick', $post['nick']) )
		{
			$post['kind'] = 'interm';
			$modelUser = Getter::model('user');
			if( $modelUser->createUser($post) )
			{
				$iduser = $modelUser->getUserLastInsertId();
				$post['iduser'] = $iduser;
				if( $this->model->createInterm($post) )
				{
					Message::create('success', $post['nick'].' has been created');
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
				$text 	= 'Try with an other username';
			}
		}
		else
		{
			$status = 'warning';
			$text 	= 'Try with an other nickname';
		}
		Message::create($status, $text);
		Service::referer();
	}

	public function update()
	{
	    $post = Tool::sanitizer($_POST);
		$id['interm'] = (int) $post['needle'][0];
		$id['user'] 	= (int) $post['needle'][1];
		$post['nick'] = strtoupper($post['nick']);

		$result = $this->model->updateInterm($id['interm'], $post);
		Event::set($result, 'nickname');

		$newUsername = ($post['username'] !== $post['usernamePrev']) ? true : false;
		$newPassword  = (!empty($post['passwordNew'])) ? true : false;
		if($newUsername || $newPassword)
		{
			$modelUser = Getter::model('user');
			if($newUsername)
			{
				$result = $modelUser->updateUsername($id['user'], $post['username']);
				Event::set($result, 'username');
			}

			if($newPassword)
			{
				$result = $modelUser->updatePassword($id['user'], $post['passwordNew']);
				Event::set($result, 'new password');
			}
		}
		$generated = Message::generate(Event::get('updated'), 'Intermediary');
		Message::create($generated['status'], $generated['text']);
		Service::referer();
	}

	public function preremove($params)
	{
		$id = (int) $params[0];
		$data['interm'] = $this->model->getInterm($id);
		$this->view->render($this->folder.'/preremove', $data);
	}

	public function remove()
	{
	    $post = Tool::sanitizer($_POST);
		$id['interm'] = (int) $post['needle'][0];
		$id['user']   = (int) $post['needle'][1];

		$result = $this->model->removeInterm($id['interm']);
		Event::set($result, 'intermediary');
		if($result)
		{
			$modelUser = Getter::model('user');
			$result = $modelUser->updateEnable($id['user'], 0);
			Event::set($result, 'disabled');
		}

		$generated = Message::generate(Event::get('removed'), $post['name']);
		Message::create($generated['status'], $generated['text']);
	    if( $generated['status'] === 'success' )
	    {
	      $this->home();
	    }
		Service::referer();
	}
}
