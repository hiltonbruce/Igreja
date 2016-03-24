<form method="post" action="" name="" id="form1">&nbsp;
<?php
require_once 'forms/autoCompletaMembro.php';
?>
<table class="table">
	<tbody>
		<tr>
			<td><label>CPF:</label>
			<input type="text"  name="cpf" id="cpf" class="form-control"
			 value='<?PHP echo $cpf;?>' tabindex="<?PHP echo $ind++;?>" ></td>
			<td><label>Igreja que congrega</label>
			<input type="text"  name="igreja" id="igreja_val" disabled="disabled" class="form-control">
				<input type="hidden" name="escolha" value="controller/despesa.php">
				<input type="hidden" name="age" value="8"></td>
			<td><label>Fone: </label>
			<input type="text" id="id_val" name="id" class="form-control" disabled="disabled" value="" /></td>
			<td><label>Celular:</label>
			<input type="text" id="cel" class="form-control" name="sigla" disabled="disabled" value="" /></td>
		</tr>
		<tr>
			<td><label>RG:</label>
			<input type="text" name="rg" id="rg" class="form-control"
			 value='<?PHP echo $rg;?>' tabindex="<?PHP echo $ind++;?>" ></td>

			<td><label>Função:</label>
					<?php
					$bsccredor = new List_sele('funcao', 'descricao', 'idfunc');
					$listaIgreja = $bsccredor->List_Selec($ind++,$funcao,'class="form-control" required="required" ');
					echo $listaIgreja;

					$pgto ='';
					if ($diapgto=='1') {
						$pgto ='<option value="1">Dia 1º</option>';
					}elseif ($diapgto=='15') {
						$pgto ='<option value="15">Dia 15</option>';
					}elseif ($diapgto=='661') {
						$pgto ='<option value="661">Toda Sexta</option>';
					}elseif ($diapgto=='615') {
						$pgto ='<option value="615">Por Quinzena</option>';
					}elseif ($diapgto=='600') {
						$pgto ='<option value="600">Pgto da Sede</option>';
					}
						$pgto .='<option></option>';
					?>
				</td>
			<td><label>Dia pgto:</label> <select name="diapgto" required='required'
					tabindex="<?PHP echo ++$ind; ?>" class="form-control" autofocus="autofocus">
						<?PHP echo $pgto;?>
						<option value="1">1&ordm;</option>
						<option value="15">15</option>
						<option value="661">Sexta</option>
						<option value="615">Quinzena</option>
						<option value="600">Pgto's da Sede</option>
				</select>
		   </td>
			<td>
				<label>Fonte para pgto:</label>
				<?php
					$congr = new List_sele ("fontes", "discriminar", "fonte");
						echo $congr->List_Selec ($ind++,$tipo,' required="required" class="form-control"');
				?>
			</td>
		</tr>
	<tr>
		<td><label>Igreja onde presta o serviço:</label><?php
		$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
		$listaIgreja = $bsccredor->List_Selec($ind++,$igreja,'class="form-control" required="required" autofocus="autofocus" ');
		echo $listaIgreja;

		if (!empty($_GET['id'])) {
			echo '<input type="hidden" name="id" value="'.$_GET['id'].'" >';
		}
		?></td>
		<td>
		<label>Hierarquia:</label>
			<input type="text" name="hierarquia" tabindex="<?PHP echo $ind++;?>"
			 value='<?PHP echo $hier;?>' class="form-control" >
		</td>
		<td>
			<label>Valor:</label>
			<input type="text" name="valor" tabindex="<?PHP echo $ind++;?>"
			 value='<?PHP echo $vlrPago;?>' class="form-control" ></td>
		<td>
			<label>Código da Conta de Despesa:</label>
			<input type="text" name="acesso" tabindex="<?PHP echo $ind++;?>"
			value='<?PHP echo $codCta;?>' class="form-control"
			required="required" placeholder="Cód de acesso da conta"></td>
	</tr>
	<tr>
		<td></td>
		<td><label>&nbsp;</label> <input type="submit" name="Submit" value="Lançar..." class="btn btn-primary btn-sm"
						tabindex="<?PHP echo ++$ind; ?>" /></td>
	</tr>
	</tbody>
</table>
</form>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( fone, nome, celular, igreja, rol,cpf,rg ) {
			$("#id_val").val(fone);
			$("#estado_val").val(nome);
			$("#cel").val(celular);
			$("#igreja_val").val(igreja);
			$("#rol").val(rol);
			$("#cpf").val(cpf);
			$("#rg").val(rg);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autoMembroCargos.php?q=" + this.value;
	});
</script>
