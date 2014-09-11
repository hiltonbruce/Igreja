<form method="post" action="" name="" id="form1">&nbsp;
<?php
require_once 'forms/autoCompletaMembro.php';
?>
<table class="table">
	<tbody>
		<tr>
			<td><label>CPF:</label>
			<input type="text"  name="cpf" id="cpf" class="form-control" tabindex="<?PHP echo $ind++;?>" ></td>
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
			<input type="text" name="rg" id="rg" class="form-control" tabindex="<?PHP echo $ind++;?>" ></td>
			
			<td><label>Função:</label>
					<?php
					$bsccredor = new List_sele('funcao', 'descricao', 'idfunc');
					$listaIgreja = $bsccredor->List_Selec($ind++,$_GET['idfunc'],'class="form-control" required="required" ');
					echo $listaIgreja;
					?></td>
			<td><label>Dia pgto:</label>
			<input type="text" name="diapgto" id='dia' tabindex="<?PHP echo $ind++;?>" 
				 required="required" class="form-control" ></td>
			<td>	
				<label>Fonte para pgto:</label>
				<?php 						
					$congr = new List_sele ("fontes", "discriminar", "fonte");
						echo $congr->List_Selec ($ind++,$_GET['fonte'],' required="required" class="form-control"');
				?>
			</td>
		</tr>
	<tr>
		<td><label>Igreja onde presta o serviço:</label><?php
		$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
		$listaIgreja = $bsccredor->List_Selec($ind++,$_GET['igreja'],'class="form-control" required="required" autofocus="autofocus" ');
		echo $listaIgreja;
		?></td>
		<td>
		<label>Hieraquia:</label>
		<select name="hieraquia" id="" tabindex="<?PHP echo $ind++;?>" class="form-control" 
			required="required" >
              <option value=""></option>	
              <option value="1">Primeiro</option>
              <option value="2">Segundo</option>
              <option value="2">Terceiro</option>
              <option value="4">Quarto</option>
		  </select></td>
		<td>
			<label>Valor:</label>
			<input type="text" name="valor" tabindex="<?PHP echo $ind++;?>" class="form-control" ></td>
		<td>
			<label>Código da Conta de Despesa:</label>
			<input type="text" name="acesso" tabindex="<?PHP echo $ind++;?>" class="form-control" 
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