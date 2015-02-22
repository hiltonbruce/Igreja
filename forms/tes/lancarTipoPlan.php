
<form>
	<label>Utilizar para pagamento: </label>
		<select name="igreja" id="igreja" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
			<?php
				$bsccredor = new tes_listDisponivel();
				$listaIgreja = $bsccredor->List_Selec_pop($linkAcesso,$idIgreja);
				//echo $listaIgreja;
			?>
	</select>
</form>