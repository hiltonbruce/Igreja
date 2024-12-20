<?PHP
controle("tes");

$atualiza = new DBRecord ('dizimooferta',(int)$_POST['idDizOf'],"id"); //Aqui ser� selecionado pelo id

	//Se cada vari�vel tem um valor
	if ($_POST['valor']>0 && ($atualiza->lancamento()=='0' || $_SESSION["setor"]>"50") &&  $_POST['rolIgreja']>0){
		echo "<p>";
	  foreach ($_POST as $key => $value) {
		if ($key!=="Submit" && $key!=="tabela" && $key!=="escolha" && $key!=="listar" && $key!=="idDizOf") {
			
		echo "Campo: ".$key." <-> value: ".$value;
		//print $atualiza->$key()." ++++ ";
		 if ($key=='data') {
		 	$value = br_data($value, 'Campo data invalida!');
		 }elseif ($key=='valor'){
		 	$value = number_format($value,2,'.',',');
		 }elseif ($key=='rolIgreja'){
		 	$key = 'igreja';
		 }
		$atualiza->$key = ltrim($value); //Aqui � atribuido a esta vari�vel um valor para UpDate
		}
	  }
	 echo '</p>';
	  $atualiza->Update();	  //Atualizar dados
	
	}elseif ($atualiza->lancamento()!='0') {
		echo  "Ap�s o fechamento do caixa a altera��o n�o � permitida!";
	}elseif ($_POST['rolIgreja']=='0') {
		echo  "Ser� exibida para todas as igrejas!";
	}else{
	  echo  "N�o definido valor!";
	}
	

 ?> 