<?php
class ajaxModel extends Model
{
    //V14

    public function __construct() {
        //V14
        parent::__construct();
    }
    public function getPaises()
    {
        //V14
    	$paises = $this->_db->query("select * from paises");
    	return $paises->fetchall();
    }
    public function getCiudades($pais)
    {
        //V14
    	$ciudades = $this->_db->query("select * from ciudades where pais ={$pais}");
    	$ciudades->setfetchMode(PDO::FETCH_ASSOC);
        return $ciudades->fetchall();
    }

    public function insertarCiudad($ciudad, $pais)
    {
        //V14
        
        $sql = "Dentro de insertarCiudad  insert into ciudades values (null, '$ciudad', $pais)";
        //echo $sql;
    	//$paises = $this->_db->query("insert into ciudades values (null, '$ciudad', $pais)");
        //return $sql;
        
        $this->_db->prepare("INSERT INTO ciudades VALUES (null, :ciudad, :pais)")
        ->execute(
                array(
                   ':ciudad' => $ciudad,
                   ':pais' => $pais,
                ));

    }
}