<?php 
	$ano = (empty($_GET['ano'])) ? date('Y'):$_GET['ano'];
?>
<fieldset>
	<legend>Relatório de Lançamentos</legend>
    <div class="form-group">
	<form method="get" name="" action="">
		<table class="table">
		<tbody>
			<tr id="form">
				<td>
					Congrega&ccedil;&atilde;o:<br />
					<?php
						$bsccredor = new List_sele('igreja', 'razao', 'igreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control"');
						echo $listaIgreja;
					?> 
				</td>
				<td>
					Mês:<br /> 
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
					      <?php
					      	$linha1 = '<option value="0">Selecione o mês...</option>';
						      foreach(arrayMeses() as $mes => $meses) {            
								 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
								 if ($_GET['mes']==$mes) {
								 	$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
								 }
						      }
						      echo $linha1.$linha2;
					      ?>
				      </select>
				</td>
				<td>
					Ano:(Zero p/ todos os anos) <br />
					<input type="text" name="ano" value="<?php echo $ano;?>" 
					tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />  
					<input type="hidden" name="membro"	value="<?php echo true;?>" /> 
					<input type="hidden" name="fin"	value="<?php echo $fin;?>" /> 
				</td><td>
					<input name="escolha" type="hidden" value="tesouraria/receita.php" /><br />
					<input type="hidden" name="rec"	value="<?php echo $rec;?>" /> 
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
