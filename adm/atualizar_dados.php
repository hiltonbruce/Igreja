<?PHP
controle ("atualizar");
$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
// verifica se o cpf j? est? cadastrado
if (!empty($_POST["cpf"]) && strlen($_POST["cpf"])=='14') {
	$profis = new DBRecord ("profissional",ltrim($_POST["cpf"]),"cpf");
	if ($profis->cpf()<>"" && $profis->cpf()<>$_POST["cpf_atual"]) {
	?>
		CPF: <?PHP echo "{$_POST["cpf"]} j&aacute; cadastrado para o Rol: {$profis->rol()}"?> !
		 <a href="./?escolha=adm/dados_profis.php&tabela=profissional&campo=cpf">Voltar...</a>
		<script language="JavaScript" type="text/javascript">
			alert("CPF: <?PHP echo "{$_POST["cpf"]} j� cadastrado para o Rol: {$profis->rol()}"?>...");
			location.href="./?escolha=adm/dados_profis.php&tabela=profissional&campo=cpf";
		</script>
	<?PHP
	}
}
if (!validaCPF($_POST["cpf"]) && $_POST["submit"]=="Alterar CPF ..."){
	echo "<script>alert('CPF: {$_POST["cpf"]} - N�mero de CPF inv�lido');</script>";
	echo "CPF inv�lido";
}
$id = (!empty($_POST['id'])) ? intval($_POST['id']) : intval($_GET['id']);
if ($_POST['tabela'] == 'carta') {
	$rec = new DBRecord ($_POST["tabela"],$id,'id');
	if ($_POST['campo']=='data') {
		$rec->$_POST["campo"] = br_data($_POST[$_POST["campo"]],$_POST["campo"]); //Aqui ? atribuido a esta vari?vel um valor para UpDate
	} else {
		$rec->$_POST["campo"] = ltrim($_POST[$_POST["campo"]]); //Aqui ? atribuido a esta vari?vel um valor para UpDate
	}
	$rec->Update();
	echo "<script> alert('Altera��o realizada com sucesso!');window.history.go(-1);</script>";
}else {
	$rol = (!empty($_POST['bsc_rol'])) ? intval($_POST['bsc_rol']) : $id;
	$query = 'select * from '.$_POST['tabela'].' ';
	$query .='WHERE rol = "'.$rol.'"';
/*else {
	$query .="where rol='{$_SESSION["rol"]}'";
	$rol = $_SESSION["rol"];
	}*/
	//echo "<h1>te -{$_POST["id"]}- teste -{$_POST["tabela"]}</h1>";
	$result = mysql_query($query) or die (mysql_error());
	if (mysql_num_rows($result)>'0')
	{
		$rec = new DBRecord ($_POST["tabela"],$rol,'rol'); //Aqui ser? selecionado a informa��o do campo
		print "<br \>O Campo foi atualizado de:<h3>{$rec->$_POST["campo"]()}</h3>\n"; //Imprime o valor na tela
		
		if ($_POST["campo"]=="auxiliar" || $_POST["campo"]=="diaconato"
		|| $_POST["campo"]=="presbitero" ||  $_POST["campo"]=="evangelista"
		|| $_POST["campo"]=="pastor" ||  $_POST["campo"]=="datanasc"
		|| $_POST["campo"]=="missionario"
		|| $_POST["campo"]=="dt_nasc" ||  $_POST["campo"]=="dt_apresent"
		|| $_POST["campo"]=="data" ||  $_POST["campo"]=="dat_aclam"
		|| $_POST["campo"]=="batismo_em_aguas" || $_POST["campo"]=="c_entregue"
		|| $_POST["campo"]=="c_impresso"  || $_POST["campo"]=="dt_mudanca_denominacao"
		|| $_POST["campo"]=="dt_muda_assembleia") 
		{
			//Aqui ? colocado os campo do tipo date e ent?o ? feita a valida��o da data e altera��o para o formato 0000-00-00 (AAAA-MM-DD), fun��o br_data()
			$rec->$_POST["campo"] = br_data($_POST[$_POST["campo"]],$_POST["campo"]); //Aqui ? atribuido a esta vari?vel um valor para UpDate
		}else{
			$rec->$_POST["campo"] = ltrim($_POST[$_POST["campo"]]); //Aqui ? atribuido a esta vari?vel um valor para UpDate
		}
			if ($_POST["campo"]=="pai" || $_POST["campo"]=="mae" || $_POST["campo"]=="conjugue") 
			{
				$cam="rol_{$_POST["campo"]}";
				$rec->$cam = ltrim($_POST["$cam"]); //Aqui ? atribuido a esta vari?vel um valor para UpDate
				$rec->Update(); //? feita a chamada do m?todo q realiza a atualiza��o no Banco
				print "Para:<h3> {$_POST[$_POST["campo"]]} - {$_POST["$cam"]}</h3>";
				echo "<script> alert('Altera��o realizada com sucesso!');window.history.go(-2);</script>";
			}else{
				//No caso de membro disciplinado ? feita um inser��o na tabela disciplina
				if ($_POST["campo"]=="situacao_espiritual" && $_POST["situacao_espiritual"]=="2") 
				{
					if (empty($_POST["prazo"])) {
						$dt_fim = date ("Y-m-d",mktime (0,0,0,date("m"),date("d")+30,date("Y")));
					}else{
						$dt_fim = date ("Y-m-d",mktime (0,0,0,date("m"),date("d")+$_POST["prazo"],date("Y")));
					}
					$value = "null,'{$_SESSION["rol"]}','{$_POST["situacao"]}','{$_POST["motivo"]}','".date("Y-m-d")."','$dt_fim','$hist',NOW()";
					$disciplina = new insert ("$value","disciplina");
					$disciplina -> inserir();
				}

				$rec->Update(); //? feita a chamada do m?todo q realiza a atualiza��o no Banco
				print "Para:<h3> {$_POST[$_POST["campo"]]}</h3>";
				if ($_POST["campo"]!="escolaridade" || $_POST["campo"]!="congregacao")
					echo "<script charset='iso-8859-1'> alert('Altera��o realizada  com sucesso!');window.history.go(-2);</script>";
				else
					echo "<script charset='iso-8859-1'> alert('Altera��o realizada com sucesso!');window.history.go(-1);</script>";
				/*echo "<script> alert('Altera��o realizada com sucesso!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf={$_POST["uf_end"]}';</script>";*/

		}
	} else {
		$value = $rol;
		$dados_pessoais = new insert ($value,$_POST["tabela"]);//deve-se colocar todos valores para os campos da tabela a ser inserida
		$dados_pessoais->inserir();
	}
}
echo mysql_error();
 ?>
