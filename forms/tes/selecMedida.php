<?php

$lin1 = '<option value=""></option>';
	if (isset($unid)) {
		switch (strtolower($unid)) {
			case 'unid':
			$lin1 = '<option value="unid">Unidade</option>';
				break;
			case 'm':
			$lin1 = '<option value="m">Metro</option>';
				break;
			case 'l':
			$lin1 = '<option value="l">Litro</option>';
				break;
			case 'ml':
			$lin1 = '<option value="ml">Mililitro</option>';
				break;
			case 'cx':
			$lin1 = '<option value="Cx">Caixa</option>';
				break;
			case 'pc':
			$lin1 = '<option value="Pc">Pacote</option>';
				break;
		}
	}
	$selMat  = '<label><small>Tipo Medida<span class="glyphicon glyphicon-question-sign text-danger"';
	$selMat .= 'aria-hidden="true" data-toggle="tooltip" data-placement="top"';
	$selMat .= 'title="Discrimina&ccedil;&atilde;o da unidade. Ex.: Unid, Cx, Pc, etc"></span></small></label>';
	$selMat .= '<select name="unid" class="form-control input-sm" required >';
	$selMat .= $lin1;
	$selMat .= '<option value="unid">Unidade</option>';
	$selMat .= '<option value="m">Metro</option>';
	$selMat .= '<option value="l">Litro</option>';
	$selMat .= '<option value="ml">Mililitro</option>';
	$selMat .= '<option value="Cx">Caixa</option>';
	$selMat .= '<option value="Pc">Pacote</option>';
	$selMat .= '</select>';
 ?>
