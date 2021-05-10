<?PHP

controle ("atualizar");

$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];

$id = intval($_POST["id"]);
$query = 'SELECT * FROM '.$_POST["tabela"];
//echo "ID: ".$_POST["id"]." Campo: ".$_POST["campo"]." Tabela: ".$_POST["tabela"]." Post[Post[campo]]: ".ltrim($_POST[$_POST["campo"]]);
$query .=' WHERE rol="'.$id.'"';

$result = mysql_query($query) or die (mysql_error());

   if (mysql_num_rows($result)>0)
	{
		//$rec = new UPDatesist($_POST["tabela"], $id,$_POST["campo"]);

		$rec = new DBRecord ("{$_POST["tabela"]}",$id,"rol"); //Aqui ser? selecionado a informa??o do campo
		print "<br \>Foi atualizado de:<h3>{$rec->$_POST["campo"]()}</h3>\n";

		switch ($_POST["campo"]) {
			case 'cultos': //Imprime o valor na tela
				$virgula = '';
				if ($_POST["campo"]=='cultos') {
					for ($i=1; $i<8; $i++) {
					    $culto = 'culto'.$i;
					    if (!empty($_POST[$culto]) && $_POST[$culto]>0 && $_POST[$culto]<8) {
					       $atualizador .= $virgula.$_POST[$culto];
					       $virgula = '-';
					    }
					}
				}
				break;
			case 'ceia':
				$atualizador =intval($_POST["semana"].$_POST["dia"]);
				break;
			case 'pastor':
				$hist = $_SESSION['valid_user']."@".$_SESSION['nome'].'@'.date('d/m/Y H:i:s');
				//$atualizador =intval($_POST["semana"].$_POST["dia"]);
				if ($id=='1' && $_POST["pastor"]=='') {
					$atualizador = ltrim($_POST["nome"]);
				} else {
					$atualizador = ltrim($_POST["pastor"]);
				}
				#Atualiza os dados na tabela de hist?rico de fun??es
				$atualHist  = 'UPDATE cargohist SET datafim="'.date('Y-m-d').'", ';
				$atualHist .= 'cadfim= "'.$hist.'" ';
				$atualHist .= 'WHERE descricao = "1" AND igreja="'.$id.'" ';
				$atualHist .= 'AND datafim="0000-00-00" LIMIT 1';
				$result = mysql_query($atualHist);
				if (!$result) {
				    echo 'Falha na autaliza??o: ' . mysql_error();
				    exit;
				}
				#Cadastra os dados na tabela de hist?rico de fun??es
				$dt = br_data ($_POST["data"],'Data de in?cio na fun??o!');
				if ($_POST["campo"]=='pastor' && $_POST["tabela"]=='igreja' ) {
					$value  = '"","1","'.$_POST["nome"].'","'.$id.'","'.$_POST["pastor"].'"';
					$value .= ',"1","'.$dt.'","","'.$hist.'",""';
					$dados = new insert ($value,'cargohist');
					$dados->inserir();
				}
				break;
			case 'razao':
				//$atualizador =intval($_POST["semana"].$_POST["dia"]);
					if ($id=='1') {
						$atualizador = ' '.$_POST["razao"];
					} else {
						$atualizador = ltrim($_POST["razao"]);
					}
				break;
			default:
				$atualizador = ltrim($_POST[$_POST["campo"]]);
				break;
		}
		if ($_POST["campo"]=='secretario1' || $_POST["campo"]=='secretario2') {
			$atualizador = trim($_POST["pastor"]);
		}
		$rec->$_POST["campo"] = $atualizador; //Aqui ? atribuido a esta vari?vel um valor para UpDate
		$rec->Update(); //? feita a chamada do m?todo q realiza a atualiza??o no Banco

		print "Para:<h3> $atualizador</h3>";
		echo mysql_error();
		echo "<script> alert('Alteração realizada com sucesso!');window.history.go(-1);</script>";
				/*echo "<script> alert('Alteração realizada com sucesso!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf={$_POST["uf_end"]}';</script>";*/

	}


 ?>
