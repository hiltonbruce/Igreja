<?php 
$ind=1;
$igreja = ($_GET['rol']!='') ? $_GET['rol']:'1';
?>
<fieldset>
	<legend>Lan&ccedil;amento Contábil</legend>
		<!-- Desenvolvido por Wellington Ribeiro -->
		<form method="post" name="autocompletar" action="">

		<table style="border: 0; background-color: transparent;">
			<tbody>
				<tr>
					<td><label>Valor (R$)</label> <input name="valor" type="text" autofocus="autofocus"
						id="valor" tabindex="<?PHP echo ++$ind; ?>" required = "required" />
					</td>
					<td><label>Igreja:</label> <?php
					$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
					$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'required="required" ');
					echo $listaIgreja;
					?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<?php
						conectar();
							require_once 'forms/tes/autoCompletaContas.php';
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label>Histórico</label>
						   <textarea class="text_area" name="referente" id="referente" tabindex="<?PHP
						   echo $ind++;?>" onKeyDown="textCounter(this.form.referente,this.form.remLen,255);" 
								onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"
								><?php echo $_GET["referente"];?></textarea>
						   
						   <div id="progreso"></div>
						   (Max. 255 Carateres)
						  <input readonly type=text name=remLen size=3 maxlength=3 value="255"> 
						Caracteres restantes
							<label></label>
					</td>
				<tr>
					<td><label>Data</label> <input name="data" type="text" id="data"
						tabindex="<?PHP echo ++$ind; ?> "
						value="<?php echo date('d/m/Y');?>" />
					</td>
					<td><input type="submit" name="Submit" value="Lançar..."
						tabindex="<?PHP echo ++$ind; ?>" /> <input name="escolha"
						type="hidden" value="models/tes/lancamento.php" />
					</td>
				</tr>
				</tr>
			</tbody>
		</table>
	</form>
</fieldset>