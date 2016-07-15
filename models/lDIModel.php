<?php 
	class LDIModel extends Banco{
		private $pdo;
		private $valorTotal;
		private $numRows;
		private $dados;
		public function __construct(){
			$this->pdo = $this->conexaoPDO();
		}
		public function numRows(){
			return $this->numRows;
		}
		public function getValorTotal(){
			$this->valorTotal = 0;
			foreach ($this->getDados() as $key => $value) {
				$this->valorTotal += $value['valor'];
			}
			return $this->valorTotal;
		}

		public function getDados(){
			return $this->dados;
		}
		public function seleciona($tabela,$dados, $where_cond = "AND"){
			if(!empty($dados) && is_array($dados)){
				$sql = "SELECT id, descricao, valor, data FROM ".$tabela." WHERE ";
				$arrayCol = array();
				$arrayValue = array();
				foreach ($dados as $key => $value) {
					$arrayCol[] = $key." = ?";
					$arrayValue[] = $dados[$key];
				}
				$sql .= implode(" ".$where_cond." ", $arrayCol);
				$sql .= " ORDER BY id DESC";
				$sql = $this->pdo->prepare($sql);
				$sql->execute($arrayValue);
		
				if($sql->rowCount() >0){
					$this->numRows = $sql->rowCount();
					$this->dados = $sql->fetchAll();
				}
			}
		}
		public function salvar($tabela, $dados, $id=null){
			if(!empty($id)){
				$sql = "UPDATE ".$tabela." SET ";
				$arrayCol = array();
				$arrayValue = array();
				foreach ($dados as $chave => $value) {
					$arrayCol[] = $chave." = ?";
					$arrayValue[] = $dados[$chave];
				}
				$sql .= implode(", ", $arrayCol);
				$arrayValue[] = $id; 
				$sql .= " WHERE id = ?";
				$sql = $this->pdo->prepare($sql);
				$sql->execute($arrayValue);
			}else{
				$sql = "INSERT INTO ".$tabela." SET ";
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
		public function deletar($tabela, $id){
			if(!empty($id)){
				$sql ="DELETE FROM ".$tabela." WHERE id = ?";
				$sql = $this->pdo->prepare($sql);
				$sql->execute(array($id));
			}
		}
	}
?>