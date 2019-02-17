<?php
//V9
class loginModel extends Model
{
    public function __construct() {
        //V9
        parent::__construct();
    }
    
    public function getUsuario($usuario, $password){
        //V9
        $datos = $this->_db->query(
            "select * from usuarios " . 
            "where usuario = '$usuario' " .
            "and pass = '" . md5($password) . "'"
            );
        /*
        $datos = $this->_db->query(
                "select * from usuarios " . 
                "where usuario = '$usuario' " .
                "and pass = '" . Hash::getHash('md5',$password,HASH_KEY) . "'"
                );
        */
        return $datos->fetch();
    }
    
    
}