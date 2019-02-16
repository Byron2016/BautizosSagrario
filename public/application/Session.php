<?php
//V7 - V8
class Session 
{
    public static function init()
    {
        //V7
        session_start();
    }
    
    public static function destroy($clave = FALSE)
    {
        //V7
        if ($clave) 
        {
            if (is_array($clave)) {
                for ($i=0; $i < count($clave); $i++) { 
                    if (isset($_SESSION[$clave[$i]])) {
                        unset($_SESSION[$clave[$i]]);
                    }
                }
            }
            else
            {
                if (isset($_SESSION[$clave])) {
                    unset($_SESSION[$clave]);
                }
            }
        }else{
            session_destroy();
        }
    }
    public static function set($clave, $valor)
    {
        //V7
        if (!empty($clave)) {
            $_SESSION[$clave] = $valor;
        }
        
    }
    public static function get($clave)
    {
        //V7
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        }
    }

    public static function acceso($level)
    {
        //V7  - V8
        if(!Session::get('autenticado')){
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
        
        Session::tiempo(); //V8
        
        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
    }

    public static function accesoView($level)
    {
        //V7 - V8
        
        if(!Session::get('autenticado')){
            return FALSE;
        }
        Session::tiempo(); //V8
        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){
            return FALSE;
        }
        
        return true;
    }

    public static function getLevel($level)
    {
        //V7
        //diferentes niveles de acceso en aplicación
        $rol['admin'] = 3;
        $rol['especial'] = 2;
        $rol['usuario'] = 1;
        
        if(!array_key_exists($level, $rol)){
            throw new Exception('Error de acceso en session.php funcion getLevel');
        }  else {
            return $rol[$level];
        }
    }
    
    public static function accesoEstricto(array $level, $noAdmin = FALSE)
    {
        //V8
        if(!Session::get('autenticado')){
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
        //Session::tiempo();
     
        if($noAdmin == false){
            if(Session::get('level') == 'admin'){
                return;
            }
        }
        
        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return;
            }
        }
        
        header('location:' . BASE_URL . 'error/access/5050');
        
    }

    public static function accesoViewEstricto(array $level, $noAdmin = FALSE)
    {
        //V8
        if(!Session::get('autenticado')){
            return false;
        }
        
        if($noAdmin == false){
            if(Session::get('level') == 'admin'){
                return true;
            }
        }
        
        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return true;
            }
        }
        
        return false;
    }

    public static function tiempo()
    {
        //V8
        if((!Session::get('tiempo')) || (!defined('SESSION_TIME'))){
            throw new Exception('Error Session/Tiempo: No se ha definido el timpo de sesion');
        }
        if(SESSION_TIME == 0){
            //tiempo de session indefinido
            return;
        }
        
        if((time() - Session::get('tiempo')) > (SESSION_TIME * 60)){
            Session::destroy();
            header('location:' . BASE_URL . 'error/access/8080');
        }
        else{
            Session::set('tiempo', time()); //reinicia tiempo de sesion y coloca el tiempo actual
        }
    }
    
}