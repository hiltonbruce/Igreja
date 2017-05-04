<?PHP
controle("tes");
$idRec = intval($_GET['id']);
$atualiza = new DBRecord ('tes_recibo',$idRec,"id"); //Aqui será selecionado pelo id

echo $atualiza->lancamento().' *** '.$_SESSION["setor"].' *** ';
	//Se cada variável tem um valor
	if (($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50") && $atualiza->lancamento()<'1' ){
		echo '<p>';
		echo 'Cancelado recibo: '.$idRec;
		//print $atualiza->$key()." ++++ ";
		$atualiza->lancamento = 'Cancelado'; //Aqui é atribuido a esta variável um valor para UpDate
	 echo '</p>';
	  $atualiza->Update();	  //Atualizar dados
	}elseif ($atualiza->lancamento()=='Cancelado') {
		echo  'Recibo já CANCELADO!';
	}elseif ($atualiza->lancamento()!='0') {
		echo  'Após lançado recibo não será permitido o CANCELAMENTO!';
	}else{
	  echo  'Erro... Cancelmento não confirmado!';
	}
?>
