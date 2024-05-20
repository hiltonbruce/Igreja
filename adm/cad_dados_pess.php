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
			$batismo_em_aguas	= br_data($_POST["batismo_em_aguas"],"batismo_em_aguas");
			$_SESSION['dtbatismo'] = $_POST["batismo_em_aguas"];
		}else{
			echo "batismo_em_aguas null - ";
			$batismo_em_aguas	= '0000';
		}
		if (!empty ($_POST["dt_mudanca_denominacao"])) {
			echo $_POST["dt_mudanca_denominacao"];
			$dt_mudanca_denominacao	= br_data($_POST["dt_mudanca_denominacao"],"dt_mudanca_denominacao");
		}else{
			echo "dt_mudanca_denominacao null - ";
			$dt_mudanca_denominacao	= '0000-00-00';
		}
		if (!empty ($_POST["auxiliar"])) {
			echo $_POST["auxiliar"];
			$auxiliar	= br_data($_POST["auxiliar"],"auxiliar");
		}else{
			echo "auxiliar null - ";
			$auxiliar	= '0000-00-00';
		}
		if (!empty ($_POST["diaconato"])) {
			echo $_POST["diaconato"];
			$diaconato=br_data($_POST["diaconato"],"diaconato");
		}else{
			echo "diaconato null - ";
			$diaconato	= '0000-00-00';
		}
		if (!empty ($_POST["presbitero"])) {
			$presbitero=br_data($_POST["presbitero"],"presbitero");
		}else{
			echo "presbitero null - ";
			$presbitero	= '0000-00-00';
		}
		if (!empty ($_POST["evangelista"])) {
			$evangelista=br_data($_POST["evangelista"],"evangelista");
		}else{
			echo "evangelista null - ";
			$evangelista	= '0000-00-00';
		}
		if (!empty ($_POST["pastor"])) {
			$pastor=br_data($_POST["pastor"],"pastor");
		}else{
			echo "pastor null - ";
			$pastor	= '0000-00-00';
		}
		if (!empty ($_POST["missionario"])) {
			$missionario=br_data($_POST["missionario"],"missionario");
		}else{
			echo "missionario null - ";
			$missionario	= '0000-00-00';
		}
		if (!empty ($_POST["dt_muda_assembleia"])) {
			$dt_muda_assembleia=br_data($_POST["dt_muda_assembleia"],"dt_muda_assembleia");
		}else{
			$dt_muda_assembleia = '0000-00-00';
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
		}else{
			$c_impresso = '0000-00-00';
		}
		if (!empty ($_POST["batismo_espirito_santo"])) {
			$batismo_espirito_santo= intval ($_POST["batismo_espirito_santo"]);
		}else{
			$batismo_espirito_santo='0';			
		}
		if (!empty ($_POST["c_entregue "])) {
			$c_entregue = br_data($_POST["c_entregue "],"c_entregue");
		}else{
			$c_entregue = '0000-00-00';			
		}
		if (!empty ($_POST["quem_recebeu"])) {
			$quem_recebeu = intval ($_POST["quem_recebeu"]);
		}else{
			$quem_recebeu = 0;			
		}

		$quem_enttregou = (empty($_POST["quem_entregou"])) ? 0 : intval ($_POST["quem_entregou"]) ;
		$num_recibo = (empty($_POST["rec_entrega"])) ? 0 : intval ($_POST["rec_entrega"]) ;


		$_SESSION['igreja'] = (int)$_POST["congregacao"];
		$cad = date("Y-m-d h:i:s");
		$rolMembro = (!empty($_POST['bsc_rol'])) ? intval($_POST['bsc_rol']): intval($_GET['bsc_rol']);
		// echo "Rol-------> ".$rolMembro;

		$_SESSION['igreja'] = (int)$_POST["congregacao"];
		$cad = date("Y-m-d h:i:s");
		$rolMembro = (!empty($_POST[bsc_rol])) ? intval($_POST[bsc_rol]): intval($_GET[bsc_rol]);
		echo "Rol-------> ".$rolMembro;
		$value = "'{$rolMembro}','{$_SESSION['igreja']}','$batismo_em_aguas','{$_POST["local_batismo"]}','{$_POST["uf"]}',"
				 ."'{$_POST["batismo_espirito_santo"]}','$dt_mudanca_denominacao',"
				 ."'{$_POST["veio_qual_denominacao"]}','$auxiliar','$diaconato','$presbitero','$evangelista','$pastor',"
				 ."'{$_POST["veio_outra_assemb_deus"]}','$dt_muda_assembleia','{$_POST["lugar"]}',"
				 ."'$data','$dat_aclam','$c_impresso','$quem_imprimiu','{$_POST["c_entregue"]}','$quem_recebeu','$quem_enttregou',"
				 ."'$num_recibo','{$_POST["situacao_espiritual"]}','','$hist','$cad','{$_POST["obs"]}'";
		$eclesiastico = new insert ("$value","eclesiastico");
		$eclesiastico->inserir();


