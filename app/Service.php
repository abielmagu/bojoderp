<?php

class Service
{
  static public function reply( Request $request )
  {
    $controllerName   = $request->getController();
    $controllerMethod = $request->getMethod();
    $controllerParams = $request->getParams();
		$controllerFile 	= $controllerName.'_controller.php';
    $controllerRoute  = CONTROLLERS.$controllerFile;
		
    if( is_readable($controllerRoute) )
    {			
      require_once $controllerRoute;
      $controllerClass = new $controllerName();

      if( !is_callable(	array($controllerClass, $controllerMethod) ) )
			{ $controllerMethod = METHOD_DEFAULT; }

			$controllerAction = array($controllerClass, $controllerMethod);
      call_user_func($controllerAction, $controllerParams);
    }
    else
    {
      throw new Exception(__CLASS__.': Controller not found...', 1);
    }
  }

  static public function relocation($url = '')
  {
		$relocation = DOMAIN.DS.$url;
        header('location: '.$relocation);
		exit();
  }
	
	static public function referer()
	{
		if( isset($_SERVER['HTTP_REFERER']) )
		{
			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit();
		}
		self::relocation();
	}
	# $referer = base64_encode($_SERVER['HTTP_REFERER']) ?: trim($_POST['referer']) ?: false; 

  static private function historyback()
  {
    echo '<script>window.history.back();</script>';
  }
}
