<table >
		<caption>Lançamento Concluído</caption>
		
			<colgroup>
				<col id="Conta">
				<col id="Débito">
				<col id="Crédito">
				<col id="Valor (R$)">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Conta</th>
				<th scope="col">Débito (R$)</th>
				<th scope="col">Crédito (R$)</th>
				<th scope="col">Saldo Atual</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php 
					echo $exibideb;//Valor retirado do script models/feccaixaculto.php
					echo $exibicred;//Valor retirado do script models/feccaixaculto.php
				?>
			</tr>
		</tbody>
	</table>
