<?php if($_SESSION['id_user']) :?>
<header>
	<h3>
		<strong>Perfil do usuario </strong><br>
		<small class="text-danger">Confira seu perfil.</small>
	</h3> 
	<p class="bg-info">OBS: É recomendado que seja preenchido todos os campos.</p>
</header>
<form method="POST" enctype="multipart/form-data">
	<?php if(!empty($erro)): ?>
				<p class="bg-danger"><?php echo $erro; ?></p>
	<?php endif;?>
	<input type="hidden" name="tID" value="<?php echo $user->getId(); ?>">
	<div class="form-group col-xs-6">
		<label for="cNome">Nome: * </label>
		<input type="text" name="tNome" id="cNome" class="form-control" value="<?php echo $user->getNome(); ?>">
	</div>
	<div class="form-group col-xs-6">
		<label for="cSobrenome">Sobrenome: * </label>
		<input type="text" name="tSobrenome" id="cSobrenome" class="form-control" value="<?php echo $user->getSobrenome(); ?>">
	</div>
	<div class="form-group col-xs-6">
		<label for="cEmail">Email: </label>
		<input type="email" id="cEmail" class="form-control" value="<?php echo $user->getEmail() ?>" disabled="yes">
		<input type="hidden" name="tEmail" value="<?php echo $user->getEmail() ?>"/>
	</div>
	<div class="form-group col-xs-6">
		<label for="cSenha">Nova Senha:  </label>
		<input type="password" name="tSenha" id="cSenha" class="form-control">
	</div>
	<div class="form-group col-xs-6">
		<label for="cRepitSenha">Repetir nova senha: </label>
		<input type="password" name="tRepitSenha" id="cRepitSenha" class="form-control">
	</div>
	<div>
		<div class="form-group col-xs-6">
			<label for="cImagem">Foto do Perfil: </label>
			<input type="file" name="tImagem" id="cImagem" class="form-control">
		</div>
	</div>

		<p class="text-right"><input type="submit" value="Alterar" name="tCadastrar" class="btn btn-primary btn-block"> <br><a href="/home" class="btn btn-danger btn-block">Cancelar</a></p>
</form>
<?php else: header("Location: /home"); endif;?>