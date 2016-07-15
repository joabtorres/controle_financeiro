
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
		<section class="row">
			<div class="col-xs-offset-4 col-xs-4">
				<form class="form" method="POST">
				<h2 class="text-center text-upercase">Lembra Senha</h2>
					<?php if(!empty($erro)) : ?>
						<p class="bg-danger"><?php echo $erro; ?></p>
					<?php endif; ?>
					<div class="form-group">
						<label for="cEmail">Email:</label>
						<input type="email" name="tEmail" id="cEmail" class="form-control"/>
					</div>
					<input type="submit" class="btn btn-primary btn-block" name="submit" value="Enviar"><br>
					<a href="/home" class="btn btn-danger btn-block">Cancelar</a>
				</form>
			</div>
		</section>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script src="/views/js/bootstrap.min.js"></script>
</body>
</html>
