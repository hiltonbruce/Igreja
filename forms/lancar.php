<?php
$ind=1;
$igreja = ($_GET['rol']!='') ? $_GET['rol']:'1';
?>
<fieldset>
	<legend>Lan&ccedil;amento Cont&aacute;bil</legend>
		<!-- Desenvolvido por Wellington Ribeiro -->
		<form method="post" name="autocompletar" action="">
		<table class='table'>
			<tbody>
				<tr>
					<td>
						<label>Valor (R$)</label> <input name="valor" type="text" autofocus="autofocus"
						id="valor" tabindex="<?PHP echo ++$ind; ?>" required = "required"
						class="form-control money" />
					</td>
					<td><label>Igreja:</label>
						<?php
							$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
							$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'required="required" class="form-control" ');
							echo $listaIgreja;
						?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<?php
							require_once $form;
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label>Hist&oacute;rico</label>
						   <textarea class="text_area form-control" name="referente" id="referente" tabindex="<?PHP
						   echo $ind++;?>" onKeyDown="textCounter(this.form.referente,this.form.remLen,255);"
								onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"
								 class="form-control"><?php echo $_GET["referente"];?></textarea>
 						    <div id="progreso"></div>
 						<div class="row">
 						  <div class="col-xs-2">
 						    <br /><br />(Max. 255 Carateres)
 						  </div>
 						  <div class="col-xs-2"><label>&nbsp;</label>
								<input readonly type=text name=remLen value="255" class="form-control">
							</div>
 						  <div class="col-xs-2">
 						    <br /><br />Caracteres restantes
 						  </div>
 						  <div class="col-xs-3">
								<label>Data</label> <input name="data" type="text" id="data"
									tabindex="<?PHP echo ++$ind; ?> " class="form-control"
									value="<?php echo date('d/m/Y');?>" />
 						  </div>
 						  <div class="col-xs-2">
								<label>&nbsp;</label> <input type="submit" name="Submit" value="Lan&ccedil;ar..." class="btn btn-primary btn-sm"
									tabindex="<?PHP echo ++$ind; ?>" /> <input name="escolha"
									type="hidden" value="models/tes/lancamento.php" />
 						  </div>
			 			</div>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</fieldset>
