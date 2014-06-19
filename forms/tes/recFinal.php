<tr>
	<td>
		<label>Valor (R$):</label>
		<input name="valor" type="text" class="form-control" id="valor" size="14" tabindex="<?PHP echo ++$ind; ?>" value="<?php echo $_GET["valor"];?>" />
	</td><td colspan="2">
		<label>Data</label>
		<input name="data" type="text" id="data" class="form-control" tabindex="<?PHP echo ++$ind; ?>" 
		value="<?php echo $_GET["data"];?>" placeholder="Em branco para hoje" />
	</td>
</tr>
<tr>
	<td>	
		<label>Fonte para pgto:</label>
		<?php 						
			$congr = new List_sele ("fontes", "discriminar", "fonte");
				echo $congr->List_Selec (++$ind,$_GET['fonte'],' class="form-control"');
		?>
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
	<label>Referente a/motivo do recibo</label>
   <textarea class="text_area form-control" name="referente" cols="25" id="referente" tabindex="<?PHP
   echo $ind++;?>" onKeyDown="textCounter(this.form.referente,this.form.remLen,255);" 
		onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"
		><?php echo $_GET["referente"];?></textarea>
   
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