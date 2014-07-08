<?php
require_once 'forms/autoCompletaMembro.php';
?>
<table class="table">
	<tbody>
		<tr>
			<td><label>Fone: </label>
			<input type="text" id="id_val" name="id" class="form-control" disabled="disabled" value="" /></td>
			<td><label>Celular:</label>
			<input type="text" id="cel" class="form-control" name="sigla" disabled="disabled" value="" /></td>
			<td colspan="2"><label>Igreja que congrega</label>
			<input type="text"  name="igreja" id="igreja_val" disabled="disabled" class="form-control"></td>
		</tr>
		<tr>
			<td><label>RG:</label>
			<input type="text" name="rg" id="rg" class="form-control"></td>
			<td><label>CPF:</label>
			<input type="text"  name="cpf" id="cpf" class="form-control"></td>
			<td colspan="2"><label>Função:</label>
					<?php
					$bsccredor = new List_sele('funcao', 'descricao', 'idfunc');
					$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['idfunc'],'class="form-control" required="required" ');
					echo $listaIgreja;
					?></td>
		</tr>
	<tr>
		<td><label>Igreja onde presta o serviço:</label><?php
		$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
		$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control" required="required" autofocus="autofocus" ');
		echo $listaIgreja;
		?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</tbody>
</table>
