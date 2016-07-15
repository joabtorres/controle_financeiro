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
			<td><?php echo number_format($value['valor'],2,",",".") ?></td>
			<td class="text-center">
				<a href="/lucro/editar/<?php echo $value['id']; ?>" class="btn btn-primary">Editar</a>
				<a href="/lucro/deletar/<?php echo $value['id']; ?>" class="btn btn-primary">Excluir</a>
			</td>
		</tr>
	<?php endforeach; endif; ?>
	</table>
</article>

<?php else: header("Location: /home"); endif;?>