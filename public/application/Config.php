<?php 

// anteriores - V10
   
define('DEFAULT_CONTROLLER', 'index'); //controlador por defecto de la aplicación en caso de no enviarse en aplicación.
define('DEFAULT_METODO', 'index');
define('BASE_URL', 'http://SagrarioBautizos.net/');
//CONSTANTE PARA INCLUIR ARCHIVOS DEL LADO DEL USUARIO, DEL LADO DE LAS VISTAS
//define('DEFAULT_LAYOUT', 'default');
define('DEFAULT_LAYOUT', 'layout1');
define('APP_NAME', 'BAUTIZOS EL SAGRARIO');
define('APP_SLOGAN', 'FRAMEWORK php mvc');
define('APP_COMPANY', 'SagrarioBautizos.net');
//parametros para base de datos:
    define('DB_HOST', 'localhost');
    define('DB_USER', 'homestead');
    define('DB_PASS', 'secret');
    define('DB_NAME', 'ba_sag_2019');
    define('DB_CHAR', 'utf8');
    define('DB_PORT', '3306');
//sesiones
define('SESSION_TIME', 10); //V8
//hash key
define('HASH_KEY', '5806aed8e2552'); //V10 //echo uniqid();exit; //5806aed8e2552
//define('ROLL_DEFECTO', 'usuario'); //V10 comentado en V15
define('ROLL_DEFECTO', '1'); //V15
//define('ESTADO_DEFECTO', '1'); //V10
define('ESTADO_DEFECTO', '0'); //V11