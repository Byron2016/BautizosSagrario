<?php

class postController extends Controller
{
	private $_post; //esta variable usaremos para instanciar el modelo
	public function __construct(){
		parent::__construct();
		$this->_post = $this->loadModel('post');
	}
	public function index()
	{
		$post = $this->loadModel('post');
		$this->_view->posts = $post->getPosts();
		$this->_view->titulo = 'portada';
		$this->_view->renderizar('index', 'post');
	}
    public function nuevo()
    {
        //Session::acceso('especial');
        //Session::accesoEstricto(array('usuario'));
    	$this->_view->titulo = 'Nuevo_post';
        $this->_view->setJs(array('nuevo'));
    	//$this->_view->prueba = $this->getTexto('titulo');
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST; //para que se quede lleno. No deberia hacerse así sino hacer funcion que retorne parámetros post.
            
            if(!$this->getTexto('titulo')){
                $this->_view->_error = 'Debe introducir el titulo del post';
                $this->_view->renderizar('nuevo', 'post');
                exit;
            }
            
            if(!$this->getTexto('cuerpo')){
                $this->_view->_error = 'Debe introducir el cuerpo del post';
                $this->_view->renderizar('nuevo', 'post');
                exit;
            }
            //echo 'a1';
            /*
            $this->_post->insertarPost(
                    $this->getTexto('titulo'),
                    $this->getTexto('cuerpo')
                    );
            */
            $this->_post->insertarPost(
                    $this->getPostParam('titulo'),
                    $this->getPostParam('cuerpo')
                    );
            
            $this->redireccionar('post');
        }  
    	$this->_view->renderizar('nuevo', 'post');
    }
    public function editar($id)
    {
        if(!$this->filtrarInt($id)){
            $this->redireccionar('post');
        }
        //si no existe el post redireccionar.
        if(!$this->_post->getPost($this->filtrarInt($id))){
            $this->redireccionar('post');
        }
        
        $this->_view->titulo = 'Editar Post';
        $this->_view->setJs(array('nuevo'));
        //si se envio parametro guardar quiere decir que epresione sublim.
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getTexto('titulo')){
                $this->_view->_error = 'Debe introducir el titulo del post';
                $this->_view->renderizar('editar', 'post');
                exit;
            }
            
            if(!$this->getTexto('cuerpo')){
                $this->_view->_error = 'Debe introducir el cuerpo del post';
                $this->_view->renderizar('editar', 'post');
                exit;
            }
            
            $this->_post->editarPost(
                    $this->filtrarInt($id),
                    $this->getTexto('titulo'),
                    $this->getTexto('cuerpo')
                    );
            
            $this->redireccionar('post');
        }
        
        $this->_view->datos = $this->_post->getPost($this->filtrarInt($id)); //los datos de la vista lo llenamos con el registro base datos
        $this->_view->renderizar('editar', 'post');
    }
    public function eliminar($id)
    {
        if(!$this->filtrarInt($id)){
            $this->redireccionar('post');
        }
        
        if(!$this->_post->getPost($this->filtrarInt($id))){
            $this->redireccionar('post');
        }
        
        $this->_post->eliminarPost($this->filtrarInt($id));
        $this->redireccionar('post');
    }
}