<fieldset>
	<legend>Movimenta&ccedil;&atilde;o no m&ecirc;s</legend>
	<form method="get" name="" action="">
	<div class="row">
	  <div class="col-xs-2">
			<label>Dia:</label>
			 <input type="text" size="2" maxlength="2" name="dia" autofocus="autofocus"
			value="<?php echo $d;?>"tabindex="<?PHP echo ++$ind; ?>"
			 class="form-control" placeholder="dia" />
	  </div>
	  <div class="col-xs-3"><label>M&ecirc;s:</label>
			<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
						<?php
							$linha1 = '<option value="0">Selecione o m&ecirc;s...</option>';
							foreach(arrayMeses() as $mes => $meses) {
						 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
						 if ($m==$mes) {
							$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
						 }
							}
							echo $linha1.$linha2;

							//Marca a op��o atual para lista Com e Sem o n�vel mais baixo
								$Completo = '';
								$Simples = '';
								$Comadep = '';
							if ($_GET['tipo']=='1') {
								$Simples = 'active';
							}elseif ($_GET['tipo']=='4') {
								$Comadep = 'active';
							}elseif (empty($_GET['tipo']) || $_GET['tipo']=='2') {
								$Completo = 'active';
							}
						?>
					</select>
	  </div>
	  <div class="col-xs-2"><label>Ano</label>
			<input type="text" name="ano" value="<?php echo $ano;?>"
			tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
	  </div>
	  <div class="col-xs-5">
		<label>Contas</label>
		<select name='gpconta' class='form-control' tabindex='<?php echo ++$ind;?>'>"
			<?php
				$lin1 = '<option>-->> Todas as Contas <<--</option>';
				$lins = '';
				$ctaList = new tes_conta();
				foreach ($ctaList->contasCod() as $cod => $nomeCta) {
					if ($_GET['gpconta']==$cod) {
						$lin1 = "<option value='".$cod."'>".$cod.' &bull; '.$nomeCta['titulo']."</option>".$lin1;
					}
				$lins .= "<option value='".$cod."'>".$cod.' &bull; '.$nomeCta['titulo']."</option>";
			}
			echo $lin1.$lins;
			?>
		</select>
	</div>
	  <div class="col-xs-5">
			<label>&nbsp;</label>
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-primary <?php echo $Simples;?>">
					<input type="radio" name="tipo" value='1' >3 N&iacute;veis
				</label>
				<label class="btn btn-primary <?php echo $Completo;?>">
					<input type="radio" name="tipo" value='2' >2 N&iacute;veis
				</label>
				<label class="btn btn-primary <?php echo $Comadep;?>">
					<input type="radio" name="tipo" value='4' >COMADEP
				</label>
			</div>
	  </div>
	  <div class="col-xs-5">
			<label>Congrega&ccedil;&atilde;o:</label>
			<?php
				$bsccredor = new List_Igreja('igreja');
				$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control"');
				echo $listaIgreja;
			?>
	  </div>
	  <div class="col-xs-2">
			<div class="form-group">
			<input name="escolha" type="hidden" value="tesouraria/receita.php" />
			<label>&nbsp;</label>
			<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
			tabindex="<?PHP echo ++$ind; ?>" />
			<input type="hidden" name="rec"	value="6" class="form-control" />
			<input name="menu" type="hidden" value="top_tesouraria" />
			</div>
	  </div>
	</div>
	</form>
</fieldset>
