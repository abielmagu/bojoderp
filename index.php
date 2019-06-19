<?php require_once 'init.php';

try
{
	Session::start();
	Service::reply( new Request($_GET) );
}
catch( Exception $e )
{
	echo "<pre>{$e->getMessage()}</pre>";
}