<?PHP
define ('NOMESYS','NomeDaAplicação');
define ('NOMEIGR','DenominaçãoDaIgreja');
define ('CIDADEIG','CidadeDaIgreja');
define ('UFIG','UfDaCidadeDaIgreja');
define ('DBPATH','localhost');
define ('DBUSER','igreja');
define ('DBPASS','suaSenha');
define ('DBNAME','assembleia');
define ('SECTOR_QUANT','5');#Quantidade de setores da Igreja na cidade
define ('MSGCARTAO','&quot;Este cart&atilde;o s&oacute; ter&aacute; validade com apresenta&ccedil;&atilde;o da carta&quot');#Mensagem do cartão de membro
$dns = 'mysql://'.DBUSER.':'.DBPASS.'@'.DBPATH.'/'.DBNAME;
/*
 * Usuário e senha de Backup:
 * usuário: igrejaBKP
 * senha: abPh!jUEyjs@8EK#xX4
 */
?>
