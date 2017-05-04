<?php echo $titTable; ?>
  <table class='table table-striped table-hover table-bordered'>
    <colgroup>
      <col id="N&ordm;">
      <col id="Nome">
      <col id="Motivo">
      <col id="Valor(R$)">
      <col id="igreja">
      <col id="albumCol"/>
    </colgroup>
  <thead>
    <tr>
      <th scope="col">N&ordm;</th>
      <th scope="col">Nome</th>
      <th scope="col">Motivo</th>
      <th scope="col">Valor(R$)</th>
      <th scope="col">Igreja</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    <?php
      echo $nivel1;
     ?>
  </tbody>
	<tfoot>
		<?php echo $rodapeRec; ?>
	</tfoot>
</table>
<<?php echo $tagTmnhoFim;?>
