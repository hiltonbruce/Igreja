<?PHP
controle("tes");
$idRec = intval($_GET['id']);
$atualiza = new DBRecord ('tes_recibo',$idRec,"id"); //Aqui ser� selecionado pelo id

echo $atualiza->lancamento().' *** '.$_SESSION["setor"].' *** ';
	//Se cada vari�vel tem um valor
	if (($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50") && $atualiza->lancamento()<'1' ){
		echo '<p>';
		echo 'Cancelado recibo: '.$idRec;
		//print $atualiza->$key()." ++++ ";
		$atualiza->lancamento = 'Cancelado'; //Aqui � atribuido a esta vari�vel um valor para UpDate
	 echo '</p>';
	  $atualiza->Update();	  //Atualizar dados
	}elseif ($atualiza->lancamento()=='Cancelado') {
		echo  'Recibo j� CANCELADO!';
	}elseif ($atualiza->lancamento()!='0') {
		echo  'Ap�s lan�ado recibo n�o ser� permitido o CANCELAMENTO!';
	}else{
	  echo  'Erro... Cancelmento n�o confirmado!';
	}
?>
