<?php

$server = array(
	'driver' => 'mysql',
	'host' 	 => 'localhost',
	'name' 	 => 'database',
	'user' 	 => 'user',
	'pass' 	 => 'password',
	'char' 	 => 'utf8',
	'port' 	 => 3306,
	'socket' => '',
);

$local = array(
	'driver' => 'mysql',
	'host' 	 => 'localhost',
	'name' 	 => 'testdb',
	'user' 	 => 'testeru',
	'pass' 	 => 'testerp',
	'char' 	 => 'utf8',
	'port' 	 => 3306,
	'socket' => '',
);

$tables = array(
	'clients' 	  => PREFIX.'_clients',
	'crews'		  	=> PREFIX.'_crews',
	'guarantees'  => PREFIX.'_guarantees',
	'inspections' => PREFIX.'_inspections',
	'interms'	  	=> PREFIX.'_intermediaries',
	'sessions'	  => PREFIX.'_sessions',
	'users'		  	=> PREFIX.'_users',
	'workers'	  	=> PREFIX.'_workers',
	'works'		  	=> PREFIX.'_works'
);


/*

MySQLi

// DB SERVER
define('DBTYPE', 'mysql');
define('DBHOST', 'localhost');
define('DBNAME', 'dbname');
define('DBUSER', 'dbuser');
define('DBPASS', 'dbpass');
define('DBCHAR', 'utf8');
define('DBPORT', 3306);
define('DBSCKT', '');

// DB LOCAL
define('DBTYPE', 'mysql');
define('DBHOST', 'localhost');
define('DBNAME', 'dbname');
define('DBUSER', 'tester');
define('DBPASS', 'tester');
define('DBCHAR', 'utf8');
define('DBPORT', 3306);
define('DBSCKT', '');

*/
