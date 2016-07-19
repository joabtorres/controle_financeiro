<?php 
	class HomeController extends Controller{
		
		public function index(){
			if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])){
				$this->loadView("index");
			}else{
				header("Location: /usuario/login");
			}	
		}
		public function sair(){
			$_SESSION['id_user'] = array();
			header("location: /usuario/login");
		}
	}
 ?>