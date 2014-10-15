<form method="post" action="">
	&nbsp;
	<table class='table'>
		<tbody>
			<tr>
				<td><label>Gerar Recibos: </label> <select name="grupo" required='required'
					id="grupo" tabindex="<?PHP echo ++$ind; ?>" class="form-control" autofocus="autofocus">
						<option></option>
						<option value="1">Ministério</option>
						<option value="2">Tesoureiros</option>
						<option value="3">Auxílio</option>
						<option value="4">Zelador</option>
						<option value="6">Pgto's-Sexta-Feira</option>
						<option value="7">Pgto's Quinzenal</option>
						<option value="8">Pgto's Sede</option>
						<option value="5">Demais Pgto's</option>
				</select>
				</td>
				<td colspan="3"><label>Referente a ou motivo de todos os recibo</label> <textarea
						class="text_area form-control" name="referente" cols="25"
						id="referente" tabindex="<?PHP
   echo $ind++;?>" required='required'
						onKeyDown="textCounter(this.form.referente,this.form.remLen,255);"
						onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"><?php echo $_GET["referente"];?></textarea>

					<div id="progreso"></div> (Max. 255 Carateres) <input readonly
					type=text class="btn" name=remLen size=3 maxlength=3 value="255">
					Caracteres restantes <input type="submit" class="btn btn-primary"
					name="Submit" value="Emitir..." tabindex="<?PHP echo ++$ind; ?>" />
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="transid" value="<?php echo (get_transid());?>">
	<input type="hidden" name="rec" value="4">
</form>

