<fieldset>
	<legend>Lista recibos por per&iacute;do</legend>
    <div class="form-group">
	<form method="get" name="" action="">
		<table class="table">
		<tbody>
			<tr id="form">
				<td>
					<label>Dia:</label>
					<input type="text" size="2" maxlength="2" name="dia"
					value="<?php echo $_GET['dia'];?>"tabindex="<?PHP echo ++$ind; ?>"
					 class="form-control" placeholder="dia" />
				</td>
				<td>
					<label>M&ecirc;s:</label>
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
					      <?php
								$mesSel = arrayMeses();
								$mesPer = $mesSel[$mesPer];
				      	$linha1 = '<option value="0">Selecione o m&ecirc;s...</option>';
					      foreach($mesSel as $mes => $meses) {
								 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
									 if ($_GET['mes']==$mes) {
									 	$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
	                  $mesPer = $meses;
									 }
						      }
						      echo $linha1.$linha2;
                  $perLista = ($diaPer=='') ?  $mesPer.' de '.$anoPer: $diaPer.' de '.$mesPer.' de '.$anoPer ;
					      ?>
				      </select>
				</td>
				<td>
					<label>Ano</label>
					<input type="text" name="ano" value="<?php echo $anoForm;?>"
					tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
				</td><td>
					<input name="escolha" type="hidden" value="controller/recibo.php" />
					<input type="hidden" name="rec"	value="<?php echo $recMenu;?>" />
					<label>&nbsp;</label>
					<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
					tabindex="<?PHP echo ++$ind; ?>" />
					<input name="menu" type="hidden" value="top_tesouraria" />
				</td>
			</tr>
		</tbody>
	</table>
	</form>
  Per&iacute;odo listado: <?php echo $perLista; ?>
	</div>
</fieldset>
<table class='table table-striped table-hover table-bordered'>
    <colgroup>
      <col id="N&ordm;">
      <col id="Nome">
      <col id="Motivo">
      <col id="Valor(R$)">
      <col id="igreja">
      <col id="albumCol"/>
    </colgroup>
  <thead>
    <tr>
      <th scope="col">N&ordm;</th>
      <th scope="col">Nome</th>
      <th scope="col">Motivo</th>
      <th scope="col">Valor(R$)</th>
      <th scope="col">Igreja</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    <?php
      echo $nivel1;
     ?>
  </tbody>
	<tfoot>
		<?php echo $rodapeRec; ?>
	</tfoot>
</table>
