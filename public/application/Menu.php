<?php 
  
 		$menu = array(
			array(
				'id' => 'inicio',
				'titulo' => 'Inicio',
				'enlace' => BASE_URL
			),
			array(
				'id' => 'hola',
				'titulo' => 'Hola',
				'enlace' => BASE_URL . 'hola'
			),
			array(
				'id' => 'post',
				'titulo' => 'Post',
				'enlace' => BASE_URL . 'post'
			)
        );
        /*
        if(Session::get('autenticado')){
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Cerrar Sesion',
                'enlace' => BASE_URL . 'login/cerrar'//,
                //'imagen' => 'icon-book'
            );
        } else {
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Iniciar Sesion',
                'enlace' => BASE_URL . 'login'//,
                //'imagen' => 'icon-book'
            );
            
            $menu[] = array (
                'id' => 'registro',
                'titulo' => 'Registrar Usuario',
                'enlace' => BASE_URL . 'registro'//,
                //'imagen' => 'icon-book'
            );
        }
        */