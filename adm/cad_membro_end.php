<script language="javascript">
<!--
	function pergunta() {
		var p=window.confirm("O CPF não é válido, mesmo assim deseja ultiliza-lo:  <?php echo $_POST["cpf"];?>.E estando em branco será utilizado o número do rol.");window.location=(p) ? "./?conf_cpf_ruim=ok&escolha=adm/cad_membro_end.php" : "./?escolha=adm/cadastro_membro.php&uf=PB";}
		
	function pergunta_nome() {
		var p=window.confirm("O nome já está sendo utlizado:  <?php echo $_POST["nome_cad"];?>. OK para continuar com este nome?");	window.location=(p) ? "./?conf_cpf_ruim=ok&conf_nome_ruim=ok&escolha=adm/cad_membro_end.php" : "./?escolha=adm/cadastro_membro.php&uf=PB";}		
		
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
		<h2>CPF: <?PHP echo "{$_POST["cpf"]} j&aacute; cadastrado para o Rol: {$profis->rol()}"?> ! 
		<a href="./?escolha=adm/cadastro_membro.php&uf=<?PHP echo $_POST["uf_nasc"];?>">Voltar...</a>
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
<table>
	<tbody>
		<tr>
			<td><label>Nome:</label>
	<button class="form-control"><?PHP echo $_SESSION["nome_cad"];?></button></td>
			<td><label>CPF: </label>
	<button class="form-control"><?PHP echo $_SESSION["cpf"];?></button></td>
		</tr>
		<tr>
			<td><label>Nacionalidade:</label>
	<button class="form-control"><?PHP echo $_SESSION["nacao"];?></button></td>
			<td><label>Natural de: </label>
	<button class="form-control"><?PHP echo $nome_cidade;?></button></td>		
		</tr>
			<td><label>UF:</label>
	<select name="uf_end" class="form-control" id="uf_end" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		<?PHP
			$estnatal = new List_UF('estado', 'nome','uf_end');
			echo $estnatal->List_Selec_pop('escolha=adm/cad_membro_end.php&uf_end=',$_GET['uf_end']);
		?>
	  </select>
				</td>
			<td><label>Cidade:</label>
			<?PHP
		$vl_uf=$uf_end;
		$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cid_end");
		$vlr_linha=$lst_cid->ListDados ("2");//"2" é o indice de tabulação do formulário
	?>
			</td>
		<tr>
		</tr>
	</tbody>
</table>	   
	<p><label></label>
		
	<p><label></label>
	  <input type="submit" class="btn btn-primary" name="Submit" value="Continuar..." tabindex="3">
      <input name="escolha" type="hidden" value="adm/cadastro.php" />
  </p>
</form>
</fieldset>
