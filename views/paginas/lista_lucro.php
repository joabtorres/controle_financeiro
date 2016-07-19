<?php if($_SESSION['id_user']) : ?>
<header>
	<h3>
		<strong>Lucros </strong><br>
		<small class="text-danger">Confira seus lucros.</small>
	</h3> 
	<h4 class="text-right text-danger">Lucro Total: R$ <?php echo $lucro->numRows() > 0 ? number_format($lucro->getValorTotal(),2,",",".") : 0 ?></h4>
</header>
<articles>
	<p>
	<a href="/lucro/adicionar" class="btn btn-success">Adicionar</a>
	</p>
	<table class="table table-bordered table-hover">
		<tr class="success">
			<th>Nome</th>
			<th>Data</th>
			<th>Valor</th>
			<th>Ação</th>
		</tr>

		<?php if($lucro->numRows() >0) :
		foreach ($lucro->getDados() as $value) : ?>
		<tr>
			<td><?php echo $value['descricao'] ?></td>
			<td><?php $data = explode("-", $value['data']); echo $data[2]."/".$data[1]."/".$data['0']; ?></td>
			<td>R$ <?php echo number_format($value['valor'],2,",",".") ?></td>
			<td class="text-center">
				<a href="/lucro/editar/<?php echo $value['id']; ?>" class="btn btn-primary">Editar</a>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cExcluir<?php echo $value['id']; ?>">Excluir</button>

				<div class="modal fade" id="cExcluir<?php echo $value['id']; ?>" tabindex='-1' role='dialog' aria-labelledby="MyModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<header class="modal-header">
								<button type="button" class="close" data-dismiss='modal' aria-label="close"><span aria-hidden="true">&times;</span></button>
								<h2 class="text-left" >Lucro</h2>
							</header>
							<section class="modal-body">
								<p class="text-left">Deseja excluir este registro?<br>
									<strong>
									<?php echo $value['descricao'] ?> - 
									R$ <?php echo number_format($value['valor'],2,",",".");?>
									</strong>
								</p>
							</section>
							<footer class="modal-footer">
								<a href="/lucro/deletar/<?php echo $value['id']; ?>" class="btn btn-primary">Confirmar</a>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							</footer>
						</div>
					</div>
				</div>
			</td>
		</tr>
	<?php endforeach; endif; ?>
	</table>
</article>
<?php else: header("Location: /home"); endif;?>