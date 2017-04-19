<?php
	$ufender = (empty($_GET['uf_end'])) ? '' : '&uf_end='.$_GET['uf_end'] ;
	$linkPost = 'uf_nasc='.$_GET["ufNasc"].'&cid_nasc='.$_GET["cid_nasc"].'&nome_cad='.$_GET["nome_cad"].'&cpf='.$_GET["cpf"].'&nacionalidade='.$_GET["nacionalidade"].'&nacionalidade1='.$_GET["nacionalidade1"].$ufender;
 ?>
<script language="javascript">
<!--
	function pergunta() {
		var p=window.confirm("O CPF não é válido, mesmo assim deseja ultiliza-lo:<?php echo $_GET["cpf"];?>.E estando em branco será utilizado o número do rol.");
		window.location=(p) ?
		"./?conf_cpf_ruim=ok&escolha=adm/cad_membro_end.php&<?php echo $linkPost;?>"
		:
		 "./?escolha=adm/cadastro_membro.php&uf=PB&<?php echo $linkPost;?>";
	}

	function pergunta_nome() {
		var p=window.confirm("O nome já está sendo utlizado:  <?php echo $_GET["nome_cad"];?>. OK para continuar com este nome?");	window.location=(p) ? "./?conf_cpf_ruim=ok&conf_nome_ruim=ok&escolha=adm/cad_membro_end.php" : "./?escolha=adm/cadastro_membro.php&uf=PB";}
</script>
<?php
if (empty($_GET['uf_end']) && empty($_POST['uf_end'])){
	$uf_end = "PB";
}elseif (!empty($_POST['uf_end'])) {
	$uf_end = $_POST['uf_end'];
}else{
	$uf_end = $_GET['uf_end'];
}

if (isset($_GET["nacionalidade"])){
	$nacao = (strlen($_GET["nacionalidade1"])>'4') ? $_GET["nacionalidade1"]:$_GET["nacionalidade"];
	$ufExtrang = (!empty($_GET['ufExtrang'])) ?  strtoupper($_GET['ufExtrang']): '';
	$cid_natal = (!empty($_GET['cidExtrang'])) ? $_GET['cidExtrang'].'-'.$ufExtrang: $_GET["cid_nasc"] ;
	//$_SESSION["cid_natal"] = $_GET["cid_nasc"];
	$cpf = ltrim($_GET["cpf"]);
	$nome_cad = ltrim($_GET["nome_cad"]);
	$profis = new DBRecord ("profissional",ltrim($_GET["cpf"]),"cpf");
	$nome_cad = new DBRecord ("membro",$nome_cad,"nome");
	$nome_cad_alt = new DBRecord ("membro",strtoupper($nome_cad),"nome");
	if ($profis->cpf()<>"") {
	?>
		<h2>CPF: <?PHP echo "{$_GET["cpf"]} j&aacute; cadastrado para o Rol: {$profis->rol()}"?> !
		<a href="./?escolha=adm/cadastro_membro.php&uf=<?PHP echo $_GET["uf_nasc"];?>">Voltar...</a>
            <script language="JavaScript" type="text/javascript">
			alert("CPF: <?PHP echo "{$_GET["cpf"]} já cadastrado para o Rol: {$profis->rol()}"?>...");
			location.href="./?escolha=adm/cadastro_membro.php&uf=<?PHP echo $_GET["uf_nasc"];?>";
		  </script>
			<?PHP
	exit;
	}
	if (validaCPF($_GET["cpf"]) xor (empty($_GET["conf_cpf_ruim"]))){
			echo "<script>pergunta();</script>";
			echo "CPF inválido";
			exit;
		}elseif ( ($nome_cad->nome()<>"") && ($nome_cad_alt->nome()<>"")  && (empty($_GET["conf_nome_ruim"]))) {
			echo "<script>pergunta_nome();</script>";
			echo "Nome em uso! Ative o JavaScript!";
			exit;
		}
}

	$cid_natal = (empty($_POST["cid_nasc"])) ? $_GET["cid_nasc"] : $_POST["cid_nasc"] ;
	$rec = new DBRecord ("cidade",$cid_natal,"id");// Aqui será selecionado a informação do campo autor com id=2
	$cidNatal = $rec->nome()." - ".$rec->coduf();
	$nome_cidade = ($rec->nome()=='') ? $cid_natal : $cidNatal ;
	//print_r($rec);
	//echo "<h1>Teste $uf_natal $cid_natal</h1>";
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</h2>
<?php
$nome_cad = (empty($_POST["nome_cad"])) ? $_GET["nome_cad"] : $_POST["nome_cad"] ;
$cpf = (empty($_POST["cpf"])) ? $_GET["cpf"] : $_POST["cpf"] ;
if (empty($_POST["nacionalidade1"]) && empty($_GET["nacionalidade1"])) {
	$nacao = (empty($_POST["nacionalidade"])) ? $_GET["nacionalidade"] : $_POST["nacionalidade"] ;
} else {
	$nacao = (empty($_POST["nacionalidade1"])) ? $_GET["nacionalidade1"] : $_POST["nacionalidade1"] ;
}
//$nome_cidade = (empty($_POST["cid_nasc"])) ? $_GET["cid_nasc"] : $_POST["cid_nasc"] ;

//$linkPost = 'uf_nasc='.$_POST["ufNasc"].'&cid_nasc='..'&nome_cad='..'&cpf='..'&nacionalidade='.$_POST["nacionalidade"].'&nacionalidade1='.$_POST["nacionalidade1"];
?>
<fieldset>
<legend>Cadastro de Membro - Endere&ccedil;o residencial</legend>
<form method="post" action="">
	<div class="row">
  <div class="col-xs-8">
		<label>Nome:</label>
			<input class="form-control" disabled='disabled' value = '<?PHP echo $nome_cad;?>'>
			<input name='nome_cad' type='hidden' value = '<?PHP echo $nome_cad;?>'>
  </div>
  <div class="col-xs-4">
		<label>CPF: </label>
			<input class='form-control' disabled='disabled' value = '<?PHP echo $cpf;?>' >
			<input name='cpf' type='hidden' value = '<?PHP echo $cpf;?>' >
  </div>
  <div class="col-xs-4">
		<label>Nacionalidade:</label>
			<input class="form-control" disabled='disabled' value = '<?PHP echo $nacao;?>'>
			<input name='nacao' type='hidden' value = '<?PHP echo $nacao;?>'>
  </div>
  <div class="col-xs-8">
		<label>Natural de: </label>
			<input class="form-control" disabled='disabled' value = '<?PHP echo $nome_cidade;?>'>
			<input name='cid_natal' type='hidden' value = '<?PHP echo $cid_natal;?>'>
  </div>
  <div class="col-xs-4">
		<label>UF:</label>
			<select name="uf_end" class="form-control" id="uf_end" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
				<?PHP
					$estnatal = new List_UF('estado', 'nome','uf_end');
					echo $estnatal->List_Selec_pop('escolha=adm/cad_membro_end.php&'.$linkPost.'&uf_end=',$uf_end);
				?>
				</select>
  </div>
  <div class="col-xs-6">
		<label>Cidade:</label>
		<?PHP
			$vl_uf=$uf_end;
			$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cid_end");
			$vlr_linha=$lst_cid->ListDados ("2");//"2" é o indice de tabulação do formulário
		?>
  </div>
  <div class="col-xs-2">
		<label>&nbsp;</label>
		  <input type="submit" class="btn btn-primary" name="Submit" value="Continuar..." tabindex="3">
	      <input name="escolha" type="hidden" value="adm/cadastro.php" />
  </div>
</div>
</form>
</fieldset>
