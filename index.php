<?php
session_start();
$params = explode('/', $_SERVER['REQUEST_URI']);
($params[2]=='exporttoPdf') ? '' : ob_start('ob_gzhandler');

function ob_html_compress($buf){
    return preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
}

ob_start("ob_html_compress");
define('APPS_NAME','casamaktok');
define('SERVER_ROOT', 'D:/wamp/www/'.APPS_NAME.'/');
define('VIEW', 'application/views');
define('CONTROLLER', 'application/controllers');
define('MODEL', 'application/models');
define('INCLUDES', 'application/includes');
define('SITE', 'application/');
define('SCRIPTS', 'application/views/scripts/');
define('SITE_ROOT', 'http://localhost:81/'.APPS_NAME.'/');
define('URL_ARRAY','2');

require_once(SERVER_ROOT . 'application/controllers/' . 'router.php');
 ob_end_flush();
?>