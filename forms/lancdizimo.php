<?php
$_SESSION['debito']=0;
$_SESSION['credito']=0;

//concluir lançamento final na tabela lançamento
$roligreja =(int) $_POST['rolIgreja'];
$lanigreja = new DBRecord('igreja',$roligreja, 'rol' );
$exibir = new lancdizimo($roligreja);
//Faz o leiaute do lançamento do débito da tabela dizimooferta
$exibirlanc = '';
$tablanc = mysql_query('SELECT SUM(valor) AS valor,devedora FROM dizimooferta WHERE lancamento="0" AND igreja = "'.$roligreja.'" GROUP BY devedora');
$totDebito = mysql_num_rows($tablanc);
while ($tablancarr = mysql_fetch_array($tablanc)) {
	$exibirlanc .= $exibir->lancamacesso ($tablancarr['valor'],$tablancarr['devedora'],'D');
}

//Faz o leiaute do lançamento do crédito da tabela dizimooferta
$tablanc_c = mysql_query('SELECT SUM(valor) AS valor,credito FROM dizimooferta WHERE lancamento="0" AND igreja = "'.$roligreja.'" GROUP BY credito');
$totCredito = mysql_num_rows($tablanc_c);
while ($tablancarrc = mysql_fetch_array($tablanc_c)) {
	$exibirlanc .= $exibir->lancamacesso ($tablancarrc['valor'],$tablancarrc['credito'],'C');
}
if ($_SESSION['lancar'] && ($totDebito>0 || $totCredito>0)) {
	//Inicializado as variáveis
	$ind = 0;
	
	$dtlanc = (empty($_POST['dataLancamento']) ) ? date('d/m/Y'):$_POST['dataLancamento'];
	?>
<form method="post" action="">
		<label>Hist&oacute;rico do lan&ccedil;amento:</label> <input
			type="text" name="hist" id="hist" size="60" autofocus="autofocus" class="form-control"
			tabindex="<?PHP echo ++$ind;?>">
	<div class="col-xs-4">
		<label>Data:</label>
		<input type="text" name="data" id="data" class="form-control"
			value="<?php echo $dtlanc;?>" tabindex="<?PHP echo ++$ind;?>">
	</div>
	<div class="col-xs-2">
			<label>&nbsp;</label>
  			<input type="submit" name="Submit" class='btn btn-primary'
			value="Lançar..." tabindex="<?PHP echo ++$ind;?>" />
	</div>
	<div class="col-xs-6"><label>&nbsp;</label></div> 
	<p>Ou marque uma das sugestões de hist&oacute;rico abaixo</p>
	
		
	<br />
	<div class="radio">
		<label><input type="radio"
		name="histsug" value="Ref. dízimos nesta data"
		tabindex="<?PHP echo ++$ind;?>" > Ref. dizimos nesta data</label>
	</div>
	<div class="radio">
		 <label>
		 <input type="radio" name="histsug" value="Ref. dízimos e ofertas nesta data"
		tabindex="<?PHP echo ++$ind;?>" > Ref. dizimos e ofertas nesta data</label>
	</div>
	<div class="radio">
		<label><input type="radio" name="histsug"
		value="Ref. dízimos, ofertas e oferta-extra nesta data"
		tabindex="<?PHP echo ++$ind;?>" > Ref. dizimos, ofertas e oferta-extra
		nesta data</label>
	</div>
		<h3>Com Missões</h3>
	<div class="radio">
		<label><input type="radio" name="histsug"
		value="Ref. dízimos, ofertas, oferta-extra, votos e ofertas de missões nesta data"
		tabindex="<?PHP echo ++$ind;?>" > Ref. dizimos, ofertas, oferta-extra,
		votos e ofertas de missões nesta data</label>
	</div>
	<div class="radio">
		<label><input type="radio" name="histsug"
		value="Ref. dízimos e ofertas de missões nesta data"
		tabindex="<?PHP echo ++$ind;?>" > Ref. dizimos e ofertas de missões
		nesta data</label> 
	</div>
		<input name="escolha" type="hidden"
		value="<?php echo $_GET['escolha'];?>" /> <input name="lancar"
		type="hidden" value="1" /> <input name="igreja" type="hidden"
		value="<?php echo $roligreja;?>" />
</form>

	<?php
}elseif ($totDebito<1 && $totCredito<1) {
	echo '<h3>Essa Igreja não possui lançamento a realizar!</h3>';
}else {
	echo '<h3>Voc&ecirc; deve corrigir a pend&ecirc;ncia do lan&ccedil;amento acima para finalizar!</h3>';
}

require_once 'views/lancdizimo.php';//chama o view para montar
?>