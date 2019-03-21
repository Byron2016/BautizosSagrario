<?php

class Bootstrap
{
	public static function run(Request $peticion)
	{
		$controller = $peticion->getControlador() . 'Controller';
		$rutaControlador = ROOT . 'controllers' . DS . $controller  . '.php';
		// echo $rutaControlador; exit;
		$metodo =  $peticion->getMetodo();
		$args = $peticion->getArgs();
		/*
		echo "Bootstrap.php run rutaControlador "  . $rutaControlador . '<br>'; 
		echo "Bootstrap.php run controller "  . $controller . '<br>'; 
		echo "Bootstrap.php run metodo "  . $metodo . '<br>'; 
		echo "Bootstrap.php run args "  .  '<br>'; 
		print_r($args);
		echo "Bootstrap.php run args "  .  '<br>';
		//exit;
		*/
		if(is_readable($rutaControlador)){
			//vverificar si archivo existe y es legible
			require_once $rutaControlador;
			$controller = new $controller;
			if(is_callable(array($controller, $metodo))){
				$metodo = $peticion->getMetodo();
			} else {
				$metodo = DEFAULT_METODO;
			}
			if(isset($args)){
				call_user_func_array(array($controller, $metodo), $args);
			} else {
				call_user_func(array($controller, $metodo));
			}
		} else {
			throw new Exception('Error en application clase Bootstrap: No encontrado: ' . $rutaControlador);
		}
	}
}