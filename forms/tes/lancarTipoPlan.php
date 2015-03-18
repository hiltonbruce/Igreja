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
	<table class='table'>
		<tbody>
			<tr>
				<td>
					<label><strong>Pagamento realizado pela fonte: </strong></label>
						<select name="disponivel" id="caixa" class="form-control" tabindex="<?PHP echo ++$ind; ?>" >
							<?php
								$bsccredor = new tes_listDisponivel();
								$listaIgreja = $bsccredor->List_Selec($_GET['acesso']);
								echo $listaIgreja;
							?>
					</select>
				</td>
				<td>
					<label>Data</label>
					<input name='data' id='data' class='form-control' value='<?php echo date('d/m/Y');?>'
					  tabindex='<?PHP echo ++$ind; ?>' />
				</td>
			</tr>
		</tbody>
	</table>
	<?PHP
		$titTabela = 'Contas de Despesas';
		require_once 'help/tes/lancTipoPlan.php';
		require_once 'views/tesouraria/lancTipoPlan.php';
	?>
</form>