//		$value = "$rolMembro,'{$_SESSION['igreja']}','$batismo_em_aguas','{$_POST["local_batismo"]}','{$_POST["uf"]}',"
//				 ."'$batismo_espirito_santo','$dt_mudanca_denominacao',"
//				 ."'{$_POST["veio_qual_denominacao"]}','$auxiliar','$diaconato','$presbitero','$evangelista','$pastor',"
//				 ."'$missionario','{$_POST["veio_outra_assemb_deus"]}','$dt_muda_assembleia','{$_POST["lugar"]}',"
//				 ."'$data','$dat_aclam','$c_impresso','$quem_imprimiu','$c_entregue','$quem_recebeu','$quem_enttregou',"
//				 ."'$num_recibo','{$_POST["situacao_espiritual"]}',null,'$hist','$cad','{$_POST["obs"]}'";
		echo $value;
//		$eclesiastico = new insert ("$value","eclesiastico");
//		$eclesiastico->inserir();

		$cpf = $_GET["cpf"];
		echo "<script>location.href='./?escolha=adm/dados_profis.php&cpf=$cpf&bsc_rol=$rolMembro'</script>";
		echo "<a href='./?escolha=adm/dados_profis.php&cpf=$cpf&bsc_rol=$rolMembro'>Continuar...<a>";

		break;

	case "membro"://cadastro de membro
		$dt_nasc=br_data($_POST["datanasc"],"dt_nasc");

		// print_r($_POST);

		$rolMae = (empty($_POST["rol_mae"])) ? 'NULL' : intval($_POST["rol_mae"]) ;
		$rolPai = (empty($_POST["rol_pai"])) ? 'NULL' : intval($_POST["rol_pai"]) ;
		$sexo = (empty($_POST["sexo"])) ? 'M' : $_POST["sexo"];
		$nacao = (empty($_POST["nacao"])) ? 'NULL' : $_POST["nacao"];
		$endereco = (empty($_POST["endereco"])) ? 'NULL' : 'TEste';
		$doador = (empty($_POST["doador"]) || $_POST["doador"]=='') ? 'NULL' : $_POST["doador"];
		$obs = (empty($_POST["obs"]) || $_POST["obs"]=='') ? 'NULL' : $_POST["obs"];

		// var_dump($_POST).'<br />';
		// echo $dt_nasc;

$value = "null,'{$_POST["nome"]}','$nacao','{$_POST["cid_natal"]}','{$_POST["uf_nasc"]}','$sexo','$endereco',".
				"'{$_POST["numero"]}','{$_POST["complemento"]}','{$_POST["cep"]}','{$_POST["bairro"]}',".
				"'{$_POST["cidade"]}','{$_POST["uf_resid"]}','{$_POST["escolaridade"]}','{$_POST["graduacao"]}',".
				"'{$_POST["email"]}','{$_POST["fone_resid"]}','{$_POST["celular"]}','$dt_nasc','{$_POST["obs"]}',".
				"'{$_POST["doador"]}','{$_POST["sangue"]}','{$_POST["mae"]}',".
				"$rolMae,'{$_POST["pai"]}','$rolPai','".date('Y-m-d H:i:s')."','$hist'";



