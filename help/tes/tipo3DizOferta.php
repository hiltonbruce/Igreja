<?php
$nome = NULL;
$rolMembro = NULL;
echo '<br /> tipo 3 POST rol: '.$_POST["rol"];

if ($_POST["rol"]!='' && $_POST["nome"]=='') {
	//Se for informado o rol, entï¿½o traz o nome do banco
	$nomecont = new DBRecord('membro', $_POST["rol"], 'rol');
	$rolMembro = (int)$_POST["rol"];
	$nome = $nomecont -> nome();
	$eclesia = new DBRecord('eclesiastico', $_POST["rol"], 'rol');
	$congcontrib = $eclesia->congregacao();
} elseif ($_POST["nome"]!='')  {
	$nome = strip_tags($_POST["nome"]);
}
//corrigir os post para oferta...
for ($i = 0; $i < 13; $i++) {

	$campo = 'oferta'.$i;
	//printf ("$campo: %s",$_POST["$campo"]);

	$valor = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );//Captura o valor e converte p o padrÃ£o americano

	if ($valor>0) {

		switch ($i) {
			case 0:
				$conta = "'700','1','1'";//Dï¿½zimo
				break;
			case 1:
				$conta = "'701','1','2'";//Oferta
				break;
			case 2:
				$conta = "'702','1','3'";//Oferta extra
				break;
			case 3:
				$conta = "'704','1','4'";//Voto
				break;
			case 4:
				$conta = "'720','3','7'";//Oraï¿½ï¿½o Adulto
				break;
			case 5:
				$conta = "'722','8','7'";//Oraï¿½ï¿½o Mocidade
				break;
			case 6:
				$conta = "'723','5','7'";//Oraï¿½ï¿½o Infantil
				break;
			case 7:
				$conta = "'721','3','7'";//Voto em Circ. de Oraï¿½ï¿½o
				break;
			case 8:
				if ($rolIgreja=='1') {
					$conta = "'820','2','5'";//Missï¿½es Sede;
				} else {
					$conta = "'821','2','5'";//Missï¿½es Congreï¿½ï¿½es;
				}
				break;
			case 9:
				$conta = "'822','2','5'";//Missï¿½es Carnï¿½s
				break;
			case 10:
				$conta = "'826','2','5'";//Missï¿½es Cofres
				break;
			case 11:
				$conta = "'824','2','5'";//Missï¿½es Envelopes
				break;
			default:
			case 12:
				$conta = "'825','3','5'";//Voto para missï¿½es
				break;
			default:
				;
				break;
		}

		$congcontrib = ($congcontrib=='') ? $_POST["igreja"]:$congcontrib;

		//$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );
		$value  = "null,null,$conta,'".$congregacao."','$rolMembro','$nome','$valor',";
		$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$rolIgreja}','{$_SESSION['valid_user']}',";
		$value .= "'".$confirma."','{$_POST["obs"]}',NOW(),'$hist'";
		$dados = new insert ($value,"dizimooferta");
		echo '<br />Registrando lançamento: '.$value.' - Oferta: '.$campo;
		exit;
		$dados->inserir();
	}

}
?>
