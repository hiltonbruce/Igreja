<?php
if (!empty($_GET['dia']) || !empty($_GET['mes']) || !empty($_GET['ano']) || !empty($_GET['acesso'])
|| !empty($_GET['refer']) || !empty($_GET['numLanc']) || !empty($_GET['vlrLanc']) ) {
	$tabMembros = new membro();
	$tesSede = $tabMembros->nomes();
	$cargoIgreja = new tes_cargo;
	$tesArray = $cargoIgreja->dadosArray();
	//tabela com a lista p confirmar lanï¿½amento$idIgreja$idIgreja$idIgreja$idIgreja$idIgreja
	$lancContabil = new tes_relatLanc();
	$resultado = $lancContabil->histLancamentos($roligreja,$mes,$ano,$dia,$ctaId,$debValor,$credValor,$refer,$numLanc,$vlrLanc);
	$tabLancamento = $resultado['0'];
	$statusLancamento = '<h5><strong>Lan&ccedil;amentos Cont&aacute;beis</strong></h5>';
	$linkResumo  = 'rec=15&igreja='.$_GET['igreja'].'&dia='.$_GET['dia'].'&ano='.$_GET['ano'].'&mes='.$_GET['mes'];
	$linkResumo .='&rol='.$_GET['rol'].'&nome='.$_GET['nome'];
	$linkResumo .= '&credito='.$_GET['credito'].'&conta='.$_GET['conta'];
	if (!empty($_GET['escolha'])) {
		$imprimir  = '<a href="tesouraria/receita.php/?tipo=1&'.$linkResumo.' " target="_blank" >';
		$imprimir .= '<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-print">';
		$imprimir .= '</span> Imprimir ...</button> </a>';
		$titulo= (empty($titulo)) ? '':trim($titulo);
		$rodape  = '<tfoot><tr class="info"><th>Total lan&ccedil;ado:</th><th class="text-right">';
		$rodape .= number_format($resultado['2'],2,',','.').'</th></tr></tfoot>';
	}else {
		$imprimir='';
		$rodape = '<tfoot><tr><th>Rubricar:</th><th>Data:</th></tr></tfoot>';
		$dirigenteIgreja = $igrejaSelecionada->pastor();
		if ($igrejaSelecionada->rol()>'1') {
			$dirCong = new DBRecord('membro',$igrejaSelecionada->pastor(),'rol');
			$dirigenteIgreja = $dirCong->nome();
			$tesIgreja = $tesArray['8'][$igrejaSelecionada->rol()]['1']['nome'];//Tesoureiro das congregaï¿½ï¿½es
		}else {
			$tesIgreja = $tesArray['22']['1']['1']['nome'];//Tesoureiro Geral - Central
		}
			$fonIni = '<h6>';
			$fonFim = '</h6>';
		$titulo  =  $statusLancamento;
		if ($idIgreja==0) {
			$campo = 'Campo da cidade de '.$origem;
		} elseif ($idIgreja>1) {
			$campo = 'Congreg.: '.$igrejaSelecionada->razao();
		} else {
				$campo = 'Igreja: '.$igrejaSelecionada->razao();
		}
		$titulo .=  $fonIni.' &bull; '.$campo.' &bull; ';
		$titulo .=  'Dire&ccedil;&atilde;o Atual: '.$dirigenteIgreja;
		$titulo .=  ', 1&ordm; Tesoureiro: '.$tesIgreja;//Tesoureiro
		$titulo .=  '&bull; Data de Emiss&atilde;o: '.date('d/m/Y H:i:s').$fonIni;//Tesoureiro
	}
if (empty($descricao) && $tabLancamento!='') {
	$descricao='Descri&ccedil;&atilde;o';
	echo '<p>'.$imprimir.'</p>';

	if (!empty($_GET['conta']) && intval($_GET['conta'])>0) {
		$acessoCta = intval($_GET['conta']);
		$cta = new tes_contas();
		$dadoCta = $cta->ativosArray();
		$titCta = $dadoCta [intval($_GET['conta'])]['codigo'].' &bull; '.$dadoCta [$acessoCta]['titulo'];

		?>
		<div class="alert alert-info alert-dismissible fade in" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4>Usando filtro de Conta</h4>
			  <p>Localizado lan&ccedil;amentos na conta <strong><?php echo $titCta;?></strong>
			   no m&ecirc;s de 
			   <?php 
			   echo $_GET['mes'].'/'.$_GET['ano'];
			   printf("</p><p>Código de acesso: <strong>%'04u</strong>", $acessoCta);
			   ?> 
			   </p>
			</div>
		<?php
	}
?>

<table class='table table-hover table-bordered'>
	
	<?php
		if ($titulo!='') {
				echo '<caption class="text-left"><h6>'.$titulo.'</h6></caption>';
			}
		
			?>
			<colgroup>
				<col id="albumCol">
				<col id="valor"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col"><?php echo $descricao;?></th>
				<th scope="col" class="centro"><?php echo $tituloColuna5;?></th>
			</tr>
		</thead>
			<?php
				echo $tabLancamento.$rodape;
			?>
</table>
<?php
	//print_r($tabMembros->nomes());
	//print_r ($resultado['1']);
	echo($imprimir);
} else
  {
  $cta = new tes_contas();
  $dadoCta = $cta->ativosArray();
  // var_dump($dadoCta);
  $titCta = $dadoCta [intval($_GET['conta'])]['codigo'].' &bull; '.$dadoCta [intval($_GET['conta'])]['titulo'];
  ?>

  <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Nenhum Registro!</h4>
		<p>N&atilde;o foi localizado nenhuma lan&ccedil;amento para conta <strong><?php echo $titCta;?></strong> no m&ecirc;s de <?php echo $_GET['mes'].'/'.$_GET['ano'];?> ...
		<?php 
			   echo $_GET['mes'].'/'.$_GET['ano'];
			   printf("</p><p>Código de acesso: <strong>%'04u</strong>", $_GET['conta']);
			   ?> 
			   </p>
        
      </div>

  <?php
  }
}
?>
