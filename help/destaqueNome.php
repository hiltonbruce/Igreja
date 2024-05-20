
<?php
// Realiza o destaque para cada parte do nome na pesquisa realizada
switch ($quantNomes) {
  		case '3':
        // $estado = addslashes($dados);
  			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i","/(" . $q4 . ")/i");
  			$replacements = array($destaque,$destaque,$destaque,$destaque);
  			// preg_replace($patterns, $replacements, $string);
  			$dados = preg_replace($patterns, $replacements, $estado);
  		break;
  		case '2':
        // $estado = addslashes($dados);
  			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i");
  			$replacements = array($destaque,$destaque,$destaque);
  			//  preg_replace($patterns, $replacements, $string);
  			$dados = preg_replace($patterns, $replacements, $estado);
  		break;
  		case '1':
        // $estado = addslashes($dados);
  			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i");
  			$replacements = array($destaque,$destaque);
  			// preg_replace($patterns, $replacements, $string);
  			$dados = preg_replace($patterns, $replacements, $estado);
  		break;
  		default:
      // $estado = addslashes($dados);
      $patterns = array("/(" . $q . ")/i");
      $replacements = array($destaque);
      $dados = preg_replace($patterns, $destaque, $estado);
  		break;
  	}
 ?>
