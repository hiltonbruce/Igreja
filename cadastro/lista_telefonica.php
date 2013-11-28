<?PHP
require_once ( "../classes/classes.php" );

$db =& DB::Connect( $dsn, array() );
if (PEAR::isError($db)) { die($db->getMessage()); }

$rec = new consulta_id( "membro", 1 );
print $rec->Name()."\n";

?>