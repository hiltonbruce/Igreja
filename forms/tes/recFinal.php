<tr>
	<td>
		<label>Valor (R$):</label>
		<input name="valor" type="text" class="form-control money" size="14" tabindex="<?PHP echo ++$ind; ?>" value="<?php echo $_GET["valor"];?>" />
	</td><td colspan="2">
		<label>Data</label>
		<input name="data" type="text" id="data" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
		value="<?php echo $_GET["data"];?>" placeholder="Em branco para hoje" />
	</td>
</tr>
<tr>
	<td>
		<label>Fonte para pgto:</label>
		<select name="credito" id="caixa" class="form-control"
		tabindex="<?PHP echo ++$ind; ?>" <?PHP echo $desCampoCta; ?> >
			<?php
				$bsccredor = new tes_listDisponivel();
				$listaIgreja = $bsccredor->List_Selec($_GET["deb"]);
				echo $listaIgreja;
			?>
		</select>
	</td>
	<td colspan="2">
		<label>Igreja:</label>
		<?php
			$congr = new List_sele ("igreja","razao","igreja");
				echo $congr->List_Selec (++$ind,$_GET['igreja'],' class="form-control"');
		?>
	</td>
</tr>
<tr>
	<td colspan="3">
		Despesa com,
		<?php
			$conta = intval($_GET['cred']);
			if ($conta>0) {
				$cta = new DBRecord ("contas", $conta, "acesso");
				$cred = $cta->acesso();
				$nomeCred = $cta->titulo();
			} else {
				$cred = '';
				$nomeCred = '';
			}
			require_once 'forms/tes/autoCompletaContas.php';
		?>
	</td>
</tr>
<tr>
	<td colspan="3">
	<label>Referente a:</label>
   <textarea class="form-control" name="referente" id="referente" tabindex="<?PHP
   echo $ind++;?>" onKeyDown="textCounter(this.form.referente,this.form.remLen,255);"
		onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"
		placeholder="Informe de maneira curta o que motivou a emiss&atilde;o deste recibo"><?php echo $_GET["referente"];?></textarea>

   <div id="progreso"></div>
   (Max. 255 Carateres)
  <input readonly type=text class="btn" name=remLen size=3 maxlength=3 value="255">
Caracteres restantes
	<input type="submit" class="btn btn-primary" name="Submit" value="Emitir..." tabindex="<?PHP echo ++$ind; ?>"/>
				</td>
			</tr>
		</tbody>
	</table>
	<label></label>
	<input type="hidden" name="rec" value="<?php echo $rec;?>">
	<input type="hidden" name="transid" value="<?php echo (get_transid());?>">
</form>
</fieldset>
