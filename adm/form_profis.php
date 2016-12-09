<script language="javascript">
	function pergunta() {
		var p=window.confirm("O CPF não é válido, mesmo assim deseja ultiliza-lo:  <?php echo $_POST["cpf"];?>");
		window.location=(p) ? "./?conf_cpf_ruim=ok&escolha=adm/dados_profis.php" : "./?escolha=adm/dados_pessoais.php";}
</script>
<?php
	controle ("inserir");
	$rec = new DBRecord ("cidade",$_SESSION["cid_natal"],"id");// Aqui será selecionado a informação do campo autor com id=2
	$nome_cidade = $rec->nome()." - ".$rec->coduf();
  $bsc_rol = (!empty($_GET['bsc_rol'])) ? intval($_GET['bsc_rol']) : intval($_POST['bsc_rol']);
	//echo "<h1>Teste $uf_natal $cid_natal</h1>";
	$prof = new DBRecord ("profissional",$bsc_rol,"rol");
	$link = "atualizar_array";//define para q página direcionará o form para atualizar
	if ($prof->cpf()<>"") {
		$cpf = 	$prof->cpf();
	}elseif ($_GET["cpf"]<>""){
		$cpf = $_GET["cpf"];
		$link = "cad_dados_pess";//define para q página direcionará o form para atualizar
	}else {
		$cpf = $_SESSION["cpf"];
		$link = "cad_dados_pess";//define para q página direcionará o form para atualizar
	}
	$profis = new DBRecord ("profissional",ltrim($cpf),"cpf");
	if ($profis->cpf()<>"") {//Recusa se o CPF já estiver cadastrado
	?>
		<h2>CPF j&aacute; cadastrado! <a href="./?escolha=adm/cadastro_membro.php&uf=<?PHP echo $_POST["uf_nasc"];?>">Voltar.else..</a>
            <script language="JavaScript" type="text/javascript">
			alert("CPF já cadastrado!");
			location.href="./?escolha=adm/cadastro_membro.php&uf=<?PHP echo $_POST["uf_nasc"];?>";
		  </script>
	<?PHP
	exit;
	}
	if ((validaCPF($_GET["cpf"]) xor (empty($_GET["conf_cpf_ruim"]))) && empty($_SESSION["cpf"]) && empty($_GET['bsc_rol'])){
		echo "<script>pergunta();</script>";
		echo "CPF inválido";
		exit;
	}
?>
<div id="lst_cad">
<fieldset>
<legend>Dados Eclesi&aacute;sticos - Cadastro de Membro</legend>
<form method="post" action="">
	<div id="lst_cad">
	<table class='table'>
      <tr>
        <td colspan="2">
            <div class="row">
              <div class="col-xs-4">
                <label>CPF :</label>
        		<?PHP
        		$ind=1;
        		if ($cpf<>""){
                    ?>
                <input type="text" disabled='disabled' class='form-control' value="<?PHP echo $cpf;?>" />
              	<input name="cpf" type="hidden" id="cpf" value="<?PHP echo $cpf;?>" />
        		<?PHP }else {?>
    		 	<input name="cpf" type="text" id="cpf" class='form-control' tabindex="<?PHP echo $ind++;?>" />
    			<?PHP } ?>
            </div>
              <div class="col-xs-4">
                <label>Identidade:</label>
                <input name="rg" type="text" id="rg" class='form-control' tabindex="<?PHP echo $ind++;?>" />
            </div>
              <div class="col-xs-4">
                <label>Org&atilde;o expedidor :</label>
                <input name="orgao_expedidor" type="text" id="orgao_expedidor"
                class='form-control' tabindex="<?PHP echo $ind++;?>" />
            </div></div>
    </tr>
    <tr>
        <td colspan="2"><label>Profiss&atilde;o:</label>
            <input name="profissao" type="text" id="profissao"
            tabindex="<?PHP echo $ind++;?>" class='form-control' />
        </td>
    </tr>
      <tr>
        <td colspan="2"><label>Empresa onde Trabalha:</label>
            <input name="onde_trabalha" type="text" id="onde_trabalha"
            class='form-control' tabindex="<?PHP echo $ind++;?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2"><label>Obs:</label>
          <textarea name="obs" id="obs"
          tabindex="<?PHP echo $ind++;?>" class='form-control' ></textarea>
          </label>
        </td>
    </tr>
    </table>
	</div><br />
	<input name="escolha" type="hidden" value="adm/<?PHP echo $link;?>.php" />
	<input name="tabela" type="hidden" id="tabela" value="profissional" />
  <input name="bsc_rol" type="hidden" id="tabela" value="<?PHP echo $bsc_rol;?>" />
	<input name="hist" type="hidden" id="hist" value="<?PHP echo $_SESSION['valid_user'].": ".$_SESSION['nome'].", em: ".date("d/m/Y H:i:s")."@".$prof->hist();?>" />
	<input type="submit" class='btn btn-primary' name="Submit" value="Cadastrar..."
    tabindex="<?PHP echo $ind++;?>" />
</form>
</fieldset>
</div>
