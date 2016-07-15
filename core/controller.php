<?php 
	class Controller{
		public function loadView($view, $dados = array()){
			extract($dados);
			include 'views/paginas/'.$view.".php";
		}
	}
?>