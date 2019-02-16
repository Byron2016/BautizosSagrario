<?php

class indexController extends Controller
{
	public function __construct(){
		parent::__construct();
    }
    
	public function index()
	{
        //echo "Hola desde index Controler";
        
		$post = $this->loadModel('post');
		$this->_view->posts = $post->getPosts();
		//$this->_view->titulo = 'portada';
        //$this->_view->renderizar('index', 'inicio');
		
		$this->_view->titulo = 'Portada';
		$this->_view->renderizar('index', 'inicio');
	}
}