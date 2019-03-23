<?php

use PHPMailer\PHPMailer\Exception; //V11
use PHPMailer\PHPMailer\PHPMailer; //V11


class registroController extends Controller
{
	//V10 - V11
	private $_registro;
	public function __construct()
	{
        //V10
		parent::__construct();
		$this->_registro = $this->loadModel('registro');
	}
	public function index()
	{
        //V10 - V15
        //autentificación del usuario
		if (Session::get('autenticado')) {
			$this->redireccionar(); //si esta logueado no puede entrar debe cerrar sesion primero
		}
		//$this->_view->titulo = 'Registro'; //comento en la V15
        $this->_view->assign('titulo', 'Registro'); //V15
		
		if ($this->getInt('enviar') == 1) 
		{
			//$this->_view->datos = $_POST; //comento en la V15
			$this->_view->assign('datos',$_POST); //V15
            //V10 - V15
			if (!$this->getSql('nombre')) 
			{
				//$this->_view->_error = "Debe introducir su nombre"; //comento en la V15
				$this->_view->assign('_error','Debe introducir su nombre'); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if (!$this->getAlphaNum('usuario')) 
			{
				//$this->_view->_error = "Debe introducir su nombre de usuario"; //comento en la V15
				$this->_view->assign('_error','Debe introducir su nombre de usuario'); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if ($this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) 
			{
				//$this->_view->_error = "El usuario " . $this->getAlphaNum('usuario') . " ya existe"; //comento en la V15
				//$this->_view->assign('_error','Debe introducir el titulo del post'); //V15
				$this->_view->assign('_error',"El usuario " . $this->getAlphaNum('usuario') . " ya existe"); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if (!$this->validarEmail($this->getPostParam('email'))) 
			{
				//$this->_view->_error = "La direccion de email es inv&aacute;ida"; //comento en la V15
				$this->_view->assign('_error','La direccion de email es inv&aacute;ida'); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if ($this->_registro->verificarEmail($this->getPostParam('email'))) 
			{
				//$this->_view->_error = "Esta direccion de correo ya esta registrada"; //comento en la V15
				$this->_view->assign('_error','Esta direccion de correo ya esta registrada'); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if (!$this->getSql('pass')) 
			{
				//$this->_view->_error = "Debe introducir un password"; //comento en la V15
				$this->_view->assign('_error','Debe introducir un password'); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
            }
            //V10
			if ($this->getPostParam('pass') != $this->getPostParam('confirmar')) 
			{
				//$this->_view->_error = "Los passwords no coinciden"; //comento en la V15
				$this->_view->assign('_error','Los passwords no coinciden'); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
			}
			//V11
			
			$this->getLibrary('Exception','PHPMailer/src');
			$this->getLibrary('PHPMailer','PHPMailer/src');
			$this->getLibrary('SMTP','PHPMailer/src');

			//echo '<pre>'; print_r(get_required_files());
			//exit;
			//echo '1';

			$mail = new PHPMailer(TRUE);
			//echo '2';
            //V10
			$this->_registro->registrarUsuario(
					$this->getSql('nombre'),
					$this->getAlphaNum('usuario'),
					$this->getSql('pass'),
					$this->getPostParam('email')
					);
			//echo '3';

			//vuelve a verificar si usaurio existe
			/*
			//V10
			if (!$this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) 
			{
				$this->_view->_error = "registroControler: Error al registrar el usuario";
				$this->_view->renderizar('index', 'registro');
				exit;
			}
			$this->_view->datos = false; //para q luego q el usuario se registre los campos se pongan vacios
			$this->_view->_mensaje = "Registro Completado";
			*/
			//V11
			$usuario = $this->_registro->verificarUsuario($this->getAlphaNum('usuario'));
			//echo $usuario;
			//exit;
			if (!$usuario) 
			{
				//$this->_view->_error = "registroControler: Error al registrar el usuario"; //comentado en V15
				$this->_view->assign('_error',"registroControler: Error al registrar el usuario"); //V15
				$this->_view->renderizar('index', 'registro');
				exit;
			}

			$mail->setLanguage('es');

			//$mail->From = 'sagrariobautizos.net/';
			$mail->From = 'sagrariobautizos@yahoo.com'; //$this->getPostParam('email')
			$mail->FromName = 'Administrador registro usuarios';
			$mail->Subject = 'Activación de cuenta de usuario';
			$mail->Body = 'Hola <strong>' . $this->getSql('nombre') . '<strong>' .
						'<p>Se ha registrado en sagrariobautizos.net para activar ' . 
						'su cuenta haga click sobre el siguiente enlace: <br> ' .
						'<a href="' . BASE_URL . 'registro/activar/' .
						$usuario['id'] . '/' . $usuario['codigo'] . '">' .
						BASE_URL . 'registro/activar/' .
						$usuario['id'] . '/' . $usuario['codigo'] . '</a>';
			

			$mail->AltBody = 'Su servidor de correo no soporta html';
			$mail->AddAddress($this->getPostParam('email'));
			$mail->Send();

			//$this->_view->datos = false; //para q luego q el usuario se registre los campos se pongan vacios
			//$this->_view->_mensaje = "Registro Completado, revise su email para activar su cuenta";

			$this->_view->assign('datos',false); //V15
			$this->_view->assign('_mensaje',"Registro Completado, revise su email para activar su cuenta"); //V15
			
		}
		$this->_view->renderizar('index', 'Registro');
	}

	public function activar($id, $codigo)
	{
		//V11
		try {
		//echo '<br> Dentro de registroController activar ID: ' . $id .' MODELO ' . $codigo . '<br>';
		if(!$this->filtrarInt($id) || !$this->filtrarInt($codigo)){
			//$this->_view->_error = 'Esta cuenta no existe';//comentado en V15
			$this->_view->assign('_error',"Esta cuenta no existe"); //V15
			$this->_view->renderizar('activar', 'registro');
			exit;

		}

		$row = $this->_registro->getUsuario(
					  $this->filtrarInt($id),
					  $this->filtrarInt($codigo)
		              );
		if(!$row ){
			//usuario existe
			//$this->_view->_error = 'Esta cuenta no existe';//comentado en V15
			$this->_view->assign('_error',"Esta cuenta no existe"); //V15
			$this->_view->renderizar('activar', 'registro');
			exit;
		}

		if($row['estado'] == 1 ){
			//usuario existe
			//$this->_view->_error = 'Esta cuenta ya ha sido activada';//comentado en V15
			$this->_view->assign('_error',"Esta cuenta ya ha sido activada"); //V15
			$this->_view->renderizar('activar', 'registro');
			exit;
		}
		//echo '<br> ANTES DE LLAMAR activarUsuario <br>';
		$this->_registro->activarUsuario(
			$this->filtrarInt($id),
			$this->filtrarInt($codigo)
			);

		$row = $this->_registro->getUsuario(
				$this->filtrarInt($id),
				$this->filtrarInt($codigo)
				);

		if($row['estado'] == 0){
			//

			//$this->_view->_error = 'Error al activar la cuenta, por favor intente más tarde';//comentado en V15
			$this->_view->assign('_error',"Error al activar la cuenta, por favor intente más tarde"); //V15
			$this->_view->renderizar('activar', 'registro');
			exit;
			}

		//$this->_view->_mensaje = "Registro Completado, su cuenta ha sido activada";//comentado en V15
		$this->_view->assign('_mensaje',"Registro Completado, su cuenta ha sido activada"); //V15
 
		$this->_view->renderizar('activar', 'Registro');
		}  catch(Exception $e) {
			echo $e->getMessage();
		}

	}
}