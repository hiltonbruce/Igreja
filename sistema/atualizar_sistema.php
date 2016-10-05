<?PHP
controle ("atualizar");
$rec_alterar = new DBRecord("tes_recibo", $_POST['id'], "id");
//list($anov, $mesv, $diav) = explode("-", $rec_alterar->data());
//echo '<br />  - Data atual - ultimo Vencimento: '.$rec_alterar->data().' ---- '. ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24));
//$diasemissao = ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24)); //quantidade de dias após a emissão do recibo
#Verifica se o recibo já foi lançado e bloqueia para alteração
$testLanc = ($rec_alterar->lancamento()=='' || $rec_alterar->lancamento()=='0') ? true : false;
if (($_POST ['tabela']=='tes_recibo' && $testLanc) || $_POST ['tabela']!='tes_recibo' || $_SESSION["setor"]=='99'){
$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
$query = "select * from {$_POST["tabela"]} ";
//echo "ID: ".$_POST["id"]." Campo: ".$_POST["campo"]." Tabela: ".$_POST["tabela"]." Post[Post[campo]]: ".ltrim($_POST[$_POST["campo"]]);
$query .="where id='{$_POST["id"]}'";
$id = (int)$_POST["id"];
$result = mysql_query($query) or die (mysql_error());

if (mysql_num_rows($result)>0)
	{
		//$rec = new UPDatesist($_POST["tabela"], $id,$_POST["campo"]);
		$rec = new updatesist ("{$_POST["tabela"]}",$id,"id"); //Aqui será selecionado a informação do campo
		print "<br \>Foi atualizado de:<h3>{$rec->$_POST["campo"]()}</h3>\n"; //Imprime o valor na tela
		$valor =$_POST[$_POST["campo"]];
		if ($_POST["campo"]=='conta' && !empty($_POST['acessoDebitar'])) {
			$valor = intval($_POST['acessoDebitar']);
		}

//Faz a troca de "," por "." quando necessário
		if ($_POST["campo"]=='valor') {
			if (strstr($valor,',') && strstr($valor,'.')) {
				$trans = array("." => "", "," => ".");
			}elseif (strstr($valor,',')){
				$trans = array("," => ".");
			}else {
				$trans = array();
			}
			$valor = strtr($valor,$trans);
			$vlrUpdate = strtr($valor,',','.');
		}else {
			$vlrUpdate = $valor;
		}
		$rec->$_POST["campo"] = ltrim($vlrUpdate); //Aqui é atribuido a esta variável um valor para UpDate
		//Exeção para atualiza nome e setor da tabela usuario
		if (!empty($_POST['setor']) && $_POST["tabela"]=='usuario') {
			$rec->setor = $_POST['setor'];
		}
		$rec->Update(); //É feita a chamada do método q realiza a atualização no Banco
		print "Para:<h3> {$_POST[$_POST["campo"]]}</h3>";
		echo "<script> alert('Alteração realizada com sucesso!');window.history.go(-1);</script>";
				/*echo "<script> alert('Alteração realizada com sucesso!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf={$_POST["uf_end"]}';</script>";*/
	}
echo mysql_error();
}elseif ($_POST["tabela"]=='tes_recibo') { //fim do if para verificar se prazo para alteração do recibo expirou
	echo '<script> alert("O recibo já teve seu lançamento confirmado e você não poderá altera-lo!");window.history.go(-1);</script>';
}
 ?>
