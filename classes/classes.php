
<?PHP
// arquivos de classes

require_once( "DB.php" );
require_once('func_class/constantes.php');

class consulta_id
{
  var $h;

  public function DBConsulta( $table, $id )
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
