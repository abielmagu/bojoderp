<?php

class User extends Controller
{
  public function __construct(){ parent::__construct(); }

	// Live session
	public function home(){ return false;	}

	public function index($params)
	{
		$kind = Session::get('kind');
		$session = Getter::index($kind);
		$data = $session->getDashboard();
		$this->view->render('index', $data);
	}

	// Death session
  public function login()
	{
		$data['again'] = false;
		if( $data['again'] = Session::getTemp('again') ) Session::removeTemp('again');
		$this->view->render('index', $data, false);
	}

  public function logging()
  {
		$post = Tool::sanitizer($_POST);
		if( isset($post['username'], $post['password'], $post['token']) )
		{
			if( $user = $this->model->loggingUser($post) )
			{
				Session::create();
				Session::set('id' 		, (int) $user['id']);
				Session::set('name'	  , $user['name']);
				Session::set('kind'	  , $user['kind']);
				Session::set('updated', $user['updated_at']);
				$this->view->setSessionEnvironment($user['kind']);
			}
			else
			{
				Session::setTemp('again', true);
			}
		}
		Service::relocation();
  }

	public function logout()
	{
		Session::destroy();
		Service::relocation();
	}

	public function settings()
	{
		Middleware::checkpoint(Session::get('kind'), ['admin']);
		$data['username'] 	 = Session::get('name');
		$data['userUpdated'] = Session::get('updated');
		$this->view->render('settings', $data);
	}

  public function update()
  {
		Middleware::checkpoint(Session::get('kind'), ['admin']);

		$post 				= Tool::sanitizer($_POST);
		$post['username'] = Session::get('name');
		$id 					= Session::get('id');

		if( $this->model->verification($id, $post) )
		{
			if( !empty($post['passwordNew']) )
			{
				if($this->model->updatePassword($id, $post['passwordNew']))
				{
					$user = $this->model->getUser($id);
					Session::set('name', $user['name']);
					Session::set('kind', $user['kind']);
					Session::set('updated', $user['updated_at']);
					$status = 'success';
					$text   = 'Your account has been updated';
				}
				else
				{
					$status = 'warning';
					$text   = 'New password invalid';
				}
			}
			else
			{
				$status = 'success';
				$text   = 'Password confirmed';				
			}
		}
		else
		{
			$status = 'danger';
			$text   = 'Password incorrect';
		}
	  
		Message::create($status, $text);
		Service::referer();
  }

  public function shutdown()
  {
    require_once VIEWS.'user'.DS.'shutdown.php';
  }

	public function help()
	{
		$this->view->render('help');
	}
}
