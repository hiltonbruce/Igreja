<?php
	require_once 'views/secretaria/menuTopDados.php';
	$foco = (empty($_GET['bsc_rol']) || empty($_GET['campo'])) ? 'autofocus="autofocus"' : '';
?>
<div class="bs-callout bs-callout-info" >
<form id="form1" name="form1" method="get" action="" >
<div class="row">
  <div class="col-xs-1">
		<h4>Busca</h4>
  </div>
  <div class="col-xs-1">
	<label>
		<?PHP
		echo $campo_rol;//valor recebido do script index.php
		$anterior=$bsc_rol-1;
		$proximo=$bsc_rol+1;
		if ($anterior<=0)
		{
			$anterior=0;
		}
		?>
  </div>
  <div class="col-xs-2">
		</label>
		<input name="bsc_rol" type="text" id="inputTwo" class="form-control input-sm"
		<?PHP echo $foco;?> title="Insira o Rol" value="<?PHP echo $bsc_rol; ?>" tabindex="<?php echo ++$ind;?>"/>
		<input name="escolha" type="hidden" id="escolha" value="adm/dados_pessoais.php" />
  </div>
  <div class="col-xs-8">
		<div class="btn-group" role="group" aria-label="...">
				<a href="./?escolha=<?PHP echo $_GET["escolha"];?>&bsc_rol=<?PHP echo $anterior;?>"
					 class="btn btn-default btn-sm" >
				<span class="glyphicon glyphicon-chevron-left"></span>
				&nbsp;Registro Anterior</a>
			<a href="./?escolha=<?PHP echo $_GET["escolha"];?>&bsc_rol=<?PHP echo $proximo;?>"
				class="btn btn-default btn-sm" >&nbsp;Pr&oacute;ximo Registro&nbsp;
			<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
			<?PHP if ($_GET["escolha"]<>"adm/cartao.php" && $_GET["escolha"]<>"adm/dados_cartas.php") {//O script cartao_print.php possui op��o pr�pria para impress�o ?>
			<a href="relatorio/ficha.php?rol=<?php echo $bsc_rol;?>"
				title="Imprimir ficha completa" target='_black' class="btn btn-primary btn-sm" >
			<span class="glyphicon glyphicon-print"></span>&nbsp;Ficha 1
			</a>
			<a href="./views/fichamembro.php?rol=<?php echo $bsc_rol;?>"
				title="Imprimir ficha completa" target='_black' class="btn btn-primary btn-sm" >
				<span class="glyphicon glyphicon-print"></span>&nbsp;Ficha 2
				</a>
				<?PHP } ?>
		</div>
	</div>
		<?php

		require_once "forms/sec/EasyAutocomplete.php";

		?>
		<div class="col-xs-2"><label>&nbsp;</label>
			<input type="submit" name="Submit2"  class="btn btn-primary btn-sm"
			value="Listar..." title="Click aqui para listar os dados do Membro"
 			tabindex="<?php echo ++$ind;?>"	/>

		</div>
</div>
</form>
	<?php
		// require_once 'forms/autocompleta.php';
		if (!(strstr($_GET["escolha"], "dados_pessoais.php") || strstr($_GET["escolha"], "cartao.php")) && isset($_SESSION["membro"]))
		{
			echo 'Membro: '.$membro->nome().' - Cargo: '.cargo($bsc_rol).' - Congrega: '.$igreja->razao();
		}
	?>
</div>
