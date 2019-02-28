<?php 
//ant - V13
/*
$ru = ROOT . DS . 'libs' . DS . 'smarty' . DS . 'Smarty.class.php';
echo $ru;
exit;
*/
require_once ROOT . DS . 'libs' . DS . 'smarty'. DS . 'libs' . DS . 'Smarty.class.php';

class View extends Smarty
{
    private $_controlador;
    private $_js;

	public function __construct(Request $peticion)
	{
        parent::__construct();
        $this->_controlador = $peticion->getControlador();
        $this->_js = array();

	}
    public function renderizar($vista, $item = false)
    {
        //ant - V13
        $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT .DS; //V13
		$this->config_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'configs' . DS ; //V13
		$this->cache_dir = ROOT . 'tmp' . DS . 'cache' .DS; //V13
		$this->compile_dir = ROOT . 'tmp' . DS . 'template' .DS; //V13

        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.tpl';
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

        if(is_readable($rutaView)){
            // include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            // include_once $rutaView;
            // include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
            $this->assign('_contenido' , $rutaView); //V13
        } else {
            throw new Exception ('Error application View: Error de vista');
        }

        $this->assign('_layoutParams', $_params); //V13
        $this->display('template.tpl'); //V13

        
    }

    public function setJs(array $js) 
    {
        //para enviar js que deseamos incluir en una vista
        if(is_array($js) && count($js))
        {
            for ($i=0; $i < count($js); $i++)
            {
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' .  $js[$i] . '.js';
                
            }
            //var_dump($this->_js);
        } else{
            throw new Exception('Error application View: SetJS Error de js'); 
        }
    }

}
