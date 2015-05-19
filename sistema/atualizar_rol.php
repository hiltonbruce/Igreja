<?PHP

controle ("atualizar");

$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];

$id = (int)$_POST["id"];
$query = 'SELECT * FROM '.$_POST["tabela"];
//echo "ID: ".$_POST["id"]." Campo: ".$_POST["campo"]." Tabela: ".$_POST["tabela"]." Post[Post[campo]]: ".ltrim($_POST[$_POST["campo"]]);
$query .=' WHERE rol="'.$id.'"';

$result = mysql_query($query) or die (mysql_error());

   if (mysql_num_rows($result)>0)
	{
		//$rec = new UPDatesist($_POST["tabela"], $id,$_POST["campo"]);

		$rec = new DBRecord ("{$_POST["tabela"]}",$id,"rol"); //Aqui será selecionado a informação do campo
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
				$atualizador =(int)($_POST["semana"].$_POST["dia"]);
				break;
			case 'pastor':
				//$atualizador =(int)($_POST["semana"].$_POST["dia"]);
				if ($id=='1' && $_POST["pastor"]=='') {
					$atualizador = ltrim($_POST["nome"]);
				} else {
					$atualizador = ltrim($_POST["pastor"]);
				}
				break;
			case 'razao':
				//$atualizador =(int)($_POST["semana"].$_POST["dia"]);
					if ($id=='1') {
						$atualizador = ltrim($_POST["razao"]);
						$atualizador = ' '.$atualizador;
					} else {
						$atualizador = ltrim($_POST["razao"]);
					}
				break;
			default:
				$atualizador = ltrim($_POST[$_POST["campo"]]);
				break;
		}

		$rec->$_POST["campo"] = $atualizador; //Aqui é atribuido a esta variável um valor para UpDate
		$rec->Update(); //É feita a chamada do método q realiza a atualização no Banco

		print "Para:<h3> $atualizador</h3>";
		echo mysql_error();
		echo "<script> alert('Alteração realizada com sucesso!');window.history.go(-1);</script>";
				/*echo "<script> alert('Alteração realizada com sucesso!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf={$_POST["uf_end"]}';</script>";*/

	}


 ?>
