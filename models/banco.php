<?php 
	class Banco{
		protected function conexaoPDO(){
			try{
				$pdo = new PDO('mysql:dbname=controle_financeiro;host=localhost', 'root', '');
			}catch(PDOException $e){
				echo "Falho: ".$e->getMessage();
			}
			return $pdo;
		}
	}
?>