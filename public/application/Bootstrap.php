<?php

class Bootstrap
{
	//ant - V18
	public static function run(Request $peticion)
	{
		$modulo = $peticion->getModulo(); //V18
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

		if($modulo){
			//V18
			//revisamos si trabajamos en base a modulo o controlador
			$rutaModulo = ROOT . 'controllers' . DS . $modulo . 'Controller.php';
			//$rutaModulo = ROOT . 'modules' . DS . $modulo . DS . 'controllers' . DS . $controller . '.php'; //revisa si hay controlador base para el modulo. El proposito de este es q proporcione código para el módulo completo.
			//echo $rutaModulo . '<br>'; exit;
			if(is_readable($rutaModulo)){
				require_once $rutaModulo;
				$rutaControlador = ROOT . 'modules' . DS . $modulo . DS .  'controllers' . DS . $controller . '.php';
			}
			else {
				throw new Exception('Error en Bootstrap: No encontrado modulo solicitado: ' );
			}
		}
		else {
			$rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';
			//echo $rutaControlador;
		}








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