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
// print_r($_SESSION);
controle("inserir");
$virgula = '';
for ($i=1; $i<8; $i++) {
    $culto = 'culto'.$i;
    if (!empty($_POST[$culto]) && $_POST[$culto]>0 && $_POST[$culto]<8) {
       $diasDeCulto .= $virgula.$_POST[$culto];
       $virgula = '-';
    }
}
$primSecretario = (empty($_POST["secretario1"])) ? 'null' : intval($_POST["secretario1"]) ;
$segSecretario = (empty($_POST["secretario2"])) ? 'null' : intval($_POST["secretario2"]) ;

$ceia = $_POST["semana"].$_POST["dia"];
$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
$registro = date('Y-m-d H:i:s');
$razao = $_POST["razao"];

$value  = "null,'$razao','{$_POST["setor"]}','{$_POST["cnpj"]}','{$_POST["site"]}'";
$value .= ",'{$_POST["email"]}','$ceia','{$_POST["oracao"]}','$diasDeCulto','{$_POST["pastor"]}'";
$value .= ",{$primSecretario},{$segSecretario},'1','{$_POST["rua"]}'";
$value .= ",'{$_POST["numero"]}','{$_POST["bairro"]}','{$_POST["cidade"]}','PB','{$_POST["cep"]}'";
$value .= ",'{$_POST["fone"]}','1','$registro','$hist'";
echo "<h1> $value </h1>";
$dados = new insert ($value,"igreja");
$dados->inserir();
echo "<h1>".mysql_insert_id()."</h>";//recupera o id do �ltimo insert no mysql
echo "<script>location.href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf_end=PB'</script>";
echo "<a href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf_end=PB'>Continuar...<a>";
/*
$eclesiastico = new insert ("$value","eclesiastico");
$eclesiastico->inserir();
*/
echo "<h1> - $rol - </h1>";
?>
<p>&nbsp;</p>
