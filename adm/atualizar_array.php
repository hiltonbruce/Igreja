<?PHP
controle("atualizar");

	//Se cada variável tem um valor
	if ($_SESSION["rol"]){
	  $atualiza = new DBRecord ("{$_POST["tabela"]}",$_SESSION['rol'],"rol"); //Aqui será selecionado a informação do campo rol

	  foreach ($_POST as $key => $value) {
		if ($key!=="Submit" && $key!=="tabela" && $key!=="escolha") {
		echo "<p>Campo: ".$key." <-> value: ".$value."</p>";
		print $atualiza->$key()." ++++ ";
		 
		$atualiza->$key = ltrim($value); //Aqui é atribuido a esta variável um valor para UpDate
		$atualiza->Update();	  //Atualizar dados
		}
	  }
	
	}else{
	  echo  "Não há membro selecinado!";
	}
	

 ?> 