<?php 
	class UsuarioController extends Controller{
		public function index(){
			$this->login();
		}
		public function login(){

			$array = array('teste'=>false);;
			if(isset($_POST['tEmail']) && !empty($_POST['tEmail']) && isset($_POST['tSenha']) && !empty($_POST['tSenha'])){
				$usuario = array("email" => strtolower(addslashes($_POST['tEmail'])),
					"senha" => md5(addslashes($_POST['tSenha'])));

				$user = new UsuarioModel();
				$user->seleciona($usuario);
				if($user->numRows() > 0){
					$_SESSION['id_user'] = $user->getId();
					header("Location: /home");
				}else{
					$array['teste'] = true;
					$array['erro'] = "Usuário ou senha incorreto";
				}
			}
			$this->loadView("login", $array);
		}
		public function cadastrar(){		
			
			$validacao = array();
			$this->loadView('cadastrar-usuario',$validacao);
			if(isset($_POST['tCadastrar'])){
				if(isset($_POST['tNome']) && !empty($_POST['tNome'])){
					$usuario = array( 'nome' => ucwords(strtolower(addslashes($_POST['tNome']))));
					$validacao['nome'] = $_POST['tNome'];
					if(isset($_POST['tSobrenome']) && !empty($_POST['tSobrenome'])){
						$usuario['sobrenome'] = ucwords(strtolower(addslashes($_POST['tSobrenome'])));
						$validacao['sobrenome'] = $_POST['tSobrenome'];	

						if(isset($_POST['tEmail']) && !empty($_POST['tEmail'])){
							// FALTA CONSULTA NO BANCO SE O USUARIO JÁ ESTÁ CADASTRADO
							$user = new UsuarioModel();
							$user->seleciona(array('email'=>strtolower(addslashes($_POST['tEmail']))));

							if($user->numRows() > 0){
								$validacao['erro'] = 'E-mail já cadastrado';
							}else{
								$usuario['email'] = strtolower(addslashes($_POST['tEmail']));
								$validacao['email'] = $_POST['tEmail'];
								if(isset($_POST['tSenha']) && !empty($_POST['tSenha']) && 
									isset($_POST['tRepitSenha']) && !empty($_POST['tRepitSenha']) && ($_POST['tSenha'] == $_POST['tRepitSenha'])){
									if(strlen($_POST['tSenha']) >= 6){
										
										$usuario['senha'] = md5(addslashes($_POST['tSenha']));

										$new = new UsuarioModel();
										$new->salvar($usuario);
										$validacao = array();

										$msg = "<script>alert('Usuário cadastrado com sucesso!'); location.href='/home';</script>";
										echo $msg;
									}else{
										
										$validacao['erro'] = 'A senha deve conter acima de 6 digitos';
									}
								}else{
									
									$validacao['erro'] = "Senha incorreta ou não informada";
								}
							}	
						}else{
							
							$validacao['erro'] = 'Email não informado';
						}
					}else{
						
						$validacao['erro'] = 'Preencha todos os campos';
					}
				}else{
					$validacao['erro'] = 'Preencha todos os campos';
				}
			}

		}
		public function lembra_usuario(){
			$validacao = array();
			if(isset($_POST['tEmail']) && !empty($_POST['tEmail'])){
				$usuario = array("email" => strtolower(addslashes($_POST['tEmail'])));
				$user = new UsuarioModel();
				$user->seleciona($usuario);
				if($user->numRows() > 0){
					$senha = rand(100000,10000000);
					$usuario=array('senha' => md5($senha));
					$user->salvar($usuario, $user->getId());
					
					$para = $user->getEmail();
					$assunto = "NOVA SENHA - Controle Financeiro";
					$mensagem = "<meta charset='UFT-8'> Olá ".$user->getNome().",<br> Confira sua nova senha abaixo, é recomendado que altere depois. <br><br> <strong>Usuario: </strong>".$user->getEmail().'<br><strong>Senha: </strong>'.$senha."<br><br> Atenciosamente Controle Financeiro;";
					$mensagem = '
					<html>
					<head>
					 <title>'.$assunto.'</title>
					</head>
					<body>
					Olá '.$user->getNome().',<br> Confira sua nova senha abaixo, é recomendado que altere depois. <br><br> <strong>Usuario: </strong>'.$user->getEmail().'<br><strong>Senha: </strong>'.$senha.'<br><br> Atenciosamente Controle Financeiro;
					</body>
					</html>
					';
					
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: Controle Financeiro <controlefinanceiro@endogenese.com.br>' . "\r\n";
					$headers .= 'X-Mailer: PHP/'.phpversion();

					mail($para, $assunto, $mensagem, $headers);
					$msg = "<script>alert('Foi enviado uma nova senha para seu e-mail.'); location.href='/home';</script>";
					echo $msg;
				}else{
					$validacao['erro'] = "Usuário incorreto";
				}
			}
			$this->loadView('lembra-usuario',$validacao);
		}
	}
?>