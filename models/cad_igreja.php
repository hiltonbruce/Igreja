<h1><img src="img/loading2.gif" width="30" height="30"></h1>
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICEN�A
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa BRuce (http://)
 * @license    http://
 * Insere dados no banco do form cadastro.php na tabela:igreja
 */
controle("inserir");

$ceia = $_POST["semana"].$_POST["dia"];

$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];

$value = "'','{$_POST["razao"]}','{$_POST["setor"]}','{$_POST["cnpj"]}','{$_POST["site"]}',
	'{$_POST["email"]}','$ceia','{$_POST["oracao"]}','{$_POST["pastor"]}','{$_POST["secretario1"]}',
	'{$_POST["secretario2"]}','1','{$_POST["rua"]}','{$_POST["numero"]}','{$_POST["bairro"]}',
	'{$_POST["cidade"]}','PB','{$_POST["cep"]}',
	'{$_POST["fone"]}','1',NOW(),'$hist'";

$dados = new insert ($value,"igreja");
$dados->inserir();
echo "<h1>".mysql_insert_id()."</h>";//recupera o id do �ltimo insert no mysql


		echo "<script>location.href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf_end=PB'</script>";
		echo "<a href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf_end=PB'>Continuar...<a>";




/*
$value="'{$_SESSION["rol"]}','','','','','','','','','','','','','','','','','','','','','','','',''";
$eclesiastico = new insert ("$value","eclesiastico");
$eclesiastico->inserir();
*/



echo "<h1> - $rol - </h1>";

?>
<p>&nbsp;</p>