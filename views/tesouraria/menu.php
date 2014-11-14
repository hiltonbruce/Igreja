<p>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "0"); ?> href="<?php echo $linkLancamento;?>&rec=0">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Busca</button></a>
	</div>

	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "1"); ?> href="<?php echo $linkLancamento;?>&rec=1">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Entradas</button></a>
	</div>

	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "3"); ?> href="<?php echo $linkLancamento;?>&rec=3">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Esc. Bíblica</button></a>
	</div>

	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "9"); ?> href="<?php echo $linkLancamento;?>&rec=9">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Resumo</button></a>
	</div>

	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "7"); ?> href="<?php echo $linkLancamento;?>&rec=7">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Saldos</button></a>
	</div>

	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "8"); ?> href="<?php echo $linkLancamento;?>&rec=8&tipo=1" title="Plano de Contas" >
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>"
	  	data-toggle="tooltip" data-placement="bottom" >Plano de Contas</button></a>
	</div>
	  <?php if ($_GET['rec']=='4' || $_GET['rec']=='5' || $_GET['rec']=='21'  ||
	  $_GET['rec']=='22'  || $_GET['rec']=='2') {
	  	$linkAtivo='active';
	  }else {
	  	$linkAtivo='';
	  }?>
	 <div class="btn-group">
	  <button type="button" class="btn btn-info btn-xs <?php echo $linkAtivo;?>">Lançamento</button>
	  <button type="button" class="btn btn-info btn-xs dropdown-toggle <?php echo $linkAtivo;?>" data-toggle="dropdown">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
		  <?php if ($_GET['rec']=='21' ) {
		  	$linkAtivo='class="active"';
		  }else {
		  	$linkAtivo='';
		  }?>
	    <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=21">Relatório</a></li>

		  <?php if ($_GET['rec']=='4' ) {
		  	$linkAtivo='class="active"';
		  }else {
		  	$linkAtivo='';
		  }?>
	    <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=4">Recibo</a></li>

		  <?php if ($_GET['rec']=='5' ) {
		  	$linkAtivo='class="active"';
		  }else {
		  	$linkAtivo='';
		  }?>
	    <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=5">Lan&ccedil;ar Despesa</a></li>
	    <li class="divider"></li>
		  <?php if ($_GET['rec']=='2' ) {
		  	$linkAtivo='class="active"';
		  }else {
		  	$linkAtivo='';
		  }?>
	    <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=2">Lan&ccedil;. Cont&aacute;bil</a></li>
	    <?PHP
	    	$linkAtivo = ($_GET['rec']=='22' ) ?  'class="active"': '' ;
	    	$linkEstonoDefino = 'data-toggle="tooltip" data-placement="bottom" href="'.$linkLancamento.'&rec=22" title="Estorna dizimos e ofertas"'
	    ?>
	    <li <?php echo $linkAtivo;?>><a <?php echo $linkEstonoDefino;?> >Estorno Definido</a></li>
	  </ul>
	</div>

	 <div class="btn-group">
		<a <?PHP $b=link_ativo($_GET["rec"], "6");?>
				href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=6">
				<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">COMADEP</button>
		</a>
	</div>
	</p>
