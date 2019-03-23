<?php 
//ant - V13 - V15
/*
$ru = ROOT . DS . 'libs' . DS . 'smarty' . DS . 'Smarty.class.php';
echo $ru;
exit;
*/
require_once ROOT . DS . 'libs' . DS . 'smarty'. DS . 'libs' . DS . 'Smarty.class.php';

class View extends Smarty
{
    //V15 - V19
    //private $_controlador; //V19 comentado
    private $_request; //V19
    private $_js;
    private $_acl; //V15
    private $_rutas; //V19

	public function __construct(Request $peticion, ACL $_acl) //V15 aumenta , ACL $_acl
	{
        //V15
        //echo 'View constructor ' . '<br>';
        parent::__construct();
        //$this->_controlador = $peticion->getControlador(); //V19 comentado
        $this->_request = $peticion; //V19
        $this->_js = array();
        $this->_acl = $_acl; //V15
        $this->_rutas = array(); //V19

        $modulo = $this->_request->getModulo();//V19
        $controlador = $this->_request->getControlador();//V19
        
        if($modulo){
            //V19
			$this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
			$this->_rutas['js'] = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/js/' ;
		}
		else {
            //V19
			$this->_rutas['view'] = ROOT . 'views' . DS . $controlador . DS;
			$this->_rutas['js'] = BASE_URL .  'views/' . $controlador . '/js/' ;
		}


	}
    public function renderizar($vista, $item = false)
    {
        //ant - V13 - V19
        //echo 'View renderizar ' . '<br>';
        $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT .DS; //V13
		$this->config_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'configs' . DS ; //V13
		$this->cache_dir = ROOT . 'tmp' . DS . 'cache' .DS; //V13
		$this->compile_dir = ROOT . 'tmp' . DS . 'template' .DS; //V13

        // $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.tpl'; //V19 Comentado
        //echo $rutaView;

        require_once APP_PATH . 'Menu.php';

        $js = array();
        if(count($this->_js)){
            $js = $this->_js;
        }
        /*
        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu,
            'js' => $this->_js,
        );
        */

        $_params = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu,
            'item' => $item, //V13
            'js' => $this->_js,
            'root' => BASE_URL, //V13
            'configs' => array( //V13
                'app_name' =>APP_NAME,
                'app_slogan' => APP_SLOGAN,
                'app_company' => APP_COMPANY
            )
        );

        /*
        //V19comentado
        if(is_readable($rutaView)){
            // include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            // include_once $rutaView;
            // include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
            $this->assign('_contenido' , $rutaView); //V13
        } else {
            throw new Exception ('Error application View: Error de vista');
        }
        */
        //V19
        if(is_readable($this->_rutas['view'] . $vista . '.tpl')){
            //V19
            $this->assign('_contenido' , $this->_rutas['view'] . $vista . '.tpl'); //V19
        } else {
            //V19
            throw new Exception ('Error application View: Error de vista');
        }


        $this->assign('_acl', $this->_acl); //V15

        $this->assign('_layoutParams', $_params); //V13
        //echo 'View renderizar antes display template ' . '<br>';
        $this->display('template.tpl'); //V13

        
    }

    public function setJs(array $js) 
    {
        //ant - V19
        //para enviar js que deseamos incluir en una vista
        if(is_array($js) && count($js))
        {
            for ($i=0; $i < count($js); $i++)
            {
                //$this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' .  $js[$i] . '.js'; //V19 cometado
                $this->_js[] = $this->_rutas['js'] .  $js[$i] . '.js'; //V19
                
            }
            //var_dump($this->_js);
        } else{
            throw new Exception('Error application View: SetJS Error de js'); 
        }
    }

}
