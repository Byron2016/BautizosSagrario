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
/*
//V23 __autoload deprecated, usar spl_autoload_register
function __autoload($class){ 
	include APP_PATH . $class . '.php';
}
*/
try {
	/*
spl_autoload_register(function ($class) {
	//V23
	echo "llamando a la clase: " . ucfirst(strtolower($class)) . "<br>";
    include APP_PATH . ucfirst(strtolower($class)) . '.php';
});
*/
	require_once APP_PATH . 'Autoload.php'; //V23
	require_once APP_PATH . 'Config.php';
	/*
	//comentado en V23
	require_once APP_PATH . 'Acl.php'; //V15
	
	require_once APP_PATH . 'Request.php';
	require_once APP_PATH . 'Bootstrap.php';
	require_once APP_PATH . 'Controller.php';
	require_once APP_PATH . 'Model.php';
	require_once APP_PATH . 'View.php';
	require_once APP_PATH . 'DataBase.php';
	require_once APP_PATH . 'Session.php'; //V7
	require_once APP_PATH . 'Hash.php'; //V10
	require_once APP_PATH . 'Registry.php'; //V22
	*/

	
	
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
	$registry = Registry::getInstancia(); //V22
	$registry->_request = new Request(); //V22
	$registry->_db = new Database(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASS, DB_CHAR); //V22
	$registry->_aclR = new ACL(); //V22
	$registry->_db2 = new Database(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASS, DB_CHAR); //V22

    //echo "index.php antes Bootstrap "  . '<br>'; 
	//Bootstrap::run(new Request); //Comentado en V22
	Bootstrap::run($registry->_request); //V22
	//echo "index.php despues Bootstrap "  . '<br>'; 

} catch(Exception $e) {
	echo $e->getMessage();
}