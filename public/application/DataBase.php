<?php
class DataBase extends  PDO
{
        
        //Antes hacer cambio para más de una base de datos //22
	public function __construct()
	{
                $var = 'mysql:host=' . DB_HOST . 
                ';dbname=' . DB_NAME.
                ';port=' . DB_PORT.','.DB_USER.','. DB_PASS;
                //echo $var;
        
        parent::__construct(
                'mysql:host=' . DB_HOST . 
                ';dbname=' . DB_NAME.
                ';port=' . DB_PORT,
                DB_USER, 
                DB_PASS, 
                array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR 
                ));
        
	}
        
/*
        public function __construct($host, $dbname,  $port, $user, $pass, $char)
        {
        parent::__construct(
                'mysql:host=' . $host . 
                ';dbname=' . $dbname.
                ';port=' . $port,
                $user, 
                $pass, 
                array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $char 
                ));
        
        }
*/
} 