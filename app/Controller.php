<?php

abstract class Controller
{
  protected $view, $model = null;

  public function __construct()
  {
		$live = Session::get('kind') ?: 'user';
    $this->view  = self::getView($live);
		$this->model = self::getModel( get_class($this) );
  }
	
	private function getView($session){	return new View($session); }
	
	private function getModel($modelName)
	{
		$modelFile = $modelName.'_model.php';
    $modelRoute = MODELS.$modelFile;
		
    if( is_file($modelRoute) )
    {
      require_once $modelRoute;
			$modelClass = $modelName.'Model';
			return new $modelClass();
    }
		return false;
	}
	
	protected static function getNeedle($params)
	{
		if( !empty($params) )
		{
			$needle = (int) $params[0];
			if( is_int($needle) )
			{
				return $needle;
			}
		}
		return false;
	}
	
	// Default url
  abstract public function index($params);
	// Relocation to index
  abstract public function home();
}
