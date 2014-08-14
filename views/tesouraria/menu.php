<p>
	  <a <?PHP $b=link_ativo($_GET["rec"], "0"); ?> href="<?php echo $linkLancamento;?>&rec=0">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Busca</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "1"); ?> href="<?php echo $linkLancamento;?>&rec=1">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Entradas</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "3"); ?> href="<?php echo $linkLancamento;?>&rec=3">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Esc. Bíblica</button></a>
	  
	 
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "9"); ?> href="<?php echo $linkLancamento;?>&rec=9">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Resumo</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "7"); ?> href="<?php echo $linkLancamento;?>&rec=7">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Saldos</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "8"); ?> href="<?php echo $linkLancamento;?>&rec=8&tipo=1" title="Plano de Contas" >
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Plano de Contas</button></a>
	  
	   <div class="btn-group">
	  <button type="button" class="btn btn-info btn-xs ">Lançamento</button>
	  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
	    <li><a href="<?php echo $linkLancamento;?>&rec=21">Relatório</a></li>
	    <li><a href="<?php echo $linkLancamento;?>&rec=4">Recibo</a></li>
	    <li><a href="<?php echo $linkLancamento;?>&rec=5">Lan&ccedil;ar Despesa</a></li>
	    <li class="divider"></li>
	    <li><a href="<?php echo $linkLancamento;?>&rec=2">Contábil</a></li>
	  </ul>
	</div>
	
	</p>