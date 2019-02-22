<?php
class registroModel extends Model
{
    //V10 

    public function __construc()
    {
    	parent::__construc();
    }
    public function verificarUsuario($usuario)
    {
        //V10 
		//si usuario ya existe en base de datos no deja que se vuelva a registrar
		echo "<br>";
		echo "select id from usuarios where usuario = '$usuario'";
		echo "<br>";
    	$id = $this->_db->query(
    			"select id from usuarios where usuario = '$usuario'"
    		);
    	if ($id->fetch()) 
    	{
    		return true;
    	}
    	return false;
	}
	
    public function verificarEmail($email)
    {
    	$id = $this->_db->query(
    			"select id from usuarios where email = '$email'"
    		);
    	if ($id->fetch()) 
    	{
    		return true;
    	}
    	return false;
	}
	
    public function registrarUsuario($nombre, $usuario, $password, $email)
    {
		//V10 
		/*
		echo "<br>";
		$sql = "insert into usuarios values" ;
		$sql = $sql . "(null, :nombre, :usuario, :pass, :email,'" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now())";
		echo $sql;
		echo "<br>";
		*/
    	$this->_db->prepare(
    			"insert into usuarios values" .
    			"(null, :nombre, :usuario, :pass, :email,'" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now())"
    			)
    			->execute(array(
    				':nombre' => $nombre,
    				':usuario' => $usuario,
    				':pass' => Hash::getHash('md5', $password, HASH_KEY),
    				':email' => $email
    				));
    }
}