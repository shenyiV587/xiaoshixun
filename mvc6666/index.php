<?php 
header("content-type:text/html;charset=utf-8");

define('DS', str_replace("\\", "/", realpath('')));

define('APP', DS."/Application");

define('CORE',DS.'/Core');

define('DEBUG', true);

if (!DEBUG) {
	error_reporting(0);
}

$_SERVER['config'] = include DS.'/Common/config.php';

include DS.'/Common/function.php';

include CORE.'/core.php';

spl_autoload_register('\Core\core::load');

\Core\core::run();



 ?>