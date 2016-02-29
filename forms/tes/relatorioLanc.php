<fieldset>
	<legend>Relat&oacute;rio de Lan&ccedil;amentos</legend>
    <div class="form-group">
	<form method="get" name="" action="">
	<div class="row">
	  <div class="col-xs-1">
	  	<label>Dia</label>
	    <input type="text" name='dia' class="form-control" placeholder="dia"
	    tabindex="<?PHP echo ++$ind; ?>" value="<?PHP echo $dia;?>">
	  </div>
	  <div class="col-xs-3">
	  	<label>M&ecirc;s:</label>
		<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
		      <?php
		      	$linha1 = '<option value="0">Selecione o m&ecirc;s...</option>';
			      foreach(arrayMeses() as $mesRel => $meses) {
					 $linha2 .= '<option value='.$mesRel.'>'.$meses.'</options>';
					 if ($_GET['mes']==$mesRel) {
					 	$linha1 = '<option value='.$mesRel.'>'.$meses.'</options>'.$linha1;
					 }
			      }
			      echo $linha1.$linha2;
		      ?>
	      </select>
	  </div>
	  <div class="col-xs-2">
	  	<label>Ano:</label>
		<input type="text" name="ano" value="<?php echo $anoForm ;?>"
		tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
		<input type="hidden" name="membro"	value="<?php echo true;?>" />
		<input type="hidden" name="fin"	value="<?php echo $fin;?>" />
	  </div>
	  <div class="col-xs-5">
	  	<label>Congrega&ccedil;&atilde;o:</label>
		<?php
			$bsccredor = new List_sele('igreja', 'razao', 'igreja');
			$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control"');
			echo $listaIgreja;
		?>
	  </div>
	  <div class="col-xs-6">
	  	<label>Conta</label>
		<select class='form-control' name="conta" id="conta" tabindex="<?PHP echo ++$ind; ?>" >
		<?PHP
			$campo = new tes_listCta ('titulo','contas');
			$options = $campo->List_Selec($cta);
			echo $options['0'];
		?>
		</select>
	  </div>
	  <div class="col-xs-5">
	  	<label>Referente:</label>
		<input type="text" name="refer" value="<?php echo $refer;?>"
		tabindex="<?PHP echo ++$ind; ?>" class="form-control"
		value="<?PHP echo $ref;?>" placeholder="Referente..." />
	  </div>
	  <div class="col-xs-4">
		<input name="escolha" type="hidden" value="tesouraria/receita.php" /><br />
		<input type="hidden" name="rec"	value="<?php echo $rec;?>" />
		<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
		tabindex="<?PHP echo ++$ind; ?>" />
		<input name="menu" type="hidden" value="top_tesouraria" />
	  </div>
	  <div class="col-xs-6">
	  	<label class="checkbox-inline">
		  <input type="checkbox" name='deb' <?PHP echo $deb;?> id="debito" value="1"> D&eacute;bito
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" name='cred' <?PHP echo $cred;?>  id="credito" value="1"> Cr&eacute;dito
		</label>
	</div>
	</div>
	</form>
	</div>
</fieldset>
