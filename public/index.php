<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);

try {
	require_once APP_PATH . 'Config.php';
	require_once APP_PATH . 'Request.php';
	require_once APP_PATH . 'Bootstrap.php';
	require_once APP_PATH . 'Controller.php';
	require_once APP_PATH . 'Model.php';
	require_once APP_PATH . 'View.php';
	require_once APP_PATH . 'Register.php';
	require_once APP_PATH . 'DataBase.php';
	require_once APP_PATH . 'Session.php'; //V7
	require_once APP_PATH . 'Hash.php'; //V10

	// echo Hash::getHash('md5','tete',HASH_KEY); //V10
	// echo Hash::getHash('sha1','tete',HASH_KEY); //V10
	Session::init(); //V7
    
    Bootstrap::run(new Request);

} catch(Exception $e) {
	echo $e->getMessage();
}