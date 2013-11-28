
<form method="post" name="prestacao" action="" >
&nbsp;
<fieldset>
<legend>Dados da Igreja</legend>

<table style="border:0; width: 100%;">
<thead>
	<!-- Criar tabela temporaria p/ prestação de contas das Congregações -->
</thead>
	<tbody>
		<tr class ='odd'>
			<td>
				Data do Lançamento: <br /><?php echo date('d/m/Y');?><input name="data" id="data" type="hidden" value="<?php echo date('d/m/Y');?>"  OnKeyPress="formatar('##/##/####', this);" tabindex="<?php echo ++$ind;?>" />
			</td>
			<td>
				Igreja: <br />
				<?php 
					$lisigreja = new List_Igreja('igreja');
					//$lisigreja -> List_Selec(++$ind, '1');
					
					$igreja = ($_GET['rol']!='') ? $_GET['rol']:'1';
					$lisigreja -> igreja_pop(++$ind, $igreja);
				?>
				<input type="hidden" name="roligreja" value="<?php echo $_GET['rol'];?>" />
			</td>
			<td>
				<?php 
					$sem = semana(date('d/m/Y'));
					$sem_lanc = '<option value="'.$sem.'">'.$sem.'&ordf; Semana</option>';					
				?>
				<label>Semana</label>
				<select name='semanaof' id='semanaof' tabindex='<?php echo ++$ind;?>'>
				<?php echo $sem_lanc;?>
	       		<option value='1'>1&ordf; Semana</option>
	       		<option value='2'>2&ordf; Semana</option>
	       		<option value='3'>3&ordf; Semana</option>
	       		<option value='4'>4&ordf; Semana</option>
	       		<option value='5'>5&ordf; Semana</option>
		    	</select>
			</td>
			<td>Ano:<br />
				<input name="ano" id="ano" size="4" value="<?php echo date('Y');?>" maxlength="4" tabindex="<?php echo ++$ind;?>" >
			</td>
		</tr>
	</tbody>
</table>
</fieldset>
<fieldset>
<legend>Receita dos Cultos</legend>
<table style="border: 0; width: 100%">
	<tbody>
		<tr class ='odd'>
			<td>
				Culto do dia: <br /><input name="data1" id="data1" type="text" value="<?php echo date('d/m/Y');?>"  OnKeyPress="formatar('##/##/####', this);" tabindex="<?php echo ++$ind;?>" />
			</td>
			<td>
				Culto do dia: <br /><input name="data2" id="data2" type="text" value="<?php echo date('d/m/Y');?>"  OnKeyPress="formatar('##/##/####', this);" tabindex="<?php echo ++$ind;?>" />
			</td>
			<td>
				Culto do dia: <br /><input name="data3" id="data3" type="text" value="<?php echo date('d/m/Y');?>"  OnKeyPress="formatar('##/##/####', this);" tabindex="<?php echo ++$ind;?>" />
			</td>
		</tr>
		<tr class ='odd'>
			<td><label>Dizimos:</label>
				<input name="dizimo" autofocus="autofocus" id="dizimo1" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td><label>Dizimos:</label>
				<input name="oferta" id="dizimo2" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td><label>Dizimos:</label>
				<input name="ofertaex" id="dizimo3" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
		</tr>
		<tr class ='odd'>
			<td>Ofertas:<br />
				<input name="dizimo" id="oferta1" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td><label>Ofertas:</label>
				<input name="oferta" id="oferta2" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td>Ofertas:<br />
				<input name="ofertaex" id="oferta3" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
		</tr>
		<tr class ='odd'>
			<td>Ofertas Extras:<br />
				<input name="ofertaex1" id="ofertaex1" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td><label>Ofertas:</label>
				<input name="ofertaex2" id="ofertaex2" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td>Ofertas Extras:<br />
				<input name="ofertaex3" id="ofertaex3" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
		</tr>
		<tr class ='odd'>
			<td><label>Total do dia</label>&nbsp;
			</td>
			<td><label>Total do dia</label>&nbsp;
			</td>
			<td><label>Total do dia</label>&nbsp;
			</td>
		</tr>
		<tr class ='odd'>
			<td><label>Observação:</label>
				<input name="obs1" id="obs1" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td><label>Observação:</label>
				<input name="obs2" id="obs3" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
			<td><label>Observação:</label>
				<input name="obs3" id="obs3" type="text" tabindex="<?php echo ++$ind;?>" >
			</td>
		</tr>
	</tbody>
</table>
</fieldset>
	<input type="hidden" name="escolha" value="models/dizoferta.php">
	<input type="submit" name="listar" value="Lançar..." tabindex="<?php echo ++$ind;?>">
</form>	
