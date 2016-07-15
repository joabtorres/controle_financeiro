<?php 
	class PerfilController extends Controller{
		public function index(){
			
			$dados = array('campo'=>'perfil_usuario');
			if(isset($_POST['tCadastrar'])){
				// NOME
				if(isset($_POST['tNome']) && !empty($_POST['tNome']) ){
					$usuario = array();
					$usuario['nome'] = ucwords(strtolower(addslashes($_POST['tNome'])));
					$dados['nome'] = $usuario['nome'];

					// SOBRENOME
					if(isset($_POST['tSobrenome']) && !empty($_POST['tSobrenome'])){
						$usuario['sobrenome'] = ucwords(strtolower(addslashes($_POST['tSobrenome'])));
						$dados['sobrenome'] = $usuario['sobrenome'];

							
						if(isset($_POST['tSenha']) && !empty($_POST['tSenha']) && 
							isset($_POST['tRepitSenha']) && !empty($_POST['tRepitSenha']) && 
							($_POST['tSenha'] == $_POST['tRepitSenha'])){
							if(strlen($_POST['tSenha']) >= 6){
								$usuario['senha'] = md5(addslashes($_POST['tSenha']));
								//UPLOAD FOTO
								if(!empty($_FILES['tImagem'])){
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
									$user = new UsuarioModel();
									$user->seleciona(array('id'=> addslashes($_POST['tID'])));
									if($user->getUrl_foto()){
										unlink($user->getUrl_foto());
									}
									$usuario['url_foto'] = $imagem['diretorio']	;
									$user->salvar($usuario, addslashes($_POST['tID']));
									
									$msg = "<script>alert('Usuário Alterado com sucesso!'); location.href='/home';</script>";
									echo $msg;
								}else {
									$dados['erro'] = "Só pode carregar arquivos com extensão png, jpg e jpeg";
								}
								
							}	

								

							}else{
								$dados['erro'] = 'A senha deve conter acima de 6 digitos';
							}
						}else{
							$dados['erro'] = "Senha incorreta ou não informada";
						}		
					}else{
						$dados['erro'] = 'Preencha todos os campos obrigatórios';
					}

				}else{
					$temerro = true;
					$dados['erro'] = 'Preencha todos os campos obrigatórios';
				}

				
					
		}
			$this->loadView('index',$dados);
		}
	}
?>