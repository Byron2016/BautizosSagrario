<?php
class ajaxController extends Controller
{
    //V14
	private $_ajax;
	
	public function __construct()
	{
        //V14
		parent::__construct();
		$this->_ajax = $this->loadModel('ajax');
	}
	public function index()
	{
        // V14

        $this->_view->assign('titulo','Ejemplo de AJAX');
            
        $this->_view->assign('paises' , $this->_ajax->getPaises());

        $this->_view->setJs(array('ajax'));
        $this->_view->renderizar('index');
	}
	public function getCiudades()
	{
        // V14
		//echo "Hola estuve en getCiudades buscar pais id: " . $this->getInt('pais');
		
		if($this->getInt('pais'))
		{
			//echo "a";
			echo json_encode($this->_ajax->getCiudades($this->getInt('pais')));
		}
		/*
		else
			echo 'esta en el else';
			*/
	}
	public function insertarCiudad()
	{
        // V14
		//echo "antes if";
		//echo " <script language=’JavaScript’>   alert(‘JavaScript dentro de PHP’); </script>";
		if($this->getInt('pais') && $this->getSql('ciudad'))
		{
			//$a = $this->_ajax->insertarCiudad($this->getSql('ciudad'), $this->getInt('pais'));
			$a = $this->_ajax->insertarCiudad(
                    $this->getSql('ciudad'),
                    $this->getInt('pais')
                    );
			//echo $a;
			echo "Si pudo insertar valor de pais: " . $this->getInt('pais') . " valor de ciudad " . $this->getSql('ciudad');
		} else {
			echo "No pudo insertar valor de pais: " . $this->getInt('pais') . " valor de ciudad " . $this->getSql('ciudad');
		}
	}
}