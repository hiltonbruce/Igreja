<script language="javascript">
<!--
	function pergunta() {
		var p=window.confirm("O CPF não é válido, mesmo assim deseja ultiliza-lo:  <?php echo $_POST["cpf"];?>. E estando em branco será utilizado o número do rol.");
		window.location=(p) ? "./?conf_cpf_ruim=ok&escolha=adm/cad_membro_end.php" : "./?escolha=adm/cadastro_membro.php&uf=PB";}
		
	function pergunta_nome() {
		var p=window.confirm("O nome já está sendo utlizado:  <?php echo $_POST["nome_cad"];?>. OK para continuar com este nome?");
		window.location=(p) ? "./?conf_cpf_ruim=ok&conf_nome_ruim=ok&escolha=adm/cad_membro_end.php" : "./?escolha=adm/cadastro_membro.php&uf=PB";}		
		
</script>

<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");

if (empty($_GET['uf_end'])){
	$uf_end = "PB";
}else{
	$uf_end = $_GET['uf_end'];
}

if (isset($_POST["nacionalidade"])){
	
	$_SESSION["nacao"] = $_POST["nacionalidade"];
	$_SESSION["cid_natal"] = $_POST["cid_nasc"];
	$_SESSION["cpf"] = ltrim($_POST["cpf"]);
	$_SESSION["nome_cad"] = ltrim($_POST["nome_cad"]);
	
	$profis = new DBRecord ("profissional",ltrim($_POST["cpf"]),"cpf");
	$nome_cad = new DBRecord ("membro",$_SESSION["nome_cad"],"nome");
	$nome_cad_alt = new DBRecord ("membro",strtoupper($_SESSION["nome_cad"]),"nome");
	
	if ($profis->cpf()<>"") {
	?>
		<h2>CPF: <?PHP echo "{$_POST["cpf"]} j&aacute; cadastrado para o Rol: {$profis->rol()}"?> ! <a href="./?escolha=adm/cadastro_membro.php&uf=<?PHP echo $_POST["uf_nasc"];?>">Voltar...</a>
            <script language="JavaScript" type="text/javascript">
			alert("CPF: <?PHP echo "{$_POST["cpf"]} já cadastrado para o Rol: {$profis->rol()}"?>...");
			location.href="./?escolha=adm/cadastro_membro.php&uf=<?PHP echo $_POST["uf_nasc"];?>";
		  </script>
	          <?PHP
	exit;
	}
	
	if (validaCPF($_POST["cpf"]) xor (empty($_GET["conf_cpf_ruim"]))){
			echo "<script>pergunta();</script>";
			echo "CPF inválido";
			exit;
		}elseif ( ($nome_cad->nome()<>"") && ($nome_cad_alt->nome()<>"")  && (empty($_GET["conf_nome_ruim"]))) {
			echo "<script>pergunta_nome();</script>";
			echo "Nome em uso! Ative o JavaScript!";
			exit;
		}

}
	$rec = new DBRecord ("cidade",$_SESSION["cid_natal"],"id");// Aqui será selecionado a informação do campo autor com id=2
	$nome_cidade = $rec->nome()." - ".$rec->coduf();
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
		<fieldset>
<legend>Dados Pessoais - Cadastro de Membro</legend>
<form method="post" action="">
  <p><label></label>
	Nome: <?PHP echo $_SESSION["nome_cad"];?></p>  </p>
	<p><label></label>
	CPF: <?PHP echo $_SESSION["cpf"];?></p>
	
	<p>Nacionalidade: <h5><?PHP echo $_SESSION["nacao"];?></h5>
	</p>
	<p>Natural de: <h5><?PHP echo $nome_cidade;?></h5>
	<p>Endere&ccedil;o Residencial: </p>
	<p><label>UF:</label>
	<select name="uf_end" id="uf_end" onchange="MM_jumpMenu('parent',this,0)" tabindex="1" onselect="1">
			<option value="<?PHP echo $uf_end;?>"><?PHP echo $uf_end;?></option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=AC'>Acre</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=AL'>Alagoas</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=AP'>Amapá</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=AM'>Amazonas</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=BA'>Bahia</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=CE'>Ceará</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=DF'>Distrito Federal</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=GO'>Goiás</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=MA'>Maranhão</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=MT'>Mato Grosso</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=MS'>Mato Grosso do Sul</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=MG'>Minas Gerais</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=PA'>Pará</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=PB'>Paraíba</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=PR'>Paraná</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=PE'>Pernambuco</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=PI'>Piauí</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=RJ'>Rio de Janeiro</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=RN'>Rio Grande do Norte</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=RS'>Rio Grande do Sul</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=RO'>Rondônia</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=RR'>Roraima</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=SC'>Santa Catarina</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=SP'>São Paulo</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=SE'>Sergipe</option>
			<option value='./?escolha=adm/cad_membro_end.php&uf_end=TO'>Tocantins</option>
	  </select>
		<?PHP
		$vl_uf=$uf_end;
		$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cid_end");
		echo "Cidade:";		
		$vlr_linha=$lst_cid->ListDados ("2");//"2" é o indice de tabulação do formulário
		?></p>
	<p><label></label>
	  <input type="submit" name="Submit" value="Continuar..." tabindex="3">
      <input name="escolha" type="hidden" value="adm/cadastro.php" />
  </p>
</form>
</fieldset>
