<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
	$credor = (empty($_GET['credor'])) ? 0 : $_GET['credor'] ;
	if (!empty($_GET['data'])) {
		list($d,$m,$y) = explode('/', $_GET['data']);
	}else {
		$d =  1 ;
		$m = date("m");
		$y = date("Y");
	}

	//$credor = ($_GET['credor']>'0') ? $_GET['credor']:'0';
	//Array's para troca do dia da semana para portugês
	$diaEn = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$diaBr   = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b');

 ?>
<table id="Contas do per&iacute;odo" class='table table-condensed' >
			<colgroup>
				<col id="dia">
				<col id="Evento">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Dia</th>
				<th scope="col">Evento</th>
				<th scope="col">Total&nbsp;(R$)</th>
			</tr>
		</thead>
		<tbody id="periodo" >
		<?php
			$iniDia = new datetime ("$y-$m-$d");
			//print_r($iniDia);
			$ultimoDia = new datetime ("$y-$m-$d");
			$ultimoDia = $ultimoDia->modify( 'last days next month' );

			$iniLoop = ($d=1) ? 0 : $d ;
			for ($p = $iniLoop; $p < $ultimoDia->format('t'); $p++) {
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
				$evento = $lista->demonstrativo(date('Y-m-d',$iniDia->getTimestamp()),$credor,$dataget);//usa o objeto do script tesouraria/agenda.php com $lista = new agenda();
				echo '</tr>';
				$iniDia->modify( '+1 day' );
				//$dia_periodo = strtotime("$dia_periodo +1 day");
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3" class="info"><h5>Exibi um trecho de 12 dias. Faixa em verde é o dia atual!
		 Contas vencidas a mais de 5 dias:
	<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&vencidas=1&data=<?php echo $dataget;?>" title="Clique aqui para Listar...">
	<button class="btn btn-primary">Click aqui!</button> Atualmente são:<?php echo $lista->vencidas();?>
	</a></h5>
				</th>
			</tr>
		</tfoot>
</table>
<?php
}
 ?>
