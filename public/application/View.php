<?php 
  
class View
{
	private $controlador;

	public function __construct(Request $peticion)
	{
		$this->_controlador = $peticion->getControlador();

	}
    public function renderizar($vista, $item = false)
    {
        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';

        require_once APP_PATH . 'Menu.php';
        
        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu,
            //'js' => $this->_js,
        );
        if(is_readable($rutaView)){
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        } else {
            throw new Exception ('Error application View: Error de vista');
        }
    }

}
