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
define ('PROVMISSOES',0.4);#Percentual da provisão de missões
define ('DESPMISSOES','3.2.1.001.005');#Conta da Despesa da provisão de missões
define ('PROVCONVENCAO',0.1);#Percentual da provisão para convenção estadual
define ('DESPCONVENCAO','3.1.1.001.007');#Conta da Despesa da provisão para convenção estadual
$dns = 'mysql://'.DBUSER.':'.DBPASS.'@'.DBPATH.'/'.DBNAME;
/*
 * Usuário e senha de Backup:
 * usuário: igrejaBKP
 * senha: abPh!jUEyjs@8EK#xX4
 */
?>
