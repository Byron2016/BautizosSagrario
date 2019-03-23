<?php 
/*
use PHPMailer\PHPMailer\Exception; //V11
use PHPMailer\PHPMailer\PHPMailer; //V11
*/
abstract class Controller
{
    //anteriores - V9 - V10 - V15 - V19
    protected $_view;
    protected $_acl; //V15
    protected $_request; //V18
    
	public function __construct()
	{
        $this->_acl = new ACL(); //V15
        $this->_request = new Request();  //V15
        //$this->_view = new View(new Request); //comentado en V15
        //echo 'constructor Controller ' . '<br>';
        $this->_view = new View($this->_request, $this->_acl); //V15
        //echo 'constructor Controller salir ' . '<br>';
    }
    
    abstract public function index();


    protected function loadModel($modelo, $modulo = false) 
    {
        $modelo = $modelo . 'Model';
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';
        //echo '<br> dentro de Controller LoadModel El modelo levantado es: ' . $rutaModelo .' modelo ' . $modelo . '<br>';


        if(!$modulo){
            $modulo = $this->_request->getModulo();
        }
        if($modulo){
            if($modulo != 'default'){
                
                $rutaModelo = ROOT . 'modules' . DS . $modulo . DS . 'models' . DS . $modelo .  '.php'; 
            }
        }

        if (is_readable($rutaModelo))
        {
            //echo '<br> si es legible EL MODELO ' . $rutaModelo . '<br><br>';
            require_once $rutaModelo;
            //echo '<br> 1<br><br>';
            $modelo = new $modelo;
            //echo '<br> 2<br><br>';
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
        //echo "<br>" . $rutaLibreria . "<br>";
        
        if (is_readable($rutaLibreria))
        {
            require_once $rutaLibreria;
            //echo  " Si es legible <br>";
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

    protected function getSql($clave)
    {
        //V9
        //limpia los stringtags
        //sanitizar password
        
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = strip_tags($_POST[$clave]);
            
            if(!get_magic_quotes_gpc()){
                //$_POST[$clave] = mysql_escape_string($_POST[$clave]);
                
            }
            return trim($_POST[$clave]);
        }
    }
    
    protected function getAlphaNum($clave)
    {
        //V9
        //solo acepta 0 9 a z y andrescords.
        //sanitizar nombre usuario
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
        
    }


    public function validarEmail($email)
    {
        //V10
        $email = trim($email);
        /*
        echo ' el email es: ' . $email . '<br>';
        var_dump(filter_var('bgva2005@yahoo.com', FILTER_VALIDATE_EMAIL));
        var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
        echo '<br>';
        $a = filter_var($email, FILTER_VALIDATE_EMAIL);
        echo $a . ' antes exit '  . '<br>';
        if(!$a){
            echo 'aaaaaaa' . '<br>';
        } else {
            echo 'bbbbb' . '<br>';
        }
        */
        //exit;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo 'Entro a el mail no es válido y retorna false';
            return FALSE;
        }
        
        return true;
    }

    
    
}