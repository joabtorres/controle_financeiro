
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Sistema de Controle Financeiro</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/views/css/bootstrap.min.css" rel="stylesheet">
    <link href="/views/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="col-xs-offset-1 col-xs-10">
			
			<form method="POST" class="form">
			<h2 class="text-center"><strong>Novo Usuário</strong></h2>
			<p class="danger">* : Campo obrigatório</p>
				<?php if(!empty($erro)){ ?>
							<p class="bg-danger"><?php echo $erro; ?></p>
				<?php  }else if(!empty($msg)){?>
						<p class="bg-success"><?php echo $msg; ?></p>
				<?php }?>
				<div class="form-group">
					<label for="cNome">Nome: * </label>
					<input type="text" name="tNome" id="cNome" class="form-control" value="<?php echo $nome ?>">
				</div>
				<div class="form-group">
					<label for="cSobrenome">Sobrenome: * </label>
					<input type="text" name="tSobrenome" id="cSobrenome" class="form-control" value="<?php echo $sobrenome ?>">
				</div>
				<div class="form-group">
					<label for="cEmail">Email: * </label>
					<input type="email" name="tEmail" id="cEmail" class="form-control" value="<?php echo $email ?>">
				</div>
				<div class="form-group">
					<label for="cSenha">Senha: * </label>
					<input type="password" name="tSenha" id="cSenha" class="form-control">
				</div>
				<div class="form-group">
					<label for="cRepitSenha">Repetir senha: * </label>
					<input type="password" name="tRepitSenha" id="cRepitSenha" class="form-control">
				</div>

					<p class="text-right"><input type="submit" value="Cadastrar" name="tCadastrar" class="btn btn-primary"> <a href="/home" class="btn btn-danger">Cancelar</a></p>
			</form>
		</div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script src="/views/js/bootstrap.min.js"></script>
</body>
</html>
