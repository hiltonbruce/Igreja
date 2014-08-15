<!-- Desenvolvido por Wellington Ribeiro -->
<fieldset>
	<legend>Movimentação no mês</legend>
    <div class="form-group">
	<form method="get" name="" action="">
		<table>
		<tbody>
			<tr>
				<td><label>Dia:</label>
					 <input type="text" size="2" maxlength="2" name="dia" autofocus="autofocus"
					value="<?php echo $d;?>"tabindex="<?PHP echo ++$ind; ?>"
					 class="form-control" placeholder="dia" />
				</td>
				<td><label>Mês:</label>
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
					      <?php
					      	$linha1 = '<option value="0">Selecione o mês...</option>';
						      foreach(arrayMeses() as $mes => $meses) {            
								 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
								 if ($m==$mes) {
								 	$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
								 }
						      }
						      echo $linha1.$linha2;
					      ?>
				      </select>
				</td>
				<td><label>Ano:(Zero p/ todos os anos)</label>
					<input type="text" name="ano" value="<?php echo $a;?>" 
					tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />  
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Congrega&ccedil;&atilde;o:</label>
					<?php
						$bsccredor = new List_sele('igreja', 'razao', 'igreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control"');
						echo $listaIgreja;
					?> 
				</td>
				<td>
					<input name="escolha" type="hidden" value="controller/despesa.php" /><br />
					<input type="hidden" name="age"	value="4" />
					<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
					tabindex="<?PHP echo ++$ind; ?>" /> 
					<input name="menu" type="hidden" value="top_tesouraria" />
				</td>
               </tr>
		</tbody>
	</table>
	</form>
	</div>
</fieldset>