//			echo count($_POST).'<br /><br />';
//			print_r ($_POST).'<br /><br />';
//		echo '<br /><br />*** '.$value.' *** <br />';
		// var_dump($_POST).'<br />';

		$dados_pessoais = new insert ($value,"membro");
		$dados_pessoais->inserir();
		$rolMembro = mysql_insert_id();//recupera o id do �ltimo insert no mysql
		// Salta para n�o permitir registro 666
		$test_rol = $rolMembro+1;
		if ((substr_count($test_rol, '666'))>0){
			$aut_inc = str_replace("666","667",$test_rol);
			echo "<h1>Incrementado $aut_inc</h1>";
			$inc = mysql_query( "ALTER TABLE  membro auto_increment = $aut_inc");
		}
		if (empty($_POST["cpf"])) {
			$cpf=$rolMembro;
		}else {
			$cpf = $_POST["cpf"];
		}
		echo "<script>location.href='./?escolha=adm/dados_ecles.php&cpf=$cpf&uf_end=PB&bsc_rol=$rolMembro'</script>";
		echo "<a href='./?escolha=adm/dados_ecles.php&cpf=$cpf&uf_end=PB&bsc_rol=$rolMembro'>Continuar...<a>";
		break;
	case "profissional";
		//insere na tabela profissional
		$rolMembro = (!empty($_POST[bsc_rol])) ? intval($_POST[bsc_rol]): intval($_GET[bsc_rol]);
		$value="'{$rolMembro}','{$_POST["profissao"]}','{$_POST["obs"]}','{$_POST["cpf"]}','{$_POST["rg"]}','{$_POST["orgao_expedidor"]}','{$_POST["onde_trabalha"]}','$hist',NOW()";
		$profissional = new insert ("$value","profissional");
		$profissional->inserir();
		echo "<script>location.href='./?escolha=adm/dados_famil.php&bsc_rol={$rolMembro}'</script>";
		echo "<a href='./?escolha=adm/dados_famil.php&bsc_rol={$rolMembro}'>Continuar...<a>";
		unset($_SESSION["cpf"]);
		break;

	case "est_civil";
		//insere na tabela est_civil
		$rolMembro = (!empty($_POST[bsc_rol])) ? intval($_POST[bsc_rol]): intval($_GET[bsc_rol]);
		if (!empty ($_POST["data"])) {
			$data=br_data($_POST["data"],"data");
		}else{
			$data ="00000000";
		}

		
		$rol_conjugue = (empty($_POST["rol_conjugue"])) ? 0 : intval ($_POST["rol_conjugue"]);

		$value="'{$rolMembro}','{$_POST["estado_civil"]}','{$_POST["conjugue"]}','$rol_conjugue','{$_POST["certidao_casamento_n"]}','{$_POST["livro"]}','{$_POST["obs"]}','{$_POST["folhas"]}','{$data}','$hist',NOW()";
		$est_civil = new insert ("$value","est_civil");
		$est_civil->inserir(); 

		echo "<script>location.href='./?escolha=adm/dados_famil.php&bsc_rol={$rolMembro}'</script>";
		echo "<a href='./?escolha=adm/dados_famil.php&bsc_rol={$rolMembro}'>Continuar...<a>";
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

		$value="null,'{$_POST["nome"]}','{$_POST["endereco"]}','{$_POST["numero"]}','{$_POST["bairro"]}','{$_POST["cidade"]}','{$_POST["uf"]}','{$_POST["nacionalidade"]}','{$_POST["fone"]}','{$_POST["celular"]}','$dt_nasc','{$_POST["congregacao"]}','{$_POST["sexo"]}','$dt_aceitou','{$_POST["obs"]}','$hist',NOW()";
		$est_civil = new insert ("$value","{$_POST["tabela"]}");
		$est_civil->inserir();

		echo "<script>location.href='./?escolha=nv_convertido/cad_nv_convert.php&uf=PB'</script>";
		echo "<a href='./?nv_convertido/cad_nv_convert.php&uf=PB'>Continuar...<a>";
		break;

	case "cetad_aluno";
		//Cadastra aluno em curso
		$rolMembro = (!empty($_POST[bsc_rol])) ? intval($_POST[bsc_rol]): intval($_GET[bsc_rol]);
		$query = 	"SELECT rol FROM cetad_aluno "
				."WHERE rol = '{$rolMembro}' AND situacao = '1' ";

 		$result = mysql_query($query) or die (mysql_error());
		 if (mysql_num_rows($result)>0) {

			echo "<script>alert('O aluno: {$_SESSION["membro"]}, j� possui matr�cula ativa!');window.history.go(-1);</script>";
			echo "<a href='./?escolha=cetad/matricula.php'>Voltar ...<a>";
			break;
		 }

		if (!empty ($_POST["curso"])) {
		$valor = number_format($_POST["mensal"], 2, '.', ',');
		$value = "null,'{$rolMembro}','{$_POST["nome"]}','{$_POST["curso"]}','1','$valor','{$_POST["vencimento"]}',NOW(),'$hist'";
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
		$value = "null,'{$_POST["curso"]}','{$_POST["aluno"]}','$valor','$hist',NOW()";
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
		$value = "null,'{$_POST["tipo"]}','{$_POST["turma"]}','$mensal','{$_POST["horas_total"]}','$dias','{$_POST["hora_ini"]}','{$_POST["hora_fim"]}','$hist','1'";
		$cad = new insert ("$value","{$_POST["tabela"]}");
		$cad -> inserir();

		echo "<script>location.href='./?escolha=cetad/matricula.php&menu=top_cetad'</script>";
		echo "<a href='./?escolha=cetad/matricula.php&menu=top_cetad'>Continuar...<a>";

		} else {
			echo "<script>alert('Todos os Campos s�o de preenchimento OBRIGAT�RIO!');window.history.go(-1);</script>";
		}
		break;

	case "disciplina";
		$rolMembro = (!empty($_POST[bsc_rol])) ? intval($_POST[bsc_rol]): intval($_GET[bsc_rol]);
		if ($rolMembro>0) {
			//verifica
		//insere na tabela disciplina
		$pass = md5($_POST['senha']);

		$query = "SELECT * FROM usuario "
				."WHERE cpf = '{$_SESSION["valid_user"]}'"
				." AND senha='$pass' AND situacao = '1' AND nivel >= '10' ";

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

			$motivo = addslashes($_POST['motivo']);
			$situacao = addslashes($_POST['situacao']);
			$value = "null,'{$rolMembro}','$situacao','$motivo','$dt_ini','$dt_fim','$hist',NOW()";
			$disciplina = new insert ("$value","disciplina");
			$disciplina -> inserir();
			//Atualiza a tabela eclesiastico com o novo valor
			$rec = new DBRecord ("eclesiastico",$rolMembro,"rol");
			$rec->situacao_espiritual = intval($_POST["situacao"]); //Aqui � atribuido a esta vari�vel o valor para UpDate
			$rec->UpDate();
			echo "<script>location.href='./?escolha=adm/dados_disciplina.php&bsc_rol={$rolMembro}'</script>";
			echo "<a href='./?escolha=adm/dados_disciplina.php&bsc_rol={$rolMembro}'>Continuar...<a>";
			}else{
			echo "<script> alert('Senha incorreta ou voc� n�o tem autoriza��o para disciplinar membros!');</script>";
			}
			}else {
				echo "<script> alert('Rol do membro n�o foi informado!');</script>";
			}
		break;
	case "organica";
		//insere na tabela

	      /* if (strlen($_POST["subordinado"])>'6') {
			 $codigo = $_POST["subordinado"].$_POST["area_atual"].'01';
		    }else {

	       }
		$value="null,'$codigo','{$_POST["alias"]}','{$_POST["descricao"]}','$hist',NOW()";
		$cargos = new insert ("$value","{$_POST["tabela"]}");
		$cargos->inserir();
			echo "<script>location.href='./?escolha=igreja/cad_organica.php&menu=top_igreja'</script>";
			echo "<a href='./?escolha=igreja/cad_organica.php&menu=top_igreja'>Continuar...<a>";*/
		break;
	case "cargo_igreja";
		//insere na tabela
		$rolMembro = (!empty($_POST[bsc_rol])) ? intval($_POST[bsc_rol]): intval($_GET[bsc_rol]);
		$value="null,'{$_POST["descricao"]}','{$_POST["obs"]}','{$_POST["igreja"]}','{$rolMembro}','{$_POST["hierarquia"]}','1','$hist',NOW()";
		$cargos = new insert ("$value","{$_POST["tabela"]}");
		$cargos->inserir();
					echo "<script>location.href='./?escolha=igreja/cad_cargos.php&menu=top_igreja'</script>";
					echo "<a href='./?escolha=igreja/cad_cargos.php&menu=top_igreja'>Continuar...<a>";
		break;
	default:
		echo "Tabela n&atilde;o definida!";
		break;

}


/*
$value="'{$rolMembro}',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null";
$eclesiastico = new insert ("$value","eclesiastico");
$eclesiastico->inserir();
*/



echo "<h1> - $rol - </h1>";

?>
<p>&nbsp;</p>
