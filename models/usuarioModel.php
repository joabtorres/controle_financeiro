<?php 
	class UsuarioModel extends Banco{
		private $pdo;
		private $numRows;
		private $id;
		private $nome;
		private $sobrenome;
		private $email;
		private $url_foto;
		public function __construct(){
			$this->pdo= $this->conexaoPDO();
		}
		public function numRows(){
			return $this->numRows;
		}
		public function getId(){
			return $this->id;
		}
		public function getNome(){
			return $this->nome;
		}
		public function getSobrenome(){
			return $this->sobrenome;
		}
		public function getEmail(){
			return $this->email;
		}
		public function getUrl_foto(){
			return $this->url_foto;
		}
		public function salvar($dados, $id = null){
			if(!empty($id)){
				$sql = "UPDATE usuarios SET ";
				$arrayCol = array();
				$arrayValue = array();
				foreach ($dados as $chave => $value) {
					$arrayCol[] = $chave." = ?";
					$arrayValue[] = $dados[$chave];
				}
				$sql.=implode(", ", $arrayCol);
				$arrayValue[] = $id; 
				$sql .= " WHERE id = ?";
				$sql = $this->pdo->prepare($sql);
				$sql->execute($arrayValue);
			}else{
				$sql = "INSERT INTO usuarios SET ";
				$arrayCol = array();
				$arrayValue = array();
				foreach ($dados as $chave => $value) {
					$arrayCol[] = $chave." = ?";
					$arrayValue[] = $dados[$chave];
				}
				$sql.=implode(", ", $arrayCol);
				$sql = $this->pdo->prepare($sql);
				$sql->execute($arrayValue);
			}
		}
		public function seleciona($dados, $where_cond = "AND"){
			if(!empty($dados) && is_array($dados)){
				$sql = "SELECT * FROM usuarios WHERE ";
				$arrayCol = array();
				$arrayValue= array();
				foreach ($dados as $chave => $valor) {
					$arrayCol[] = $chave." = ?";
					$arrayValue[] = $dados[$chave];
				}
				$sql .= implode(" ".$where_cond." ", $arrayCol);
				$sql = $this->pdo->prepare($sql);
				$sql->execute($arrayValue);

				$this->numRows = $sql->rowCount(); 
				
				if($sql->rowCount() > 0){
					$dado = $sql->fetch();
					$this->id = $dado['id'];
					$this->nome = $dado['nome'];
					$this->sobrenome = $dado['sobrenome'];
					$this->email = $dado['email'];
					$this->url_foto = $dado['url_foto'];
				}
			}
		}
	}
?>