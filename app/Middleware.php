<?php

class Middleware
{
	public function __construct(){ return false; }
	public function __destruct(){ return false; }
	public function __clone(){ return false; }
	
	static public function checkpoint($input, array $values)
	{
		if( !in_array($input, $values) )
		{
			Service::relocation('dashboard');
		}
		return true;
	}
	
	static public function denegate($input, array $values)
	{
		if( in_array($input, $values) )
		{
			Service::referer();
		}
		return false;
	}
	
	static public function paramsless($array, $relocation = true)
	{
		if( count($array) && $relocation )
		{
			Service::relocation();
		}
		return false;
	}
}