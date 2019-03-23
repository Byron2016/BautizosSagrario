<?php
//ant - V12 - V13
class postController extends Controller
{
	private $_post; //esta variable usaremos para instanciar el modelo
	public function __construct(){
		parent::__construct();
		$this->_post = $this->loadModel('post');
	}
	public function index($pagina = false)
	{
        //ant - V12 - V19
        /*
        for($i = 0; $i < 300; $i++){
            $model = $this->loadModel('post');
            $model->insertarPost('titulo' . $i, 'cuerpo' . $i);
        }
        */
        //$this->_acl->acceso('nuevo_post'); //V19
        $this->_view->setJs(array('prueba')); //V19
        if(!$this->filtrarInt($pagina)){
            $pagina = false;
        }
        else {
            $pagina = (int) $pagina;
        }
        $this->getLibrary('paginador','paginador'); //V12
        $paginador = new Paginador(); //V12


		$post = $this->loadModel('post');
        //$this->_view->posts = $post->getPosts(); //antes V12
        /*
        $this->_view->posts = $paginador->paginar($this->_post->getPosts(), $pagina); //V12
        $this->_view->paginacion = $paginador->getView('prueba', 'post/index'); //V12 llama a la paginacion relacionada con la vista
		$this->_view->titulo = 'portada';
        $this->_view->renderizar('index', 'post');
        */
        $this->_view->assign('posts' , $paginador->paginar($this->_post->getPosts(), $pagina)); //V13
        $this->_view->assign('paginacion', $paginador->getView('prueba', 'post/index')); //V13 llama a la paginacion relacionada con la vista
		$this->_view->assign('titulo', 'portada'); //V13
        $this->_view->renderizar('index', 'post'); //V13

	}
    public function nuevo()
    {
        //ant - V15
        $this->_acl->acceso('nuevo_post'); //V15
        //Session::acceso('especial'); //v7
        //Session::acceso('usuario'); //v7
        //Session::accesoEstricto(array('usuario')); //V8
        //$this->_view->titulo = 'Nuevo_post'; //comento en la V14
        $this->_view->assign('titulo', 'Nuevo_post'); //V14
        $this->_view->setJs(array('nuevo'));
    	//$this->_view->prueba = $this->getTexto('titulo');
        if($this->getInt('guardar') == 1){
            // $this->_view->datos = $_POST; //comento en la V14 //para que se quede lleno. No deberia hacerse así sino hacer funcion que retorne parámetros post.
            $this->_view->assign('datos',$_POST); //V14
            if(!$this->getTexto('titulo')){
                //$this->_view->_error = 'Debe introducir el titulo del post';
                //$this->_view->renderizar('nuevo', 'post');
                //exit;

                $this->_view->assign('_error','Debe introducir el titulo del post');
                $this->_view->renderizar('nuevo', 'post');
                exit;
            }
            
            if(!$this->getTexto('cuerpo')){
                //$this->_view->_error = 'Debe introducir el cuerpo del post';
                //$this->_view->renderizar('nuevo', 'post');
                //exit;

                $this->_view->assign('_error','Debe introducir el cuerpo del post');
                $this->_view->renderizar('nuevo', 'post');
                exit;
            }

            $imagen = '';
            if(isset($_FILES['imagen']['name']))
            {
                $this->getLibrary('class.upload','upload');
                $ruta = ROOT . 'public' . DS . 'img' . DS . 'post' . DS;
                $upload = new upload($_FILES['imagen'],'es_ES');
                //tipos mimes a ser aceptados
                $upload->allowed = array('image/*');
                //renombrar
                $upload->file_new_name_body = 'upl_' . uniqid();
                //ruta donde queremos q se guarde el archivo
                $upload->process($ruta);
                //verificar si fue exitoso
                if($upload->processed){
                    //miniatura de imagen
                    //https://www.verot.net/php_class_upload.htm
                    $imagen = $upload->file_dst_name;
                    $thumb = new upload($upload->file_dst_pathname);
                    $thumb->image_resize = true;
                    $thumb->image_x = 100;
                    $thumb->image_y = 70;
                    $thumb->file_name_body_pre = 'thumb_';
                    $thumb->process($ruta . 'thumb' . DS);
                } else {
                    //error a la vista
                    //echo "error echo";
                    $this->_view->assign('_error', $upload->error);
                    $this->_view->renderizar('nuevo', 'post');
                    exit;
                }
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
                    $this->getPostParam('cuerpo'),
                    $imagen
                    );
            
            $this->redireccionar('post');
        }  
    	$this->_view->renderizar('nuevo', 'post');
    }

    public function editar($id)
    {
        //ant - V15
        //$this->_acl->acceso('editar_post'); //V15
        if(!$this->filtrarInt($id)){
            $this->redireccionar('post');
        }
        //si no existe el post redireccionar.
        if(!$this->_post->getPost($this->filtrarInt($id))){
            $this->redireccionar('post');
        }
        
        //$this->_view->titulo = 'Editar Post'; // V15 se comenta
        $this->_view->assign('titulo','Editar Post'); // V15
        $this->_view->setJs(array('nuevo'));
        //si se envio parametro guardar quiere decir que epresione sublim.
        if($this->getInt('guardar') == 1){
            //$this->_view->datos = $_POST;
            $this->_view->assign('datos',$_POST); //V14
            
            if(!$this->getTexto('titulo')){
                //$this->_view->_error = 'Debe introducir el titulo del post';// V15 se comenta
                $this->_view->assign('_error','Debe introducir el titulo del post');// V15
                $this->_view->renderizar('editar', 'post');
                exit;
            }
            
            if(!$this->getTexto('cuerpo')){
                //$this->_view->_error = 'Debe introducir el cuerpo del post';// V15 se comenta
                $this->_view->assign('_error','Debe introducir el cuerpo del post');// V15
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
        
        //$this->_view->datos = $this->_post->getPost($this->filtrarInt($id)); //los datos de la vista lo llenamos con el registro base datos // V15 se comenta
        $this->_view->assign('posts', $this->_post->getPost($this->filtrarInt($id)));// V15
        $this->_view->renderizar('editar', 'post');
    }
    public function eliminar($id)
    {
        //ant v7 V15
        //Session::acceso('admin'); //v7
        $this->_acl->acceso('eliminar_post'); //V15
        if(!$this->filtrarInt($id)){
            $this->redireccionar('post');
        }
        
        if(!$this->_post->getPost($this->filtrarInt($id))){
            $this->redireccionar('post');
        }
        
        $this->_post->eliminarPost($this->filtrarInt($id));
        $this->redireccionar('post');
    }


    public function prueba($pagina = false)
    {
        //V12
        /*
        for($i =0; $i <300; $i++){
            $model = $this->loadModel('post');
            $model->insertarPrueba('nombre ' . $i) ;
        }
        */
        if(!$this->filtrarInt($pagina)){
            $pagina = false;
        }else {
            $pagina = (int) $pagina;
        }
        $this->getLibrary('paginador','paginador');
        $paginador = new Paginador();
        
        $this->_view->posts = $paginador->paginar($this->_post->getPrueba(), $pagina); //V12
        $this->_view->paginacion = $paginador->getView('prueba', 'post/prueba'); //V12 llama a la paginacion relacionada con la vista
		$this->_view->titulo = 'post';
		$this->_view->renderizar('prueba', 'post');
    }
}