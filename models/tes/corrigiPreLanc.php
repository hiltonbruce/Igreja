<?PHP
controle("atualizar");
if (empty($_POST['id'])) {
	$idLanc = false;
	$mensagem = 'Erro na Atualização do Pre-Lançamento';
} else {
	$idLanc = (int)$_POST['id'];
	$preLanc = new DBRecord('dizimooferta',$idLanc,'id');
	$preLanc->igreja = $_POST['rolIgreja'];
	list($credito,$devedora,$tipo) = explode(',', $_POST['acesso']);
	$preLanc->credito = $credito;
	$preLanc->devedora = $devedora;
	$preLanc->tipo = $tipo;
	$preLanc->data = br_data ($_POST['data'],'Data de Lançamento');
	$preLanc->mesrefer = $_POST['mes'];
	$preLanc->anorefer = $_POST['ano'];
	$preLanc->obs = $_POST['obs'];
	if ($_POST['semana']>0 && $_POST['semana']<6) {
		$preLanc->semana = $_POST['semana'];
	}
	$vlrPost = strtr(str_replace(array('.',','),array(',','.'),$_POST["oferta0"]), ',','.' );
	//$vlrPost = strtr( str_replace(array('.',','),array('','.'),$_POST["oferta0"]), ',.','.,' );
	$valorBR = number_format($vlrPost, 2, ',', '.');
	$preLanc->valor = $vlrPost;

	$preLanc->nome = $_POST['nome'];
	$preLanc->rol = $_POST['rol'];

	$preLanc->Update();	  //Atualizar dados
	$mensagem = 'atualizado com Sucesso';
	}

echo "<script> alert('$mensagem!{$_POST["oferta0"]}-$valorBR - $vlrPost'); window.history.go(-2);</script>"
 ?>
