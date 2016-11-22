<?php
	$ind = 0;
	//$ano = (empty($_GET['ano'])) ? date('Y') : $_GET['ano'] ;
	$mesEstatisca = (empty($_GET['mes']) || $_GET['mes']>12) ? date('m') : $_GET['mes'] ;
	$igreja = (empty($_GET['igreja'])) ? '' : $_GET['igreja'] ;
	$lstCta = new tes_conta();
?>
<div class="bs-callout bs-callout-danger" id="callout-alerts-no-default">
    <h4>Lan&ccedil;amentos de pagamentos!<small> (Per&iacute;odo abaixo...)</small></h4>
<form  method='get'>
	<div class="row">
		 <div class="col-xs-4">
		<label>Contas</label>
		<select name='conta' class='form-control' tabindex='<?php echo ++$ind;?>'>"
			<?php
				$lin1 = '<option>-->> Todas as Contas <<--</option>';
				$lins = '';
				foreach ($lstCta->contasN3() as $cod => $nomeCta) {
					if ($_GET['conta']==$cod) {
						$lin1 = "<option value='".$cod."'>".$nomeCta['titulo']."</option>".$lin1;
					}
				$lins .= "<option value='".$cod."'>".$nomeCta['titulo']."</option>";
			}
			echo $lin1.$lins;
			?>
		</select>
	  	</div>
		<div class="col-xs-3">
			<label>M&ecirc;s de refer&ecirc;ncia:</label>
			<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" required="required" >
	      <?php
	      	$linha1 = '<option value=""></option>';
		      foreach(arrayMeses() as $mes => $meses) {
				 $linha2 .= '<option value='.intval($mes).'>'.$meses.'</options>';
				 if ($mesEstatisca==$mes & !empty($_GET['mes'])) {
				 	$linha1 = '<option value='.(int)$mes.'>'.$meses.'</options>'.$linha1;
				 	$mesPesquisa = $meses;
				 }
		      }
		      echo $linha1.$linha2;
	      ?>
      </select>
	  	</div>
		<div class="col-xs-2">
			<label>Ano</label>
					<input type="text" name="ano" value="<?php echo $anoForm;?>" required='required'
					tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
					<input type="hidden" name="direita"	value="1" /><!-- tira a tabela lateral -->
	  	</div>
		<div class="col-xs-2">
			<input name="escolha" type="hidden" value="tesouraria/receita.php" />
			<input type="hidden" name="rec"	value="<?php echo $_GET['rec'];?>" />
			<input type="hidden" name="direita"	value="1" />
				<label>&nbsp;</label>
			<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
			tabindex="<?PHP echo ++$ind; ?>" />
			<input name="menu" type="hidden" value="top_tesouraria" />
	  	</div>
	</div>
</form>
  </div>
<?PHP
	if (!empty($_GET['mes']) && !empty($_GET['ano'])) {
?>
<p class="text-primary">Clique no primeiro campo a conta utilizada para pagar a despesa.
E mais abaixo: informe o grupo relativo ao gasto, com valor e hist&oacute;rico.
 "Clicando" no sinal de "+" para que seja visualizado
 os campos para preenchimento relativos a despesa!
</p>
<div class="panel panel-primary">
<?PHP
	//Inicia o bloco com os forms de lançamentos
	$ctaDespesa = new tes_despesas(addslashes($_GET['conta']));
	$arrayDespesas = $ctaDespesa->dadosArray();
	$bsccredor = new tes_listDisponivel();
	$acesso = (empty($_GET['acesso'])) ? '' : $_GET['acesso'] ;
	$listaFonte = $bsccredor->List_Selec($acesso,0.01);
	$titTabela = '<div class="panel-heading"><h3 class="panel-title">Lan&ccedil;ar pagamentos - Per&iacute;odo: '.$mesPesquisa.'/'.$ano.'</h3></div>';
	require_once 'help/tes/lancTipoPlan.php';
	require_once 'views/tesouraria/lancTipoPlan.php';
	//print_r($arrayDesp);
?>
</div>
<?PHP } ?>
