<?PHP
$cidade = (empty($_POST["cidade"])) ? (int)$_GET["cidade"]:(int)$_POST["cidade"];

$uf = (empty($_POST["uf"])) ? $_GET["uf"]:$_POST["uf"];

if (($cidade>'0' && empty($_POST["bairro"])) || (empty($_POST["cidade"]) && empty($_POST["cidade"]))) {
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<fieldset><legend>Cadastrar Bairro</legend>
<form action="" method="post" name="form1">
 <table>
 	<tbody>
 		<tr>
 			<td><label>Estado:</label>
				<select name="destino" id="destino" onchange="MM_jumpMenu('parent',this,0)" class="form-control" >
				<?PHP
				if ($uf!='')
				{?>
					<option value='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=<?php echo $uf;?>'><?php echo $uf;?></option>
				<?PHP
				}
				?>
					<option value="">Escolha o Estado</option>
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
 			</td>
 			<td>
				<?PHP
				if (!empty($_GET["uf"]))
				{	
					echo '<label for="disabledSelect">Cidade</label>';
					if (empty($_GET['cidade'])) {
						conectar();
						$vl_uf=$_GET["uf"];
						$lst_cid = new sele_cidade("cidade","$vl_uf","codUf","nome","cidade");
						$vlr_linha=$lst_cid->ListDados ("1");
					}else {
						echo('<span id="disabledTextInput" disabled="disabled" class="form-control">'.$_GET['nomeCid'].'</span>');
						echo '<input name="cidade" type="hidden" value="'.$_GET['cidade'].'" >';	
						
					}
					
					
				
				?>
 			</td>
 		</tr>
 		<tr>
 			<td>
 				<label>Bairro:</label>
			    <input name="bairro" type="text" id="bairro" class="form-control" placeholder="Nome do bairro para cadastrar">
			    <input name="escolha" type="hidden" id="escolha" value="<?PHP 
			    	echo "tab_auxiliar/cadastro_bairro.php";?>">
				<?PHP } ?>
			</td>
 			<td>
			    <label>&nbsp;</label>
			    <input type="submit"  class="btn btn-primary"name="Submit" value="Cadastrar">
    </td>
 		</tr>
 	</tbody>
 </table>
    

</form></fieldset>
<?PHP
}elseif ($_SESSION['nivel']>4)//Verifica se o usuário tem autorização para o cadastro e realiza inserção 
{
	//Inserir dados na tadela bairro
	$bairros = new bairro($cidade,$_POST["bairro"]);
	$linkRetorno = (empty($_SESSION["nome_cad"])) ? $_GET['escolha']:'adm/';
	if ($bairros->exitecad()) {
		echo $_GET['nomeCid'].'</div>';
		echo('<script> alert("Bairro: '.$_POST['bairro'].', já cadastrado para esta cidade '.$_GET['nomeCid'].'!");</script>');
		echo '<h3>Deseja voltar e continuar o cadastro ? <a href="./?escolha=';
		echo $_GET['escolha'].'&cid_end=';
		echo $cidade.'"><button class="btn btn-primary">Clique aqui...</button></a></h3>';
	}else {
		$log = "Inserido por:{$_SESSION["valid_user"]}";
	$value = "'','{$_POST["bairro"]}','$cidade',NULL,'$log'";
	$carta = new insert ("$value","bairro");
	$idBairro = $carta->inserir();
	}
	if ($idBairro>'0'){//Se o usuário já vinha realizado o cadastro aqui dá opção de continuar
		echo '<h3>Deseja voltar e continuar o cadastro ? <a href="./?escolha=';
		echo $_GET['escolha'].'&cid_end=';
		echo $cidade.'&bairro='.$idBairro.'"><button class="btn btn-primary">Clique aqui...</button></a></h3>';
	}
	
}else{
	echo "Desculpe! Mas voc&ecirc; não te autoriza&ccedil;&atilde;o para esta terefa.";
}
?>