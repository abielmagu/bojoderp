<?php

class Tool
{		
	public static function minimum($input, $minimum = 0)
	{
		$spaceless = str_replace(' ', '', $input);
		$value = ( !empty($spaceless) ) ? $spaceless : false;
		if( is_string($value) && strlen($value) >= $minimum)
		{
			return $value;
		}
		return false;
	}
	
	public static function sanitizer($vars)
  {
		if( is_array($vars) )
		{
			$healed = array();
			foreach($vars as $key=>$value)
			{
				if( is_array($value) )
				{
					foreach($value as $k => $v)
					{
						if( !is_array($v) )
						{
							$value[$k] = self::cure($v);
						}
					}
					$healed[$key] = $value;
				}
				else
				{
					$healed[$key] = self::cure($value);
				}
			}
		}
		else
		{
			$healed = self::cure($vars);
		}
		return $healed;
  }
	
	private static function cure($value)
	{
		$striped = stripslashes($value);
		return htmlspecialchars($striped, ENT_QUOTES, 'utf-8');	
	}
	
	public static function encrypt($string)
	{
		require ROOT.'classified/keys.php';
		$encrypted = sha1( md5($string).'$@'.$salt );
		return $encrypted;
	}
}