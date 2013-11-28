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
  <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&menu=top_tesouraria&igreja=<?php echo $_GET['igreja']?>&credor=<?php echo $_GET['credor']?>&altdias=<?PHP echo $dias-1;?>" >Voltar 1 dia
  	<img src="img/1910_32x32.png" alt="Voltar 1 dia" width="22" height="22" title="Voltar 1 dia" align="absmiddle" border="0" />
  </a>
  <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&menu=top_tesouraria&igreja=<?php echo $_GET['igreja']?>&credor=<?php echo $_GET['credor']?>&altdias=<?PHP echo $dias+1;?>" >
	  	<img src="img/1967_32x32.png" width="22" height="22" title="Adiantar 1 dia" alt="Adiantar 1 dia" align="absmiddle" border="0"/>Adiantar 1 dia
  </a> 
<fieldset>
<legend>Busca por Despesas Agendadas</legend>
	Por fornecedor:
	  <select name="credor" id="credor" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		  <?php 
		  	$bsccredor = new list_fornecedor('credores', 'alias', 'credor');
		  	echo $bsccredor->List_Selec_pop('escolha='.$_GET["escolha"].'&menu=top_tesouraria&altdias='.$dias.'&credor=');
		  ?>
	  </select>, 
	Por Igreja:
	  <select name="igreja" id="igreja" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		  <?php 
		  	$bsccredor = new List_sele('igreja', 'razao', 'igreja');
		  	echo $bsccredor->List_Selec_pop('escolha='.$_GET["escolha"].'&menu=top_tesouraria&credor='.$_GET["credor"].'&altdias='.$dias.'&igreja=',$_GET['igreja']);
		  ?>
	  </select>, 
	  <form method="get" action="">
	  Com tabela de Despesas: <input type="checkbox" name="fixa">Fixas, 
	  <input type="checkbox" name="prazo">Com prazo determinado<br>
	  Com prazo: <input type="radio" name='vencidas' value="2" checked="checked"> Com data vencida ou 
	  <input type="radio" name='vencidas' value="3"> Com as datas vencidas ou não!<br>
	  Motivo:<input type="text" name="motivo" autofocus="autofocus">
	  <input type="hidden" name="menu" value="top_tesouraria">
	  <input type="hidden" name="escolha" value="<?PHP echo $_GET["escolha"];?>">
	  <input type="hidden" name="credor" value="<?php echo $_GET['credor']?>">
	  <input type="submit" value="Listar...">
	  </form>
</fieldset>
	<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&vencidas=1&data=<?php echo $dataget;?>" title="Clique aqui para Listar...">
	<button>Listar contas vencidas a mais de 5 dias: <?php echo $lista->vencidas();?></button>
	</a>
<?php	
}
 ?>