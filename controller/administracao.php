<?php
switch ($_GET['cad']) {
	case 1:
		require_once 'forms/manutencao.php';
		require_once 'forms/igreja/cargos.php';
	break;
	
	default:
		;
	break;
}