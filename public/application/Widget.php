<?php 
abstract class Widget
{
    //V24
    protected function loadModel($model) 
    {
        //V24
    	if(is_readable(ROOT . 'widgets' . DS . 'models' . DS . $model . '.php')){
    		include_once ROOT . 'widgets' . DS . 'models' . DS . $model . '.php';
    		$modelClass = $model . 'Modelwidget';
    		if(class_exists($modelClass)){
    			return new $modelClass;
    		}
    	}
    	throw new Exception("Error clase widged fun loadModel: error modelo de widget");
    	
    }
    protected function render($view, $data = array(), $ext = 'phtml') 
    {
        //V24
    	if(is_readable(ROOT . 'widgets' . DS . 'views' . DS .  $view . '.' . $ext)){
    		ob_start();
    		extract($data);
    		include ROOT . 'widgets' . DS . 'views' . DS .  $view . '.' . $ext;
    		//echo ROOT . 'widgets' . DS . 'views' . DS .  $view . '.' . $ext; exit;
    		$content = ob_get_contents();
    		ob_end_clean();
    		return $content;
    	}
    	throw new Exception("Error clase widged fun redenr: error vista  widget");
        
    }
}