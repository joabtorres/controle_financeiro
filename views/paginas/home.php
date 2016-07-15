<?php if($_SESSION['id_user']) : ?>
<header><h3><strong>Internet Banking </strong><br><small>Confira o seu saldo bancário.</small></h3></header>
<article >
	<div class="row">
	  <div class="col-xs-4">
	    <a href="https://www2s.bancoamazonia.com.br/netbanking/" class="thumbnail" target="_blank" >
	      <img src="/views/imagens/img-amazonia.jpg" class="text-block img-center">
	      <span class="text-center  text-block">Banco da Amazônia</span>
	    </a>
	  </div>
	  <div class="col-xs-4">
	    <a href="http://www.banpara.b.br/menu/servi%C3%A7os/voce/internet-banking/" class="thumbnail" target="_blank" >
	      <img src="/views/imagens/img-banpara.jpg" class="text-block img-center">
	      <span class="text-center  text-block">Banco do Banpará</span>
	    </a>
	  </div>
	  <div class="col-xs-4">
	    <a href="http://banco.bradesco/html/classic/canais-digitais/internet-banking/" class="thumbnail" target="_blank" >
	      <img src="/views/imagens/img-bradesco.jpg" class="text-block img-center">
	      <span class="text-center  text-block">Banco do Bradesco</span>
	    </a>
	  </div>
	</div>

	<div class="row">
	  <div class="col-xs-4">
	    <a href="https://www30.bancobrasil.com.br/aai/" class="thumbnail" target="_blank" >
	      <img src="/views/imagens/img-brasil.jpg" class="text-block img-center">
	      <span class="text-center  text-block">Banco do Brasil</span>
	    </a>
	  </div>
	  <div class="col-xs-4">
	    <a href="https://internetbanking.caixa.gov.br" class="thumbnail" target="_blank" >
	      <img src="/views/imagens/img-caixa.jpg" class="text-block img-center">
	      <span class="text-center  text-block">Banco da Caixa</span>
	    </a>
	  </div>
	  <div class="col-xs-4">
	    <a href="https://www.itau.com.br/" class="thumbnail" target="_blank" >
	      <img src="/views/imagens/img-itau.jpg" class="text-block img-center">
	      <span class="text-center  text-block">Banco do Itaú</span>
	    </a>
	  </div>
	</div>
</article>
<?php else: header("Location: /home"); endif;?>