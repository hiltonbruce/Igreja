<?PHP

controle ("admin_user");

$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	$id = (int)$_POST["id"];

$query = "select * from 'usuario' ";
//echo "ID: ".$_POST["id"]." Campo: ".$_POST["campo"]." Tabela: ".$_POST["tabela"]." Post[Post[campo]]: ".ltrim($_POST[$_POST["campo"]]);
	$query .="where id='$id'";
	
$result = mysql_query($query) or die (mysql_error());

   if (mysql_num_rows($result)>0)
	{
		//$rec = new UPDatesist($_POST["tabela"], $id,$_POST["campo"]);
		
		$rec = new updatesist ("usuario",$id,"id"); //Aqui será selecionado a informação do campo
		print "<br \>Foi atualizado de:<h3>{$rec->$_POST["campo"]()}</h3>\n"; //Imprime o valor na tela
				
		$rec->$_POST["campo"] = ltrim($_POST[$_POST["campo"]]); //Aqui é atribuido a esta variável um valor para UpDate
				
		$rec->Update(); //É feita a chamada do método q realiza a atualização no Banco
				
				
		print "Para:<h3> {$_POST[$_POST["campo"]]}</h3>";
		
		echo "<script> alert('Alteração realizada com sucesso!');window.history.go(-1);</script>";
				/*echo "<script> alert('Alteração realizada com sucesso!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf={$_POST["uf_end"]}';</script>";*/

	}
		
	echo mysql_error();
 ?> 