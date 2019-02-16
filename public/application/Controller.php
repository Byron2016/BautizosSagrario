<?php 

abstract class Controller
{
    protected $_view;
    
	public function __construct()
	{
		$this->_view = new View(new Request);
    }
    
    abstract public function index();


    protected function loadModel($modelo, $modulo = false) 
    {
        $modelo = $modelo . 'Model';
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';
        //echo $rutaModelo;
        if (is_readable($rutaModelo))
        {
            //echo 'si es legible';
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        }
        else 
        {
            throw new Exception('Error en application Controler: Error de modelo función LoadMOdel');
        
        }
    }

    protected function getLibrary($libreria,$dirInterno)
    {
        $rutaLibreria = ROOT . 'libs' . DS . $dirInterno . DS . $libreria . '.php';
        
        if (is_readable($rutaLibreria))
        {
            require_once $rutaLibreria;
        }
        else 
        {
            throw new Exception('Error en application Controler getLibrary: Error de libreria');
        }
        
    }

    
    
}