<?php 
	class Core{
		public function run(){
			$url = $_GET['url'];
			if(!empty($url)){
				$url = explode("/", $url);
				$currentController = $url[0]."Controller";
				if(!empty($url[1])){
					$currentAction = $url[1];
				}else{
					$currentAction = "index";
				}
			}else{
				$currentController = "HomeController";
				$currentAction = "index";
			}
			
			require_once('core/controller.php');

			if(class_exists($currentController) && method_exists($currentController, $currentAction)){
				$c = new $currentController();
				$c->$currentAction();
			}else{
				$co = new Controller();
				$co->loadView("404");
			}
				
		}
	}
?>