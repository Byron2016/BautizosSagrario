<?php

class registroModel extends Model
{
    //V10 - V11

    public function __construc()
    {
		echo '<br> Dentro del constructor de registroModel <br><br>';
    	parent::__construc();
	}
	/*
    public function verificarUsuario($usuario)
    {
        //V10 
		//si usuario ya existe en base de datos no deja que se vuelva a registrar
		//echo "<br>";
		//echo "select id from usuarios where usuario = '$usuario'";
		//echo "<br>";
    	$id = $this->_db->query(
    			"select id from usuarios where usuario = '$usuario'"
    		);
    	if ($id->fetch()) 
    	{
    		return true;
    	}
    	return false;
	}
	*/

	public function verificarUsuario($usuario)
    {
        //V11 
		//si usuario ya existe en base de datos no deja que se vuelva a registrar
		//echo 'entro a verificarUsuario <br> ' . "select id, codigo from usuarios where usuario = '$usuario'";

    	$id = $this->_db->query(
    			"select id, codigo from usuarios where usuario = '$usuario'"
    		);
		return $id->fetch();

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
		//V10 - V11 
		$random = rand(178259847, 999999999);
		/*
		echo "<br>";
		$sql = "insert into usuarios values " ;
		$sql = $sql . "(null, '$nombre', '$usuario', '" . Hash::getHash('md5', $password, HASH_KEY)."', ";
		$sql = $sql . "' $email', '" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now(), $random)";
		echo $sql;
		echo "<br>";
		*/

    	$this->_db->prepare(
    			"insert into usuarios values" .
    			"(null, :nombre, :usuario, :pass, :email,'" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now(), :codigo)"
    			)
    			->execute(array(
    				':nombre' => $nombre,
    				':usuario' => $usuario,
    				':pass' => Hash::getHash('md5', $password, HASH_KEY),
					':email' => $email,
					':codigo' => $random,
    				));
	}
	
	public function getUsuario($id, $codigo)
    {
        //V11 
		//echo "select * from usuarios where id = $id and codigo =  '$codigo'";
    	$usuario = $this->_db->query(
    			"select * from usuarios where id = $id and codigo =  '$codigo'"
    		);
		return $usuario->fetch();

	}

	public function activarUsuario($id, $codigo)
    {
        //V11 
		//echo "DENTRO ACTIVARUSUARIO DE REGISTRO MODEL id = $id and codigo =  '$codigo'";
    	$usuario = $this->_db->query(
				"update usuarios set estado = 1 " .  
				"where id = $id and codigo =  '$codigo'"
    		);

	}
}