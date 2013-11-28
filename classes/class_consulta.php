<?php
require_once( "DB.php" );
$dsn = 'mysql://usuarioBanco:senha@localhost/assembleia';
$db =& DB::Connect( $dsn, array() );
if (PEAR::isError($db)) { die($db->getMessage()); }

class DBRecord
{
  var $h;

  public function DBRecord( $table, $id )
  {
      global $db;
      $res = $db->query( "SELECT * from $table WHERE id=?", array( $id ) );
      $res->fetchInto( $row, DB_FETCHMODE_ASSOC );
    $this->{'h'} = $row;
  }
  public function __call( $method, $args )
  {
    return $this->{'h'}[strtolower($method)];
  }
  public function __get( $id )
  {
    return $this->{'h'}[strtolower($id)];
  }
}
?>
