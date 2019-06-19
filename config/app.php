<?php

/* URLS */
# $domain = ($_SERVER['SERVER_NAME'] === 'localhost') ? 'localhost'.dirname($_SERVER['PHP_SELF']) : $_SERVER['SERVER_NAME'];
# $protocol = ( $domain !== 'localhost' && !isset($_SERVER['HTTPS']) ) ? 'https://' : 'http://';
if( $_SERVER['SERVER_NAME'] === 'localhost' )
{
	$protocol = 'http://';
	$domain = 'localhost'.dirname( $_SERVER['PHP_SELF'] );
}
else
{
	$protocol = 'https://';
	$domain = $_SERVER['SERVER_NAME'];
}
define('PROTOCOL', $protocol);
define('DOMAIN', PROTOCOL.$domain);
define('SOURCES', DOMAIN.'/sources');

/* OS */
define('DS', DIRECTORY_SEPARATOR); // Slashes OS
define('NL', chr(13).chr(10)); // New line

/* PATHS */
define('ROOT', realpath( dirname( dirname(__FILE__) ) ).DS );
define('APP', ROOT.'app'.DS);
define('CONTROLLERS', ROOT.'controllers'.DS);
define('MODELS', ROOT.'models'.DS);
define('VIEWS', ROOT.'views'.DS);
define('LIBRARY', ROOT.'libs'.DS);
define('GALLERY', ROOT.'sources'.DS.'gallery'.DS);

/* DEFAULTS */
define('CONTROLLER_DEFAULT', 'User');
define('METHOD_DEFAULT', 'index');
define('PREFIX', 'prefix');

/* LIMITS */
define('USERNAME_MIN', 5);
define('PASSWORD_MIN', 5);
define('LIMIT_ROWS', 20);
define('PAGINATION', 10);
