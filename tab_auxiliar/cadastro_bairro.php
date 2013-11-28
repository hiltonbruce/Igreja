<?PHP
if (empty($_POST["cidade"]) && empty($_POST["bairro"])){
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<fieldset><legend>Cadastrar Bairro</legend><form action="" method="post" name="form1">
 <label>Estado:</label>
	<select name="destino" id="destino" onchange="MM_jumpMenu('parent',this,0)">
	<?PHP
	if (empty($_GET["uf"]))
	{?>
		<option value="">Escolha o Estado</option>
	<?PHP
	}else{
		echo "<option value={$_GET['uf']}>{$_GET['uf']}</option>";
	} 
	?>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=AC'>Acre</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=AL'>Alagoas</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=AP">Amap&aacute;</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=AM'>Amazonas</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=BA'>Bahia</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=CE">Cear&aacute;</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=DF'>Distrito Federal</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=GO">Goi&aacute;s</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=MA">Maranh&atilde;o</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=MT'>Mato Grosso</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=MS'>Mato Grosso do Sul</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=MG'>Minas Gerais</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=PA">Par&aacute;</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=PB">Para&iacute;ba</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=PR">Paran&aacute;</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PE'>Pernambuco</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=PI">Piau&iacute;</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=RJ'>Rio de Janeiro</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=RN'>Rio Grande do Norte</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=RS'>Rio Grande do Sul</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=RO">Rond&ocirc;nia</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=RR'>Roraima</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=SC'>Santa Catarina</option>
		<option value="./?escolha=tab_auxiliar/cadastro_bairro.php&amp;uf=SP">S&atilde;o Paulo</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=SE'>Sergipe</option>
		<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=TO'>Tocantins</option>
	</select>
	<?PHP
	if (!empty($_GET["uf"]))
	{
		conectar();
		$vl_uf=$_GET["uf"];
		$lst_cid = new sele_cidade("cidade","$vl_uf","codUf","nome","cidade");
		echo "<label>Cidade de Destino:</label>";		
		$vlr_linha=$lst_cid->ListDados ("1");
	
	?>
    <label>Bairro:</label>
    <input name="bairro" type="text" id="bairro">
    <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "tab_auxiliar/cadastro_bairro.php";?>">
    
	
	<?PHP } ?>

    <label>
    <input type="submit" name="Submit" value="Cadastrar">
    </label>
</form></fieldset>
<?PHP
}elseif ($_SESSION['nivel']>4)//Verifica se o usuário tem autorização para o cadastro e realiza inserção 
{
	//Inserir dados na tadela bairro
	$log = "Inserido por:{$_SESSION["valid_user"]}";
	$value = "'','{$_POST["bairro"]}','{$_POST["cidade"]}',NULL,'$log'";
	$carta = new insert ("$value","bairro");
	$carta->inserir();
	if (isset($_SESSION["cid_end"])){//Se o usuário já vinha realizado o cadastro aqui dá opção de continuar
		echo "<h3><a href=./?escolha=adm/cadastro.php>Deseja continuar o cadastro ? Clique aqui...</a></h3>";
	}
	
}else{
	echo "Desculpe! Mas voc&ecirc; não te autoriza&ccedil;&atilde;o para esta terefa.";
}
?>