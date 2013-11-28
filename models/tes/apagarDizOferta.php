<?PHP
controle("tes");

$atualiza = new DBRecord ('dizimooferta',(int)$_POST['idDizOf'],"id"); //Aqui será selecionado pelo id

	//Se cada variável tem um valor
	if ($_POST['valor']>0 && ($atualiza->lancamento()=='0' || $_SESSION["setor"]>"50") &&  $_POST['rolIgreja']>0){
		echo "<p>";
	  foreach ($_POST as $key => $value) {
		if ($key!=="Submit" && $key!=="tabela" && $key!=="escolha") {
		echo "Campo: ".$key." <-> value: ".$value." ++++";
		//print $atualiza->$key()." ++++ ";
		 if ($key=='data') {
		 	$value = br_data($value, 'Campo data invalida!');
		 }elseif ($key=='valor'){
		 	$value = number_format($value,2,'.',',');
		 }
		$atualiza->$key = ltrim($value); //Aqui é atribuido a esta variável um valor para UpDate
		}
	  }
	 echo '</p>';
	  $atualiza->Update();	  //Atualizar dados
	
	}elseif ($atualiza->lancamento()!='0') {
		echo  "Após o fechamento do caixa a alteração não é permitida!";
	}elseif ($_POST['rolIgreja']<='0') {
		echo  "Informe a igrejas!";
	}elseif ($_POST['valor']<=0) {
		echo  "Não definido valor!";
	}
	else{
		echo  "Erro no preenchimeto!";
	}	

 ?> 