<?php
if ($_GET['rec']=='16' && $_GET['tipo']=='4') {
	$fontIniCom = '<div style="font-size:112%;">';
	$fontFimCom = '</div>';
} else {
	$fontIniCom = '';
	$fontFimCom = '';
}
echo $fontIniCom;
 ?>
<table class='table table-striped table-hover'>
		<caption><h5>
		<?php
		if ($recLink!='' && !empty($recLink)) {
			echo '<a href="'.$linkImpressao.'" ';
			echo 'target="_black" title="Imprimir demonstrativo">';
			echo '<button class="btn btn-default glyphicon glyphicon-print"> </button></a>&nbsp;';
			$imprimir = '';
		}else {
			//$imprimir = '<script type="text/javascript">window.print();</script>';
		}
		echo $titTabela;
		?>
	</h5></caption>
		<colgroup>
				<col id="Conta">
				<col id="Descricao">
				<col id="Movimento">
				<col id="Saldo Anterior">
				<col id="Saldo Atual">
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Conta</th>
				<th scope="col">Descri&ccedil;&atilde;o</th>
				<th scope="col" style="text-align: center;">Movimento</th>
				<th scope="col" style="text-align: center;">Sld Atual</th>
				<th scope="col" style="text-align: center;">Sld Ant.</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($_GET['tipo']==1) {
				//exibi plano de contas
				echo $nivel1;
			}else {
				echo $nivel2;
			}
			?>
		</tbody>
		<tfoot> 
			<?php
				echo '<tr id="total">';
				echo '<tdid="moeda" ></td>';
				echo '<td colspan="3" class="text-right"></td>';
				echo '<td colspan="2" id="moeda" ></td></tr>';
			?>
		</tfoot>
	</table>
	<?php
		echo $assinatura;
				//echo $grupoFora.'<br />';
				//echo $sldFora.' *** ';

		echo $fontFimCom;
		echo $imprimir;
	?>

<div style='page-break-after:always'></div>

<div class="col-md-8">
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Receita <span class="small">versus</span> Despesas</h3>
	</div>
	<div class="panel-body">		
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center"></th>Total das Saídas</th>
						<th class="text-center">Total das Entradas</th>
						<th class="text-center">Diferença de Saldos</th>
						<th class="text-center">Situação</th>
					</tr>
				</thead>
				<tbody>
					<tr class='
							<?php
								if (abs($entradasCta) - abs($saidasCta)>0) {
									echo 'success';
								} elseif (abs($entradasCta) - abs($saidasCta)<0){
									echo 'danger';
								} else {
									echo 'muted';
								}					
							?>
						'>
						<td class="text-right">
							<?php
								echo number_format(abs($saidasCta),2,',','.');
							?>
						</td>
						<td class="text-right">
							<?php
								echo number_format(abs($entradasCta),2,',','.');
							?>					
						</td>
						<td class="text-right">
							<?php
								echo number_format(abs($entradasCta) - abs($saidasCta),2,',','.');
							?>					
						</td>
						<td class="text-center">
							<?php
								if (abs($entradasCta) - abs($saidasCta)>0) {
									echo '<span  class="lead">Superavit</span>';
								} elseif (abs($entradasCta) - abs($saidasCta)<0){
									echo '<span  class="lead">Deficit</span> ';
								} else {
									echo 'Nulo';
								}					
							?>					
						</td>
					</tr>
				</tbody>
			</table>
		</div>		
	</div>
  </div>

  <div class="col-md-8">
<div class="panel panel-info md-2">
<div class="panel-heading">Saldo Disponível</div>
  <div class="panel-body">
	  
		  <table class="table table-bordered">
			  <thead>
				  <tr>
					  <th class="text-center">Saldo do mês Anterior</th>
					  <th class="text-center">Saldo do mês Atual</th>
					  <th class="text-center">diferença entre os saldos</th>
					  <th class="text-center">Situação</th>
				  </tr>
			  </thead>
			  <tbody>
				  <tr class='
						  <?php
							  if (abs($cxBco) - abs($cxAnt)>0) {
								  echo 'success';
							  } elseif (abs($cxBco) - abs($cxAnt)<0){
								  echo 'danger';
							  } else {
								  echo 'muted';
							  }					
						  ?>
					  '>
					  <td class="text-right">
						  <?php
							  echo number_format(abs($cxAnt),2,',','.');
						  ?>
					  </td>
					  <td class="text-right">
						  <?php
							  echo number_format(abs($cxBco),2,',','.');
						  ?>					
					  </td>
					  <td class="text-right">
						  <?php
							  echo number_format(abs($cxBco) - abs($cxAnt),2,',','.');
						  ?>					
					  </td>
					  <td class="text-center">
						  <?php
							  if (abs($cxBco) - abs($cxAnt)>0) {
								  echo '<span  class="lead">Superavit</span>';
							  } elseif (abs($cxBco) - abs($cxAnt)<0){
								  echo '<span  class="lead">Deficit</span> ';
							  } else {
								  echo 'Nulo';
							  }					
						  ?>					
					  </td>
				  </tr>
			  </tbody>
		  </table>
	  </div>
  </div>
</div>
</div>