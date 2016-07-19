<?php if($_SESSION['id_user']) :
	$user = new UsuarioModel();
	$user->seleciona(array('id' => $_SESSION['id_user']));
	$lucro = new LDIModel();
	$despesa = new LDIModel();
	$investimento = new LDIModel();
	$lucro->seleciona('lucros', array('id_usuario'=>$_SESSION['id_user']));
	$despesa->seleciona('despesas', array('id_usuario'=>$_SESSION['id_user']));
	$investimento->seleciona('investimentos', array('id_usuario'=>$_SESSION['id_user']));

 ?>
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
	<section class="container ">
		<article class="row">
			<header class="col-xs-12" id="header">
				<section class="row">
					<article class="col-xs-12">
					<?php $foto =$user->getUrl_foto(); if(!empty($foto)) : ?>
					<img src="/<?php echo $user->getUrl_foto(); ?>" alt="Foto do Usuário" class="float-left foto-usuario">
					<?php else: ?>
					<img src="/views/imagens/usuario.jpg" alt="Foto do Usuário" class="float-left foto-usuario">
					<?php endif; ?>	
					<p><strong><?php echo $user->getNome()." ".$user->getSobrenome(); ?></strong>
					</p>
					<ul class="list-unstyled">
						<li>Lucros: R$ <?php echo $lucro->numRows() > 0 ? number_format($lucro->getValorTotal(),2,",",".") : 0 ?></li>
						<li>Despesas: R$ <?php echo $despesa->numRows() > 0 ? number_format($despesa->getValorTotal(),2,",",".") : 0 ?></li>
						<li>Investimentos: R$ <?php echo $investimento->numRows() > 0 ? number_format($investimento->getValorTotal(),2,",",".") : 0 ?></li>
						<li>Saldo: R$ 
							<?php
							$l = $lucro->numRows() > 0 ? floatval($lucro->getValorTotal()) : 0;
							$d = $despesa->numRows() > 0 ? floatval($despesa->getValorTotal()) : 0;
							$i = $investimento->numRows() > 0 ? floatval($investimento->getValorTotal()) : 0;
							echo number_format(($l-$d-$i),2,',','.');	
							?>
						</li>
					</ul>
					</article>
				</section>
			</header>
		</article>
		<article class="row">
			<aside class="col-xs-2 sidebar">
				<nav class="menu">
					<ul class="list-unstyled">
						<li><a href="/home">Inicial</a></li>
						<li><a href="/lucro">Lucros</a></li>
						<li><a href="/despesa">Despesas</a></li>
						<li><a href="/investimento">Investimentos</a></li>
						<!-- <li><a href="/consultas">Consultas</a></li> -->
						<li><a href="/perfil">Perfil</a></li>
						<li><a href="/home/sair">Sair</a></li>
					</ul>
				</nav>
			</aside>
			<section class="col-xs-10">

				<?php 
					if(!empty($campo)){
						require_once ($campo.".php");
					}else{
						require_once ('home.php');
					}
				?>

				
			</section>
		</article>
		<article class="row">
			<footer class="col-xs-12">
				<p class="text-center">Joab Torres Alencar <br> 2016</p>
			</footer>
		</article>
	</section>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script src="/views/js/bootstrap.min.js"></script>
</body>
</html>

<?php else: header("Location: /home"); endif;?>