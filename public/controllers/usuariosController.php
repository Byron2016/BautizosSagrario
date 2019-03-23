<?php

class usuariosController extends Controller
{
    //V17
    private $_usuarios; //esta variable usaremos para instanciar el modelo
    
	public function __construct(){
        //V17
		parent::__construct();
		$this->_usuarios=  $this->loadModel('usuarios');
	}
	public function index()
	{
        //V17
        $this->_view->assign('titulo', 'Usuarios');
        $this->_view->assign('usuarios', $this->_usuarios->getUsuarios());
		$this->_view->renderizar('index');
	}

	public function permisos($usuarioID)
	{
		//V17
		$id = $this->filtrarInt($usuarioID);
		if(!$id){
			$this->redireccionar('usuarios');
		}
		
		if($this->getInt('guardar') == 1){
			$values = array_keys($_POST);
			//$ax = $values; print_r($ax);exit;
			$replace = array();
			$eliminar = array();
			for($i = 0; $i < count($values); $i++){
				if(substr($values[$i],0,5) == 'perm_'){
					$permiso = (strlen($values[$i]) - 5);

					if($_POST[$values[$i]] == 'x'){
						$eliminar[] = array(
							'usuario' => $id,
							'permiso' => substr($values[$i], -$permiso)
							);
					}
					else {
						if($_POST[$values[$i]] == 1){
							$v = 1;
						}
						else {
							$v = 0;
						}
						$replace[] = array(
							'usuario' => $id,
							'permiso' => substr($values[$i], -$permiso),
							'valor' => $v
							);
					}
				}
			}

			for($i = 0; $i < count($eliminar); $i++){
				$this->_usuarios->eliminarPermiso(
					$eliminar[$i]['usuario'], 
					$eliminar[$i]['permiso']);
			}

			for($i = 0; $i < count($replace); $i++){
				$this->_usuarios->editarPermiso(
					$replace[$i]['usuario'], 
					$replace[$i]['permiso'],
					$replace[$i]['valor']);
			}

		}


		$permisosUsuarios = $this->_usuarios->getPermisosUsuario($id);
		$permisosRol = $this->_usuarios->getPermisosRole($id);

		if(!$permisosUsuarios || !$permisosRol){
			$this->redireccionar('usuarios');
		}

		$this->_view->assign('titulo', 'Permisos de Usuario');
		$this->_view->assign('permisos', array_keys($permisosUsuarios));
		//$ax = array_keys($permisosUsuarios); print_r($ax);//exit;
		$this->_view->assign('usuario', $permisosUsuarios);
		//$ax = $permisosUsuarios; print_r($ax);//exit;
		$this->_view->assign('role', $permisosRol);
		//$ax = $this->_usuarios->getUsuario($id); print_r($ax);//exit;
		$this->_view->assign('info', $this->_usuarios->getUsuario($id));
		$this->_view->renderizar('permisos');
	}
}