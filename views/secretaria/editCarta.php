<div id="lst_cad">
  <?php
  if (mysql_num_rows($sql3)>'0') {
  ?>
	<table class='table'>
      <tr>
        <td>Tipo:
          <?PHP
		//	$nome = new editar_form("tipo",$arr_dad["tipo"],$tab,$tab_edit);
			echo "<h4>Carta de ".carta($arr_dad["tipo"]).'</h4>';
			//$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
			?></td>
        <td>Data:
          <?PHP
          if ($diasemissao==1) {
          	echo ' (Criada hoje)';
          }elseif ($diasemissao<3){
            echo ' (Criada ontem!)';
          }elseif ($anov>'2000') {
          	echo ' (Criada a '.$diasemissao. ' dias)';
          }
     $nome = new editar_form("data",$arr_dad["data"],$tab,$tab_edit);
	   $nome->getMostrar();
		if ($diasemissao<='3') {
			$nome->getEditar('','',$arr_dad["id"]);
		}elseif ($_GET['campo']=='data') {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert">
			<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
			<span class="sr-only">Close</span></button>
			Prazo <strong>EXPIRADO</strong>! Voc&ecirc; tem at&eacute; <strong>3 dias
			</strong> para alterar esta data!
			</div>
			<?php
		}
		?></td>
      </tr>
      <tr>
        <td colspan="2">Igreja/Institui&ccedil;&atilde;o:
          <?PHP
		$nome = new editar_form("igreja",$arr_dad["igreja"],$tab,$tab_edit);
		$nome->getMostrar();
		if ($diasemissao<='20') {
			$nome->getEditar('','',$arr_dad["id"]);
		}elseif ($_GET['campo']=='igreja')  {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert">
			<span class="glyphicon glyphicon-remove-circle" aria-hidden="true">
			</span><span class="sr-only">Close</span></button>
			Prazo <strong>EXPIRADO</strong>! Voc&ecirc; tem at&eacute; <strong>20 dias
			</strong> para alterar a Igreja de destino!
			</div>
			<?php
		}
		?></td>
      </tr>
      <tr>
        <td>Destino:
        <?PHP
        $det_inteiro = (int)$arr_dad["destino"];
        if ($det_inteiro!=0){
        	$rec = new DBRecord ("cidade",$arr_dad["destino"],"id");// Aqui ser� selecionado a informa��o do campo autor com id=2
					$cidade=$rec->nome()." - ".$rec->coduf();
    		}else {
    		 	$cidade = $arr_dad["destino"];
    		}
    		if (isset($cidade)){
    				//print $cidade;
    				$cid = new editar_form("destino",$cidade,$tab,$tab_edit);
    				$cid->getMostrar();
    				if ($diasemissao<='20') {
    					$cid->getEditar('','',$arr_dad["id"]);
    				}elseif ($_GET['campo']=='destino')  {
    					?>
    					<div class="alert alert-danger alert-dismissible" role="alert">
    						<button type="button" class="close" data-dismiss="alert">
    						<span  class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
    						<span class="sr-only">Close</span></button>
    						Prazo <strong>EXPIRADO</strong>! Voc&ecirc; tem at&eacute; <strong>
    						20 dias</strong> para alterar o destino!
    					</div>
    					<?php
    				}
    			}
		?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">Observa&ccedil;&otilde;es
		<?PHP
		$nome = new editar_form("obs",$arr_dad["obs"],$tab,$tab_edit);
		$nome->getMostrar();
				if ($diasemissao<='20') {
					$nome->getEditar('','',$arr_dad["id"]);
				}elseif ($_GET['campo']=='obs')  {
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						<span  class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
						<span class="sr-only">Close</span></button>
						Prazo <strong>EXPIRADO</strong>! Voc&ecirc; tem at&eacute; <strong>
						20 dias</strong> para alterar a observa&ccedil;&atilde;o!
					</div>
					<?php
				}
		?></td>
      </tr>
    </table>
	<?PHP
}else {
			echo '<div class="alert alert-alerta alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">
					<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
					<span class="sr-only">Close</span></button>
					<h3>Sem registro de carta</h3>
					 Nenhuma carta encontrada para este membro!
					</div>';
	}
	if ($ecles->situacao_espiritual()=='1') {
	?>
	<form id="form1" name="form1" method="get" action="">
	  <label>
	    <input type="submit" class='btn btn-primary' name="Submit" value="Cadastrar nova carta" />
      </label>
      <input name="escolha" type="hidden" id="escolha" value="adm/cria_carta.php" />
      <input name="bsc_rol" type="hidden" id="bsc_rol" value="<?php echo $_GET['bsc_rol'];?>" />
      <input name="uf" type="hidden" id="uf" value="PB" />
	</form>
	<?php
	}else {
		echo '<div class="bs-callout bs-callout-warning">';
		echo '<h4>Esta pessoa n&atilde;o est&aacute; com situa&ccedil;&atilde;o regular em nosso rol de membro! </h4>';
		echo '<h4>Verifique na ABA <strong>Eclesi&aacute;astico</strong> e na de <strong>';
		echo 'Registros</strong> e veja o fazer para regularizar!</h4>';
		echo 'Para emiss&atilde;o de outra carta, &eacute; necess&aacute;rio que esteja em comunh&atilde;o com a igreja! ';
		echo 'Se deseja emitir nova transfer&ecirc;ncia, caso a anterior tenha perdido a validade, ';
		echo 'ou qualquer outro tipo de carta, reintegre-o a comunh&atilde;o da igreja e emita nova carta! ';
		echo 'Tendo, ainda, 3 dias para alterar a data e 20 para os demais dados! <br>';
		echo '</div>';
	}
    $cargoIgreja = new tes_cargo();
    $dadosCargo = $cargoIgreja->dadosArray();
  //  print_r($dadosCargo['7']);
  //  echo $dadosCargo['7']['1']['2']['nome'].' *** ';

if ($cidade!=''){
?>
<form id="form2" name="form2" method="post" action="relatorio/carta_print.php">
  <input type="hidden" name="id_carta" value="<?PHP echo $arr_dad["id"];?>" />
  <input name="bsc_rol" type="hidden" id="bsc_rol" value="<?php echo $_GET['bsc_rol'];?>" />
  <div class="row">
  <div class="col-xs-5">
  <label>Secret&aacute;rio que ir&aacute; assinar a carta:</label>
  <select name="secretario" id="secretario" class='form-control'>
    <option value="1"><?PHP echo $dadosCargo['7']['1']['1']['nome'];?></option>
    <option value="2"><?PHP echo $dadosCargo['7']['1']['2']['nome'];?></option>
  </select></div>
  <div class="col-xs-2">
  <!-- Envia o id para a impress�o da carta escolhida -->
  <input type="image" src="img/Preview-48x48.png" name="Submit2" value="Imprimir esta Carta" align="absmiddle" alt="Visualizar Impress&atilde;o" title="Visualizar Impress&atilde;o"/>
	</div></div>
</form>
<?PHP
}
?>
</div>
