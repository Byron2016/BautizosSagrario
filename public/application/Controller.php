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

    protected function getTexto($clave) 
    {
        //para evitar sqlinjection
        //toma variable enviada por post, la filtra y la retorna
        if(isset($_POST[$clave]) && !empty($_POST[$clave]))
        {
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
            return $_POST[$clave];
        }
        
        return '';
    }

    protected function getInt($clave) 
    {
        //para evitar sqlinjection
        //toma variable enviada or post y la filtra y retoran entero
        if(isset($_POST[$clave]) && !empty($_POST[$clave]))
        {
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }
        
        return 0;
    }

    protected function redireccionar($ruta = FALSE)
    {
        if($ruta)
        {
            header('location:' . BASE_URL . $ruta);
            exit();
        }
        else
        {
            header('location:' . BASE_URL);
            exit();
        }
    }

    protected function filtrarInt($int)
    {
        //valida el int quero llega por url.
        $int = (int) $int;
        
        if(is_int($int)){
            return $int;
        }
        else{
            return 0;
        }
    }

    protected function getPostParam($clave)
    {
        if(isset($_POST[$clave])){
            return $_POST[$clave];
        }
    } 



    
    
}