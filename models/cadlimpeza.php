<?php

$hist 	= $_SESSION['valid_user'].": ".date("Y-m-d h:i:s");
$igreja	= ((int)$_POST['igreja']>0) ? $_POST['igreja']:false;
$data 	= (checadata($_POST['data'])) ? br_data($_POST['data'],'Data').' 00:00:00':date("Y-m-d h:i:s");
$item 	= (int)$_POST['item'];
$quant	= (int)$_POST['quant'];
$menerro = '';

//verifica se data está ok
if (checadata($_POST['data'])) {

	if ($igreja && $data) {

		/*
		 * Verifica se ja casdastrou
	 */
		global $db;
		$prodCadastrado = $db->query ("SELECT * FROM limpezpedid WHERE item=? AND igreja=? AND mesref=?",
				array($item,$igreja,$mesref));
		//echo '<h1>'.$row[0].'</h1>';
		//return $row[0];
		$prodCadastrado->fetchInto($row, DB_FETCHMODE_ASSOC);
		echo '<h1> ** '.$row['id'].' **</h1>';
		if ($row['id']>0 && $quant>0) {
			//Atualiza se o item já estiver cadastrado
			$upPedLimpeza = new DBRecord('limpezpedid', $row['id'], 'id');
			$upPedLimpeza->quant = $quant;
			$upPedLimpeza->Update();
			echo "<script>alert('Item atualizado!');</script>";
		}elseif ($row['id']>0 && $quant<=0){
			//deletar item
			$prodCadastrado = $db->query('DELETE FROM limpezpedid WHERE id=?',array($row['id']));
			echo '<script>alert("** O item foi apagado! **");</script>';
		}else {
			$cong = new DBRecord('igreja',$igreja, 'rol');
			$dadosagenda = sprintf("'','%s','%s','%s','%s','%s','%s','%s'",$item,$quant,$mesref,$data,$igreja,$cong->matlimpeza(),$hist);
			echo $dadosagenda.' *** <br />';
			$pedLimpeza= new insert ($dadosagenda,"limpezpedid");
			echo $pedLimpeza->inserir();

		}


		echo "<script>location.href='./?escolha=controller/limpeza.php&menu=top_tesouraria&igreja=$igreja&data={$_POST['data']}&mesref=$mesref';</script>";

	}
}else {
	$data = false;
	echo "<script>alert('Desculpe! Mas, é inválida');</script>";
}
?>
