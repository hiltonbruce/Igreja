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
$sexo = (empty($_GET['sexo'])) ? '' : $_GET['sexo'] ;

switch ($sexo) {
	case 'M':
		$sqlSexo = ' AND m.sexo = "M" ';
		break;
	case 'F':
		$sqlSexo = ' AND m.sexo = "F" ';
		break;	
	default:
		$sqlSexo = '';
		break;
}

$quantNomes = substr_count(trim($q),' ');//Quantidade de palavras

$igrejaArr = "SELECT * FROM igreja ORDER BY razao";
$stmtIgr = $conn->prepare($igrejaArr);
$stmtIgr->execute();

$IgArray = $stmtIgr->fetchAll(PDO::FETCH_ASSOC);

// var_dump($IgArray['0']['razao']);

$sqlOrd = $sqlSexo." ORDER BY m.nome ASC";

$sql  = "SELECT e.congregacao,e.situacao_espiritual,m.nome,m.celular,m.fone_resid,m.rol,m.sexo FROM membro AS m,";
switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol AND";
	 $sql .= " LOCATE(:NOME1,m.nome) AND LOCATE(:NOME2,m.nome) AND";
	 $sql .= " LOCATE(:NOME3,m.nome) AND LOCATE(:NOME4,m.nome)".$sqlOrd;

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
   $stmt ->bindParam(":NOME4", $q4);
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol AND";
	 $sql .= " LOCATE(:NOME1,m.nome) AND LOCATE(:NOME2,m.nome) AND";
	 $sql .= " LOCATE(:NOME3,m.nome)".$sqlOrd;

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol";
	 $sql .= " AND  m.nome LIKE CONCAT('%',:NOME1,'%') AND m.nome LIKE CONCAT('%',:NOME2,'%')".$sqlOrd;
	 // $sql .= "LOCATE(:NOME1,m.nome) ";

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
	break;
	default:
	 $q=trim($q);
	 $sql .= " eclesiastico AS e WHERE";
	 $sql .= " m.rol=e.rol AND LOCATE(:NOME,m.nome)>0".$sqlOrd;

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME", $q);
	break;
}

// 	$exibiCong = strip_tags($nomecong);
// 	$estado = strtoupper(strtr( $campo['nome'], 'ÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
// 	$endereco = strtoupper(strtr( $campo ['endereco'], 'ÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩÔøΩ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
// 	//$endereco .=', '.$campo['numero'];

  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($results);
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

			// array_push($data2,$value);
			$destaque = "<code>\$1</code>";

			if ($value['sexo']=='M') {
				$cargo = cargo ($value['rol'])['0'];
			}elseif($value['sexo']=='F'){
				$cargo = cargo ($value['rol'])['2'];
			}else{
				$cargo = '';
			}

			foreach ($value as $chave => $dados) {

				if ($dados=='') {
					$dados = 'N&atilde;o informado' ;
				}

					if ($chave=='nome') {
						$json .= '"name": "'.$dados.'",';
						$dados = strtoupper(strtr( $dados, '·‡„‚ÈÍÌÛıÙ˙¸Á¡¿√¬… Õ”’‘⁄‹«','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
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
						 		break;
						 }
					}

					$json .= '"'.$chave.'": "'. $dados.'"';

          if ($chave=='rol') {
			$rol = $dados;
            $img="img_membros/$rol.jpg";
            $icon = "<img src='$img' class='img-thumbnail thumb' alt=' ' width='25' height='35' align='absmiddle' />";
						$json .= ',"icon": "'.$icon .'"';
          }

					 if ($chave=='congregacao') {
						 $cong = $dados - 1;
						 $razao = ($IgArray[$cong]['razao']=='') ? 'Falta informar igreja no cadastro' : "<span class='text-warning'>".$cargo.' &bull; '.$IgArray[$cong]['razao']."</span>" ;
						 $json .= ',"razao": " - '.$razao.'"';
           			}

					if (endKey($value) !== $chave) {
						$json .= ',';
					}
				}

				if (++$item==20) {
					break;
				}

				if ($value !== end($results)) {
					$json .= '},';
				}

		}

		$json .= '}]';

	// header('Content-Type: application/json');
	// var_dump($IgArray);
	// echo '<br/>';
	echo $json;
	// echo ' "Toal de '.$stmt->rowCount().'"';
