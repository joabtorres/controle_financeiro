<?php 
	class investimentoController extends Controller{
		public function index(){
			$this->loadView('index',array('campo'=>'lista_investimento'));
		}
		public function adicionar($id=null){
			$dados = array('campo'=>'investimento');
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
						$new->salvar('investimentos', $array, $id);
						$msg = "<script>alert('Investimento alterado com sucesso!'); location.href='/investimento';</script>";
					}else{
						$new->salvar('investimentos', $array);
						$msg = "<script>alert('Investimento adicionado com sucesso!'); location.href='/investimento';</script>";
					}
					echo $msg;
				}
			}else if(!empty($id)){
				$investimento = new LDIModel();
				$investimento->seleciona('investimentos', array('id' => addslashes($id), 'id_usuario' => $_SESSION['id_user']));
				if($investimento->numRows() > 0){
					foreach ($investimento->getDados() as $key => $value) {
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
			$deleta->seleciona('investimentos',array('id' => addslashes($id)));
			if($deleta->numRows()){
				$deleta->deletar('investimentos', addslashes($id));
				$msg = "<script>alert('Investimento deletado com sucesso!'); location.href='/investimento';</script>";
				echo $msg;
			}

		}
	}
?>