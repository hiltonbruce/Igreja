<?PHP
	controle ("consulta");
?>
<p>
<a <?PHP $b=id_corrente ("aniversario");?> href="./?escolha=aniv/aniversario.php">
<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Anivesariantes de hoje</button></a>
<a <?PHP $b=id_corrente ("casamento");?> href="./?escolha=aniv/casamento.php">
<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">de Casamento - Hoje</button></a>
	<a <?PHP $b=id_corrente ("batismo");?> href="./?escolha=aniv/batismo.php">
<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">de Batismo - Hoje</button></a>
	<a <?PHP $b=id_corrente ("semana");?> href="./?escolha=aniv/semana.php&ord=3">
<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">da Semana</button></a>
	<a <?PHP $b=id_corrente ("mes");?> href="./?escolha=aniv/mes.php&ord=3">
<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">do M&ecirc;s</button></a>
</p>
