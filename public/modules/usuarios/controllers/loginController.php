<?php
// V7 - V9
class loginController extends Controller
{

    private $_login; //V9 //ahora en login usuario se ocupa
    
    public function __construct()
    {
        //anteriores - V9
        echo 'Constructor loginCongroller ' . '<br>';
        parent::__construct();
        $this->_login = $this->loadModel('login'); //V9
        
    }

    
    public function index()
    {
        //V9 - V10 - V15
        //echo 'index loginCongroller ' . '<br>';
        if(Session::get('autenticado')){
            //V10
            $this->redireccionar();
        }
        
        //$this->_view->titulo = 'Iniciar Sesion';//comentado en V15
        $this->_view->assign('titulo',"Iniciar Sesion"); //V15
        
        if($this->getInt('enviar') == 1)
        {
            //V9
            $this->_view->datos = $_POST; //para q se mantenga el nombre d usuario
            
            if(!$this->getAlphaNum('usuario')){
                //$this->_view->_error = 'Debe introducir su nombre de usuario';//comentado en V15
                $this->_view->assign('_error',"Debe introducir su nombre de usuario"); //V15
                $this->_view->renderizar('index','login');
                exit;
            }
            
            if(!$this->getSql('pass')){
                //$this->_view->_error = 'Debe introducir su password';//comentado en V15
                $this->_view->assign('_error',"Debe introducir su password"); //V15
                $this->_view->renderizar('index','login');
                exit;
            }
            
            $row = $this->_login->getUsuario(
                    $this->getAlphaNum('usuario'),
                    $this->getSql('pass')
                    );
            
            if(!$row){
                //V9
                //$this->_view->_error = 'Usuario y/o password incorrectos';//comentado en V15
                $this->_view->assign('_error',"Usuario y/o password incorrectos"); //V15
                $this->_view->renderizar('index','login');
                exit;
            }
            
            if($row['estado'] != 1)
            {
                //V9
                //$this->_view->_error = 'Este usuario no esta habilitado';//comentado en V15
                $this->_view->assign('_error',"Este usuario no esta habilitado"); //V15
                $this->_view->renderizar('index','login');
                exit;
            }
            
            
                       
            Session::set('autenticado', true);
            Session::set('level', $row['role']);
            //echo 'level: ' . Session::get('level').'<br>'; exit;
           // Session::set('usuario', $row['usuario']);
            Session::set('id_usuario', $row['id']);
            Session::set('tiempo', time());
            // print_r($_SESSION); exit;
            
            $this->redireccionar();
        }
        
        $this->_view->renderizar('index','login');   
    }
    
    /*
    public function index()
    {
        //V7 - V8
        Session::set('autenticado', true);
        Session::set('level', 'usuario');
        Session::set('tiempo', time()); //V8
        Session::set('var1', 'var1');
        Session::set('var2', 'var2');
        $this->redireccionar('login/mostrar');
            
    }
    
    
    public function mostrar()
    {
        //V7
        echo 'level: ' . Session::get('level').'<br>';
        echo 'var1: ' . Session::get('var1').'<br>';
        echo 'var2: ' . Session::get('var2').'<br>'; 
    }
    */
    
    public function cerrar()
    {
        //V7 - V9
        
        //Session::destroy(array('var1','var2'));
        //Session::destroy('var1');
        Session::destroy();
        //$this->redireccionar('login/mostrar');
        $this->redireccionar(); //V9
    }
    
}