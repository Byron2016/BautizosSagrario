<?php
//V12 - V21
class Paginador 
{
	//private $_registry; //22
	private $_datos; //registros devueltos
	private $_paginacion; //datos de la paginacion
	protected $_db;
	
	public function __construct() {
		$this->_datos = array();
		$this->_paginacion = array();
		//$this->_db = new Database(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASS, DB_CHAR); //22
		//$this->_registry = Registry::getInstancia(); //22
		//$this->_db = $this->_registry->_db;  //22
	}
	public function paginar($query, $pagina = false, $limite = false, $paginacion = false)
	{
		//echo 'valor de pagina: ' . $pagina;
		if($limite && is_numeric($limite))
		{
			$limite = $limite;
		} else {
			$limite = 10;
		}
		if($pagina && is_numeric($pagina))
		{
			$pagina = $pagina;
			$inicio = ($pagina -1) * $limite;
		} else {
			$pagina = 1;
			$inicio = 0;
		}
		$registros = count($query);
		$total = ceil($registros / $limite);
		$this->_datos = array_slice($query, $inicio, $limite);
		$paginacion = array();
		$paginacion['actual'] = $pagina;
		$paginacion['total'] = $total;
		$paginacion['limite'] = $limite; //V21
		if($pagina > 1){
			$paginacion['primero'] = 1;
			$paginacion['anterior'] = $pagina - 1;
		} else {
			$paginacion['primero'] = '';
			$paginacion['anterior'] = '';
		}
		if($pagina < $total){
			$paginacion['ultimo'] = $total;
			$paginacion['siguiente'] = $pagina + 1;
		} else {
			$paginacion['ultimo'] = '';
			$paginacion['siguiente'] = '';
		}		
		$this->_paginacion = $paginacion;
		$this->_RangoPaginacion($paginacion);
		return $this->_datos;
	}
	private function _RangoPaginacion($limite = false)
	{
		if($limite && is_numeric($limite))
		{
			$limite = $limite;
		} else {
			$limite = 10;
		}
		$total_paginas = $this->_paginacion['total'];
		$pagina_seleccionada = $this->_paginacion['actual'];
		$rango = ceil($limite / 2);
		$paginas = array();
		$rango_derecho = $total_paginas - $pagina_seleccionada;
		
		if($rango_derecho < $rango)
		{
			$resto = $rango - $rango_derecho;
		} else {
			$resto = 0;
		}
		$rango_izquierdo = $pagina_seleccionada	- ($rango + $resto);
		for ($i = $pagina_seleccionada; $i > $rango_izquierdo; $i--) { 
			if ($i == 0) {
				break;
			}
			$paginas[] = $i;
		}
		sort($paginas);
		if($pagina_seleccionada < $rango){
			$rango_derecho = $limite;
		} else {
			$rango_derecho = $pagina_seleccionada + $rango;
		}
		for($i = $pagina_seleccionada + 1; $i <= $rango_derecho; $i++){
			if($i > $total_paginas)
			{
				break;
			}
			$paginas[] = $i;
		}
		$this->_paginacion['rango'] = $paginas;
		return $this->_paginacion;
	}
	//crear vista solo para paginacion
	//para usar misma vista en varias paginaciones
	public function getView($vista, $link = false)
	{
		$rutaView = ROOT . 'views' . DS . '_paginador' . DS . $vista . '.php';
		if($link)
			$link = BASE_URL . $link . '/';
		if(is_readable($rutaView)) 
		{
			ob_start(); //apertura el buffer
			include $rutaView;
			$contenido = ob_get_contents();
			ob_end_clean(); //limpia el buffer que acabamos de extraer
			return $contenido;
		}
		throw new Exception('Paginador.php, getView Error de paginacion');
	}
}