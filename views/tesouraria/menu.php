<p>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "0"); ?> href="<?php echo $linkLancamento;?>&rec=0">
	  <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Busca</button></a>
	</div>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "1"); ?> href="<?php echo $linkLancamento;?>&rec=1">
	  <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Entradas</button></a>
	</div>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "3"); ?> href="<?php echo $linkLancamento;?>&rec=3">
	  <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Esc. B&iacute;blica</button></a>
	</div>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "24"); ?> href="<?php echo $linkLancamento;?>&rec=24">
	  <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Lan&ccedil;. por Semanas</button></a>
	</div>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "9"); ?> href="<?php echo $linkLancamento;?>&rec=9">
	  <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Resumo</button></a>
	</div>
	  <?php if ($_GET['rec']=='4' || $_GET['rec']=='5' || $_GET['rec']=='21'  ||
	  $_GET['rec']=='22'  || $_GET['rec']=='2') {
	  	$linkAtivo='active';
	  }else {
	  	$linkAtivo='';
	  }?>
	 <div class="btn-group">
	  <button type="button" class="btn btn-info btn-sm dropdown-toggle <?php echo $linkAtivo;?>" data-toggle="dropdown">
	     Lan&ccedil;amento <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
		  <?php if ($_GET['rec']=='21' ) {
		  	$linkAtivo='class="active"';
		  }else {
		  	$linkAtivo='';
		  }
		  $linkRelt = '&rec=21';
		  ?>
	    <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento.$linkRelt;?>">Relat&oacute;rio</a></li>

		  <?php if ($_GET['rec']=='5' ) {
		  	$linkAtivo='class="active"';
		  }else {
		  	$linkAtivo='';
		  }?>
	    <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=5">Lan&ccedil;ar Pagamentos</a></li>
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
	<?PHP
		require_once 'views/menus/planoCtaMenu.php';
	?>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "25"); ?> href="<?php echo $linkLancamento;?>&rec=25">
	  <button type="button" class="btn btn-info btn-sm <?php echo $b;?>"
	  	><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Dados</button></a>
	</div>
	 <div class="btn-group">
	  <a <?PHP $b=link_ativo($_GET["rec"], "26"); ?> href="<?php echo $linkLancamento;?>&rec=26">
	  <button type="button" class="btn btn-info btn-sm <?php echo $b;?>"
		  ><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Fotos</button></a>
	</div>
	</p>
