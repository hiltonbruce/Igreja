<?php
require_once( "DBrecord.php" );

$rec = new DBRecord( "author", 2 );
print $rec->Name()."\n";
?>
