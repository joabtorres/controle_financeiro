<?php 
	class PerfilController extends Controller{
		public function index(){
			
			$dados = array('campo'=>'perfil_usuario');
			$usuario = array();
			$user = new UsuarioModel();
			if(isset($_POST['tCadastrar'])){
				// NOME
				if(isset($_POST['tNome']) && !empty($_POST['tNome']) ){
					$usuario['nome'] = ucwords(strtolower(addslashes($_POST['tNome'])));
					// SOBRENOME
					if(isset($_POST['tSobrenome']) && !empty($_POST['tSobrenome'])){
						$usuario['sobrenome'] = ucwords(strtolower(addslashes($_POST['tSobrenome'])));								
					}else{
						$dados['erro'] = 'Preencha os campos Sobrenome';
					}

				}else{
					$dados['erro'] = 'Preencha o campos Nome';
				}

			if(isset($_POST['tSenha']) && !empty($_POST['tSenha']) && 
				isset($_POST['tRepitSenha']) && !empty($_POST['tRepitSenha'])){
				if($_POST['tSenha'] != $_POST['tRepitSenha']){
					$dados['erro'] = 'Senha incorreta, por favor digite novamente';
				} 
				if(strlen($_POST['tSenha']) >= 6){
					$usuario['senha'] = md5(addslashes($_POST['tSenha']));	
				}else{
					$dados['erro'] = 'A senha deve conter acima de 6 digitos';
				}
			}	

			//UPLOAD FOTO
			if(!empty($_FILES['tImagem']) && !empty($_FILES['tImagem']['tmp_name'])){
				$imagem['temp'] = $_FILES['tImagem']['tmp_name'];
				$imagem['extensao'] =explode(".", $_FILES['tImagem']['name']);
				$imagem['extensao'] = strtolower(end($imagem['extensao']));
				$imagem['nome'] = md5($_FILES['tImagem']['name'].time()).".".$imagem['extensao'];
				$imagem['diretorio'] = "uploads/".$imagem['nome'];
				if($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png'){

					$largura = 150;
					$altura = 150;
					list($larguraOriginal, $alturaOriginal) = getimagesize($imagem['temp']);
					$ratio = $larguraOriginal/$alturaOriginal;
					if($largura/$altura > $ratio){
						$largura = $altura*$ratio;
					}else{
						$altura = $largura/$ratio;
					}

					$imagem_final = imagecreatetruecolor($largura, $altura);

					if($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg'){
						$imagem_original = imagecreatefromjpeg($imagem['temp']);
						imagecopyresampled($imagem_final, $imagem_original,
							0,0,0,0,
							$largura, $altura, $larguraOriginal, $alturaOriginal);
						imagejpeg($imagem_final, $imagem['diretorio'], 90);
					}else if($imagem['extensao'] == 'png'){
						$imagem_original = imagecreatefrompng($imagem['temp']);
						imagecopyresampled($imagem_final, $imagem_original,
							0,0,0,0,
							$largura, $altura, $larguraOriginal, $alturaOriginal);
						imagepng($imagem_final, $imagem['diretorio']);
					}
					
					$user->seleciona(array('id'=> addslashes($_POST['tID'])));
					$foto = $user->getUrl_foto()
					if(!empty($foto)){
						unlink($user->getUrl_foto());
					}
					$usuario['url_foto'] = $imagem['diretorio'];
					
				}else {
					$dados['erro'] = "Só pode carregar arquivos com extensão png, jpg e jpeg";
				}
				
			}	
			
			// SE EXITE ERRO
			if(empty($dados['erro'])){
				$user->salvar($usuario, addslashes($_POST['tID']));					
				$msg = "<script>alert('Usuário Alterado com sucesso!'); location.href='/home';</script>";
				echo $msg;
			}
		}

			$this->loadView('index',$dados);

		}
	}
?>