<?php //namespace App;

class Session
{
  private function __construct(){ return false; }

  public static function start()
	{ 
		session_start();
	}
	
	/* SESSION DATA USER */
	public static function exists()
	{ 
		return isset($_SESSION['user']);
	}
	
	public static function create()
	{ 
		return $_SESSION['user'] = array();
	}
	
	public static function set($prop, $value = null)
	{
		if( is_string($prop) || is_int($prop) && !is_null($value) )
		{
			$_SESSION['user'][$prop] = $value;
			return true;
		}
		return false;
	}
	
	public static function get($prop)
	{
		if( isset($_SESSION['user'][$prop]) )
		{
			return $_SESSION['user'][$prop];
		}
		return false;
	}

	public static function remove($prop)
	{
		if( isset($_SESSION['user'][$prop]) )
		{
			unset($_SESSION['user'][$prop]);
			return true;
		}
		return false;
	}
	
  public static function destroy()
  {
		unset($_SESSION['user']);
		session_destroy();
  }
	
	
	/* SESSION DATA TEMPORALY */
	public static function setTemp($key, $value = null)
	{
		return $_SESSION[$key] = $value;
	}
	
	public static function existsTemp($key)
	{
		return isset($_SESSION[$key]);
	}
	
	public static function getTemp($key)
	{
		if( array_key_exists($key, $_SESSION) )
		{
			return $_SESSION[$key];
		}
		return false;
	}
	
	public static function removeTemp($key)
	{
		if( array_key_exists($key, $_SESSION) )
		{
			unset($_SESSION[$key]);
			return true;
		}
		return false;
	}
}
