<?php
$_SESSION['debito']=0;
$_SESSION['credito']=0;

//concluir lançamento final na tabela lançamento
$roligreja =(int) $_POST['rolIgreja'];
$lanigreja = new DBRecord('igreja',$roligreja, 'rol' );
$exibir = new lancdizimo($roligreja);
//Faz o leiaute do lançamento do débito da tabela dizimooferta
$exibirlanc = '';
$queryBusc  = 'devedora,data FROM ';
$queryBusc .= 'dizimooferta WHERE lancamento="0" AND igreja = "';
$queryBusc .= $roligreja;
$tablanc = mysql_query('SELECT SUM(valor) AS valor,'.$queryBusc.'" GROUP BY devedora');
$totDebito = mysql_num_rows(mysql_query('SELECT valor,'.$queryBusc.'" GROUP BY data'));
while ($tablancarr = mysql_fetch_array($tablanc)) {
	$lanc  = $exibir->lancamacesso ($tablancarr['valor'],$tablancarr['devedora'],'D');
	$exibirlanc .= $lanc['0'];
	if (empty($dataLc) || $dataLc > $tablancarr['data']) {
		$dataLc = $tablancarr['data'];
	}
}
//Faz o leiaute do lançamento do crédito da tabela dizimooferta
$tablanc_c = mysql_query('SELECT SUM(valor) AS valor,credito FROM dizimooferta WHERE lancamento="0" AND igreja = "'.$roligreja.'" GROUP BY credito');
$totCredito = mysql_num_rows($tablanc_c);
$histLanca = array();
while ($tablancarrc = mysql_fetch_array($tablanc_c)) {
	$lanc = $exibir->lancamacesso ($tablancarrc['valor'],$tablancarrc['credito'],'C');
	$exibirlanc .= $lanc['0'];
	$histLanca[]=$lanc['1'];
}

require_once 'views/lancdizimo.php';//chama o view para montar

if ($totDebito>'1') {
	$hist = str_replace( "nesta data", 'neste m&ecirc;s', $hist );
}

if ($_SESSION['lancar'] && ($totDebito>0 || $totCredito>0)) {
	//Inicializado as variáveis
	$ind = 0;
	$dtlanc =  conv_valor_br ($dataLc);
	?>

<form method="post" action="">
	<div class="col-xs-12">
		<label>Hist&oacute;rico do lan&ccedil;amento:</label> 
		<input type="text" name="hist" id="hist" size="60" autofocus="autofocus" class="form-control"
			tabindex="<?PHP echo ++$ind;?>" value='<?PHP echo $hist;?>'>
	</div>
	<div class="col-xs-2">
		<label>Data:</label>
		<input type="text" name="data" id="data" class="form-control"
			value="<?php echo $dtlanc;?>" tabindex="<?PHP echo ++$ind;?>">
	</div>
	<div class="col-xs-2">
			<label>&nbsp;</label>
  			<input type="submit" name="Submit" class='btn btn-primary btn-sm'
			value="Lançar..." tabindex="<?PHP echo ++$ind;?>" />
	</div>
		<input name="escolha" type="hidden" value="<?php echo $_GET['escolha'];?>" />
		<input name="lancar" type="hidden" value="1" />
		<input name="igreja" type="hidden" value="<?php echo $roligreja;?>" />
</form>
<?php
	//echo '<h1> ***'.$dataLc.'</h1>';
}elseif ($totDebito<1 && $totCredito<1) {
	echo '<h3>Essa Igreja não possui lançamento a realizar!</h3>';
}else {
	echo '<h3>Voc&ecirc; deve corrigir a pend&ecirc;ncia do lan&ccedil;amento acima para finalizar!</h3>';
}
?>
