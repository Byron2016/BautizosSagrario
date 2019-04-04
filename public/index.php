<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);
/*
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

var_dump(filter_var('bob@example.com', FILTER_VALIDATE_EMAIL));
var_dump(filter_var('bgva2005@yahoo.com', FILTER_VALIDATE_EMAIL));
exit;
*/
try {
	require_once APP_PATH . 'Acl.php'; //V15
	require_once APP_PATH . 'Config.php';
	require_once APP_PATH . 'Request.php';
	require_once APP_PATH . 'Bootstrap.php';
	require_once APP_PATH . 'Controller.php';
	require_once APP_PATH . 'Model.php';
	require_once APP_PATH . 'View.php';
	require_once APP_PATH . 'DataBase.php';
	require_once APP_PATH . 'Session.php'; //V7
	require_once APP_PATH . 'Hash.php'; //V10
	require_once APP_PATH . 'Registry.php'; //V22

	
	
/*
	require 'path/to/PHPMailer/src/Exception.php';
	require 'path/to/PHPMailer/src/PHPMailer.php';
	require 'path/to/PHPMailer/src/SMTP.php';

	require_once ROOT . 'libs' . DS . 'PHPMailer/src' . DS . 'Exception' . '.php';
	require_once ROOT . 'libs' . DS . 'PHPMailer/src' . DS . 'PHPMailer' . '.php';
	require_once ROOT . 'libs' . DS . 'PHPMailer/src' . DS . 'SMTP' . '.php';

	$this->getLibrary('Exception','PHPMailer/src');
	$this->getLibrary('PHPMailer','PHPMailer/src');
	$this->getLibrary('SMTP','PHPMailer/src');
*/
//exit;
	// echo Hash::getHash('md5','tete',HASH_KEY); //V10
	// echo Hash::getHash('sha1','tete',HASH_KEY); //V10
	Session::init(); //V7
    //echo "index.php antes Bootstrap "  . '<br>'; 
	//Bootstrap::run(new Request); //Comentado en V22
	Bootstrap::run($registry->_request); //V22
	//echo "index.php despues Bootstrap "  . '<br>'; 

} catch(Exception $e) {
	echo $e->getMessage();
}