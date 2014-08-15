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
controle ("tes");
	
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	
	$value  = "'','".$_POST['idfunc']."','','1','".$_POST['rolIgreja']."','".$_POST['rol']."','',";
	$value .= "'".$_POST['hieraquia']."','1','".$_POST['valor']."','".$_POST['diapgto']."','";
	$value .= $_POST['fonte']."','".$hist."','NOW()'";
	
	$dados = new insert ($value,'cargoigreja');
	$dados->inserir();
	echo "<h1>".mysql_insert_id()."</h>";//recupera o id do último insert no mysql
	
		echo "<script>location.href='./?escolha=controller/despesa.php&menu=top_tesouraria&age=7'; </script>";
		echo "<a href='./?escolha=controller/despesa.php&menu=top_tesouraria&age=7'>Continuar...<a>";
	
?>