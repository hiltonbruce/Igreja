<?php
if ($_POST["rol"]!='' && $_POST["nome"]=='') {
	//Se for informado o rol, ent�o traz o nome do banco
	$nomecont = new DBRecord('membro', $_POST["rol"], 'rol');
	$nome = $nomecont -> nome();
	$eclesia = new DBRecord('eclesiastico', $_POST["rol"], 'rol');
	$congcontrib = $eclesia->congregacao();
} elseif ($_POST["nome"]!='')  {
	$nome = $_POST["nome"];
} else {
	$nome = '';
}
//corrigir os post para oferta...
for ($i = 0; $i < 13; $i++) {

	$campo = 'oferta'.$i;
	//printf ("$campo: %s",$_POST["$campo"]);

	$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );//Captura o valor e vonverte p o padr�o americano

	if ($valor>0) {

		switch ($i) {
			case 0:
				$conta = "'700','1','1'";//D�zimo
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
				$conta = "'720','3','7'";//Ora��o Adulto
				break;
			case 5:
				$conta = "'722','8','7'";//Ora��o Mocidade
				break;
			case 6:
				$conta = "'723','5','7'";//Ora��o Infantil
				break;
			case 7:
				$conta = "'721','3','7'";//Voto em Circ. de Ora��o
				break;
			case 8:
				if ($rolIgreja=='1') {
					$conta = "'820','2','5'";//Miss�es Sede;
				} else {
					$conta = "'821','2','5'";//Miss�es Congre��es;
				}
				break;
			case 9:
				$conta = "'822','2','5'";//Miss�es Carn�s
				break;
			case 10:
				$conta = "'826','2','5'";//Miss�es Cofres
				break;
			case 11:
				$conta = "'824','2','5'";//Miss�es Envelopes
				break;
			default:
			case 12:
				$conta = "'825','3','5'";//Voto para miss�es
				break;
			default:
				;
				break;
		}

		$congcontrib = ($congcontrib=='') ? $_POST["igreja"]:$congcontrib;

		//$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );
		$value  = "NULL,NULL,$conta,'".$congregacao."','{$_POST["rol"]}','$nome','$valor',";
		$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$rolIgreja}','{$_SESSION['valid_user']}',";
		$value .= "'".$confirma."','{$_POST["obs"]}',NOW(),'$hist'";
		$dados = new insert ($value,"dizimooferta");
		$dados->inserir();
	}

}
?>
