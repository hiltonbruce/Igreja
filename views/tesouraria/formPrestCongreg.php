<fieldset>
		<legend>Receita de Cultos</legend>
		<table style="border: 0; width: 100%">
			<tbody>
				<tr class='odd'>
					<!-- A sede possui quatro cultos as congregações três calcular a data para mostrar as datas -->
					<td>Data do Culto: <br /> <input name="dataculto" id="data"
						type="text" value="<?php echo date('d/m/Y');?>"
						tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Dizimos:</label> <input name="oferta0"
						id="oferta0" type="text"
						tabindex="<?php echo ++$ind;?>">
					</td>
					<td>Ofertas:<br /> <input name="oferta1" id="oferta1" type="text"
						tabindex="<?php echo ++$ind;?>">
					</td>
				</tr>
				<tr class='odd'>
					<td>Ofertas Extras:<br /> <input name="oferta2" id="oferta2"
						type="text" tabindex="<?php echo ++$ind;?>">
					</td>
					<td><label>Voto:</label> <input name="oferta3" id="oferta3"
						type="text" tabindex="<?php echo ++$ind;?>">
					</td>
					<td><label>Observa&ccedil;&atilde;o:</label> <input name="obs1"
						id="obs1" type="text" tabindex="<?php echo ++$ind;?>">
					</td>
				</tr>
				<tr class='odd'>
					<td colspan="2">Alerta para próxima prestação:<br /> <input name="alerta" id="alerta"
						type="text" size="50%" tabindex="<?php echo ++$ind;?>">
					</td>
					<td>
						<input type="hidden" name="escolha" value="models/dizoferta.php"> <input
							type="submit" name="listar" value="Lan&ccedil;ar..."
							tabindex="<?php echo ++$ind;?>">
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>