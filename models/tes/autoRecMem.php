<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */
 require "../../func_class/funcoes.php";
 require "../../func_class/classes.php";
 function __autoload ($classe) {
 list($dir,$nomeClasse) = explode('_', $classe);
	 if (file_exists("../../models/$dir/$classe.class.php")){
		 require_once ("../../models/$dir/$classe.class.php");
	 }elseif (file_exists("../../models/$classe.class.php")){
		 require_once ("../../models/$classe.class.php");
	 }
 }
$q = mysql_real_escape_string(trim($_GET['q']));
$quantNomes = substr_count(trim($q),' ');
//crit�rios de fon�tica
$exp = new fonetica($q,'nome');
switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql  = 'SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m,tes_recibo AS t,';
	 $sql .= 'eclesiastico AS e WHERE t.recebeu=e.rol AND m.nome LIKE "%'.$q1.'%" AND ';
	 $sql .= 'm.nome LIKE "%'.$q2.'%" AND m.nome LIKE "%'.$q3.'%" AND m.nome LIKE ';
	 $sql .= '"%'.$q4.'%" AND m.rol=t.recebeu AND t.tipo=1 GROUP BY m.rol ORDER BY LOCATE("'.$q1.'",m.nome)';
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql  = 'SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m,tes_recibo AS t,';
	 $sql .= 'eclesiastico AS e WHERE t.recebeu=e.rol AND m.nome LIKE "%'.$q1.'%" AND ';
	 $sql .= 'm.nome LIKE "%'.$q2.'%" AND m.nome LIKE "%'.$q3.'%" ';
	 $sql .= 'AND m.rol=t.recebeu AND t.tipo=1 GROUP BY m.rol ORDER BY LOCATE("'.$q1.'",m.nome)';
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql  = 'SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m,tes_recibo AS t,';
	 $sql .= 'eclesiastico AS e WHERE t.recebeu=e.rol AND m.nome LIKE "%'.$q1.'%" AND ';
	 $sql .= 'nome LIKE "%'.$q2.'%" ';
	 $sql .= 'AND m.rol=t.recebeu AND t.tipo=1 GROUP BY m.rol ORDER BY LOCATE("'.$q1.'",m.nome)';
	break;
	default:
	$sql  = 'SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m,tes_recibo AS t,';
	$sql .= 'eclesiastico AS e WHERE t.recebeu=e.rol AND locate("'.$q.'",m.nome) > 0 ';
	$sql .= 'AND m.rol=t.recebeu AND t.tipo=1 GROUP BY m.rol ORDER BY LOCATE("'.$q.'",m.nome)';
	break;
}

$res = mysql_query($sql);
$linhas = mysql_num_rows($res);
# 1�linha em branco
echo "<li onselect=\" \">... </li>\n";
while( $campo = mysql_fetch_array($res) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = $campo['fone_resid'];
	//$estado = $campo['nome'];
	$estado = strtoupper(strtr( $campo['nome'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco = strtoupper(strtr( $campo ['endereco'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco .=', '.$campo['numero'];
	$cargo = cargo($campo['rol']);
	$rol = $campo['rol'];
	$igreja = new DBRecord ('igreja',$campo ['congregacao'],'rol');
	if ($igreja->razao()=='') {
		$sigla = $cargo['0'].'- <code> Congrega&ccedil;&atilde;o&nbsp;n&atilde;o&nbsp;definida!</code> - '.$campo['celular'];
	} else {
		$sigla = $cargo['0'].' - '.htmlentities($igreja->razao().' - '.$campo['celular'],ENT_QUOTES,'iso-8859-1');
	}
	switch ($campo['situacao_espiritual']) {
		case '2':
			$sigla .= '<mark>&nbsp;Disciplinado </mark>';
			break;
		case '3':
			$sigla .= '<mark>&nbsp;Falecio </mark>';
			break;
		case '4':
			$sigla .= '<mark>&nbsp;Mudou de Igreja </mark>';
			break;
		case '5':
			$sigla .= '<mark>&nbsp;Afastou-se da Igreja </mark>';
			break;
		case '6':
			$sigla .= '&nbsp;<mark>Transferido</mark> ';
			break;
	}
	$estado = addslashes($estado);
	$destaque = "<strong>\$1</strong>";
	switch ($quantNomes) {
		case '3':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i","/(" . $q4 . ")/i");
			$replacements = array($destaque,$destaque,$destaque,$destaque);
			// preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
		break;
		case '2':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i");
			$replacements = array($destaque,$destaque,$destaque);
			// preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
		break;
		case '1':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i");
			$replacements = array($destaque,$destaque);
			// preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
		break;
		default:
			$html = preg_replace("/(" . $q . ")/i", "<strong>\$1</strong>", $estado);
		break;
	}
$img='../../img_membros/'.$campo['rol'].'.jpg';//PHP verifica se existe
if (!file_exists($img)){
	$img='img_membros/ver_foto.jpg';//Localização p/ JavaScript
}else{
	$img='img_membros/'.$campo['rol'].'.jpg';//Localização p/ JavaScript
}
$html ='<img class="thumb" src="'.$img.'" title="Rol: '.$rol.'" style="width:24px;height:32px;"> '.$html;
echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$rol');\">$html ($sigla)</li>\n";
$quantExibir++;
if ($quantExibir>'9') {
		break;
	}
}
	if ($linhas>'1') {
		$linhas .=' ocorr&ecirc;ncias';
	} else {
		$linhas .=' ocorr&ecirc;ncia';
	}
	echo '<p style="text-align: right;">Total de '.$linhas.'<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10... primeiras!</p>';
?>
