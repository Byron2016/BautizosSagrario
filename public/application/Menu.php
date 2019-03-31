<?php 

//antes y V9

 		$menu = array(
			array(
				'id' => 'inicio',
				'titulo' => 'Inicio',
				'enlace' => BASE_URL,
				'imagen' => 'icon-home'
			),
			array(
				'id' => 'hola',
				'titulo' => 'Hola',
				'enlace' => BASE_URL . 'hola',
				'imagen' => 'icon-home'
			),
			array(
				'id' => 'post',
				'titulo' => 'Post',
				'enlace' => BASE_URL . 'post',
				'imagen' => 'icon-flag'
			)
        );
        
        if(Session::get('autenticado')){
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Cerrar Sesion',
                'enlace' => BASE_URL . 'usuarios/login/cerrar',
                'imagen' => 'icon-book'
            );
        } else {
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Iniciar Sesion',
                'enlace' => BASE_URL . 'usuarios/login',
                'imagen' => 'icon-book'
            );
            //V10
            $menu[] = array (
                'id' => 'registro',
                'titulo' => 'Registrar Usuario',
                'enlace' => BASE_URL . 'usuarios/registro',
                'imagen' => 'icon-book'
            );
            
        };


$menuRight = array(
			array(
				'id' => 'usuarios',
				'titulo' => 'Usuarios',
				'enlace' => BASE_URL, 'usuarios',
				'imagen' => 'icon-user'
			),
			array(
				'id' => 'acl',
				'titulo' => 'Listas de control de acceso',
				'enlace' => BASE_URL . 'acl',
				'imagen' => 'icon-list-alt'
			),
			array(
				'id' => 'ajax',
				'titulo' => 'Ejemplo uso de AJAX',
				'enlace' => BASE_URL . 'ajax',
				'imagen' => 'icon-refresh'
			)
        );
        
        if(Session::get('autenticado')){
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Cerrar Sesion',
                'enlace' => BASE_URL . 'usuarios/login/cerrar',
                'imagen' => 'icon-book'
            );
        } else {
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Iniciar Sesion',
                'enlace' => BASE_URL . 'usuarios/login',
                'imagen' => 'icon-book'
            );
            //V10
            $menu[] = array (
                'id' => 'registro',
                'titulo' => 'Registrar Usuario',
                'enlace' => BASE_URL . 'usuarios/registro',
                'imagen' => 'icon-book'
            );
            
        };
        