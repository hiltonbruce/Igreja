<?php
	$altEdit = ($_SESSION["setor"]=='3' || $_SESSION["setor"]=='99') ? true:false;
	require_once 'views/secretaria/menuTopDados.php';
	$foco = (empty($_GET['bsc_rol'])) ? 'autofocus="autofocus"' : '';
?>
	<table class='table'>
		<tr>
			<td><form id="form1" name="form1" method="get" action="" >
			<label>
			<?PHP
			  echo $campo_rol;//valor recebido do script index.php
			  $anterior=$bsc_rol-1;
			  $proximo=$bsc_rol+1;
			  if ($anterior<=0)
			  {
			  $anterior=0;
			  }
			  ?></label>
			  </td>
			<td>
			  <input name="bsc_rol" type="text" id="bsc_rol" class="form-control"
			  <?PHP echo $foco;?> title="Insira o Rol" value="<?PHP echo $bsc_rol; ?>"/>
			  <input name="escolha" type="hidden" id="escolha" value="adm/dados_pessoais.php" />
	  		</td>
			<td>
			  <input type="submit" name="Submit2"  class="btn btn-primary btn-sm" value="Listar..." title="Click aqui para listar os dados do Membro" />
			</form>
			</td>
			<td>
	  <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&bsc_rol=<?PHP echo $anterior;?>" >
	  <button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-left"></span>
	  &nbsp;Registro Anterior
	  </button></a>
	  	</td>
			<td>
	  <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&bsc_rol=<?PHP echo $proximo;?>" >
	  <button class="btn btn-default btn-sm">&nbsp;Pr&oacute;ximo Registro&nbsp;
	  <span class="glyphicon glyphicon-chevron-right"></span></button></a></td>
			<td>
	  <?PHP if ($_GET["escolha"]<>"adm/cartao.php" && $_GET["escolha"]<>"adm/dados_cartas.php") {//O script cartao_print.php possui op��o pr�pria para impress�o ?>
	    <a href="relatorio/ficha.php?rol=<?php echo $bsc_rol;?>"
	    	title="Imprimir ficha completa" target='_black' >
	 		<button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span>
	 		&nbsp;Ficha 1</button>
		</a>
	  </td>
	  <td>
		<a href="./views/fichamembro.php?rol=<?php echo $bsc_rol;?>"
			title="Imprimir ficha completa" target='_black' >
			<button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span>&nbsp;Ficha 2
			</button>
		</a></td>
	  <?PHP } ?>
		</tr>
	</table>
	<?php
		require_once 'forms/autocompleta.php';
		if (!(strstr($_GET["escolha"], "dados_pessoais.php") || strstr($_GET["escolha"], "cartao.php")) && isset($_SESSION["membro"]))
		{
			echo 'Membro: '.$membro->nome().' - Cargo: '.cargo($bsc_rol)['0'].' - Congrega: '.$igreja->razao();
		}
	?>
