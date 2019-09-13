<h1><img src="img/loading2.gif" width="30" height="30"></h1>
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICENÇA
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa Bruce (http://)
 * @license    http://
 * Insere dados no banco do form cad_usuario.php na tabela:usuario
 */
controle ("admin_user");
if ($_SESSION["setor"]==$_POST["setor"] || $_SESSION["setor"]=='99') {
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	$value  = '"","'.$_POST["nome"].'","'.$_POST["cpf"].'","'.$_POST["nivel"].'",';
	$value .='"'.$_POST["setor"].'","'.$_POST["perfil"].'","'.$_POST["cargo"].'","'.md5($_POST["senha"]).'",';
	$value .='"1","'.$hist.'",NOW()';
	$dados = new insert ($value,"usuario");
	$dados->inserir();
	echo "<h1>".mysql_insert_id()."</h>";//recupera o id do último insert no mysql
	echo "<script>location.href='./?escolha=tab_auxiliar/cad_usuario.php'; </script>";
	echo "<a href='./?escolha=tab_auxiliar/cad_usuario.php'>Continuar...<a>";
	/*
	$value="'{$_SESSION["rol"]}','','','','','','','','','','','','','','','','','','','','','','','',''";
	$eclesiastico = new insert ("$value","eclesiastico");
	$eclesiastico->inserir();
	*/
}else {
	echo "<script>alert('Desculpe! Mas, lembre-se você deve ter privilégio para adminstração do Sistema para conclusão do cadastro de acesso ao sistema!{$_SESSION["setor"]} - {$_POST["setor"]}');</script>";
}
?>
<p>&nbsp;</p>
