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
					<td><label>Valor (R$)</label> <input name="valor" type="text" autofocus="autofocus"
						id="valor" tabindex="<?PHP echo ++$ind; ?>" required = "required" class="form-control" />
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
						    conectar();
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
						   (Max. 255 Carateres)
						  <input readonly type=text name=remLen size=3 maxlength=3 value="255" class="form-control">
						Caracteres restantes
							<label></label>
					</td>
				<tr>
					<td><label>Data</label> <input name="data" type="text" id="data"
						tabindex="<?PHP echo ++$ind; ?> " class="form-control"
						value="<?php echo date('d/m/Y');?>" />
					</td>
					<td><label>&nbsp;</label> <input type="submit" name="Submit" value="Lan�ar..." class="btn btn-primary btn-sm"
						tabindex="<?PHP echo ++$ind; ?>" /> <input name="escolha"
						type="hidden" value="models/tes/lancamento.php" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</fieldset>
