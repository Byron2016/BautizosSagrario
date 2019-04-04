<?php 
//ant - V13 - V15 - V19 - V20 - V24
/*
$ru = ROOT . DS . 'libs' . DS . 'smarty' . DS . 'Smarty.class.php';
echo $ru;
exit;
*/
require_once ROOT . DS . 'libs' . DS . 'smarty'. DS . 'libs' . DS . 'Smarty.class.php';

class View extends Smarty
{
    //V15 - V19 - V20 - V24
    //private $_controlador; //V19 comentado
    private $_request; //V19
    private $_js;
    private $_acl; //V15
    private $_rutas; //V19
    private $_jsPlugin; //V20 para cargar plugins que esten ubicados en public/js
    private $_template; //V24

	public function __construct(Request $peticion, ACL $_acl) //V15 aumenta , ACL $_acl
	{
        //V15 - V24
        //echo 'View constructor ' . '<br>';
        parent::__construct();
        //$this->_controlador = $peticion->getControlador(); //V19 comentado
        $this->_request = $peticion; //V19
        $this->_js = array();
        $this->_acl = $_acl; //V15
        $this->_rutas = array(); //V19
        $this->_jsPlugin = array(); //V20
        $this->_template = DEFAULT_LAYOUT; //V24

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
    public function renderizar($vista, $item = false, $noLayout = false)
    {
        //ant - V13 - V19 - V20
        //echo 'View renderizar ' . '<br>';
        
        $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . $this->_template .DS; //V13
		$this->config_dir = ROOT . 'views' . DS . 'layout' . DS . $this->_template . DS . 'configs' . DS ; //V13
		$this->cache_dir = ROOT . 'tmp' . DS . 'cache' .DS; //V13
		$this->compile_dir = ROOT . 'tmp' . DS . 'template' .DS; //V13

        // $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.tpl'; //V19 Comentado
        //echo $rutaView;
        //echo APP_PATH . 'Menu.php';
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
            'ruta_css' => BASE_URL . 'views/layout/' . $this->_template . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . $this->_template . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . $this->_template . '/js/',
            'menu' => $menu,
            'item' => $item, //V13
            'js' => $this->_js,
            'js_plugin' => $this->_jsPlugin, //V20
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
            if($noLayout){
                //V20 para llamar la vista sin presencia de layout
                $this->template_dir = $this->_rutas['view'];
                $this->display( $this->_rutas['view'] . $vista . '.tpl');
                exit;
            }
            //V19
            $this->assign('_contenido' , $this->_rutas['view'] . $vista . '.tpl'); //V19
        } else {
            //V19
            throw new Exception ('Error application View: Error de vista');
        }

        $this->assign('_acl', $this->_acl); //V15

        $this->assign('_layoutParams', $_params); //V13
        //echo 'View renderizar antes display template ' . '<br>';
        //var_dump($_params); //exit;
        //echo "antes display";
        $this->display('template.tpl'); //V13
        //echo "luego display";

        
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

	public function setJsPlugin(array $js) 
    {
        //V20
    	//para enviar js que deseamos incluir en una vista
        if(is_array($js) && count($js))
        {
            for ($i=0; $i < count($js); $i++)
            {
                $this->_jsPlugin[] = BASE_URL . 'public/js/' .  $js[$i] . '.js';
                
            }
        } else{
            throw new Exception('Error View: SetJS Error de js plugin'); 
        }
    }

    public function setTemplate($template)
    {
        //V24
        $this->_template = (string) $template;
    }

    public function widget($widget, $method, $options = array())
    {
        //V24
        //método q llama al widget
        //este método actua como un bootstrap para los widgets
        if(!is_array($options)){
            $options = array($options); //si no se envia como arreglo, el parametro se convertira en arreglo
        }
        //echo ROOT . 'widgets' . DS . $widget . '.php';
        if(is_readable(ROOT . 'widgets' . DS . $widget . '.php')){
            include_once ROOT . 'widgets' . DS . $widget . '.php';
            $widgetClass = $widget . 'Widget';
            echo $widgetClass . '<br>';
            if(!class_exists($widgetClass)){
                throw new Exception('Error View: widget Error clase widget a'); 
            }
            if(is_callable($widgetClass, $method)){
                if(count($options)){
                    return call_user_func_array(array(new $widgetClass, $method), $options);
                }
                else {
                    return call_user_func(array(new $widgetClass, $method));
                }
            }
            throw new Exception('Error View: widget Error Metodo widget b'); 
        }
        throw new Exception('Error View: widget Error de widget c'); 
    }

}
