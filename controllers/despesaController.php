<?php 
	class despesaController extends Controller{
		public function index(){
			$this->loadView('index',array('campo'=>'lista_despesa'));
		}
		public function adicionar($id=null){
			$dados = array('campo'=>'despesa');
			if(isset($_POST['tDescricao']) && !empty($_POST['tDescricao'])){
				$array = array();
				$array['descricao'] =addslashes($_POST['tDescricao']);
				$array ['id_usuario'] = addslashes($_SESSION['id_user']);
				if(isset($_POST['tValor']) && !empty($_POST['tValor'])){
					$array['valor'] = floatval(round(addslashes($_POST['tValor']),2));
					$array['data'] = addslashes($_POST['tData']);

					$new = new LDIModel();
					$msg;
					if(!empty($_POST['id'])){
						$id = addslashes($_POST['id']);
						$new->salvar('despesas', $array, $id);
						$msg = "<script>alert('Despesa alterado com sucesso!'); location.href='/despesa';</script>";
					}else{
						$new->salvar('despesas', $array);
						$msg = "<script>alert('Despesa adicionado com sucesso!'); location.href='/despesa';</script>";
					}
					echo $msg;
				}
			}else if(!empty($id)){
				$despesa = new LDIModel();
				$despesa->seleciona('despesas', array('id' => addslashes($id), 'id_usuario' => $_SESSION['id_user']));
				if($despesa->numRows() > 0){
					foreach ($despesa->getDados() as $key => $value) {
						$dados['id'] = $value['id'];
						$dados['descricao'] = $value['descricao'];
						$dados['valor'] = $value['valor'];
						$dados['data'] = $value['data'];
					}
				}
			}
			$this->loadView('index',$dados);
		}
		public function editar(){
			$id = explode("/", $_GET['url']);
			$this->adicionar($id[2]);
		}
		public function deletar(){
			$id = explode("/", $_GET['url']);
			$id = $id[2];
			$deleta = new LDIModel();
			$deleta->seleciona('despesas',array('id' => addslashes($id)));
			if($deleta->numRows()){
				$deleta->deletar('despesas', addslashes($id));
				$msg = "<script>alert('Despesa deletado com sucesso!'); location.href='/despesa';</script>";
				echo $msg;
			}

		}
	}
?>