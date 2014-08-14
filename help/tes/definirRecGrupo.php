<?php

	$scrip = 'models/tes/insertRecibos.php';
	
	switch ($_POST['grupo']) {
		case '2':
			//tesoureiros
			$tesoureiro = $scrip;
		break;
		case '3':
			$auxilio = $scrip;
		break;
		case '4':
			//Demais Zeladores
			$zeladores = $scrip;
		break;
		case '5':
			//Demais Pagamentos
			$demaisPgto= $scrip;
		break;
		
		default:
			//grupo = 1 -> Ministerio
			$ministerio = $scrip;
		break;
	}
?>