<?php 

class Model
{
  //ant - V22
  private $_registry; //V22
    protected $_db;
    protected $_db2; //V22
    
  public function __construct() {
    //ant - V22
    // $this->_db = new Database(); //comentado en V22
		$this->_registry = Registry::getInstancia(); //V22
    $this->_db = $this->_registry->_db;  //V22
    $this->_db2 = $this->_registry->_db2;  //V22
  }
}
