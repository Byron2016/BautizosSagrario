<?php

class indexController extends Controller
{
	public function __construct(){
		parent::__construct();
    }
    
	public function index()
	{
		//ant - V13
        echo "Hola desde index Controler" . "<br>";
        /*
		$post = $this->loadModel('post');
		$this->_view->posts = $post->getPosts();
		$this->_view->titulo = 'portada';
        $this->_view->renderizar('index', 'inicio');
		*/
		/*
		$this->_view->titulo = 'Portada';
		$this->_view->renderizar('index', 'inicio');
		*/
		//echo "<br>";
		//echo "<pre>";print_r($this->_acl->getPermisos()); exit;
		$this->_view->assign('titulo','Portada') ; //V13
		echo "Hola desde index Controler 1" . "<br>";
		$this->_view->renderizar('index', 'inicio'); //V13
		echo "Hola desde index Controler 2" . "<br>";
		

	}
}