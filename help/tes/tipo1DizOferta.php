<?php
//corrigir os post para oferta...
$msg = "<script> alert('Voc� n�o definiu para qual CONTA deseja contribuir. Refa�a o lan�amento!');</script>";
for ($i = 0; $i < 13; $i++) {

	$campo = 'oferta'.$i;
	//printf ("$campo: %s",$_POST["$campo"]);

	$valor = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );//Captura o valor e converte p o padr�o americano

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
				if ($_POST['acescamp']=='') {
					$msg = "<script> alert('Voc� n�o definiu para qual campnha deseja contribuir. Refa�a o lan�amento da campanha!');</script>";
					$conta ='';
				}else {
				$conta = "'{$_POST['acescamp']}','1','6'";//Campanha
				}
				break;
			case 5:
				if ($rolIgreja=='1') {
					$conta = "'820','2','5'";//Miss�es Sede;
				} else {
					$conta = "'821','2','5'";//Miss�es Congre��es;
				}
				break;
			case 6:
				$conta = "'824','2','5'";//Miss�es Envelopes
				break;
			case 7:
				$conta = "'823','2','5'";//Miss�es Cofres
				break;
			case 8:
				$conta = "'822','2','5'";//Miss�es Carn�s
				break;
			case 9:
				$conta = "'720','3','7'";//Ora��o Adulto
				break;
			case 10:
				$conta = "'900','8','7'";//Ora��o Mocidade
				break;
			case 11:
				$conta = "'950','5','7'";//Ora��o Infantil
				break;
			case 12:
				$conta = "'721','3','7'";//Voto em Circ. de Ora��o
				break;
			default:
				break;
		}

		$congcontrib = ($congcontrib=='') ? $_POST["rolIgreja"]:$congcontrib;

		if ($conta=='') {
			echo $msg;
		}	else {
			//$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );
			$value  = "NULL,NULL,$conta,'".$congcontrib."','{$_POST["rol"]}','$nome','$valor',";
			$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$rolIgreja}','{$_SESSION['valid_user']}',";
			$value .= "'".$confirma."','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
			}
	}

}
?>
