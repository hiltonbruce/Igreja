<?php
class updatesist extends DBRecord {

  public function Update()
  {
    global $db;
    $fields = array();
    $values = array();
    foreach( array_keys( $this->{'h'} ) as $key )
    {
      if ( $key != "id" )
      {
        $fields []= $key." = ?";
        $values []= $this->{'h'}[$key];
      }
    }
    $fields = join( ",", $fields );
    $values []= $this->{'id'};
    $sql = "UPDATE {$this->{'table'}} SET $fields WHERE id = ?";
	//echo "$sql";
    $sth = $db->prepare( $sql );
    //echo "$sth";
	$db->execute( $sth, $values );
  }
}
?>
