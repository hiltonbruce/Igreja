<?php
  if (mysql_num_rows($sql3)>'0') {
?>
<table class='table table-striped table-condensed'>
  <tr>
    <td><strong>Tipo:</strong>
      <h6>Carta de <?PHP echo carta($arr_dad["tipo"]);?></h6>
    </td>
    <td><strong>Data:</strong>
      <?PHP
      if ($diasemissao==1) {
      	echo ' (Criada hoje)';
      }elseif ($diasemissao<3){
        echo ' (Criada ontem!)';
      }elseif ($anov>'2000') {
      	echo ' (Criada a '.$diasemissao. ' dias)';
      }
     echo '<h6>'.$arr_dad["data"].'</h6>';
    ?>
    </td>
  </tr>
  <tr>
    <td><strong>Igreja/Institui&ccedil;&atilde;o de destino:</strong>
      <h6><?PHP echo $arr_dad["igreja"];?></h6>
    </td>
    <td><strong>Destino:</strong>
      <h6><?PHP
    	$rec = new DBRecord ("cidade",$arr_dad["destino"],"id");// Aqui ser� selecionado a informa��o do campo autor com id=2
			echo $rec->nome()." - ".$rec->coduf();?></h6>
    </td>
  <tr>
    <td colspan="3"><strong>Observa&ccedil;&otilde;es</strong>
      <h6><?PHP echo $arr_dad["obs"];?></h6>
    </td>
  </tr>
</table>
	<?PHP
}else {
	echo '<div class="alert alert-alerta alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert">
		<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
		<span class="sr-only">Close</span></button>
		<h3>Sem registro de carta</h3>
		Nenhuma carta encontrada para este membro!
		</div>';
}
?>
