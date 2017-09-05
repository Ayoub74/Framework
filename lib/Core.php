<?php

namespace frw;

class Core{


	public static function run(){
		
		try{

			define('WEBROOT',str_replace('public/index.php','',$_SERVER['SCRIPT_NAME']));
			define('ROOT',str_replace('public/index.php','',$_SERVER['SCRIPT_FILENAME']));
			self::getAutoload();




			if(isset($_GET['p'])){
				$params = explode('/',$_GET['p']);	
			}
			else{
				$params[0] = "";
			}


			$controller = !empty($params[0]) ? $params[0] : 'index'; 
			$action = isset($params[1]) ? $params[1] : 'index';

 

			if (!file_exists(ROOT.'app/controllers/'.$controller.'Controller.php')){
				require_once(ROOT.'error404.php');
			}
			else{
 
				$controller = "app\controllers\\".$controller."Controller";
				// var_dump($controller);
				$controller = new $controller();
			}
			if (method_exists($controller, $action."Action")){
				unset($params[0]);
				unset($params[1]);
				call_user_func_array(array($controller,$action."Action"),$params);


			} else {
				require_once(ROOT.'error404.php') ;
			}
		}

		catch(Exception $e)
		{
			if ($e instanceof NotFoundException) {

				header('HTTP/1.1 404 Not Found');


			} else {

				header('HTTP/1.1 504 Internal Server Error');

			}
		}
	}

	public static function getAutoload(){
		spl_autoload_register('self::registerAutoload');
	}

	public static function registerAutoload($class){
		
		$class = explode("\\", $class);
		// var_dump($class);
		if(isset($class[2]) && file_exists(ROOT."app/controllers/".$class[2].".php")){
			// echo ROOT."app/controllers/".$class[2].".php";
			require_once ROOT."app/controllers/".$class[2].".php";

		}

		elseif(isset($class[2]) && file_exists(ROOT."app/models/".$class[2].".php")){
			// echo ROOT."app/models/".$class[2].".php";
			require_once ROOT."app/models/".$class[2].".php";

		}
		elseif(isset($class[2]) && file_exists(ROOT."lib/".$class[2].".php")){
			
			require_once ROOT."lib/".$class[2].".php";

		}
	}

}