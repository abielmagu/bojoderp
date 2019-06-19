<?php

class View
{
	private $environment, $template;
	private $share = array('admin', 'coord');
	
  public function __construct($session){ self::setSessionEnvironment($session); }

	public function render($view, $data = [], $navs = true)
	{
		$this->template = $this->environment.$view.'.php';
		
		if( is_readable($this->template) )
		{
			require_once VIEWS.'app/layouts/header.php';
			if($navs){   $this->getNavbar(); }
			require_once VIEWS.'app/layouts/container-open.php';
			if($navs){   $this->getNav(); }
			require_once $this->template;
			require_once VIEWS.'app/layouts/container-close.php';
			require_once VIEWS.'app/layouts/footer.php';
		}
		else
		{
      throw new Exception(__CLASS__.": {$this->template} not found", 1);
    }
	}
	
	public function renderTemplate($path)
	{
		$template = $this->environment.$path.'.php';
		require_once $template;
	}
	
	public function setSessionEnvironment($session)
	{
		if( in_array($session, $this->share) )
		{
			$this->environment = VIEWS.'admin'.DS;
		}
		else
		{
			$this->environment = VIEWS.$session.DS;
		}
	}
	
	private function getNavbar()
	{
		$navbar = $this->environment.'navbar.php';
		if( file_exists($navbar) )
		{ 
			require_once $navbar; 
		}
	}
	
	private function getNav()
	{
		$nav = $this->environment.'nav.php';
		if( file_exists($nav) )
		{ 
			require_once $nav;
		}	
	}
}
