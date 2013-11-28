<?PHP

controle ("deletar");

	//Inserir dados na tadela bairro
	
	$id = (int)$_GET["id"];
	$table = htmlentities ($_GET["tabela"]);
	
	//$del = new updatesist($table, $id,'id');
	
	$del_bairro = new bairro($cidade, $id);
	
	$rec = new DBRecord("membro", $id, "bairro");
	
	echo $rec->nome."teste excl_bairro.php";
	
	if ($rec->nome=="") { //verifica se o bairro já está cadastrado em outros usuários
	
	$rec->id=$id;
	$del_bairro->Deletar();
	}else{
		echo "<h3><a href=./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB>Existe(m) {$rec->linhas()} registro(s) cadastrado(s) neste bairro!...</a></h3>";
			
		echo "<script> alert('Existe(m) {$rec->linhas()} registro(s) cadastrado(s) neste bairro! O primeiro é: {$rec->nome}, só após remover este bairro do cadastro dele ou deles você poderá excluir este bairro!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB';</script>";
	
	}
	//$mostracidade = new DBRecord("cidade",$cidade,"id");
	//echo $mostracidade->nome."!</h2";

	//Se o usuário já vinha realizando o cadastro aqui dá opção de continuar
	if (isset($_SESSION["cid_end"])){
		echo "<h3><a href=./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB&cid_end=$cidade>Cadastro outro bairro? Clique aqui...</a></h3>";
		echo "<script> alert('Cadastrar outro bairro!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB';</script>";
	}else{
		echo "<h3><a href=./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB>Cadastrar outro bairro? Clique aqui...</a></h3>";
		echo "<script> alert('Bairro já cadastrado!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB';</script>";
	
	}
 ?> 