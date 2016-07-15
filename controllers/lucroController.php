<?php 
	class LucroController extends Controller{
		public function index(){
			$this->loadView('index',array('campo'=>'lista_lucro'));
		}
		public function adicionar($id=null){
			$dados = array('campo'=>'lucro');
			
			if(isset($_POST['tDescricao']) && !empty($_POST['tDescricao'])){
				$lucro = array();
				$lucro['descricao'] = addslashes($_POST['tDescricao']);
				$lucro ['id_usuario'] = addslashes($_SESSION['id_user']);
				if(isset($_POST['tValor']) && !empty($_POST['tValor'])){
					$lucro['valor'] = floatval(round(addslashes($_POST['tValor']),2));
					$lucro['data'] = addslashes($_POST['tData']);

					$new = new LDIModel();
					$msg;
					if(!empty($_POST['id'])){
						$id = addslashes($_POST['id']);
						$new->salvar('lucros', $lucro, $id);
						$msg = "<script>alert('Lucro alterado com sucesso!'); location.href='/lucro';</script>";
					}else{
						$new->salvar('lucros', $lucro);
						$msg = "<script>alert('Lucro adicionado com sucesso!'); location.href='/lucro';</script>";
					}
					echo $msg;
				}
			}else if(!empty($id)){
				$lucro = new LDIModel();
				$lucro->seleciona('lucros', array('id' => addslashes($id), 'id_usuario' => $_SESSION['id_user']));
				if($lucro->numRows() > 0){
					foreach ($lucro->getDados() as $key => $value) {
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
			$deleta->seleciona('lucros',array('id' => addslashes($id)));
			if($deleta->numRows()){
				$deleta->deletar('lucros', addslashes($id));
				$msg = "<script>alert('Lucro deletado com sucesso!'); location.href='/lucro';</script>";
				echo $msg;
			}

		}
	}
?>