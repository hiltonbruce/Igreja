
<form>
	<label>Pagamento realizado pelo: </label>
		<select name="igreja" id="igreja" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
			<?php
				$bsccredor = new tes_listDisponivel();
				$listaIgreja = $bsccredor->List_Selec_pop($linkAcesso.'&acesso=',$_GET['acesso']);
				echo $listaIgreja;
			?>
	</select>
	<?PHP
		$titTabela = 'Despesas';
		require_once 'views/tesouraria/lancTipoPlan.php';
	?>
</form>