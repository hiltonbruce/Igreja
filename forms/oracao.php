<?php 
	$ind=10;
	$igreja = $_GET['igreja'];
?>
<fieldset>
<legend>Circulos de Ora&ccedil;&otilde;es</legend>
<form id="form1" name="form1" method="post" action="">
<fieldset>
<legend>Dados da Igreja</legend>

<table style="border:0; width: 100%;">
<thead>
	<!-- Criar tabela temporaria p/ presta��o de contas das Congrega��es -->
</thead>
	<tbody>
		<tr class ='odd'>
			<td>
				Data do Cadastro: <br /><?php echo date('d/m/Y');?><input name="data" id="data" type="hidden" value="<?php echo date('d/m/Y');?>"  OnKeyPress="formatar('##/##/####', this);" />
			</td>
			<td>
				Igreja: <br />
				<?php 
					$lisigreja = new List_Igreja('igreja');					
					$igreja = ($_GET['rol']!='') ? $_GET['rol']:'1';
					$lisigreja -> igreja_pop('0', $igreja);
				?>
				<input type="hidden" name="roligreja" value="<?php echo $_GET['rol'];?>"/>
			</td>
			<td>
				<?php 
					$sem = semana(date('d/m/Y'));
					$sem_lanc = '<option value="'.$sem.'">'.$sem.'&ordf; Semana</option>';
				?>
				<label>Semana</label>
				<select name='semanaof' id='semanaof' >
				<?php echo $sem_lanc;?>
	       		<option value='1'>1&ordf; Semana</option>
	       		<option value='2'>2&ordf; Semana</option>
	       		<option value='3'>3&ordf; Semana</option>
	       		<option value='4'>4&ordf; Semana</option>
	       		<option value='5'>5&ordf; Semana</option>
		    	</select>
			</td>
			<td>Ano:<br />
				<input name="ano" id="ano" size="4" value="<?php echo date('Y');?>" maxlength="4" >
			</td>
		</tr>
	</tbody>
</table>
</fieldset>
<table>
	<colgroup>
		<col id="Adultos" />
		<col id="Mocidade" />
		<col id="albumCol" />
	</colgroup>
	<thead>
		<tr>
			<th scope="col">Adultos</th>
			<th scope="col">Mocidade</th>
			<th scope="col">Infantil</th>
		</tr>

	<tbody>
		<tr class ='odd'>
			<td>Ofertas Adulto:<br />
				<input name="ofertaa" autofocus="autofocus" type="text" tabindex="1" >
			</td>
			<td>Ofertas Mocidade:<br />
				<input name="ofertam" type="text" tabindex="3" >
			</td>
			<td>Ofertas Infantil:<br />
				<input name="ofertai" type="text" tabindex="5" >
			</td>
		</tr><tr class ='odd2'>
			<td>Votos Adulto:<br />
				<input name="votosa" type="text" tabindex="2" >
			</td>
			<td>Votos Mocidade:<br />
				<input name="votosm" type="text" tabindex="4" >
			</td>
			<td>Votos Infantil:<br />
				<input name="votosi" type="text" tabindex="6" >
			</td>
		</tr>
		<tr class ='odd'>
			<td colspan="2">
				<label>Data</label>
				<input name="data" type="text" id="data" size="10" OnKeyPress="formatar('##/##/####', this);
					" tabindex="8 "maxlength="10" value="<?php echo date('d/m/Y');?>" />
			</td>
			<td >		
				<label>Lan&ccedil;ar...</label>
				<input type="submit" name="Submit" value="Lan�ar..." tabindex="9"/>
			  	<input name="escolha" type="hidden" value="views/oracao.php" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</fieldset>
