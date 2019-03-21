<?php

class aclController extends Controller
{
    //V16
    private $_aclm; //esta variable usaremos para instanciar el modelo
    
	public function __construct(){
        //V16
		parent::__construct();
		$this->_aclm =  $this->loadModel('acl');
	}
	public function index()
	{
        //V16
		$this->_view->assign('titulo', 'Listas de Acceso');
		$this->_view->renderizar('index');
	}
	public function roles()
	{
        //V16
		$this->_view->assign('titulo', 'Administración de roles');
		$this->_view->assign('roles', $this->_aclm->getRoles());

		$this->_view->renderizar('role_listar');
	}
	public function permisos_role($roleID)
	{
        //V16
		$id = $this->filtrarInt($roleID);
		if(!$id){
			$this->redireccionar('acl/roles');
		}
		$row = $this->_aclm->getRole($id);
		if(!$row){
			$this->redireccionar('acl/roles');
		}
		$this->_view->assign('titulo','Administración de permisos role');
		//var_dump($_POST);
		if($this->getInt('guardard') == 1){
			//echo 'entro guardar' . '<br>';
			$values = array_keys($_POST);
			$replace = array();
			$eliminar = array();
			//var_dump($values );
			//var_dump($_POST);
			for($i = 0; $i < count($values); $i++){
				//echo 'a_'.$i. '<br>';
				if(substr($values[$i],0,5) == 'perm_'){
					//echo '0_'.$i. '<br>';
					if($_POST[$values[$i]] == 'x'){
						//echo '1:: '.$values[$i].' '.substr($values[$i], -1). '<br>';
						$eliminar[] = array(
							'role' => $id,
							'permiso' => substr($values[$i], -1)
							);
					}
					else {
						//echo '1e'. '<br>';
						if($_POST[$values[$i]] == 1){
							$v = 1;
							//echo '1et'. '<br>';
						}
						else {
							$v = 0;
							//echo '1e0'. '<br>';
						}
						$replace[] = array(
							'role' => $id,
							'permiso' => substr($values[$i], -1),
							'valor' => $v
							);
					}
				}
			}

			for($i = 0; $i <count($eliminar); $i++){
				$this->_aclm->eliminarPermisoRole(
					$eliminar[$i]['role'], 
					$eliminar[$i]['permiso']);
			}

			for($i = 0; $i <count($replace); $i++){
				$this->_aclm->editarPermisosRole(
					$replace[$i]['role'], 
					$replace[$i]['permiso'],
					$replace[$i]['valor']);
			}
		}
		$this->_view->assign('role', $row);
		$this->_view->assign('permisos', $this->_aclm->getPermisosRole($id));
		$this->_view->renderizar('permisos_role');
    }
    
	public function permisos()
    {
        $this->_view->assign('titulo', 'Administracion de permisos');
        $this->_view->assign('permisos', $this->_aclm->getPermisos());
        $this->_view->renderizar('permiso_listar', 'acl');
    }
    

    
    public function nuevo_role()
    {
        //V16
        //$this->_acl->acceso('nuevo_post'); 
        $this->_view->assign('titulo', 'Nuevo Role'); 
        $this->_view->setJs(array('nuevo'));

        if($this->getInt('guardar') == 1){
            //echo 'aclController nuevo_role <br>'; exit;
            $this->_view->assign('datos',$_POST); 
            if(!$this->getTexto('role')){

                $this->_view->assign('_error','Debe introducir el titulo del rol');
                $this->_view->renderizar('nuevo', 'role');
                exit;
            }

            $this->_aclm->insertarRole(
                    $this->getPostParam('role')
                    );

            $this->redireccionar('acl/roles');
        }  
    	$this->_view->renderizar('role_nuevo', 'role');
    }
    public function editar_role($roleID)
    {
        //V16
        //$this->_acl->acceso('editar_post'); 
        $id = $this->filtrarInt($roleID);
        if(!$id){
            $this->redireccionar('acl/roles');
        }
        //si no existe el rol redireccionar.
        $row = $this->_aclm->getRole($id);
		if(!$row){
			$this->redireccionar('acl/roles');
		}

        $this->_view->assign('titulo','Editar Role'); 
        $this->_view->setJs(array('nuevo'));
        //echo 'aclController editar_role antes del guardar <br> ';

        if($this->getInt('guardar') == 1){
            $this->_view->assign('datos',$_POST); 
            echo 'aclController editar_role entro a guardar <br> '; //exit;
            
            if(!$this->getTexto('role')){
                $this->_view->assign('_error','Debe introducir el titulo del role');
                $this->_view->renderizar('roles', 'role');
                exit;
            }
            //echo 'aclController 2 <br> ';

            $this->_aclm->editarRole(
                    $this->filtrarInt($id),
                    $this->getTexto('role')
                    );
            //exit;
            //$this->redireccionar('acl/role_listar');
            $this->redireccionar('acl/roles');
        }
        //$a = $this->_aclm->getRole($this->filtrarInt($id)) ;
        //echo '<pre>'; print_r($a); echo 'valor q trajo <br> '; //exit;
        $this->_view->assign('roles', $this->_aclm->getRole($this->filtrarInt($id)));
        $this->_view->renderizar('role_editar', 'role');
    }

    public function nuevo_permiso()
    {
        //V16
        //$this->_acl->acceso('nuevo_post'); 
        $this->_view->assign('titulo', 'Nuevo Permiso'); 
        $this->_view->setJs(array('nuevo'));

        if($this->getInt('guardar') == 1){
            $this->_view->assign('datos',$_POST); 
            if(!$this->getTexto('permiso')){

                $this->_view->assign('_error','Debe introducir el titulo del permiso');
                $this->_view->renderizar('permisos', 'permisos');
                exit;
            }

            if(!$this->getTexto('llave')){
                $this->_view->assign('_error','Debe introducir la llave del permiso');
                $this->_view->renderizar('permisos', 'permiso');
                exit;
            }

            $this->_aclm->insertarPermiso(
                    $this->getPostParam('permiso'),
                    $this->getPostParam('llave')
                    );

            $this->redireccionar('acl/permisos');
        }  
    	$this->_view->renderizar('permiso_nuevo', 'permiso');
    }    

    public function editar_permiso($permisoID)
    {
        //V16
        //$this->_acl->acceso('editar_post'); 
        $id = $this->filtrarInt($permisoID);
        if(!$id){
            $this->redireccionar('acl/permisos');
        }
        //si no existe el permiso redireccionar.
        $row = $this->_aclm->getRole($id);
		if(!$row){
			$this->redireccionar('acl/permisos');
		}

        $this->_view->assign('titulo','Editar Permiso'); 
        $this->_view->setJs(array('nuevo'));

        if($this->getInt('guardar') == 1){
            $this->_view->assign('datos',$_POST); 
            echo ' 1 ';
            if(!$this->getTexto('permiso')){
                $this->_view->assign('_error','Debe introducir el titulo del permiso');
                $this->_view->renderizar('permisos', 'permiso');
                exit;
            }
            if(!$this->getTexto('key')){
                $this->_view->assign('_error','Debe introducir la llave del permiso');
                $this->_view->renderizar('permisos', 'permiso');
                exit;
            }
            echo ' 2 ';

            $this->_aclm->editarPermiso(
                    $this->filtrarInt($id),
                    $this->getTexto('permiso'),
                    $this->getTexto('key')
                    );
            //exit;
            $this->redireccionar('acl/permisos');
        }
        $this->_view->assign('permiso', $this->_aclm->getPermiso($this->filtrarInt($id)));
        $this->_view->renderizar('permiso_editar', 'permiso');
    }
}