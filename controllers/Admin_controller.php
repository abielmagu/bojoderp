<?php

 class Admin extends Controller
 {
	 private $folder = 'administrators';
		 
	 public function __construct()
	 {
		 Middleware::checkpoint(Session::get('kind'), ['admin']);
		 parent::__construct();
	 }
	 
	 public function home()
	 {
		 Service::relocation($this->folder);
	 }
	 
	 public function index($params)
	 {
		 $data['admins'] = $this->model->getAdmins();
		 $this->view->render($this->folder.'/index', $data);
	 }
	 
	 public function add()
	 {
		 $this->view->render($this->folder.'/add');
	 }
	
	 public function create()
	 {
		 $post = Tool::sanitizer($_POST);
		 $post['kind'] = ($post['kind'] === 'admin') ?: 'coord';
		 $modelUser = Getter::model('user');

		 if($modelUser->createUser($post))
		 {
			 $kind = ($post['kind'] === 'admin') ? 'Administrator' : 'Coordinator';
			 Message::create('success', $kind.' has been created');
			 $this->home();
		 }
		 elseif($modelUser->getErrorDuplicate())
		 {
			 $status = 'warning';
			 $text 	 = 'Username is used, try with other';		 
		 }
		 else
		 {
			 $status = 'danger';
			 $text 	 = 'Check again the information';	 
		 }
		 Message::create($status, $text);
		 Service::referer();
	 }
	 
	 public function edit($params)
	 {
		 $id = self::getNeedle($params);
		 Middleware::denegate(Session::get('id'), [$id]);
		 
		 $data['admin'] = $this->model->getAdmin($id);
		 $this->view->render($this->folder.'/edit', $data);
	 }
	 
	 public function update()
	 {
		 $post = Tool::sanitizer($_POST);
		 $id 	 = (int) $post['needle'];
		 Middleware::denegate(Session::get('id'), [$id]);
		 
		 $modelUser = Getter::model('user');
		 if( !isset($post['disabled']) )
		 {
			 	$post['kind'] = ($post['kind'] === 'admin') ?: 'coord';
			 	$happen = $this->model->updateAdmin($id, $post);	 
			 	Event::set($happen, 'type of administrator');
				if( $post['username'] !== $post['usernamePrev'] )
				{
					$happen = $modelUser->updateUsername($id, $post['username']);
					Event::set($happen, 'username');
				}

				if( !empty($post['passwordNew']) )
				{
					$happen = $modelUser->updatePassword($id, $post['passwordNew']);
					Event::set($happen, 'new password');
				}
		 }
		 else
		 {
				$happen = $modelUser->updateEnable($id, 0);
			 	Event::set($happen, 'disabled');
		 }
		 $generated = Message::generate(Event::get('updated'), 'Administrator');
		 Message::create($generated['status'], $generated['text']);
		 Service::referer();
	 }
 }