<?php

class Request
{
  private $controller, $method, $params;
	private $routes;

  public function __construct($url)
  {
		require ROOT.'classified/routes.php';
		$this->routes = $routes;

    $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    $url = array_filter($url);

		if( Session::exists() && !SHUTDOWN )
		{
			$this->controller = self::router($url)	 ?: CONTROLLER_DEFAULT;
			$this->method     = self::methoder($url) ?: METHOD_DEFAULT;
		}
    elseif( SHUTDOWN )
    {
      $this->controller = CONTROLLER_DEFAULT;
			$this->method     = 'shutdown';
    }
		else
		{
			$this->controller = CONTROLLER_DEFAULT;
			$this->method     = self::methoder($url, false) ? 'logging' : 'login';
		}
		$this->params = self::parameter($url);
  }

	private function router(&$url)
	{
		if( count($url) && array_key_exists($url[0], $this->routes))
		{
			$key = array_shift($url);
			return $this->routes[$key];
		}
		return false;
	}

	private function methoder(&$url, $shift = true)
	{
		if( count($url) && !empty($url[0]) )
		{
			return ($shift && !is_numeric($url[0])) ? array_shift($url) : $url[0];
		}
		return false;
	}

	private function parameter(&$url)
	{
		return ( count($url) ) ? $url : array();
	}

  public function getController()
  {
		return ucfirst( strtolower( trim($this->controller) ) );
  }

  public function getMethod()
  {
		return strtolower($this->method);
  }

  public function getParams()
  {
		return $this->params;
  }
}
