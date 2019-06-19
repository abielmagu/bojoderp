<?php

class Formater
{
	public static function date($string)
	{
		if( !empty($string) && $string != DATE_ZERO )
		{
			return date(DATE_DISPLAY, strtotime($string));
		}
		return DATE_DISPLAY_ZERO;
	}
	
	public static function time($string)
	{
		if( !empty($string) && $string != TIME_ZERO )
		{
			return date(TIME_DISPLAY, strtotime($string));
		}
		return TIME_DISPLAY_ZERO;
	}
	
	public static function datetime($string)
	{
		if( !empty($string) && $string != DATETIME_ZERO )
		{
			return date(DATETIME_DISPLAY, strtotime($string));
		}
		return DATETIME_DISPLAY_ZERO;
	}
}