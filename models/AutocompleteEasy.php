<?php
// require_once '../func_class/constantes.php';
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 * @final Joseilton Costa Bruce
 * @since 29/12/2011
 */
require_once '../help/impressao.php';
$quantExibir=0;
// $linha1='';
// $linha2='';
$q =  $_GET['q'];
$item = 0;
// $q = 'jos';
// $igrejaRol = mysql_real_escape_string( $_GET['igreja'] );
if (empty($_GET['igreja'])) {
	$igrejaRol = 0;
} else {
	$igrejaRol =intval($_GET['igreja']);
}
//
$quantNomes = substr_count(trim($q),' ');//Quantidade de palavras

//
// //echo '<h1>Teste: '.$_GET['teste'].'</h1>';
//
// //critÃ©rios de fonÃ©tica
// //$exp = new fonetica($q,'nome');
//

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
	 $sql .= " m.nome LIKE :NOME1 AND m.nome LIKE :NOME2 AND";
	 $sql .= " m.nome LIKE :NOME3 AND m.nome LIKE :NOME4 ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC";
	}

   $stmt = $conn->prepare($sql);
	 $q1 = "%$q1%";
	 $q2 = "%$q2%";
	 $q3 = "%$q3%";
	 $q4 = "%$q4%";
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
   $stmt ->bindParam(":NOME4", $q4);
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol AND";
	 $sql .= " m.nome LIKE :NOME1 AND m.nome LIKE :NOME2 AND";
	 $sql .= " m.nome LIKE :NOME3 ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC";
	}

   $stmt = $conn->prepare($sql);
	 $q1 = "%$q1%";
	 $q2 = "%$q2%";
	 $q3 = "%$q3%";
   $stmt ->bindParam(":NOME1", $q1);
   $stmt ->bindParam(":NOME2", $q2);
   $stmt ->bindParam(":NOME3", $q3);
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol";
	 $sql .= " AND (m.nome LIKE :NOME1 AND m.nome LIKE :NOME2) ORDER BY ";
	 if ($igrejaRol>0) {
		 $sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC";
	 }

   $stmt = $conn->prepare($sql);
	 $q1 = "%$q1%";
	 $q2 = "%$q2%";
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
//
// $res = mysql_query( $sql."locate('$q',m.nome)" );
// $linhas = mysql_num_rows($res);
//
// # 1�linha em branco
// echo "<li onselect=\" \">... </li>\n";
//
// while( $campo = mysql_fetch_array( $res ) )
// {
// 	//echo "Id: {$campo['id']}\t{$campo['nomecong']}\t{$campo['estado']}<br />";
// 	$id = $campo['celular'];
// 	$rolMembro = $campo['rol'];
// 	//$ecles = new DBRecord ('eclesiastico',$campo ['rol'],'rol');
// 	$igreja = new DBRecord ('igreja',$campo ['congregacao'],'rol');
// 	$cargo = cargo($rolMembro);
// 	$nomecong = $cargo['0'].' - '.htmlentities($igreja->razao(),ENT_QUOTES,'iso-8859-1');
// 	switch ($campo['situacao_espiritual']) {
// 		case '2':
// 			$nomecong .= '&nbsp;<mark>Disciplinado</mark> ';
// 			break;
// 		case '3':
// 			$nomecong .= '&nbsp;<mark>Falecido</mark> ';
// 			break;
// 		case '4':
// 			$nomecong .= '&nbsp;<mark>Mudou de Igreja</mark> ';
// 			break;
// 		case '5':
// 			$nomecong .= '&nbsp;<mark>Afastou-se da Igreja</mark> ';
// 			break;
// 		case '6':
// 			$nomecong .= '&nbsp;<mark>Transferido</mark> ';
// 			break;
// 	}
// 	$exibiCong = strip_tags($nomecong);
// 	$estado = strtoupper(strtr( $campo['nome'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
// 	$endereco = strtoupper(strtr( $campo ['endereco'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
// 	//$endereco .=', '.$campo['numero'];
// 	//$estado = addslashes($estado);
// 	$destaque = "<span style=\"font-weight:bold\">\$1</span>";
// 	switch ($quantNomes) {
// 		case '3':
// 			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i","/(" . $q4 . ")/i");
// 			$replacements = array($destaque,$destaque,$destaque,$destaque);
// 			preg_replace($patterns, $replacements, $string);
// 			$html = preg_replace($patterns, $replacements, $estado);
//
// 		break;
// 		case '2':
// 			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i");
// 			$replacements = array($destaque,$destaque,$destaque);
// 			 preg_replace($patterns, $replacements, $string);
// 			$html = preg_replace($patterns, $replacements, $estado);
// 		break;
// 		case '1':
// 			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i");
// 			$replacements = array($destaque,$destaque);
// 			preg_replace($patterns, $replacements, $string);
// 			$html = preg_replace($patterns, $replacements, $estado);
// 		break;
//
// 		default:
// 			$html = preg_replace("/(" . $q . ")/i", $destaque, $estado);
// 		break;
// 	}
//
// 	$img='../img_membros/'.$campo['rol'].'.jpg';//PHP verifica se existe
// 	$IMG='../img_membros/'.$campo['rol'].'.JPG';//PHP verifica se existe
// 	if (file_exists($img)){
// 		$img='img_membros/'.$campo['rol'].'.jpg';//Localização p/ JavaScript
// 	}elseif (file_exists($IMG)){
// 		$img='img_membros/'.$campo['rol'].'.JPG';//Localização p/ JavaScript
// 	}else{
// 		$img='img_membros/ver_foto.jpg';//Localização p/ JavaScript
// 	}
//
// 	$html ='<img src="'.$img.'" title="Rol: '.$campo['rol'].'" style="width:24px;height:32px;"> '.$html;
// 	echo "<li onselect=\"this.setText('$estado').setValue('$id','$nomecong','$rolMembro','$exibiCong');\">$html ($nomecong)</li>\n";
//
// 	$quantExibir++;
//
// 	if ($quantExibir>'9') {
// 		break;
// 	}
// }
//
// if ($linhas>10) {
// 	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
// 	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
// }



  // $stmt = $conn->prepare("SELECT * FROM membro WHERE nome LIKE :NOME ORDER BY rol LIMIT 15");

  // $nome = "%$q%";
  //
  // $stmt ->bindParam(":NOME", $nome);

  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


	// print_r($resultsIgrej);

	// echo "<br/>print_r================================================<br/>";
	//
	// print_r($results);

	$data2 = array();

		// while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
		//   array_push($data2, $row);
		// }
	//
	// var_dump($results);

  // echo "<br/>foreach================================================<br/>";


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

				foreach ($value as $chave => $dados) {

					$json .= '"'.$chave.'": "'. $dados.'"';

          if ($chave=='rol') {
            $rol = $dados;
            $img="img_membros/$rol.jpg";
            $icon = "<img src='$img' class='img-thumbnail thumb' alt=' ' width='35' height='27' align='absmiddle' />";
						$json .= ',"icon": "'.$icon .'"';
          }

					 if ($chave=='congregacao') {
						 $razao = ($IgArray[$dados]['razao']=='') ? 'Falta informar igreja no cadastro' : $IgArray[$dados]['razao'] ;
							$json .= ',"razao": "'.$razao.'"';
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
