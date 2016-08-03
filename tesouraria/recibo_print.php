<?PHP
	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	session_start();

	if ($_SESSION["setor"]<50 && $_SESSION["setor"]!=2){
		echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
		$_SESSION = array();
		session_destroy();
		header("Location: ./");
	}

	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");

		function __autoload ($classe) {

		list($dir,$nomeClasse) = explode('_', $classe);
		//$dir = strtr( $classe, '_','/' );

		if (file_exists("../models/$dir/$classe.class.php")){

			require_once ("../models/$dir/$classe.class.php");
		}elseif (file_exists("../models/$classe.class.php")){
			require_once ("../models/$classe.class.php");
		}


	}

	$igreja = new DBRecord ("igreja","1","rol");

	if ($igreja->cidade()>0) {
		$cidOrigem = new DBRecord ("cidade",$igreja->cidade(),"id");
		$origem=$cidOrigem->nome().' - '.$cidOrigem->coduf();
	}else {
		$origem = $igreja->cidade().' - '.$igreja->uf();
	}

	if ($_POST["reimprimir"]==""){

		$cad_igreja = intval($_POST['igreja']);
		$cidIgreja = new DBRecord('cidade', $cad_igreja,'id');
		$nomeCidIgreja = $cidIgreja->nome();
		$valor = $_POST["valor"];
		$rec_tipo = intval($_POST["rec"]);
		$fonte_recurso = intval($_POST["caixa"]);
		$rolmembro = intval($_POST["rol"]);
		$lancamento = intval($_POST["lancamento"]);
		$credito = intval($_POST["credito"]);
		$debito = intval($_POST["acessoDebitar"]);
		$referente = $_POST["referente"];
		$nome = $_POST["nome"];
      	$cpf = $_POST["cpf"];
      	$rg = $_POST["rg"];
      	$acessoDebitar = $_POST['acessoDebitar'];

		$numero = ($_POST["numero"]=="") ? $_POST["razao"]:$_POST["numero"];

		if (empty($_POST["data"])) {
			$data = date("d/m/Y");
		}else {
			$data = $_POST["data"];
		}

	}else {
		$reimprimir = new DBRecord("tes_recibo", intval($_POST["reimprimir"]), "id");
		$cad_igreja = $reimprimir->igreja();
		$valor = $reimprimir->valor();
		$rec_tipo = $reimprimir->tipo();
		$fonte_recurso = $reimprimir->fonte();
		list($ano, $mes, $dia) = explode("-", $reimprimir->data());
		$data = $dia.'/'.$mes.'/'.$ano;
		$rolmembro = $reimprimir->recebeu();
		$numero = $rolmembro;
		list($nome, $cpf, $rg) = explode("," , $rolmembro);
		$cpf = trim( $cpf, 'CPF: ');
		$rg = trim( $rg, 'RG: ' );
		$referente = $reimprimir->motivo();
	}

		$conta = new tes_conta();
		$dadosCta = $conta->ativosArray();

	//Formata o valor e defini para exibição por texto por extenso
		$valor_us =strtr("$valor", ',','.' );
		$vlr = number_format("$valor_us",2,",",".");
		$dim = extenso($valor_us);
		$dim = ereg_replace(" E "," e ",ucwords($dim));


	$link = "../?escolha=tesouraria/recibo.php&menu=top_tesouraria&valor=$valor&referente={$_POST["referente"]}&data={$_POST["data"]}";
	$link .= "&nome=".$_POST["nome"]."&rol=".$_POST["rol"]."&rec=".$_POST["rec"];

	if (empty($valor)){
		echo "<script> alert('Você não definiu o valor do recibo!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($referente==""){
		echo "<script> alert('É necessário informar a que se refere este recibo!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($rec_tipo==1 && $rolmembro==""){
		echo "<script> alert('Para membros da Igreja é obrigatório informar o número do rol dele em nosso cadastro!');location.href='".$link."';</script>";
		$erro=1;
	}elseif (($rec_tipo=='3' && $rolmembro=='') && ($cpf=='' xor $rg=='')) {
		echo "<script> alert('Para NÃO membros da Igreja é obrigatório informar o nome completo, e pelo menos o RG ou CPF!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($rec_tipo=='2' && $numero==""){
		echo "<script> alert('Fornecedor não definido!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($rec_tipo=='' || $rec_tipo>'3'){
		$erro =1;
	}

		$hist = $_SESSION['valid_user'].": ".date("d/m/Y h:i:s");

		//Verifica click duplo no form de criar recibos
		if ((check_transid($_POST["transid"]) || $_POST["transid"]=="")) {
			//houve click duplo no form
			$gerarPgto = true;
		}else {
			//Não houve click duplo no form
			$gerarPgto = false;
			//Grava no banco codigo de autorização para o novo recibo
			add_transid($_POST["transid"]);
		}

		//Verifica o tipo de recibo no formato apropriado
		require_once '../models/tes/insertRecibos.php';

	if (empty($_POST['reimprimir'])){
	$rec_num = new ultimoid('tes_recibo');//recupera o id do último insert no mysql (número do recibo)
	$numrecibo = $rec_num->ultimo();}
	else {
		$numrecibo = $_POST['reimprimir'];
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Recibo Tesouraria Templo Sede</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.print.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="SHORTCUT ICON" href="../ad.ico"  type="image/vnd.microsoft.icon" />
</head>
<body>
<div id="container">

  <div id="header">
	<p>
	<?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} <br /> $origem - {$igreja->uf()} - CNPJ: {$igreja->cnpj()}<br />
	CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?>
	<br />Copyright &copy; <a rel="nofollow" href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information">Site&nbsp;</a>
    <br />Email: <a href="mailto: <?PHP echo "{$igreja->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>

<div id="mainnav">
		<div style="text-align: right;"><h4><?php printf ("N&uacute;mero: %'05u",$numrecibo);?></h4></div>

  </div>
	<div id="content"><div id="Tipo">
			Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 Valor: R$ <?php echo $vlr;?> <br />
  </div>
    <div id="added-div1">
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<?php
		echo $texto;
	?>, a import&acirc;ncia de <?php echo "R$ $vlr ( $dim ).";?><br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelo que firmamos o presente recibo em uma
		via para os devidos fins.<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Referente: <?PHP echo $referente;?>.</p>
		<h4 class='small'><?php printf ("Fonte: %s, Cod.: %03u.",$dadosCta[$credito]['titulo'],$credito);
		printf ("<h4>Despesa: %s, Cod.: %03u.",$dadosCta[$debito]['titulo'],$debito);
		if ($cad_igreja<2){
			echo ' Templo Sede.';
		}else {
			$imp_igreja = new DBRecord('igreja',$cad_igreja, 'rol');
			echo ' Cong. '.$imp_igreja->razao();
		}
		?></h4>
    </div>
    <div id="added-div-2" class='text-right'>
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<h3><?PHP  print $nomeCidIgreja." - ".$igreja->uf().", ".data_extenso ($data);?></h3><br /><br /><br />
    	<div id="polegar">Polegar</div><div id="assinatura">Assinatura: <?PHP echo strtoupper(toUpper($responsavel));?></div>
	 </div>
    </div>
    <div id="footer">
     Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
    </div>
  </div>
</body>
</html>

