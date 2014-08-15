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
		$texto .= ', recebi da Igreja Evang&eacute;lica Assembleia de Deus - '. $igreja->cidade().' - '.$igreja->uf();
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
		$texto .= "recebi da Igreja Evang&eacute;lica Assembleia de Deus - ". $igreja->cidade()." - ".$igreja->uf();
		$responsavel = $nome."<br />CPF: ".$cpf." - RG: ".$rg;
		$recebeu = strtoupper( toUpper($nome)).", CPF: ".$cpf.", RG: ".$rg;//Define o beneficiário do recibo
		break;
	default:
		echo "<script> alert('Recibo indefinido!');location.href='../?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec={$_POST["rec"]}';</script>";
}


if ($gerarPgto) {
	//Verifica click duplo ou se é para gerar 
	echo "<script> alert('Este recibo já foi registrado!');</script>";
}elseif ($erro != 1){
	
	//Cadastra o recibo na tabela
	$dt = br_data($data,"Data do recibo invalida: $data");
			$value  = "'','$cad_igreja','$rec_tipo','$recebeu','$valor_us','','$fonte_recurso',";
			$value .= "'$lancamento','$referente','$dt','$hist'";
	
			$dados = new insert ($value,"tes_recibo");
			$dados->inserir();

}
?>