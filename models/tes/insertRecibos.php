<?php
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
		$texto .= ', recebi da Igreja Evang&eacute;lica Assembleia de Deus - '. $origem;
		$responsavel = $membro->nome()."<br />CPF: ".$prof->cpf()." - RG: ".$prof->rg();
		$recebeu = $rolmembro;//Define o beneficiário do recibo
		break;
	case 2:
		$nome = new DBRecord ("credores",$numero,"id");
		$cidade = new DBRecord ("cidade",$nome->cidade(),"id");

		if (strlen($nome->cnpj_cpf())==18){
			$tipo = "CNPJ";
		}elseif (strlen($nome->cnpj_cpf())==14){
			$tipo = "CPF";
		}

		$texto =  "Pago a ".strtoupper( toUpper($nome->razao())).", ";
		$texto .= "$tipo: ".$nome->cnpj_cpf().", situada &agrave;: ".$nome->end().", N&ordm; ".$nome->numero();
		$texto .= ", ".$nome->bairro()." - ".$cidade->nome()." - ".$nome->uf();
		$responsavel = $nome->responsavel()."<br />CPF: ".$nome->cpf();
		$recebeu = $numero;//Define o beneficiário do recibo
		break;
	case 3:
		$texto = "Eu, ".strtoupper( toUpper($nome)).", ";
		$texto .= "CPF: ".$cpf.", RG: ".$rg.", ";
		$texto .= "recebi da Igreja Evang&eacute;lica Assembleia de Deus - ". $origem;
		$responsavel = $nome."<br />CPF: ".$cpf." - RG: ".$rg;
		$recebeu = strtoupper( toUpper($nome)).", CPF: ".$cpf.", RG: ".$rg;//Define o beneficiário do recibo
		break;
	default:
		echo "<script> alert('Recibo indefinido!');location.href='../?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec={$_POST["rec"]}';</script>";
}


if ($gerarPgto) {
	//Verifica click duplo ou se é para gerar
	echo "<script> alert('Este recibo já foi registrado!');</script>";
}elseif ($erro != '1'){

	$contas = new tes_conta();
	$contasAtivas = $contas->ativosArray();
	//print_r ($contasAtivas);


	//print_r($contasAtivas);
	//Cadastra o recibo na tabela
	if (strstr($_POST['acessoDebitar'], ',')) {
		$debitoContas	= explode(',',$_POST['acessoDebitar']);
		//print_r($debitoContas);
		$virgula = '';
		foreach ($debitoContas as $acesso){
			if ($acesso!='0') {
				$debito .= $virgula.$acesso;
				$virgula = ',';
			}
		}
	}elseif (!empty($_POST['acessoDebitar']) && intval($_POST['acessoDebitar'])==$_POST['acessoDebitar']) {
		$debito = $_POST['acessoDebitar'];
	}elseif (empty($debito)) {
		$debito ='';
	}

	if (strstr($_POST['credito'], ',')) {
		$creditoContas = explode(',',$_POST['credito']);
		//print_r($debitoContas);
		$virgula = '';
		foreach ($creditoContas as $acesso){
			if ($acesso!='0') {
				$credito .= $virgula.$acesso;
				$virgula = ',';
			}
		}
	}elseif (!empty($_POST['credito']) && intval($_POST['credito'])==$_POST['credito']) {
		$credito = (int)$_POST['credito'];
	}elseif (!empty($codAcessoDesp)) {
		$credito = $codAcessoDesp;
	}else {
		$credito = '';
	}
	//echo("<h1>$debitoContas - $debito</h1>");
	//echo("<h1> $creditoContas - $credito</h1>");

	$codConta = $debito.'@'.$credito;

	$dt = br_data($data,"Data do recibo invalida: $data");
			$value  = "'','$cad_igreja','$rec_tipo','$recebeu','$valor_us','$codConta','$fonte_recurso',";
			$value .= "'$lancamento','$referente','$dt','$hist'";

			$dados = new insert ($value,"tes_recibo");
			$dados->inserir();

}
?>
