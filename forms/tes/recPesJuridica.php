<?php
	echo '<tr><td colspan="2"><label>Credores Cadastrados</label>';
	$for_num = new List_sele ( "credores", "cnpj_cpf", "numero" );
	echo $for_num->List_Selec ( $ind ++, $_GET ['recebeu'], ' class="form-control" ' );
	echo '</td><td>';
	echo '<label>ou Credores - por Nome</label>';
	$for_num = new List_sele ( "credores", "alias", "razao" );
	echo $for_num->List_Selec ( $ind ++, $_GET ['recebeu'], ' class="form-control" ' );
	echo '</td></tr>';
	$rec = 2;
?>
			