<h1><img src="img/loading2.gif" width="30" height="30"></h1>
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICEN�A
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa BRuce (http://)
 * @license    http://
 * Insere dados no banco do form cadastro.php nas tabelas:
 * Membro e com este registro pegar o n�mero do rol e insere este n�mero
 * nas tabelas eclesiastico, est_civil e profissional
 */
controle("inserir");

$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
switch ($_POST["tabela"]) {

	case "eclesiastico":
		if (!empty ($_POST["batismo_em_aguas"])) {
			echo $_POST["batismo_em_aguas"];
			$batismo_em_aguas		= br_data($_POST["batismo_em_aguas"],"batismo_em_aguas");
			$_SESSION['dtbatismo']	= $_POST["batismo_em_aguas"];
		}
		if (!empty ($_POST["dt_mudanca_denominacao"])) {
			echo $_POST["dt_mudanca_denominacao"];
			$dt_mudanca_denominacao	= br_data($_POST["dt_mudanca_denominacao"],"dt_mudanca_denominacao");
		}
		if (!empty ($_POST["auxiliar"])) {
			echo $_POST["auxiliar"];
			$auxiliar	= br_data($_POST["auxiliar"],"auxiliar");
		}
		if (!empty ($_POST["diaconato"])) {
			echo $_POST["diaconato"];
			$diaconato=br_data($_POST["diaconato"],"diaconato");
		}
		if (!empty ($_POST["presbitero"])) {
			$presbitero=br_data($_POST["presbitero"],"presbitero");
		}
		if (!empty ($_POST["evangelista"])) {
			$evangelista=br_data($_POST["evangelista"],"evangelista");
		}
		if (!empty ($_POST["pastor"])) {
			$pastor=br_data($_POST["pastor"],"pastor");
		}
		if (!empty ($_POST["dt_muda_assembleia"])) {
			$dt_muda_assembleia=br_data($_POST["dt_muda_assembleia"],"dt_muda_assembleia");
		}
		if (!empty ($_POST["data"])) {
			$data=br_data($_POST["data"],"data");
		}else{
			$data = date("Y-m-d");
		}
		if (!empty ($_POST["dat_aclam"])) {
			$dat_aclam=br_data($_POST["dat_aclam"],"dat_aclam");
			$_SESSION['dtaclam'] = $_POST["dat_aclam"];
		}else{
			$dat_aclam = date("Y-m-d");
		}
		if (!empty ($_POST["c_impresso"])) {
			$c_impresso=br_data($_POST["c_impresso"],"c_impresso");
		}
		
		$_SESSION['igreja'] = (int)$_POST["congregacao"];
		$cad = date("Y-m-d h:i:s");

		echo "Rol-------> ".$_SESSION["rol"];
		$value = "'{$_SESSION["rol"]}','{$_SESSION['igreja']}','$batismo_em_aguas','{$_POST["local_batismo"]}','{$_POST["uf"]}',"
				 ."'{$_POST["batismo_espirito_santo"]}','$dt_mudanca_denominacao',"
				 ."'{$_POST["veio_qual_denominacao"]}','$auxiliar','$diaconato','$presbitero','$evangelista','$pastor',"
				 ."'{$_POST["veio_outra_assemb_deus"]}','$dt_muda_assembleia','{$_POST["lugar"]}',"
				 ."'$data','$dat_aclam','$c_impresso','$quem_imprimiu','{$_POST["c_entregue"]}','$quem_recebeu','$quem_enttregou',"
				 ."'$num_recibo','{$_POST["situacao_espiritual"]}','','$hist','$cad','{$_POST["obs"]}'";
		$eclesiastico = new insert ("$value","eclesiastico");
		$eclesiastico->inserir();

		echo "<script>location.href='./?escolha=adm/dados_profis.php&bsc_rol={$_SESSION["rol"]}'</script>";
		echo "<a href='./?escolha=adm/dados_profis.php&bsc_rol={$_SESSION["rol"]}'>Continuar...<a>";

		break;

	case "membro"://cadastro de membro
		$dt_nasc=br_data($_POST["datanasc"],"dt_nasc");
		echo $dt_nasc;

		$value = "'','{$_POST["nome"]}','{$_SESSION["nacao"]}',
			'{$_SESSION["cid_natal"]}','{$_POST["uf_nasc"]}','{$_POST["sexo"]}','{$_POST["endereco"]}',
			'{$_POST["numero"]}','{$_POST["complemento"]}','{$_POST["cep"]}','{$_POST["bairro"]}',
			'{$_POST["cidade"]}','{$_POST["uf_resid"]}','{$_POST["escolaridade"]}','{$_POST["graduacao"]}',
			'{$_POST["email"]}','{$_POST["fone_resid"]}','{$_POST["celular"]}','$dt_nasc','{$_POST["obs"]}',
			'{$_POST["doador"]}','{$_POST["sangue"]}','{$_POST["mae"]}',
			'{$_POST["rol_mae"]}','{$_POST["pai"]}','{$_POST["rol_pai"]}',NOW(),'$hist'";

		$dados_pessoais = new insert ("$value","membro");
		$dados_pessoais->inserir();
		$_SESSION["rol"] = mysql_insert_id();//recupera o id do �ltimo insert no mysql
		
		// Salta para n�o permitir registro 666
		$test_rol = $_SESSION["rol"]+1;		
		if ((substr_count($test_rol, '666'))>0){
			$aut_inc = str_replace("666","667",$test_rol);
			echo "<h1>Incrementado $aut_inc</h1>";
			$inc = mysql_query( "ALTER TABLE  membro auto_increment = $aut_inc");
		}
				
		if (empty($_SESSION["cpf"])) {
			$_SESSION["cpf"]=$_SESSION["rol"];
		}

		echo "<script>location.href='./?escolha=adm/dados_ecles.php&uf_end=PB&bsc_rol={$_SESSION["rol"]}'</script>";
		echo "<a href='./?escolha=adm/dados_ecles.php&uf_end=PB&bsc_rol={$_SESSION["rol"]}'>Continuar...<a>";

		unset($_SESSION["nacao"]);//Limpa estas vari�veis
		unset($_SESSION["cid_natal"]);
		unset($_SESSION["cid_end"]);
		unset($_SESSION["nome_cad"]);
		break;

	case "profissional";
		//insere na tabela profissional
		$value="'{$_SESSION["rol"]}','{$_POST["profissao"]}','{$_POST["obs"]}','{$_POST["cpf"]}','{$_POST["rg"]}','{$_POST["orgao_expedidor"]}','{$_POST["onde_trabalha"]}','$hist',NOW()";
		$profissional = new insert ("$value","profissional");
		$profissional->inserir();
		echo "<script>location.href='./?escolha=adm/dados_famil.php&bsc_rol={$_SESSION["rol"]}'</script>";
		echo "<a href='./?escolha=adm/dados_famil.php&bsc_rol={$_SESSION["rol"]}'>Continuar...<a>";
		unset($_SESSION["cpf"]);
		break;

	case "est_civil";
		//insere na tabela est_civil
		if (!empty ($_POST["data"])) {
			$data=br_data($_POST["data"],"data");
		}else{
			$data ="00000000";
		}
		$value="'{$_SESSION["rol"]}','{$_POST["estado_civil"]}','{$_POST["conjugue"]}','{$_POST["rol_conjugue"]}','{$_POST["certidao_casamento_n"]}','{$_POST["livro"]}','{$_POST["obs"]}','{$_POST["folhas"]}','{$data}','$hist',NOW()";
		$est_civil = new insert ("$value","est_civil");
		$est_civil->inserir();

		echo "<script>location.href='./?escolha=adm/dados_famil.php&bsc_rol={$_SESSION["rol"]}'</script>";
		echo "<a href='./?escolha=adm/dados_famil.php&bsc_rol={$_SESSION["rol"]}'>Continuar...<a>";
		break;

	case "nv_convert";
		//insere na tabela est_civil
		if (!empty ($_POST["dt_aceitou"])) {
			$dt_aceitou=br_data($_POST["dt_aceitou"],"dt_aceitou");
		}else {
			$dt_aceitou=date("Y-m-d");
		}
		if (!empty ($_POST["dt_nasc"])) {
			$dt_nasc=br_data($_POST["dt_nasc"],"dt_nasc");
		}

		$value="'','{$_POST["nome"]}','{$_POST["endereco"]}','{$_POST["numero"]}','{$_POST["bairro"]}','{$_POST["cidade"]}','{$_POST["uf"]}','{$_POST["nacionalidade"]}','{$_POST["fone"]}','{$_POST["celular"]}','$dt_nasc','{$_POST["congregacao"]}','{$_POST["sexo"]}','$dt_aceitou','{$_POST["obs"]}','$hist',NOW()";
		$est_civil = new insert ("$value","{$_POST["tabela"]}");
		$est_civil->inserir();

		echo "<script>location.href='./?escolha=nv_convertido/cad_nv_convert.php&uf=PB'</script>";
		echo "<a href='./?nv_convertido/cad_nv_convert.php&uf=PB'>Continuar...<a>";
		break;

	case "cetad_aluno";
		//Cadastra aluno em curso

		$query = 	"SELECT rol FROM cetad_aluno "
				."WHERE rol = '{$_SESSION["rol"]}' AND situacao = '1' ";

 		$result = mysql_query($query) or die (mysql_error());
		 if (mysql_num_rows($result)>0) {
		 	unset ($_SESSION["rol"]);
			echo "<script>alert('O aluno: {$_SESSION["membro"]}, j� possui matr�cula ativa!');window.history.go(-1);</script>";
			echo "<a href='./?escolha=cetad/matricula.php'>Voltar ...<a>";
			break;
		 }

		if (!empty ($_POST["curso"])) {
		$valor = number_format($_POST["mensal"], 2, '.', ',');
		$value = "'','{$_SESSION["rol"]}','{$_POST["nome"]}','{$_POST["curso"]}','1','$valor','{$_POST["vencimento"]}',NOW(),'$hist'";
		$cad = new insert ("$value","{$_POST["tabela"]}");
		$cad -> inserir();

		echo "<script>location.href='./?escolha=adm/dados_pessoais.php'</script>";
		echo "<a href='./?escolha=adm/dados_pessoais.php'>Continuar...<a>";

		} else {
			echo "<script>alert('Infome o curso!');window.history.go(-1);</script>";
		}
		break;

	case "cetad_pgto";
		//Cadastra pagamento
		if (!empty ($_POST["valor"])) {
		$valor = number_format($_POST["valor"], 2, '.', ',');
		$value = "'','{$_POST["curso"]}','{$_POST["aluno"]}','$valor','$hist',NOW()";
		$cad = new insert ("$value","{$_POST["tabela"]}");
		$cad -> inserir();

		echo "<script>location.href='./?escolha=cetad/pgto.php&menu=top_cetad'</script>";
		echo "<a href='./?escolha=cetad/pgto.php&menu=top_cetad'>Continuar...<a>";

		} else {
			echo "<script>alert('Infome o Valor!');window.history.go(-1);</script>";
		}
		break;

	case "cetad_curso";
		//insere na tabela cetad_aluno
		$dias = $_POST["domingo"].$_POST["segunda"].$_POST["terca"].$_POST["quarta"].$_POST["quinta"].$_POST["serta"].$_POST["sabado"];

		if ((!empty($_POST["mensal"])) AND (!empty($_POST["tipo"])) AND (!empty($_POST["turma"])) AND (!empty($_POST["horas_total"])) AND (!empty($_POST["hora_ini"])) AND (!empty($_POST["hora_fim"])) AND (!empty($dias))) {
		$mensal = number_format($_POST["mensal"], 2, '.', ',');
		$value = "'','{$_POST["tipo"]}','{$_POST["turma"]}','$mensal','{$_POST["horas_total"]}','$dias','{$_POST["hora_ini"]}','{$_POST["hora_fim"]}','$hist','1'";
		$cad = new insert ("$value","{$_POST["tabela"]}");
		$cad -> inserir();

		echo "<script>location.href='./?escolha=cetad/matricula.php&menu=top_cetad'</script>";
		echo "<a href='./?escolha=cetad/matricula.php&menu=top_cetad'>Continuar...<a>";

		} else {
			echo "<script>alert('Todos os Campos s�o de preenchimento OBRIGAT�RIO!');window.history.go(-1);</script>";
		}
		break;

	case "disciplina";
		//insere na tabela disciplina
		$pass = md5($_POST['senha']);

		$query = "SELECT * FROM usuario "
				."WHERE cpf = '{$_SESSION["valid_user"]}'"
				." AND senha='$pass' AND situacao = '1' ";

		 $result = mysql_query($query) or die (mysql_error());
		 if (mysql_num_rows($result)>0)
			{

			if (empty($_POST["data_ini"])) {
				$dt_ini = date("Y-m-d");
			}else{
				$dt_ini = br_data ($_POST["data_ini"],"Data inicial");
				echo $dt_ini."--- <> ---".$_POST["data_ini"];
			}

			$dta = explode("-",$dt_ini);
			$y = $dta[0];
			$m = $dta[1];
			$d = $dta[2];

			echo $d."/".$m."/".$y;

			if (empty($_POST["prazo"])) {
				//Se prazo for deixado em branco ser� atribuido prazo indeterminado (0000-00-00)
				$dt_fim = "0000-00-00";
			}else{
				$dt_fim = date ("Y-m-d",mktime (0,0,0,$m,$d+$_POST["prazo"],$y));
			}

			$value = "'','{$_SESSION["rol"]}','{$_POST["situacao"]}','{$_POST["motivo"]}','$dt_ini','$dt_fim','$hist',NOW()";
			$disciplina = new insert ("$value","disciplina");
			$disciplina -> inserir();
			//Atualiza a tabela eclesiastico com o novo valor
			$rec = new DBRecord ("eclesiastico",$_SESSION["rol"],"rol");
			$rec->situacao_espiritual = (int)$_POST["situacao"]; //Aqui � atribuido a esta vari�vel o valor para UpDate
			$rec->UpDate();
			echo "<script>location.href='./?escolha=adm/dados_disciplina.php&bsc_rol={$_SESSION["rol"]}'</script>";
			echo "<a href='./?escolha=adm/dados_disciplina.php&bsc_rol={$_SESSION["rol"]}'>Continuar...<a>";
			}else{
			echo "<script> alert('Senha incorreta!');</script>";
			}
		break;

	case "organica";
		//insere na tabela

	      /* if (strlen($_POST["subordinado"])>'6') {
			 $codigo = $_POST["subordinado"].$_POST["area_atual"].'01';
		    }else {

	       }
		$value="'','$codigo','{$_POST["alias"]}','{$_POST["descricao"]}','$hist',NOW()";
		$cargos = new insert ("$value","{$_POST["tabela"]}");
		$cargos->inserir();
			echo "<script>location.href='./?escolha=igreja/cad_organica.php&menu=top_igreja'</script>";
			echo "<a href='./?escolha=igreja/cad_organica.php&menu=top_igreja'>Continuar...<a>";*/
		break;

	case "cargo_igreja";
		//insere na tabela
		$value="'','{$_POST["descricao"]}','{$_POST["obs"]}','{$_POST["igreja"]}','{$_SESSION["rol"]}','{$_POST["hierarquia"]}','1','$hist',NOW()";
		$cargos = new insert ("$value","{$_POST["tabela"]}");
		$cargos->inserir();
					echo "<script>location.href='./?escolha=igreja/cad_cargos.php&menu=top_igreja'</script>";
					echo "<a href='./?escolha=igreja/cad_cargos.php&menu=top_igreja'>Continuar...<a>";
		break;

	default:
		echo "Tabela n�o definida!";
		break;

}


/*
$value="'{$_SESSION["rol"]}','','','','','','','','','','','','','','','','','','','','','','','',''";
$eclesiastico = new insert ("$value","eclesiastico");
$eclesiastico->inserir();
*/



echo "<h1> - $rol - </h1>";

?>
<p>&nbsp;</p>