<?PHP
	controle ("consulta");
?>
		<div id="tabs">
		  <ul>
			<li><a <?PHP id_corrente ("aniversario"); ?> href="./?escolha=aniv/aniversario.php"><span>do Dia</span></a></li>
			<li><a <?PHP id_corrente ("casamento");?> href="./?escolha=aniv/casamento.php"><span>de Casamento - Hoje</span></a></li>			
			<li><a <?PHP id_corrente ("batismo");?> href="./?escolha=aniv/batismo.php"><span>de Batismo - Hoje</span></a></li>
			<li><a <?PHP id_corrente ("semana");?> href="./?escolha=aniv/semana.php&ord=3"><span>da Semana</span></a></li>
			<li><a <?PHP id_corrente ("mes");?> href="./?escolha=aniv/mes.php&ord=3"><span>do M&ecirc;s</span></a></li>
		  </ul>
</div>
