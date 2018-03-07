<?php
//$roligreja = (empty($_GET['igreja'])) ? '0':$_GET['igreja'];
if (!empty($_GET['igreja'])) {
	$roligreja = $_GET['igreja'];
} elseif (!empty($_POST['igreja'])) {
	$roligreja = $_POST['igreja'];
}else {
	$roligreja = '';
}
//Calculado a data do proximo lancamento caso não seja passsado
/**/
if (!empty($_GET['data'])) {
	$dtlanc = $_GET['data'];
} elseif(!empty($_POST['data'])) {
	$dtlanc = $_POST['data'];
} elseif(!empty($_POST['dataLancamento'])) {
	$dtlanc = $_POST['dataLancamento'];
}else {
	$dtlanc = '';
}
if (!empty($_GET['menu'])) {
        $rec = $_GET['rec'];
        $escolha = $_GET['escolha'];
        $menu = $_GET['menu'];
}else {
        $rec = $_POST['rec'];
        $escolha = $_POST['escolha'];
        $menu = $_POST['menu'];
}
if ($dtlanc == '') {
	$dataProxLanc = new tes_igreja($roligreja,$anolanc);
	$periodoLanc = $dataProxLanc->dataEntrada();
	#print_r($dataProxLanc->dataEntrada());
	$meslanc = $periodoLanc ['mesrefer'];
	$anolanc = $periodoLanc ['anorefer'];
	$dtlanc  = $periodoLanc ['proxCulto'];
} else {
	$meslanc = ($_GET['mes']=='' || $_GET['mes']>12 || $_GET['mes']<1) ? date('m'):$_GET['mes'];
	$anolanc = (empty($_GET['ano'])) ? date('Y'):$_GET['ano'];
}
/*if (empty($idIgreja)) {
	$idIgreja = $rolIgreja;
	$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');
}*/
$linkAcesso  = 'escolha='.$escolha.'&menu='.$menu;
$linkAcesso .= '&rec='.$rec.'&idDizOf='.$idDizOf.'&mes='.$meslanc.'&ano='.$anolanc.'&igreja=';
$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
?>
<fieldset>
	<legend>Fecha Caixa &bull; Igreja: <?php echo ($roligreja>'0') ? $igrejaSelecionada->razao() : 'N&atilde;o definida!' ;;//do script forms/autodizimo.php
	?> </legend>
	<div class="row">
	<div class="col-xs-4">
		<?php
			if ($roligreja > '0') {
				?>
				<form method="post" action="">
				<input name="escolha" type="hidden" value="<?php echo $_GET['escolha'];?>" />
				<input name="concluir" type="hidden" value="1" />
				<input name="dataLancamento" type="hidden" value="<?php echo $dtlanc;?>" />
				<input name="rolIgreja" type="hidden" value="<?php echo $igrejaSelecionada->rol();?>" />
				<label>&nbsp;</label>
				<input type="submit" class="btn btn-primary" name="Submit" value="Fecha Caixa" tabindex="<?PHP echo ++$ind;?>" />
				</form>
				<?php
			} else {
				echo '<div class="alert alert-danger" role="alert"><h3>Fechar caixa</h3> Voc&ecirc; dever&aacute; definir igreja aqui!</div>';
			}
		 ?>
	</div>
	<div class="col-xs-8">
	<label>Alterar Igreja: </label>
		<select name="igreja" id="igreja" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		<?php
		$varCta = (empty($cta)) ? '' : 'cta='.$cta.'&';
		$listaIgreja = $bsccredor->List_Selec_pop($varCta.$linkAcesso,$idIgreja);
		//echo $listaIgreja;
		?>
		</select>
	</div>
	</div>
</fieldset>
