<?php

class Helper
{
	public static function breakdown($variable, $named = 'unknown')
	{
		$typed  = ucwords(gettype($variable));
		$valued = ( is_array($variable) ) ? print_r($variable, true) : $variable;

		$result  = '<pre>Variable<br>';
		$result .= 'Name  = $'.$named	.'<br>';
		$result .= 'Type  = '	.$typed	.'<br>';
		$result .= 'Value = '	.$valued.'<br>';
		$result .= '</pre>';

		return $result;
	}

  public static function upperfirst($string)
  {
    $stringLower = strtolower($string);
    return ucwords($stringLower);
  }

  public static function spacesless($string)
  {
    $indicted = str_replace(' ', '', $string);
    return $indicted;
  }

  public static function trimmer($input, $default = false)
  {
    $value = trim($input);
    $amend = ( !empty($value) ) ? $value : $default ;
    return $amend;
  }

  public static function percentage($total, $part, $decimal = false)
  {
    if($total == 0 && $part == 0)
    {
      $percent = 100;
    }
    elseif($total == 0 || $part == 0)
    {
      $percent = 0;
    }
    else
    {
      $calculation = ( $part / $total ) * 100;
      $percent = ($decimal) ? round($calculation, $decimal) : floor($calculation);
    }
    return $percent;
  }

	public static function notSupportedBrowser()
	{
		$notSupported = $GLOBALS['notSupported'];
		foreach ($notSupported as $browser)
		{
			if ( stripos(COMPANY_BROWSER, $browser) )
			{
				return true;
				break;
			}
		}
		return false;
	}
}
