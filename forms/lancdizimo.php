<?php
$_SESSION['debito']=0;
$_SESSION['credito']=0;
//$confirma é a variável para filtrar o sql por setor
$confirma = (empty($_POST['confirma'])) ? $_SESSION['setor'] : intval($_POST['confirma']);
//concluir lançamento final na tabela lançamento
$roligreja = intval($_POST['rolIgreja']);
$lanigreja = ($roligreja=='1') ? $igSede : new DBRecord('igreja',$roligreja, 'rol' );
$exibir = new lancdizimo($roligreja);
//Faz o leiaute do lançamento do débito da tabela dizimooferta
$exibirlanc = '';
$queryBusc  = 'devedora,data FROM ';
$queryBusc .= 'dizimooferta WHERE lancamento="0" AND igreja = "';
$queryBusc .= $roligreja.'" AND (confirma="" || confirma="'.$confirma.'") ';
$tablanc = mysql_query('SELECT SUM(valor) AS valor,'.$queryBusc.' GROUP BY devedora');
$totDebito = mysql_num_rows(mysql_query('SELECT valor,'.$queryBusc.' GROUP BY data'));
while ($tablancarr = mysql_fetch_assoc($tablanc)) {
	$lanc  = $exibir->lancamacesso ($tablancarr['valor'],$tablancarr['devedora'],'D');
	$exibirlanc .= $lanc['0'];
	if (empty($dataLc) || $dataLc > $tablancarr['data']) {
		$dataLc = $tablancarr['data'];
	}
}
//Faz o leiaute do lançamento do crédito da tabela dizimooferta
$sqlTabLanc  = 'SELECT SUM(valor) AS valor,credito FROM dizimooferta ';
$sqlTabLanc .= 'WHERE lancamento="0" AND igreja =';
$sqlTabLanc .= '"'.$roligreja.'" AND (confirma="" || confirma="'.$confirma.'") GROUP BY credito';
$tablanc_c = mysql_query($sqlTabLanc);
$totCredito = mysql_num_rows($tablanc_c);
$histLanca = array();
while ($tablancarrc = mysql_fetch_assoc($tablanc_c)) {
	$lanc = $exibir->lancamacesso ($tablancarrc['valor'],$tablancarrc['credito'],'C');
	$exibirlanc .= $lanc['0'];
	$histLanca[]=$lanc['1'];
}
require_once 'views/lancdizimo.php';//chama o view para montar
if ($totDebito>'1') {
	$hist = str_replace("nesta data", 'neste m&ecirc;s', $hist);
}
if ($_SESSION['lancar'] && ($totDebito>0 || $totCredito>0)) {
	//Inicializado as variáveis
	$ind = 0;
	$dtlanc = (empty($_POST['dataLancamento']) ) ? conv_valor_br($dataLc):$_POST['dataLancamento'];
	?>
<form method="post" action="">
	<div class="col-xs-12">
		<label>Hist&oacute;rico do lan&ccedil;amento:</label>
		<input type="text" name="hist" id="hist" size="60" autofocus="autofocus" class="form-control"
			tabindex="<?PHP echo ++$ind;?>" value='<?PHP echo $hist;?>'>
	</div>
	<div class="col-xs-3"><br />
      <div class="checkbox"><h5>
        <label>
          <input type="checkbox" required tabindex="<?PHP echo ++$ind;?>">
					 &nbsp;Confirma lan&ccedil;amento?
        </label></h5>
      </div>
	</div>
	<div class="col-xs-2">
		<label>Data:</label>
		<input type="text" name="data" id="data" class="form-control"
			value="<?php echo $dtlanc;?>" required tabindex="<?PHP echo ++$ind;?>">
	</div>
	<div class="col-xs-2">
			<label>&nbsp;</label>
  			<input type="submit" name="Submit" class='btn btn-primary btn-sm'
			value="Lan&ccedil;ar..." tabindex="<?PHP echo ++$ind;?>" />
	</div>
		<input name="escolha" type="hidden" value="<?php echo $_GET['escolha'];?>" />
		<input name="lancar" type="hidden" value="1" />
		<input name="igreja" type="hidden" value="<?php echo $roligreja;?>" />
</form>
<?php
	//echo '<h1> ***'.$dataLc.'</h1>';
}elseif ($totDebito<1 && $totCredito<1) {
	echo '<h3>Essa Igreja n&atilde;o possui lan&ccedil;amento a realizar!</h3>';
}else {
	echo '<h3>Voc&ecirc; deve corrigir a pend&ecirc;ncia do lan&ccedil;amento acima para finalizar!</h3>';
}
?>
