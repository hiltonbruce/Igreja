<?php
//corrigir os post para oferta...
$msg = "<script> alert('Você não definiu para qual CONTA deseja contribuir. Refaça o lançamento!');</script>";
for ($i = 0; $i < 13; $i++) {

	$campo = 'oferta'.$i;
	//printf ("$campo: %s",$_POST["$campo"]);

	$valor = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );//Captura o valor e converte p o padrão americano

	if ($valor>0) {

		switch ($i) {
			case 0:
				$conta = "'700','1','1'";//Dízimo
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
					$msg = "<script> alert('Você não definiu para qual campnha deseja contribuir. Refaça o lançamento da campanha!');</script>";
					$conta ='';
				}else {
				$conta = "'{$_POST['acescamp']}','1','6'";//Campanha
				}
				break;
			case 5:
				if ($rolIgreja=='1') {
					$conta = "'820','2','5'";//Missões Sede;
				} else {
					$conta = "'821','2','5'";//Missões Congreções;
				}
				break;
			case 6:
				$conta = "'824','2','5'";//Missões Envelopes
				break;
			case 7:
				$conta = "'823','2','5'";//Missões Cofres
				break;
			case 8:
				$conta = "'822','2','5'";//Missões Carnês
				break;
			case 9:
				$conta = "'720','3','7'";//Oração Adulto
				break;
			case 10:
				$conta = "'900','8','7'";//Oração Mocidade
				break;
			case 11:
				$conta = "'950','5','7'";//Oração Infantil
				break;
			case 12:
				$conta = "'721','3','7'";//Voto em Circ. de Oração
				break;
			default:
				break;
		}

		$congcontrib = ($congcontrib=='') ? $_POST["rolIgreja"]:$congcontrib;

		if ($conta=='') {
			echo $msg;
		}	else {
			//$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );
			$nome = mysql_real_escape_string($nome);
			$rol = (isset($_POST["rol"])) ? '0' : intval($_POST["rol"]) ;
			$value  = " null,0,$conta,'".$congcontrib."','$rol','$nome','$valor',";
			$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$rolIgreja}','{$_SESSION['valid_user']}',";
			$value .= "'".$confirma."','{$_POST["obs"]}','".date('Y-m-d H:i:s')."','$hist'";

			print_r($value);

			echo '<br />';
			$str = mb_convert_encoding($nome,'ISO-8859-1');
			echo mb_detect_encoding($nome);
			echo '<br />';
			echo mb_detect_encoding($str);
			echo '<br />';
			echo $str;

			exit;
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
			}
	}

}
?>
