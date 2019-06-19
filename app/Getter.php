<?php

class Getter
{
	public static function index($session)
	{
		$sessions =  array('admin' => 'Admin', 'coord' => 'Admin', 'crew' => 'Crew', 'interm' => 'Intermediary');
		$indexName = $sessions[ $session ];
		$indexPath = CONTROLLERS.$indexName.'_index.php';
		if( is_file($indexPath) )
		{
			require_once $indexPath;
			$indexInstance = $indexName.'Index';
			return new $indexInstance();
		}
		return false;
	}
	
	public static function model($name)
	{
		$modelName = ucfirst( strtolower($name) );
		$modelPath = MODELS.$modelName.'_model.php';
		if( is_file($modelPath) )
		{
			require_once $modelPath;
			$modelInstance = $modelName.'Model';
			return new $modelInstance();
		}
		return false;	
	}
	
	public static function modelKind($name)
	{
		$exploded  = explode('_', $name);
		$modelKindName = implode('', array_map('ucfirst', $exploded));
		#$result = array_map(function($data) { return ucwords($data); }, $array);
		$modelKindPath = MODELS.'/kinds/'.$modelKindName.'_model.php';	
		if( is_file($modelKindPath) )
		{
			require_once $modelKindPath;
			$modelKindInstance = $modelKindName.'Model';
			return new $modelKindInstance();
		}
		return false;
	}
}