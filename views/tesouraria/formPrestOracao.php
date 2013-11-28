<fieldset>
		<legend>Circulos de Oração</legend>
		<table style="border: 0; width: 100%">
			<tbody>
				<tr class='odd'>
					<!-- A sede possui quatro cultos as congregações três calcular a data para mostrar as datas -->
					<td>Data: <br /> <input name="dataoracao" id="expedicao"
						type="text" value="<?php echo date('d/m/Y');?>"
						tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Total das Ofertas - Adulto:</label> <input name="oferta4"
						id="oferta4" type="text"
						tabindex="<?php echo ++$ind;?>">
					</td>
					<td>Total das Ofertas - Mocidade:<br /> <input name="oferta5" id="oferta5" type="text"
						tabindex="<?php echo ++$ind;?>">
					</td>
				</tr>
				<tr class='odd'>
					<td>Total das Ofertas - Infantis:<br /> <input name="oferta6" id="oferta6"
						type="text" tabindex="<?php echo ++$ind;?>">
					</td>
					<td><label>Total dos Voto:</label> <input name="oferta7" id="oferta7"
						type="text" tabindex="<?php echo ++$ind;?>">
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