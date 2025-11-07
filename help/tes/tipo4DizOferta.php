<!-- Lançamento para o caixa do Dep de Ensino -->
<?php

// echo '<br />tipo 4 POST rol: '.$_POST["rol"];
$nome = $_POST["nome"] ? strip_tags($_POST["nome"]) : 'NULL';
$rolMembro = 'NULL';
$congcontrib = 'NULL';

// echo '<br />tipo 4 POST rol: '.$_POST["rol"];
if ((int)$_POST["rol"]!='') {
	//Se for informado o rol, então traz o nome do banco
	$nomecont = new DBRecord('membro', $_POST["rol"], 'rol');
	// print_r($nomecont);
	// echo '<br />tipo 4 nomecont rol: '.$nomecont -> rol();
	// exit;
	// $rolMembro = isset($nomecont -> rol())? (int)$_POST["rol"] : NULL;
	if ($_POST["nome"]=='NULL' && $rolMembro ) {
		$nome = $nomecont -> nome();
	}
	$eclesia = new DBRecord('eclesiastico', $rolMembro, 'rol');
	$congcontrib = $eclesia->congregacao() ? $eclesia->congregacao() : 'NULL';
} 

$rolIgreja = $_POST["rolIgreja"] ? (int)$_POST["rolIgreja"] : 'NULL';

//corrigir os post para oferta...
for ($i = 0; $i < 3; $i++) {

	$campo = 'oferta'.$i;
	//printf ("$campo: %s",$_POST["$campo"]);

	// $valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );//Captura o valor e vonverte p o padrï¿½o americano


	$valor = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );//Captura o valor e converte p o padrão americano

	if ($valor > 0) {

		switch ($i) {
			case 1:
				$conta = '801,4,1';//Corpo de Professores da EBD
				break;
			case 2:
				$conta = '803,4,9';//Revistas sem provisão p caixa de evangelização
				break;
			default:
				$conta = '800,4,1';//Ofertas
				break;
		}

		// $congcontrib = ($congcontrib=='') ? $_POST["igreja"]:$congcontrib;

		//$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );
		$value  = "NULL,0,$conta,$congcontrib,$rolMembro,$nome,'$valor',";
		$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','$rolIgreja','{$_SESSION['valid_user']}',";
		$value .= "'".$confirma."','{$_POST["obs"]}',NOW(),'$hist'";
		// echo '<br />Registrando lançamento: '.$value.' - Oferta: '.$campo;
		// exit;
		$dados = new insert ($value,"dizimooferta");
		// echo '<br />Registrando lançamento: '.$value.' - Oferta: '.$campo.' -rolIgreja '.$rolIgreja;
		// exit;
		$dados->inserir();
	}

}
?>