<?php if($_SESSION['id_user']) : ?>
<header>
	<h3>
		<strong>Despesas </strong><br>
		<small class="text-danger">Confira suas despesas.</small>
	</h3> 
	<h4 class="text-right text-danger">Despesa Total: R$ <?php echo $despesa->numRows() > 0 ? number_format($despesa->getValorTotal(),2,",",".") : 0 ?></h4>
</header>
<articles>
	<p>
	<a href="/despesa/adicionar" class="btn btn-success">Adicionar</a>
	</p>
	<table class="table table-bordered table-hover">
		<tr class="success">
			<th>Nome</th>
			<th>Data</th>
			<th>Valor</th>
			<th>Ação</th>
		</tr>

		<?php if($despesa->numRows() >0) :
		foreach ($despesa->getDados() as $value) : ?>
		<tr>
			<td><?php echo $value['descricao'] ?></td>
			<td><?php $data = explode("-", $value['data']); echo $data[2]."/".$data[1]."/".$data['0']; ?></td>
			<td><?php echo number_format($value['valor'],2,",",".") ?></td>
			<td class="text-center">
				<a href="/despesa/editar/<?php echo $value['id']; ?>" class="btn btn-primary">Editar</a>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cExcluir<?php echo $value['id']; ?>">Excluir</button>

				<div class="modal fade" id="cExcluir<?php echo $value['id']; ?>" tabindex='-1' role='dialog' aria-labelledby="MyModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<header class="modal-header">
								<button type="button" class="close" data-dismiss='modal' aria-label="close"><span aria-hidden="true">&times;</span></button>
								<h2 class="text-left" >Despesa</h2>
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
								<a href="/despesa/deletar/<?php echo $value['id']; ?>" class="btn btn-primary">Confirmar</a>
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