<?php
	$ind = 0;
?>
<div class="bs-callout bs-callout-danger" id="callout-alerts-no-default">
    <h4>Lan&ccedil;amento de Despesas!</h4>
    <p>Indique no primeiro campo a conta utilizada para pagar a despesa.
    E mais abaixo: informe o grupo relativo ao gasto, com valor e hist&oacute;rico.
     "Clicando" no sinal de "+" para que seja visualizado
     os campos para preenchimento relativos a despesa!
 	</p>
  </div>
<form method='post'><div class="alert alert-info" role="alert">
	<div class="row">
		<div class="col-xs-3">

	  	</div>
	</div>
	<?PHP
		$titTabela = 'Contas de Despesas';
		require_once 'help/tes/lancTipoPlan.php';
		require_once 'views/tesouraria/lancTipoPlan.php';
	?>
</form>
