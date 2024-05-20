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
$sqlOrd = 'titulo';
$quantNomes = substr_count(trim($q),' ');//Quantidade de palavras
 
$sql  = 'SELECT * FROM contas AS c WHERE acesso<>"0" AND ' ;
switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql .= " LOCATE(:NOME1,c.titulo) AND LOCATE(:NOME2,c.titulo) AND";
	 $sql .= " LOCATE(:NOME3,c.titulo) AND LOCATE(:NOME4,c.titulo) ORDER BY ".$sqlOrd;

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
   $stmt ->bindParam(":NOME4", $q4);
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql .= " LOCATE(:NOME1,c.titulo) AND LOCATE(:NOME2,c.titulo) AND";
	 $sql .= " LOCATE(:NOME3,c.titulo) ORDER BY ".$sqlOrd;

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql .= "c.titulo LIKE CONCAT('%',:NOME1,'%') AND c.titulo LIKE CONCAT('%',:NOME2,'%') ORDER BY ".$sqlOrd;
	 // $sql .= "LOCATE(:NOME1,c.titulo) ";

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
	break;
	default:
	 $q=trim($q);
	 $sql .= "LOCATE(:NOME,c.titulo)>0 ORDER BY ".$sqlOrd;

   $stmt = $conn->prepare($sql);
   $stmt ->bindParam(":NOME", $q);
	break;
}

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

			// array_push($data2,$value);
			$destaque = "<code>\$1</code>";

			foreach ($value as $chave => $dados) {

				if ($dados=='') {
					$dados = 'N&atilde;o informado' ;
				}

					if ($chave=='titulo') {
						$json .= '"name": "'.$dados.'",';
						$dados = strtoupper(strtr( $dados, '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
						$estado = $dados;
						require ('../help/destaqueNome.php');
                    }

                    if ($chave=='saldo') {
                        $dados = number_format($dados, 2, ',', '.');
                    }

					$json .= '"'.$chave.'": "'. $dados.'"';

          if ($chave=='rol') {
            $rol = $dados;
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
        // var_dump($json);
	echo $json;
	// echo ' "Toal de '.$stmt->rowCount().'"';
?>
