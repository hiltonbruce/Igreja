<fieldset>
	<legend>Relat&oacute;rio de Lan&ccedil;amentos</legend>
    <div class="form-group">
	<form method="get" name="" action="">
	<div class="row">
	  <div class="col-xs-2">
	  	<label>Dia</label>
	    <input type="text" name='dia' class="form-control" placeholder="dia"
	    tabindex="<?PHP echo ++$ind; ?>" value="<?PHP echo $dia;?>">
	  </div>
	  <div class="col-xs-3">
	  	<label>M&ecirc;s:</label>
		<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
		      <?php
		      	$linha1 = '<option value="0">Selecione o m&ecirc;s...</option>';
			      foreach(arrayMeses() as $mesRel => $meses) {
					 $linha2 .= '<option value='.$mesRel.'>'.$meses.'</options>';
					 if ($_GET['mes']==$mesRel) {
					 	$linha1 = '<option value='.$mesRel.'>'.$meses.'</options>'.$linha1;
					 }
			      }
			      echo $linha1.$linha2;
		      ?>
	      </select>
	  </div>
	  <div class="col-xs-2">
	  	<label>Ano:</label>
		<input type="text" name="ano" value="<?php echo $anoForm ;?>"
		tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
		<input type="hidden" name="membro"	value="<?php echo true;?>" />
		<input type="hidden" name="fin"	value="<?php echo $fin;?>" />
	  </div>
	  <div class="col-xs-4">
	  	<label>Congrega&ccedil;&atilde;o:</label>
		<?php
			$bsccredor = new List_sele('igreja', 'razao', 'igreja');
			$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control"');
			echo $listaIgreja;
		?>
	  </div>
	  <div class="col-xs-6"><br />
			<table class='table' style="background-color: #D3D3D3;">
				<tbody>
					<tr>
						<td colspan="3"><label>Conta</label><input type="text" name="nome"
							class="form-control" id="campo_estado" tabindex="<?PHP echo ++$ind; ?>"
							placeholder="Informe a conta" value="<?PHP echo $_GET['nome']; ?>" />
						</td>
					</tr>
					<tr>
						<td>C&oacute;digo/tipo:<br /> <input type="text" id="estado_val" class="form-control"
							name="estado_val" disabled="disabled" value="" />
						</td>
						<td>Saldo Atual: <br /> <input type="text" id="id_val" name="id" class="form-control"
							disabled="disabled" value="" /></td>
						<td>Acesso:<br /> <input type="text" id="acesso" name="conta" class="form-control"
							value="<?PHP echo $cta; ?>" tabindex="<?PHP echo ++$ind; ?>" /></td>
					</tr>
					<tr>
						<td colspan="3">Descri&ccedil;&atilde;o:<br />  <input type="text" size="78%" id="detalhe" name="det"
							disabled="disabled" class="form-control" /></td>
					</tr>
				</tbody>
			</table>
	  </div>
	  <div class="col-xs-5">
	  	<label>Referente:</label>
		<input type="text" name="refer" value="<?php echo $refer;?>"
		tabindex="<?PHP echo ++$ind; ?>" class="form-control"
		value="<?PHP echo $ref;?>" placeholder="Referente..." />
	  </div>
	  <div class="col-xs-3">
	  	<label>Conta c/ Lan&ccedil; de:</label>
	  	<label class="checkbox-inline">
		<input type="checkbox" name='deb' <?PHP echo $deb;?> id="debito" value="1"> D&eacute;bito
			</label>
		<label class="checkbox-inline">
		<input type="checkbox" name='cred' <?PHP echo $cred;?>  id="credito" value="1"> Cr&eacute;dito
		</label>
	  </div>
	  <div class="col-xs-2">
	  	<label>Lan&ccedil;amento N&ordm;:</label>
		<input type="text" name="numLanc" value="<?php echo $numLanc ;?>"
		tabindex="<?PHP echo ++$ind; ?>" class="form-control" placeholder="N&ordm; do lan&ccedil;amento" />
	  </div>
	  <div class="col-xs-3">
	  	<label>Valor:</label>
		<input type="text" name="vlrLanc" value="<?php echo number_format($vlrLanc, 2, ',', ' ') ;?>"
		tabindex="<?PHP echo ++$ind; ?>" class="form-control" placeholder="Valor lan&ccedil;ado" />
	  </div>
	  <div class="col-xs-3">
		<input name="escolha" type="hidden" value="tesouraria/receita.php" /><br />
		<input type="hidden" name="rec"	value="<?php echo $rec;?>" />
		<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
		tabindex="<?PHP echo ++$ind; ?>" />
		<input name="menu" type="hidden" value="top_tesouraria" />
	  </div>
	</div>
	</form>
	</div>
</fieldset>

<script type="text/javascript" src="js/autocomplete.js"></script>
<script
	type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link	rel="stylesheet" type="text/css" href="css/autocomplete.css">

<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular,detalhe ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#acesso").val(celular);
			$("#detalhe").val(detalhe);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/tes/autoContasId.php?q=" + this.value;
	});
</script>
