<?php
//V7
class errorController extends Controller
{
	
	public function __construct()
	{
        //V7
		parent::__construct();
	}
	public function index()
	{
        //V7 - V15
        // $this->_view->titulo = 'Error'; //V15 se comenta
        // $this->_view->mensaje = $this->_getError(); //V15 se comenta

        //V15
        $this->_view->assign('titulo','Error'); //V15
        $this->_view->assign('mensaje',$this->_getError()); //V15


        $this->_view->renderizar('index');
        
    }

    public function access($codigo)
    {
        //V7 - V15
        //$this->_view->titulo = 'Error'; //V15 se comenta
        //$this->_view->mensaje = $this->_getError($codigo); //V15 se comenta

        //V15
        $this->_view->assign('titulo','Error'); //V15
        $this->_view->assign('mensaje',$this->_getError($codigo)); //V15

        $this->_view->renderizar('access');
    }

    private function _getError($codigo = false)
	{
        //V7 - V8
        if($codigo){
            $codigo = $this->filtrarInt($codigo);
            if(is_int($codigo))
                $codigo = $codigo;
        }else{
            $codigo = 'default';
        }
           
        $error['default'] = 'Ha ocurrido un error y la pagina no puede mostrarse';
        $error['5050'] = 'Acceso Restringido';
        $error['8080'] = 'Tiempo de la session agotado'; //V8 //se define para manejar tiempo de sesion
        if(array_key_exists($codigo, $error))
        {
            return $error[$codigo];
        }  else {
            return $error['default'];
        }
    }

}
