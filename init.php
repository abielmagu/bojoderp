<?php

require_once 'config/server.php';
require_once 'config/payment.php';
require_once 'config/dates.php';
require_once 'config/client.php';
require_once 'config/app.php';
require_once 'config/globals.php';
require_once 'config/theme.php';

// AUTOLOAD CLASSES
spl_autoload_register( function($fileName)
{
  $fileRoute = APP.$fileName.'.php';
  if( is_file($fileRoute) ){ require_once $fileRoute; }
});

// LOAD CLASSES
#require_once 'app/Session.php';
#require_once 'app/Service.php';
#require_once 'app/Request.php';
#require_once 'app/Controller.php';
#require_once 'app/Model.php';
#require_once 'app/View.php';
#require_once 'app/Explorer.php';
#require_once 'app/Helper.php';

#Helper::arrayBreakdown( get_included_files() );
#Helper::arrayBreakdown($_SERVER);

/* HELPS
http://php.net/manual/en/function.spl-autoload-register.php
https://www.airpair.com/php/fatal-error-allowed-memory-size
*/