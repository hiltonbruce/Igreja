<!-- Desenvolvido por Wellington Ribeiro -->
<fieldset>
	<legend>Movimenta��o no m�s</legend>
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
				<td><label>M�s:</label>
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
					      <?php
					      	$linha1 = '<option value="0">Selecione o m�s...</option>';
						      foreach(arrayMeses() as $mes => $meses) {
								 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
								 if ($m==$mes) {
								 	$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
								 }
						      }
						      echo $linha1.$linha2;

						      //Marca a op��o atual para lista Com e Sem o n�vel mais baixo
						      if ($_GET['tipo']=='1') {
						      	$Completo = '';
						      	$Simples = 'active';
						      }elseif (empty($_GET['tipo']) || $_GET['tipo']=='2') {
						      	$Simples = '';
						      	$Completo = 'active';
						      }
					      ?>
				      </select>
				</td>
				<td><label>Ano:(Zero p/ todos os anos)</label>
					<input type="text" name="ano" value="<?php echo $ano;?>"
					tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
				</td>
			</tr>
			<tr>
				<td>
					<div class="btn-group" data-toggle="buttons">
					  <label class="btn btn-primary <?php echo $Simples;?>">
					    <input type="radio" name="tipo" value='1' >3 N&iacute;veis
					  </label>
					  <label class="btn btn-primary <?php echo $Completo;?>">
					    <input type="radio" name="tipo" value='2' >2 N&iacute;veis
					  </label>
				  </div>
				</td>
				<td>
					<label>Congrega&ccedil;&atilde;o:</label>
					<?php
						$bsccredor = new List_Igreja('igreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control"');
						echo $listaIgreja;
					?>
				</td>
				<td>
				  <div class="form-group">
					<input name="escolha" type="hidden" value="tesouraria/receita.php" /><br />
					<input type="hidden" name="rec"	value="6" />
					<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
					tabindex="<?PHP echo ++$ind; ?>" />
					<input name="menu" type="hidden" value="top_tesouraria" />
				  </div>
				</td>
               </tr>
		</tbody>
	</table>
	</form>
	</div>
</fieldset>
