<?php

class Message
{
	public static function create($status, $text)
	{
		$message = array();
		$message['class'] = self::getClass($status);
		$message['icon']  = self::getIcon($status);
		$message['text'] 	= trim($text);
		return Session::set('message', $message);
	}
	
	private static function getClass($key)
	{
		$colors = array(
			'success' => 'alert alert-success',
			'info' 		=> 'alert alert-info',
			'warning' => 'alert alert-warning',
			'danger' 	=> 'alert alert-danger',
		);
		return $colors[$key];
	}
	
	private static function getIcon($key)
	{
		$icons = array(
			'success' => 'glyphicon glyphicon-ok',
			'info' 		=> 'glyphicon glyphicon-asterisk',
			'warning' => 'glyphicon glyphicon-bullhorn',
			'danger' 	=> 'glyphicon glyphicon-remove',
		);
		return $icons[$key];
	}
	
	public static function generate($events, $entity)
	{
		$action = key($events);
		$generated = array();
		
		#var_dump(count($events[$action][0]));
		if(!count($events[$action][0]))
		{
			$generated['status'] = 'success';
			$generated['text'] 	 = $entity.' has been '.$action;
		}
		elseif(count($events[$action][1]))
		{
			$concepts = implode(', ', $events[$action][0]);
			$generated['status'] = 'warning';
			$generated['text']   = $entity.' was '.$action.'... but not on this: <b>'.$concepts.'</b>';
		}
		else
		{
			$concepts = implode(', ', $events[$action][0]);
			$generated['status'] = 'warning';
			$generated['text'] 	 = 'Hmm... try with an others values on: <b>'.$concepts.'</b>';		
		}
		return $generated;
	}
}