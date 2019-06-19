<?php
class Event
{
	public static function log($text)
	{
		$log = ROOT.'log.txt';
		$mode = is_file($log) ? 'a+' : 'w';
		$datetime = '['.DATETIME_NOW.']-> ';
		$format = $mode === 'w' ? $datetime.$text : NL.$datetime.$text;
		$fopen = fopen($log, $mode);
		fwrite($fopen, $format);
		fclose($fopen);
	}
	
	// Keys: 0 = false & 1 = true
	public static $events = array(0 => [], 1 => []);
	
	public static function set($happen, $description)
	{
		$key = ($happen) ? 1 : 0;
		array_push(self::$events[$key], $description);
	}
	
	public static function get($crud)
	{
		$result[$crud] = self::$events;
		return $result;
	}
	
	private static function reset()
	{
		self::$events[0] = [];
		self::$events[1] = [];
	}
}