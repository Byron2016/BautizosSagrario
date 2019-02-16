<?php 
  
class View
{
    private $_controlador;
    private $_js;

	public function __construct(Request $peticion)
	{
        $this->_controlador = $peticion->getControlador();
        $this->_js = array();

	}
    public function renderizar($vista, $item = false)
    {
        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';
        //echo $rutaView;
        require_once APP_PATH . 'Menu.php';

        $js = array();
        if(count($this->_js)){
            $js = $this->_js;
        }
        
        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu,
            'js' => $this->_js,
        );
        if(is_readable($rutaView)){
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        } else {
            throw new Exception ('Error application View: Error de vista');
        }

        
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
