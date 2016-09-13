<?PHP

define ('NOMESYS','NomeDaAplicação');
define ('NOMEIGR','DenominçãoDaIgreja');
define ('CIDADEIG','CidadeDaIgreja');
define ('UFIG','UfDaCidadeDaIgreja');
define ('DBPATH','localhost');
define ('DBUSER','igreja');
define ('DBPASS','suaSenha');
define ('DBNAME','assembleia');

$dns = 'mysql://'.DBUSER.':'.DBPASS.'@'.DBPATH.'/'.DBNAME;
/*
 * Usu�rio e senha de Backup:
 * usu�rio: igrejaBKP
 * senha: abPh!jUEyjs@8EK#xX4
 */
?>
