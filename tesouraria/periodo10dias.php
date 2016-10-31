<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
	$dias = $_GET['altdias'];
	$d = ((int)$dias=='0' ) ? date("d"): $dias;
	$m = date("m");
	$y = date("Y");
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
			for ($p = 0; $p < 12; $p++) {
				$altdias = $_GET['altdias'];
				$dia_periodo = $p-5+$dias;
				$dia_periodo = strtotime("$dia_periodo days");
				if (date('d')==date('d',$dia_periodo)) {
					$trtab = '<tr bgcolor="#90EE90">';
				}else {
				$trtab = ($p % 2) == 0 ? '<tr class="dados" >' : '<tr >';
				}
				echo $trtab;
				$diaSemana = date('D',$dia_periodo);
				$diaSemana = str_replace($diaEn, $diaBr, $diaSemana);
				echo '<td>'.date('d/m',$dia_periodo).'&nbsp;-&nbsp;'.$diaSemana.'</td><td>';
				$evento = $lista->periodo(date('Y-m-d',$dia_periodo),$credor,$dataget);//usa o objeto do script tesouraria/agenda.php com $lista = new agenda();
				echo '</tr>';
			}
		?>
		</tbody>
		<tfoot>
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
