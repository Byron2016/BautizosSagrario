<?php
//V19 
//cambia de 
	//class usuariosModel extends Model
	//class indexsModel extends Model
class indexModel extends Model
{
    //V17
    public function __construc()
    {
        //V17
    	parent::__construc();
    }

    public function getUsuarios(){
        //V17
        //echo "select u.*, r.role from usuarios u, roles r where u.role = r.id_role";
        $usuarios = $this->_db->query(
            "select u.*, r.role from usuarios u, roles r " .
            "where u.role = r.id_role "
        );
        return $usuarios->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuario($usuarioID){
        //V17
        $usuarios = $this->_db->query(
            "select u.usuario, r.role from usuarios u, roles r " .
            "where u.role = r.id_role and u.id = $usuarioID"
        );
        //return $usuarios->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios->fetch();
        
    }

    public function getPermisosUsuario($usuarioID){
        //V17
        $acl = new ACL($usuarioID);
        return $acl->getPermisos();
        
    }

    public function getPermisosRole($usuarioID){
        //V17
        $acl = new ACL($usuarioID);
        return $acl->getPermisosRole();
        
    }

    public function EliminarPermiso($usuarioID, $permisoID){
        //V17
        /*
        $this->_db->query(
            "delete from permiso_usuario " .
            "where usuario =  $usuarioID and permiso = $permisoID"
        );    
        */  
        //echo "delete from permisos_usuario where usuario = $usuarioID and permiso = $permisoID";
    	$this->_db->query("delete from permisos_usuario where usuario = $usuarioID and permiso = $permisoID");
    }

    public function editarPermiso($usuarioID, $permisoID, $valor){
        //V17
        /*
        $this->_db->query(
            "replace into permisos_usuario set" .
            "usuario =  $usuarioID, permiso = $permisoID," . 
            "valor = '$valor'"
        );
        */
        //exit;
        
        
        //echo "replace into permisos_usuario set usuario = $usuarioID, permiso = $permisoID, valor = '$valor'"; //exit;
        $this->_db->query("replace into permisos_usuario set usuario = $usuarioID, permiso = $permisoID, valor = '$valor'");
        
    }
}