<?php
	
$hist 	= $_SESSION['valid_user'].": ".date("Y-m-d h:i:s");
$igreja	= ((int)$_POST['igreja']>0) ? $_POST['igreja']:false;
$data 	= (checadata($_POST['data'])) ? br_data($_POST['data'],'Data').' 00:00:00':date("Y-m-d h:i:s");
$menerro = '';

//verifica se data está ok
if (checadata($_POST['data'])) {

if ($igreja && $data) {
	$cong = new DBRecord('igreja',$igreja, 'rol');
	$dadosagenda = sprintf("'','%s','%s','%s','%s','%s','%s','%s'",$_POST['item'],$_POST['quant'],$mesref,$data,$igreja,$cong->matlimpeza(),$hist);
	echo $dadosagenda.' *** <br />';
	$agenda= new insert ($dadosagenda,"limpezpedid");
	
	
		echo $agenda->inserir();
		echo "<script>location.href='./?escolha=controller/limpeza.php&menu=top_tesouraria&igreja=$igreja&data={$_POST['data']}&mesref=$mesref';</script>";

}
}else {
		$data = false;
		echo "<script>alert('Desculpe! Mas, é inválida');</script>";
	}
?>
