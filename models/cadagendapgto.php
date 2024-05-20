<?php

$parc 		= intval($_POST['parc']);
$hist 		= $_SESSION['valid_user'].": ".date("Y-m-d h:i:s");
$frequencia	= ($parc=='0')? 1:0;
$igreja 	= intval($_POST['igreja']);
$credor 	= intval($_POST['id']);
$numcredor 	= true;
$datven 	= true;
//Inserir a op��o para novo Cadastro
if ($credor=='' && $_POST['rol']>0) {
	$credor=$_POST['rol'].'r';
}elseif (strlen($_POST['nome'])>'5' && strlen($_POST['cnpj'])=='18') {
	//Cadastrar fornecedor
	$dadosEmpresa  = 'null,"'.$_POST['cnpj'].'","'.$_POST['nome'].'","'.$_POST['alias'].'",';
	$dadosEmpresa .= '"'.$_POST['desp1'].','.$_POST['desp2'].','.$_POST['desp3'].'",';
	$dadosEmpresa .= '"'.$_POST['telefone'].'","'.$_POST['celular'].'","'.$_POST['estado'].'",';
	$dadosEmpresa .= '"'.$_POST['bairro'].'","'.$_POST['cidade'].'","'.$_POST['uf'].'",';
	$dadosEmpresa .= '"'.$_POST['resp'].'","'.$_POST['cpf'].'","'.date('Y-m-d H:i:s').'","'.$_SESSION['valid_user'].'"';
	$cadastraCredor = new insert($dadosEmpresa,'credores');
	$credor = $cadastraCredor->inserir();
}elseif ($credor=='') {
	//Lan�ar erro aqui n�o possui credor
	$numcredor	= false;
	$menerro 	= "<script> alert('Voc� n�o informou o credor!'); window.history.go(-1);</script>";
}
echo "<h1>** $credor ***</h1>";
for ($j2 = 0; $j2 < $parc; $j2++) {
	//verifica se data est� ok
	if (!checadata($_POST['vencimento'.$j2])) {
		$datven = false;
		$dataerro = $j2.', com vencimento:'.$_POST['vencimento'.$j2];
	}
	$j0 = $j2-1;
	if ($j2>0) {
		//Verifica se quado alterada a data n�o � maior que a posterior
		list($dia,$mes,$ano) = explode('/',$_POST['vencimento'.$j2]);
		$dtfor = (mktime(0, 1, 0, $mes, $dia, $ano));
		list($dia,$mes,$ano) = explode('/',$_POST['vencimento'.$j0]);
		$dtfor0 = (mktime(0, 1, 0, $mes, $dia, $ano));
		//echo '<h1>$dtfor0 --> '.date('d/m/Y',$dtfor0).'--'.$dtfor0.'*** --- ***$dtfor --> '.date ('d/m/Y',$dtfor).$dtfor.'</h2>';
		if ($dtfor0>$dtfor) {
			$datven = false;
			$menerro 	= "<script> alert('A data que voc� alterou � inv�lida! Para parcela $dataerro...'); window.history.go(-1);</script>";
			$dataerro 	= $j2.', com vencimento:'.$_POST['vencimento'.$j2].', foi atualizada e saiu da sequ�ncia...';
		}

	}
	//echo $agenda->inserir();
	echo "<script>location.href='./?escolha=controller/despesa.php&menu=top_tesouraria&age=3';</script>";
	$variav = 'valor'.$j2;
	$$variav = $_POST["valor$j2"];

	//	echo '<h1>'.$$variav.'*** --- *** $$variav '.$variav.'</h2>';
}


if ($_POST['ajusteparc']>=0 && $_POST['ajusteparc']<$parc) {
	//Ajusta a localiza��o do valor da parcela na sequ�ncia solicitada
	//Faz a inves�o de valor de acordo com o solicitado
	--$j2;
	$sqparc = $_POST['ajusteparc'];
	$variav  	= "valor$sqparc";
	$variav2  	= "valor$j2";
	$$variav 	= $_POST["valor".$j2];
	$$variav2 	= $_POST["valor0"];
	//	echo '<h1>'.$$variav2.'--'. $variav2.' --> $$variav2*** --- ***  $$variav --> '.$$variav .'--'.$variav.' ++ $_POST["valor'.$sqparc.'"]--> '.$_POST["valor".$sqparc].'</h1>';
}

if ($credor!='' && $datven && $numcredor) {
	//verifica se credor foi informado e se as datas de vencimentos s�o validas
	//Cadastra agenda

	$extr  = 'SELECT MAX(idfatura) AS maximo FROM agenda';
	$extr_rec = mysql_query($extr);
	$valores = mysql_fetch_array($extr_rec);
	$idfatura = $valores['maximo']+1;//Acrescenta uma unidade p/ o novo grupo de pagamentos
	$creditar	= $_POST['acessoCreditar'];
	$debitar 	= $_POST['acessoDebitar'];
	$lanc	= $_POST['idlanc'];

	if ($parc=='0') {
		$valor	= $_POST["valor0"];
		$motivo 	= $_POST['motivo0'];
		$vencimento	= br_data($_POST['vencimento0'], 'Vencimento');

		$dadosagenda = sprintf("null,'%s','%s','%s','%s','%s','%s','%s','%s',null,'%s','%s',null,null,null,'%s'",
			$idfatura,$credor,$debitar,$creditar,$lanc,$frequencia,$igreja,$valor,$motivo,$vencimento,$hist);
		echo $dadosagenda.' *** <br />';
		$agenda= new insert ($dadosagenda,"agenda");
		echo $agenda->inserir();
		echo "<script>location.href='./?escolha=controller/despesa.php&menu=top_tesouraria&age=3';</script>";
	}else {
		for ($j2 = 0; $j2 < $parc; $j2++) {
			//Realiza loop para inserir os dados
			$variav = "valor$j2";
			$valor	= $$variav;
			$motivo 	= $_POST['motivo'.$j2];
			$vencimento	= br_data($_POST['vencimento'.$j2], 'Vencimento');

			$dadosagenda = sprintf("null,'%s','%s','%s','%s','%s','%s','%s','%s',null,'%s','%s',null,null,null,'%s'",$idfatura,$credor,$debitar,$creditar,$lanc,$frequencia,$igreja,$valor,$motivo,$vencimento,$hist);
			echo $dadosagenda.' *** <br />';
			$agenda= new insert ($dadosagenda,"agenda");

			if ($j2=='$parc') {
				echo $agenda->inserir();
				echo "<script>location.href='./?escolha=controller/despesa.php&menu=top_tesouraria&age=3';</script>";
			}else {
				$agenda->inserir();
			}
		}
	}

}else {

	echo $menerro;

}

?>
