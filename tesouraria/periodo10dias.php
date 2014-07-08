<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
	$dias = $_GET['altdias'];
	$d = ((int)$dias=='0' ) ? date("d"): $dias;
	$m = date("m");
	$y = date("Y");
	$credor = ($_GET['credor']>'0') ? $_GET['credor']:'0';
	
 ?>
<table cellspacing="0" id="Contas do per&iacute;odo" width="95%" >
			<colgroup>
				<col id="dia">
				<col id="Evento">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Dia</th>
				<th scope="col">Evento</th>
				<th scope="col">Total</th>
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
				echo '<td>'.date('d/m',$dia_periodo).' - '.date('D',$dia_periodo).'</td><td>';
				$evento = $lista->periodo(date('Y-m-d',$dia_periodo),$credor,$dataget);//usa o objeto do script tesouraria/agenda.php com $lista = new agenda();
				echo '</tr>';
			}
		?>
		</tbody>
</table>
	<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&vencidas=1&data=<?php echo $dataget;?>" title="Clique aqui para Listar...">
	<button class="btn btn-primary">Contas vencidas a mais de 5 dias: <?php echo $lista->vencidas();?></button>
	</a>
<?php	
}
 ?>