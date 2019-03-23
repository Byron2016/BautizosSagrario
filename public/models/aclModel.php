<?php
class aclModel extends Model
{
    //V16
    public function __construct() {
        //V16
        parent::__construct();
    }
    public function getRole($roleID)
    {
        //V16
    	$role = $this->_db->query("select * from roles where id_role =$roleID");
    	return $role->fetch();
    }
    public function getRoles()
    {
        //V16
    	$role = $this->_db->query("select * from roles ");
        return $role->fetchAll();
    }
    public function getPermisosAll()
    {
        //V16
    	$permisos = $this->_db->query("select * from permisos");
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        //$id = array();
        
        for($i = 0; $i < count($permisos); $i++){
            if($permisos[$i]['key'] == ''){continue;}
                $data[$permisos[$i]['key']] = array (
                    'key' => $permisos[$i]['key'],
                    'valor' => 'x',
                    'nombre' => $permisos[$i]['permiso'],
                    'id' => $permisos[$i]['id_permiso']
                    );
        }
        return $data;
    }
    public function getPermisosRole($roleID)
    {
        //V16
        $data = array();
        //echo "get permisosrol select * from permisos_role where role = $roleID ". '<br>';
        $permisos = $this->_db->query("select * from permisos_role where role = $roleID");
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($permisos); exit;
        
        for($i = 0; $i < count($permisos); $i++){
            $key = $this->getPermisoKey($permisos[$i]['permiso']);
            if($key  == ''){continue;}
            if($permisos[$i]['valor'] == 1){
                $v = 1;
            }
            else {
                $v = 0;
            }
            $data[$key] = array (
                    'key' => $key,
                    'valor' => $v,
                    'nombre' => $this->getPermisoNombre($permisos[$i]['permiso']),
                    'id' => $permisos[$i]['permiso']
                    );
        }
        //var_dump($data);
        $data = array_merge($this->getPermisosAll(), $data);
        //var_dump($data); exit;
        return $data;
    }
    public function eliminarPermisoRole($roleID, $permisoID)
    {
        //V16
        echo "eliminapermisorole delete from permisos_role where role = $roleID and permiso = $permisoID ". '<br>';
        $this->_db->query("delete from permisos_role  where role = $roleID and permiso = $permisoID ");
    }
    public function editarPermisosRole($roleID, $permisoID, $valor)
    {
        //V16
        //echo "editapermisosrole replace into permisos_role set role = $roleID , permiso = $permisoID, valor ='$valor'". '<br>';
        $this->_db->query("replace into permisos_role  set role = $roleID , permiso = $permisoID, valor ='$valor'");
    }
    public function getPermisoKey($permisoID)
    {
        //V16
        $permisoID = (int) $permisoID;
        //echo "<br> getPermsoKey: select `key` from permisos where id_permiso = {$permisoID}";
        //echo "getPermisoKey select `key` from permisos where id_permiso = {$permisoID} ". '<br>';
        $key = $this->_db->query("select `key` from permisos where id_permiso = {$permisoID}");
        $key = $key->fetch();
        return $key['key'];
    }
    public function getPermisoNombre($permisoID)
    {
        //V16
        $permisoID = (int) $permisoID;
        $permiso = $this->_db->query("select permiso from permisos where id_permiso = {$permisoID}");
        $permiso = $permiso->fetch();
        return $permiso['permiso'];
    }
    
    public function getPermisos()
    {
        $permisos = $this->_db->query("SELECT * FROM permisos");
        
        return $permisos->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPermiso($permisoID)
    {
        //V16
        //echo 'select * from permisos where id_permiso =' . $permisoID. ';'; 
        $permiso = $this->_db->query("select * from permisos where id_permiso =$permisoID");
        return $permiso->fetch();
    }

    public function insertarPermiso($permiso, $llave)
    {
        //V16
        //echo "INSERT INTO roles VALUES(null, '" . $role . "');";
        $this->_db->prepare("INSERT INTO permisos VALUES (null, :permiso, :llave)")
                ->execute(
                        array(
                            ':permiso' => $permiso,
                            ':llave' => $llave
                        ));

    }

    public function insertarRole($role)
    {
        //V16
        //echo "INSERT INTO roles VALUES(null, '" . $role . "');";
        $this->_db->prepare("INSERT INTO roles VALUES (null, :role)")
                ->execute(
                        array(
                           ':role' => $role
                        ));
    }

    public function editarRole($id, $role)
    {
        //V16
        $id = (int) $id;
        echo "UPDATE roles SET role = '" . $role . "' WHERE id_role = " . $id . ";";
        /*
        $this->_db->prepare("UPDATE roles SET role = :role WHERE id = :id")
                ->execute(
                        array(
                           ':id' => $id,
                           ':role' => $role
                        ));
        */
        $this->_db->prepare("UPDATE roles SET role = :role WHERE id_role = :id_role")
                ->execute(
                        array(
                           ':id_role' => $id,
                           ':role' => $role
                        ));
    }

    public function editarRoleError($id, $role)
    {
        //V16
        try {
            $id = (int) $id;
            echo "UPDATE roles SET role = '" . $role . "' WHERE id_role = " . $id . ";";
            $this->_db->prepare("UPDATE roles SET role = :role WHERE id = :id")
                ->execute(
                        array(
                           ':id_role' => $id,
                           ':role' => $role
                        ));
        } catch (Exception $e) {
            //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            //exit;
            /*
            echo 'entro al catch';
            exit;
            */
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
            echo $e->getMessage();
        }
        
        /*
        $this->_db->prepare("UPDATE roles SET role = :role WHERE id_role = :id_role")
                ->execute(
                        array(
                           ':id_role' => $id,
                           ':role' => $role
                        ));
        */
    }

    public function editarPermiso($id_permiso, $permiso, $llave)
    {
        //V16
        $id_permiso = (int) $id_permiso;

        $this->_db->prepare("UPDATE permisos SET permiso = :permiso, `key` = :llave WHERE id_permiso = :id_permiso")
                ->execute(
                        array(
                            ':id_permiso' => $id_permiso,
                            ':permiso' => $permiso,
                            ':llave' => $llave
                        ));
    }


}