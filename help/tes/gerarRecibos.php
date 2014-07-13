<?PHP
	if ($_SESSION["setor"]<50 && $_SESSION["setor"]!=2){
		echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
		$_SESSION = array();
		session_destroy();
		header("Location: ./");
		exit();
	}
	
		$reimprimir = new DBRecord("tes_recibo", (int)$_POST["reimprimir"], "id");
		$cad_igreja = $reimprimir->igreja();
		$valor = $reimprimir->valor();
		$rec_tipo = $reimprimir->tipo();
		$fonte_recurso = $reimprimir->fonte();
		list($ano, $mes, $dia) = explode("-", $reimprimir->data());
		$data = $dia.'/'.$mes.'/'.$ano;
		$rolmembro = $reimprimir->recebeu();
		$numero = $rolmembro;
		list($nome, $cpf, $rg) = explode("," , $rolmembro);
		$cpf = trim( $cpf, 'CPF: ');
		$rg = trim( $rg, 'RG: ' );
		$referente = $reimprimir->motivo();
	
	
		$fonte = new DBRecord ("fontes",$fonte_recurso,"id");
	
	//Formata o valor e defini para exibição por texto por extenso
		$valor_us =strtr("$valor", ',','.' );
		$vlr = number_format("$valor_us",2,",",".");
		$dim = extenso($valor_us);
		$dim = ereg_replace(" E "," e ",ucwords($dim));
	
	
	$link = '#';
	
	if (empty($valor)){
		echo "<script> alert('Você não definiu o valor do recibo!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($referente==""){
		echo "<script> alert('É necessário informar a que se refere este recibo!');location.href='".$link."';</script>";
		$erro=1;
	}elseif ($rec_tipo==1 && $rolmembro==""){
		echo "<script> alert('Para membros da Igreja é obrigatório informar o número do rol dele em nosso cadastro!');location.href='".$link."';</script>";
		$erro=1;
	}elseif (($rec_tipo=='3' && $rolmembro=='') && ($cpf=='' xor $rg=='')) {
		echo "<script> alert('Para NÃO membros da Igreja é obrigatório informar o nome completo, e pelo menos o RG ou CPF!');location.href='".$link."';</script>";
		$erro=1;
	}

	
		$hist = $_SESSION['valid_user'].": ".date("d/m/Y h:i:s");
	
		//Verifica o tipo de recibo de dá o texto apropriado
		
		switch ($rec_tipo){
		case 1:
			$membro = new DBRecord ("membro",$rolmembro,"rol");
			$ecles = new DBRecord ("eclesiastico",$rolmembro,"rol");
			$prof = new DBRecord ("profissional",$rolmembro,"rol");
			$texto ="Eu, ".strtoupper( toUpper($membro->nome())).", ";
	      	$texto .= "CPF: ".$prof->cpf();
	      	//echo("<h1>{$prof->rg()}ttt</h1>");
	      	
				if ($prof->rg()==(int)$prof->rg()){
					$texto .= ", RG: ".$prof->rg();
					if ($prof->orgao_expedidor()!=""){
						$texto .= " - ".$prof->orgao_expedidor();
					}
				}else{
					$texto .= ", RG: ".$prof->rg();
					if ($prof->orgao_expedidor()!=""){
						$texto .= " - ".$prof->orgao_expedidor();
					}
				}
			$texto .=', rol N&ordm: '.$rolmembro;
			$texto .= ', recebi da Igreja Evang&eacute;lica Assembleia de Deus - '. $igreja->cidade().' - '.$igreja->uf();
			$responsavel = $membro->nome()."<br />CPF: ".$prof->cpf()." - RG: ".$prof->rg();
			$recebeu = $rolmembro;//Define o beneficiário do recibo
			break;
		case 2:
			if ($numero==""){
				echo "<script> alert('Fornecedor não definido!');location.href='".$link."';</script>";
				$erro=1;
			}
			
			$nome = new DBRecord ("credores",$numero,"id");
			$cidade = new DBRecord ("cidade",$nome->cidade(),"id");
			
			if (strlen($nome->cnpj_cpf())==18){
			$tipo = "CNPJ";
			}elseif (strlen($nome->cnpj_cpf())==14){
			$tipo = "CPF";}
			
			$texto =  "Pago a ".strtoupper( toUpper($nome->razao())).", ";
	      	$texto .= "$tipo: ".$nome->cnpj_cpf().", situada &agrave;: ".$nome->end().", N&ordm; ".$nome->numero();
	      	$texto .= ", ".$nome->bairro()." - ".$cidade->nome()." - ".$nome->uf();
			$responsavel = $nome->responsavel()."<br />CPF: ".$nome->cpf();
			$recebeu = $numero;//Define o beneficiário do recibo 
			break;
		case 3:
			$texto = "Eu, ".strtoupper( toUpper($nome)).", ";
	      	$texto .= "CPF: ".$cpf.", RG: ".$rg.", ";
			$texto .= "recebi da Igreja Evang&eacute;lica Assembleia de Deus - ". $igreja->cidade()." - ".$igreja->uf();
			$responsavel = $nome."<br />CPF: ".$cpf." - RG: ".$rg;
			$recebeu = strtoupper( toUpper($nome)).", CPF: ".$cpf.", RG: ".$rg;//Define o beneficiário do recibo 
			break;
		default:
			echo "<script> alert('Recibo indefinido!');location.href='../?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec={$_POST["rec"]}';</script>";
			$erro =1;
	}
	
	//Cadastra o recibo na tabela
	if (check_transid($_POST["transid"]) || $_POST["transid"]=="") {
		echo "<script> alert('Este recibo já foi registrado!');</script>"; 
	}elseif ($erro != 1){
		
		add_transid($_POST["transid"]);
		$dt = br_data($data,"Data do recibo invalida: $data");
		$value  = "'','$cad_igreja','$rec_tipo','$recebeu','$valor_us','','$fonte_recurso',";
		$value .= "'$lancamento','$referente','$dt','$hist'";
		
		$dados = new insert ($value,"tes_recibo");
		$dados->inserir();
		
	}
	
	$rec_num = new ultimoid('tes_recibo');//recupera o id do último insert no mysql (número do recibo)	
	$numrecibo = $rec_num->ultimo();