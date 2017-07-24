<?php


namespace monControl\Controller;


class Controller {


	protected $layout;
	function __construct(){
		if(isset($_POST)){ 
			$this->data = $_POST;
		}
	}
	function render($filename , $data= array()){
		if($data != null){
			extract($data);
		}
		// var_dump($data);
		ob_start();
		require(ROOT.'app'.'/view/'.$filename.'.html');

 
		$content_for_layout = ob_get_clean();
		if($this->layout==false){
			 str_replace($content_for_layout,"{{}}",$data);

			 foreach($data as $value){
			 	echo $value."<br>";
			 }
			 
			//var_dump(str_replace($content_for_layout,"{{}}",$content_for_layout)); 
		} else {
			require_once(ROOT.'error404.php');
		}
		
	}
	function loadModel($name){
		require_once(ROOT.'models/'.strtolower($name).'Model.php');
		$this->$name = new $name();
	}

} 