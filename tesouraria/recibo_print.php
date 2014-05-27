<?PHP
	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	session_start();
	
	if ($_SESSION["setor"]<50 && $_SESSION["setor"]!=2){
		echo "<script> alert('Sem permiss�o de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
		$_SESSION = array();
		session_destroy();
		header("Location: ./");
	}
	
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	
		function __autoload ($classe) { 
		require_once ("../models/$classe.class.php");
	}
	
	$igreja = new DBRecord ("igreja","1","rol");
	
	if ($igreja->cidade()>0) {
		$cidOrigem = new DBRecord ("cidade",$igreja->cidade(),"id");
		$origem=$cidOrigem->nome();
	}else {
		$origem = $igreja->cidade();
	}
	
	if ($_POST["reimprimir"]==""){
		
		$cad_igreja = (int) $_POST['igreja'];
		$valor = $_POST["valor"];
		$rec_tipo = (int)$_POST["rec"];
		$fonte_recurso = (int)$_POST["fonte"];
		$rolmembro = (int)$_POST["rol"];
		$lancamento = (int)$_POST["lancamento"];
		$referente = $_POST["referente"];
		$nome = $_POST["nome"];
      	$cpf = $_POST["cpf"];
      	$rg = $_POST["rg"];
		
		$numero = ($_POST["numero"]=="") ? $_POST["razao"]:$_POST["numero"];
	
		if (empty($_POST["data"])) {
			$data = date("d/m/Y");
		}else {
			$data = $_POST["data"];
		}
		
	}else {
		$reimprimir = new DBRecord("tes_recibo", (int)$_POST["reimprimir"], "id");
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
	
	
		$fonte = new DBRecord ("fontes",$fonte_recurso,"id");
	
	//Formata o valor e defini para exibi��o por texto por extenso
		$valor_us =strtr("$valor", ',','.' );
		$vlr = number_format("$valor_us",2,",",".");
		$dim = extenso($valor_us);
		$dim = ereg_replace(" E "," e ",ucwords($dim));
	
	
	$link = "../?escolha=tesouraria/recibo.php&menu=top_tesouraria&valor=$valor&referente={$_POST["referente"]}&data={$_POST["data"]}";
	$link .= "&nome=".$_POST["nome"]."&rol=".$_POST["rol"]."&rec=".$_POST["rec"];
	
	if (empty($valor)){
		echo "<script> alert('Voc� n�o definiu o valor do recibo!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($referente==""){
		echo "<script> alert('� necess�rio informar a que se refere este recibo!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($rec_tipo==1 && $rolmembro==""){
		echo "<script> alert('Para membros da Igreja � obrigat�rio informar o n�mero do rol dele em nosso cadastro!');location.href='".$link."';</script>";
		$erro=1;
	}elseif (($rec_tipo=='3' && $rolmembro=='') && ($cpf=='' xor $rg=='')) {
		echo "<script> alert('Para N�O membros da Igreja � obrigat�rio informar o nome completo, e pelo menos o RG ou CPF!');location.href='".$link."';</script>";
		$erro=1;
	}

	
	
		
		$hist = $_SESSION['valid_user'].": ".date("d/m/Y h:i:s");
	
		//Verifica o tipo de recibo de d� o texto apropriado
		
		switch ($rec_tipo){
		case 1:
			$membro = new DBRecord ("membro",$rolmembro,"rol");
			$ecles = new DBRecord ("eclesiastico",$rolmembro,"rol");
			$prof = new DBRecord ("profissional",$rolmembro,"rol");
			$texto ="Eu, ".strtoupper( toUpper($membro->nome())).", ";
	      	$texto .= "CPF: ".$prof->cpf();
	      	//echo("<h1>{$prof->rg()}ttt</h1>");
	      	
				if ($prof->rg()==(int)$prof->rg()){
					$texto .= ", RG: ".$prof->rg();
					if ($prof->orgao_expedidor()!=""){
						$texto .= " - ".$prof->orgao_expedidor();
					}
				}else{
					$texto .= ", RG: ".$prof->rg();
					if ($prof->orgao_expedidor()!=""){
						$texto .= " - ".$prof->orgao_expedidor();
					}
				}
			$texto .=', rol N&ordm: '.$rolmembro;
			$texto .= ', recebi da Igreja Evang&eacute;lica Assembleia de Deus - '. $igreja->cidade().' - '.$igreja->uf();
			$responsavel = $membro->nome()."<br />CPF: ".$prof->cpf()." - RG: ".$prof->rg();
			$recebeu = $rolmembro;//Define o benefici�rio do recibo
			break;
		case 2:
			if ($numero==""){
				echo "<script> alert('Fornecedor n�o definido!');location.href='".$link."';</script>";
				$erro=1;
			}
			
			$nome = new DBRecord ("credores",$numero,"id");
			$cidade = new DBRecord ("cidade",$nome->cidade(),"id");
			
			if (strlen($nome->cnpj_cpf())==18){
			$tipo = "CNPJ";
			}elseif (strlen($nome->cnpj_cpf())==14){
			$tipo = "CPF";}
			
			$texto =  "Pago a ".strtoupper( toUpper($nome->razao())).", ";
	      	$texto .= "$tipo: ".$nome->cnpj_cpf().", situada &agrave;: ".$nome->end().", N&ordm; ".$nome->numero();
	      	$texto .= ", ".$nome->bairro()." - ".$cidade->nome()." - ".$nome->uf();
			$responsavel = $nome->responsavel()."<br />CPF: ".$nome->cpf();
			$recebeu = $numero;//Define o benefici�rio do recibo 
			break;
		case 3:
			$texto = "Eu, ".strtoupper( toUpper($nome)).", ";
	      	$texto .= "CPF: ".$cpf.", RG: ".$rg.", ";
			$texto .= "recebi da Igreja Evang&eacute;lica Assembleia de Deus - ". $igreja->cidade()." - ".$igreja->uf();
			$responsavel = $nome."<br />CPF: ".$cpf." - RG: ".$rg;
			$recebeu = strtoupper( toUpper($nome)).", CPF: ".$cpf.", RG: ".$rg;//Define o benefici�rio do recibo 
			break;
		default:
			echo "<script> alert('Recibo indefinido!');location.href='../?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec={$_POST["rec"]}';</script>";
			$erro =1;
	}
	
	//Cadastra o recibo na tabela
	if (check_transid($_POST["transid"]) || $_POST["transid"]=="") {
		echo "<script> alert('Este recibo j� foi registrado!');</script>"; 
	}elseif ($erro != 1){
		
		add_transid($_POST["transid"]);
		$dt = br_data($data,"Data do recibo invalida: $data");
		$value  = "'','$cad_igreja','$rec_tipo','$recebeu','$valor_us','','$fonte_recurso',";
		$value .= "'$lancamento','$referente','$dt','$hist'";
		
		$dados = new insert ($value,"tes_recibo");
		$dados->inserir();
		
	}
	if (empty($_POST['reimprimir'])){
	$rec_num = new ultimoid('tes_recibo');//recupera o id do �ltimo insert no mysql (n�mero do recibo)	
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
	<div id="Tipo">
			Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 Valor: R$ <?php echo $vlr;?> <br />
  </div>
  </div>
	<div id="content">
    <div id="added-div1">
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<?php
		echo $texto;
	?>, a import&acirc;ncia de <?php echo "R$ $vlr ( $dim ).";?><br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelo que firmamos o presente recibo em uma
		via para os devidos fins.<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Referente: <?PHP echo $referente;?>.</p>
		<h4><?php printf ("Fonte do recurso: %s - Cod. %03u.",$fonte->discriminar(),number_format($fonte->id(), 0, ',', '.'));
		if ($cad_igreja<2){
			echo ' Templo Sede.';
		}else {
			$imp_igreja = new DBRecord('igreja',$cad_igreja, 'rol');
			echo ' Cong. '.$imp_igreja->razao();
		}
		?></h4>
    </div>
    <div id="added-div-2">
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?PHP  print $igreja->cidade()." - ".$igreja->uf().", ".data_extenso ($data);?><br /><br /><br />
    	<div id="assinatura">Assinatura: <?PHP echo strtoupper(toUpper($responsavel));?></div>
	 </div>
    </div>
    <div id="footer">
     Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
    </div>
  </div>
</body>
</html>
	
