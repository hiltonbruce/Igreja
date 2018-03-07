<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50 || $_SESSION["setor"]==1){
	$credor = (empty($_GET['credor'])) ? 0 : $_GET['credor'];
	$igRol = (empty($_GET['igreja'])) ? 0 : $_GET['igreja'];
	if (!empty($_GET['data']) && checadata($_GET['data'])) {
		list($y,$m,$d) = explode('-', $_GET['data']);
	}else {
		$d =  '01' ;
		$m = date("m");
		$y = date("Y");
	}
	$dt = $y.'-'.$m.'-'.$d;
	//$credor = ($_GET['credor']>'0') ? $_GET['credor']:'0';
	//Array's para troca do dia da semana para portugês
	$diaEn = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$diaBr   = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b');
	$iniDia = new datetime ("$y-$m-$d");
	//print_r($iniDia);
	$ultimoDia = new datetime ("$y-$m-$d");
	$ultimoDia = $ultimoDia->modify( 'last days next month' );
	$fimDiaMes = $iniDia->format('t');
 ?>
 <form action="" method="get">
 	<div class="row">
  <div class="col-xs-2">
 	<label>Por fornecedor:</label>
	<select name="credor" id="credor" class="form-control" onchange="MM_jumpMenu('parent',this,0)"
	 tabindex="<?PHP echo ++$ind; ?>" >
	  <?php
	  	$bsccredor = new list_fornecedor('credores', 'alias', 'credor');
	  	echo $bsccredor->List_Selec_pop('escolha='.$_GET["escolha"].'&menu=top_tesouraria&age=9&data='.
			$dt.'&igreja='.$igRol.'&credor=');
	  ?>
	</select>
</div>
  <div class="col-xs-3">
 	<label>Por Igreja:</label>
	<?php
 $bsccredor = new List_sele('igreja', 'razao', 'igreja');
 $listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control" ');
 echo $listaIgreja;
	 ?>
  </div>
  <div class="col-xs-3">
	<label>Per&iacute;odo de:</label>
	<input type="date" name="data" class="form-control"
	value='<?php echo $dt;?>' tabindex="<?PHP echo ++$ind; ?>" >
  </div>
  <div class="col-xs-2">
	<label>at&eacute;:</label>
	<input disabled='disabled' class="form-control"
	value='<?php echo $fimDiaMes.$iniDia->format('/m/Y');?>' tabindex="<?PHP echo ++$ind; ?>" >
  </div>
  <div class="col-xs-1">
	<input type="hidden" name="menu" value="top_tesouraria">
	<input type="hidden" name="age" value="<?PHP echo $_GET["age"];?>">
	<input type="hidden" name="escolha" value="<?PHP echo $_GET["escolha"];?>">
	<input type="hidden" name="credor" value="<?php echo $_GET['credor']?>"></td>
	<label>&nbsp;</label><input type="submit" class="btn btn-primary" value="Listar...">
  </div>
</div>
</form>
<table id="Contas do per&iacute;odo" class='table table-condensed' >
			<colgroup>
				<col id="dia">
				<col id="Evento">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Dia</th>
				<th scope="col">Evento (Ano: <?php echo $y;?>)</th>
				<th scope="col">Total&nbsp;(R$)</th>
			</tr>
		</thead>
		<tbody id="periodo" >
		<?php
			$iniLoop = ($d=1) ? 0 : $d ;
			for ($p = $iniLoop; $p < $fimDiaMes; $p++) {
				//$altdias = $d;
				//print date('d M Y H:i:s', strtotime('last day of', strtotime('Thu Mar 31 19:50:41 IST 2011')));
				if (date('d')==$iniDia->format('d')) {
					$trtab = '<tr bgcolor="#90EE90">';
				}else {
				$trtab = ($p % 2) == 0 ? '<tr class="dados" >' : '<tr >';
				}
				echo $trtab;
				$diaSemana = $iniDia->format('D');
				$diaSemana = str_replace($diaEn, $diaBr, $diaSemana);
				echo '<td>'.$iniDia->format('d/m').'&nbsp;-&nbsp;'.$diaSemana.'</td><td>';
				$evento = $lista->demonstrativo(date('Y-m-d',$iniDia->getTimestamp()),$credor,$dataget);
				echo $evento[0];
				$totalDem += $evento[1];
				//usa o objeto do script tesouraria/agenda.php com $lista = new agenda();
				echo '</tr>';
				$iniDia->modify( '+1 day' );
				//$dia_periodo = strtotime("$dia_periodo +1 day");
				if ($fim) {
					break;
				}
				if ($fimDiaMes==$iniDia->format('d')) {
					$fim = true;
				}else {
					$fim = false;
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr class="active">
				<th colspan="2" class="text-right">
					Total:
				</th>
				<th class="text-right">
					<?php echo number_format($totalDem,2,",","."); ?>
				</th>
			</tr>
			<tr>
				<th colspan="3" class="info"><h5>Exibi um trecho de 12 dias. Faixa em verde &eacute; o dia atual!
					Contas vencidas a mais de 5 dias:
					<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&vencidas=1&data=<?php echo $dataget;?>" title="Clique aqui para Listar...">
					<button class="btn btn-primary">Click aqui!</button> Atualmente s&atilde;o:<?php echo $lista->vencidas();?>
					</a></h5>
				</th>
			</tr>
		</tfoot>
</table>
<?php
}
 ?>
