<?php 
// V22
//almacenar clases compartidas aca las guardamos 
// y cuando las necesitamos accedesn al registro a buscar estos objetos.
Class Registry
{
	private static $_instancia; //guarda instancia del registro y usamos singleton para asegurarnos q en apliccion exista solo un objeto del registro
	private $_data; //clases a ser almacenadas en el registro
	private function _construct()
	{
		//private para que no se pueda crear una instancia de la clase unica forma es desde dentro de la clase
		//$this->_data = array();
	}
	
	//singleton
	public static function  getInstancia()
	{
		//V22
		if(!self::$_instancia instanceof self){
			self::$_instancia = new Registry();
		}
		return self::$_instancia;
	}
	//sobreescribir metodos magicos get y set de la clase
	public function __set($name, $value){
		//V22
		$this->_data[$name] = $value;
	}
	public function __get($name){
		//V22
		if(isset($this->_data[$name])){
			return $this->_data[$name];
		}
		return false;
	}
}

$registry = Registry::getInstancia(); //V22
$registry->_request = new Request(); //V22
//$registry->_db = new Database(); //V22
$registry->_db = new Database(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASS, DB_CHAR); //V22
$registry->_aclR = new ACL(); //V22
//PARA CREAR CONEXION A NUEVA BASE DE DATOS
$registry->_db2 = new Database(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASS, DB_CHAR); //V22