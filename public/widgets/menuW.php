<?php
class menuWWidget extends Widget
{
    //V24
    public function menuWf()
    {
        //V24
        //Menu debería ser traído desde una base de datos
        $menuRight['menuW'] = array(
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

        return $this->render('menu-right', $menuRight);

    }
}