<?php
$exibRolConj = ($arr_dad["rol_conjugue"]!='') ? ', Rol n&ordm;:'.$arr_dad["rol_conjugue"] : '' ;
?>
<table class='table table-striped table-condensed'>
    <tr>
    <td>
      <strong>Estado Civil:</strong>
      <h6><?PHP echo $arr_dad["estado_civil"];?></h6>
    </td>
      <td colspan="2">
        <strong>Conjugue:</strong><h6><?PHP echo $arr_dad["conjugue"].$exibRolConj;?></h6>
      </td>
      <td><strong>Certid&atilde;o N&ordm;</strong>
        <h6><?PHP echo $arr_dad["certidao_casamento_n"];?></h6>
      </td>
    </tr>
    <tr>
      <td colspan="2"><strong>Folhas:</strong>
        <h6><?PHP echo $arr_dad['folhas'];?></h6>
      </td>
      <td><strong>Livro:</strong>
        <h6><?PHP echo $arr_dad['livro'];?></h6>
      </td>
      <td><strong>Data casamento:</strong>
        <h6><?PHP echo $arr_dad["data"];?></h6>
      </td>
    </tr>
    <tr>
    <td colspan="4"><strong>Observa&ccedil;&otilde;es:</strong>
      <h6><?PHP echo $arr_dad["obs"];?></h6>
    </td>
  </tr>
  </table>
<div class="alert alert-info" role="alert">
<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
Cadastro realizado por: <?php echo $arr_dad['hist'].' em: '.$arr_dad['dt_cadastro']; ?>
</div>
