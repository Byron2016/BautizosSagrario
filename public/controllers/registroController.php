<?php
class registroController extends Controller
{
	//V10 
	private $_registro;
	public function __construct()
	{
        //V10
		parent::__construct();
		$this->_registro = $this->loadModel('registro');
	}
	public function index()
	{
        //V10
        //autentificación del usuario
		if (Session::get('autenticado')) {
			$this->redireccionar(); //si esta logueado no puede entrar debe cerrar sesion primero
		}
		$this->_view->titulo = 'Registro';
		
		if ($this->getInt('enviar') == 1) 
		{
            $this->_view->datos = $_POST;
            //V10
			if (!$this->getSql('nombre')) 
			{
				$this->_view->_error = "Debe introducir su nombre";
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if (!$this->getAlphaNum('usuario')) 
			{
				$this->_view->_error = "Debe introducir su nombre de usuario";
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if ($this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) 
			{
				$this->_view->_error = "El usuario " . $this->getAlphaNum('usuario') . " ya existe";
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if (!$this->validarEmail($this->getPostParam('email'))) 
			{
				$this->_view->_error = "La direccion de email es inv&aacute;ida";
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if ($this->_registro->verificarEmail($this->getPostParam('email'))) 
			{
				$this->_view->_error = "Esta direccion de correo ya esta registrada";
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if (!$this->getSql('pass')) 
			{
				$this->_view->_error = "Debe introducir un password";
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if ($this->getPostParam('pass') != $this->getPostParam('confirmar')) 
			{
				$this->_view->_error = "Los passwords no coinciden";
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			$this->_registro->registrarUsuario(
					$this->getSql('nombre'),
					$this->getAlphaNum('usuario'),
					$this->getSql('pass'),
					$this->getPostParam('email')
					);
			//vuelve a verificar si usaurio existe
			//V10
			if (!$this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) 
			{
				$this->_view->_error = "registroControler: Error al registrar el usuario";
				$this->_view->renderizar('index', 'registro');
				exit;
			}
			$this->_view->datos = false; //para q luego q el usuario se registre los campos se pongan vacios
			$this->_view->_mensaje = "Registro Completado";
		}
		$this->_view->renderizar('index', 'Registro');
	}
}