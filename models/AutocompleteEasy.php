<?php
/**
 * @author  http://easyautocomplete.com/
 * @since Copyright (c) 2015
 * @final Joseilton Costa Bruce
 * @since 30/05/2019
 */
require_once '../help/impressao.php';
$quantExibir=0;
$q =  $_GET['q'];
$item = 0;
if (empty($_GET['igreja'])) {
	$igrejaRol = 0;
} else {
	$igrejaRol =intval($_GET['igreja']);
}

$quantNomes = substr_count(trim($q),' ');//Quantidade de palavras


$igrejaArr = "SELECT * FROM igreja ORDER BY razao";
$stmtIgr = $conn->prepare($igrejaArr);
$stmtIgr->execute();
$resultsIgrej = $stmtIgr->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultsIgrej as $key => $value) {
	$IgArray [$value['rol']]=array ('razao'=>$value['razao']);
   }

// print_r($IgArray['1']);

switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol AND";
	 $sql .= " LOCATE(:NOME1,m.nome) AND LOCATE(:NOME2,m.nome) AND";
	 $sql .= " LOCATE(:NOME3,m.nome) AND LOCATE(:NOME4,m.nome) ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC";
	}

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
   $stmt ->bindParam(":NOME4", $q4);
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol AND";
	 $sql .= " LOCATE(:NOME1,m.nome) AND LOCATE(:NOME2,m.nome) AND";
	 $sql .= " LOCATE(:NOME3,m.nome) ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC";
	}

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol";
	 $sql .= " AND LOCATE(:NOME1,m.nome) AND LOCATE(:NOME2,m.nome) ORDER BY ";
	 if ($igrejaRol>0) {
		 $sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC";
	 }

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
	break;
	default:
	 $q=trim($q);
	 $sql = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE";
	 $sql .= " m.rol=e.rol AND LOCATE(:NOME,m.nome) > 0 ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC";
	 }

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME", $q);
	break;
}

// 	$exibiCong = strip_tags($nomecong);
// 	$estado = strtoupper(strtr( $campo['nome'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
// 	$endereco = strtoupper(strtr( $campo ['endereco'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
// 	//$endereco .=', '.$campo['numero'];

  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$data2 = array();

	$json = '[';
	// $data = '';

	function endKey($value){
		end($value);
		return key($value);
	}

$totElement = count($results);

	foreach ($results as $key => $value) {

			$json .= '{';

			array_push($data2,$value);
			$destaque = "<code>\$1</code>";

			foreach ($value as $chave => $dados) {

					if ($chave=='nome') {

						$json .= '"name": "'.$dados .'",';
						$estado = $dados;
						require ('../help/destaqueNome.php');

					}

					if ($chave=='situacao_espiritual') {
						 switch ($dados) {
							 case '2':
								 $dados = " -&nbsp;<span class='text-danger'>Disciplinado</span> ";
								 break;
							 case '3':
								 $dados = " -&nbsp;<span class='text-danger'>Falecido</span> ";
								 break;
							 case '4':
								 $dados = " -&nbsp;<span class='text-danger'>Mudou de Igreja</span> ";
								 break;
							 case '5':
								 $dados = " -&nbsp;<span class='text-danger'>Afastou-se da Igreja</span> ";
								 break;
							 case '6':
								 $dados = " -&nbsp;<span class='text-danger'>Transferido</span> ";
								 break;
						 	default:
								 $dados = '';
						 		# code...
						 		break;
						 }
					}

					$json .= '"'.$chave.'": "'. $dados.'"';

          if ($chave=='rol') {
            $rol = $dados;
            $img="img_membros/$rol.jpg";
            $icon = "<img src='$img' class='img-thumbnail thumb' alt=' ' width='35' height='27' align='absmiddle' />";
						$json .= ',"icon": "'.$icon .'"';
          }

					 if ($chave=='congregacao') {
						 $razao = ($IgArray[$dados]['razao']=='') ? 'Falta informar igreja no cadastro' : "<span class='text-warning'>".$IgArray[$dados]['razao']."</span>" ;
							$json .= ',"razao": " - '.$razao.'"';
           }

					if (endKey($value) !== $chave) {
						$json .= ',';
					}

				}

				if (++$item==10) {
					break;
				}

				if ($value !== end($results)) {
					$json .= '},';
				}

		}

		$json .= '}]';

	// header('Content-Type: application/json');

	echo $json;
	// echo ' "Toal de '.$stmt->rowCount().'"';
?>
