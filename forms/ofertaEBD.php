<script type="text/javascript" src="js/autocomplete.js"></script>
<script	type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">

<?php
//$dtlanc = ($_GET['dtlanc']=='') ? date('d/m/Y'):$_GET['dtlanc'];
$meslanc = ($_GET['mes']=='' || $_GET['mes']>12 || $_GET['mes']<1) ? date('m'):$_GET['mes'];
$anolanc = ($_GET['ano']=='') ? date('Y'):$_GET['ano'];
?>
<form method="post" name="" action="">
<fieldset>
	<legend>Escola Bíblica</legend>
		<table style="background-color: #D3D3D3; border: 0;">
			<tbody>
				<tr>
					<td>
						<label>Entrada ref. Igreja:</label>
						<?php
						$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'required="required" autofocus="autofocus" class="form-control" ');
						echo $listaIgreja;
						?>
					</td>
					<td><label>Nome:</label><input type="text" name="nome" class="form-control"
						id="campo_estado" size="50%" tabindex="<?php echo ++$ind;?>" />

					<td><label>Rol:</label> <input type="text" id="rol" name="rol"
							value="" class="form-control" tabindex="<?php echo ++$ind;?>"/>
					</td>
				</tr>
				<tr>
					<td> <label>Data:</label> <input type="text" id="data" name="data"
						class="form-control" value="<?php echo $dtlanc;?>" tabindex="<?php echo ++$ind;?>"/>
					</td>
					<td>
     					<div class="row">
     					   <div class="col-xs-6">
					<label class="control-label">Mês:</label>
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
					      <?php
					      	$linha1 = '<option value="0">Selecione o mês...</option>';
						      foreach(arrayMeses() as $mes => $meses) {
								 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
								 if ($meslanc==$mes) {
								 	$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
								 }
						      }
						      echo $linha1.$linha2;
					      ?>
				      </select>
						</div>
     					   <div class="col-xs-4">
					<label class="control-label">Ano:</label> <input type="text"
						id="ano" name="ano" value="<?php echo $anolanc;?>"
						 class="form-control" tabindex="<?php echo ++$ind;?>"/>
						 </div>
						</div>

					</td>
					<td> <label>Situação e Congreg.</label> <input type="text"
						disabled="disabled" value="" id="cong" class="form-control"
						 />
					</td>
				</tr>
				<tr>
					<td> <label>Ofertas:</label> <input type="text" id="oferta0" name="oferta0"
						value="" tabindex="<?php echo ++$ind;?>" class="form-control"
						placeholder="Valor" />
					</td>
					<td><label>Pgto de Revistas EBD:</label><input type="text"
						id="oferta2" name="oferta2" value="" placeholder="Aqui não haverá provisão para COMADEP"
						tabindex="<?php echo ++$ind;?>" class="form-control" />
					</td>
					<td><label>Corpo de Prof. da EBD:</label><input type="text"
						id="oferta1" name="oferta1" value=""
						tabindex="<?php echo ++$ind;?>" class="form-control"
						placeholder="Valor" />
					</td>
				</tr>
		<tfoot><tr><td colspan="3" id='total'>
							Ofertas da Escola Bíblica e do Dep de Ensino (Estamos na:
							<?php echo semana(date('d/m/Y'));?>
							&ordf; Semana deste mês)
					</td>
				</tr>
		</tfoot>
			<tr>
				<td colspan="2">
		<label>Observação:</label><textarea name="obs" id="obs" class="form-control"
						cols="50%" tabindex="<?php echo ++$ind;?>"></textarea>
				</td>
				<td><input type="hidden" name="tipo" id="tipo" value="4"> <input
					type="hidden" name="escolha" value="models/dizoferta.php"> <input
					type="submit" name="listar" value="Lançar..."
					class="btn btn-primary btn-sm" tabindex="<?php echo ++$ind;?>">
				</td>
			</tr>
		</tbody>
	</table>
	</fieldset>
</form>

<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular, congr ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#rol").val(celular);
			$("#cong").val(congr);
		}

		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autodizimo.php?q=" + this.value;
	});
</script>

<!-- Desenvolvido por Wellington Ribeiro -->
