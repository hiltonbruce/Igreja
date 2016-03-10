<?php
	$ind = 0;
	$ano = (empty($_GET['ano'])) ? date('Y') : $_GET['ano'] ;
	$mesEstatisca = (empty($_GET['mes']) || $_GET['mes']>12) ? date('m') : $_GET['mes'] ;
	$igreja = (empty($_GET['igreja'])) ? '' : $_GET['igreja'] ;
?>
<div class="bs-callout bs-callout-danger" id="callout-alerts-no-default">
    <h4>Lan&ccedil;amentos de pagamentos</h4>
    <p>Indique no primeiro campo a conta utilizada para pagar a despesa.
    E mais abaixo: informe o grupo relativo ao gasto, com valor e hist&oacute;rico.
     "Clicando" no sinal de "+" para que seja visualizado
     os campos para preenchimento relativos a despesa!
 	</p>
<form  method='get'>
	<div class="row">
		<!-- <div class="col-xs-3">
		<label>Igreja</label>
			<?php
			//$bsccredor = new List_sele('igreja', 'razao', 'igreja');
			//$listaIgreja = $bsccredor->List_Selec(++$ind,$igreja,'class="form-control" ');
			//echo $listaIgreja;
			?>
	  	</div>-->
		<div class="col-xs-3">
			<label>M&ecirc;s de refer&ecirc;ncia:</label>
			<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
			      <?php
			      	$linha1 = '<option value="0"></option>';
				      foreach(arrayMeses() as $mes => $meses) {
						 $linha2 .= '<option value='.(int)$mes.'>'.$meses.'</options>';
						 if ($mesEstatisca==$mes) {
						 	$linha1 = '<option value='.(int)$mes.'>'.$meses.'</options>'.$linha1;
						 	$mesPesquisa = $meses;
						 }
				      }
				      echo $linha1.$linha2;
			      ?>
		      </select>
	  	</div>
		<div class="col-xs-3">
			<label>Ano</label>
					<input type="text" name="ano" value="<?php echo $anoForm;?>"
					tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
					<input type="hidden" name="direita"	value="1" /><!-- tira a tabela lateral -->
	  	</div>
		<div class="col-xs-3">
			<input name="escolha" type="hidden" value="tesouraria/receita.php" /><br />
			<input type="hidden" name="rec"	value="<?php echo $_GET['rec'];?>" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
			tabindex="<?PHP echo ++$ind; ?>" />
			<input name="menu" type="hidden" value="top_tesouraria" />
	  	</div>
	</div>
</form>
  </div>
<div class="panel panel-primary">
	<?PHP
		//Inicia o bloco com os forms de lançamentos
		$titTabela = '<div class="panel-heading"><h3 class="panel-title">Lan&ccedil;ar de pagamentos - Per&iacute;odo: '.$mesEstatisca.'/'.$ano.'</h3></div>';
		require_once 'help/tes/lancTipoPlan.php';
		require_once 'views/tesouraria/lancTipoPlan.php';
		//print_r($arrayDesp);
	?>
</div>
