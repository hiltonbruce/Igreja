
<form method="post" name="prestacao" action="">
		<table style="border: 0; width: 100%;">
			<thead>
			</thead>
			<tbody>
				<tr>
					<td>Data do Lan&ccedil;amento: <br /> <?php echo date('d/m/Y');?><input
						name="data" type="hidden" value="<?php echo date('d/m/Y');?>" />
					</td>
					<td>Igreja: <br /> 
					<?php
						$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'required="required" autofocus="autofocus" ');
						echo $listaIgreja;
					?> 
					<input type="hidden" name="roligreja"
						value="<?php echo $_GET['rol'];?>" />
					</td>
					<td><?php 
					$sem = semana(date('d/m/Y'));
					$sem_lanc = '<option value="'.$sem.'">'.$sem.'&ordf; Semana (atual)</option>';
					?> 
					<label>Semana</label> 
						<select name='semanaof' id='semanaof' 
								required='required' tabindex="<?php echo ++$ind;?>">
							<option value=''> Informe a Semana</option>
							<?php echo $sem_lanc;?>
							<option value='1'>1&ordf; Semana</option>
							<option value='2'>2&ordf; Semana</option>
							<option value='3'>3&ordf; Semana</option>
							<option value='4'>4&ordf; Semana</option>
							<option value='5'>5&ordf; Semana</option>
						</select>
					</td>
					<td>Ano:<br /> <input name="ano" id="ano" size="4"
						value="<?php echo date('Y');?>" maxlength="4">
					</td>
				</tr>
			</tbody>
		</table>
	<?php
		require_once 'views/tesouraria/formPrestCongreg.php';
	 	require_once 'views/tesouraria/formPrestOracao.php' ;
	 	require_once 'views/tesouraria/formPrestMissoes.php' ;
	 ?>
	<input type="hidden" name="tipo" value="3">
	<input type="hidden" name="escolha" value="models/dizoferta.php"> <input
		type="submit" name="listar" value="Lan&ccedil;ar..."
		tabindex="<?php echo ++$ind;?>">
</form>
