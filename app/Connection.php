<?php

class Connection
{
	public static $instance = null;
	
	public static function getInstance()
	{
		if( is_null(self::$instance) )
		{
			self::$instance = new Connection();
		}
		return self::$instance
	}
	
	
	private function __construct(){ return false; }
	private function __clone(){ return false; /* trigger_error() */ }
	private function __wakeup(){ return false; }
	private function __sleep(){ return false; }
}