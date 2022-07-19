<h1><img src="img/loading2.gif" width="30" height="30"></h1>
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICENÇA
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa Bruce (http://)
 * @license    http://
 * Insere dados no banco do forms/autodizimo.php na tabela:usuario
 */
controle ("tes");

	$vlr = false;

	
$dta = explode("/",$_POST["data"]);
		$d=$dta[0];
		$m=$dta[1];
		$y=$dta[2];
		$res = checkdate($m,$d,$y);
		
	$datalanc = sprintf("%s-%s-%s",$y,$m,$d);

$ultregistro = mysql_query ('SELECT data FROM dizimooferta WHERE lancamento="0" ORDER BY id DESC LIMIT 1');
$vlrregistro = mysql_fetch_row($ultregistro);

echo '<H1>Data do registo: '.$vlrregistro[0].'</h1>';
echo '<H1>Data do lançamento: '.$datalanc.'</h1>';

if (($vlr && $vlrregistro[0] == $datalanc) || ($vlr && $vlrregistro[0] =='') ) {
	//Verifica se o caixa do ultimo culto foi encerrado e se há algum valor em dizimo, oferta ou oferta extra
		
	/*$semana = 1;
	$anoatual = date ('y');
	$diafim = date ('d',mktime(1,0,0,$m+1,0,$y));
	
	//echo '<h1>'.$d.'/'.$m.'<br/>'.date('w',mktime(1,0,0,$m,$i,$y)).'</h1>';
	
	//echo '<h2>'.$semana.'</h2>';
	for ($i = 1; $i <= $diafim; $i++) {//Verifica a q semana pertence o lançamento
		//echo $d.' ++++++++++ '.$i;
		if (date('w',mktime(1,0,0,$m,$i,$y))=='1' && $semana<5) {
			$semana++;
			//echo '<h2>'.$semana.'</h2>';
		}
			if ($d==$i) {
			$sem=$semana;}
						
		//echo(date('d/M/Y',mktime(1,0,0,$m,$i,$y)).' <--> '.date('w',mktime(1,0,0,$m,$i,y)).' ********** ');
	}
	*/
	
	$sem = semana($_POST["data"]);
	
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	
switch ($_POST['tipo']) {
	case '1':
		if ($_POST["rol"]!='' && $_POST["nome"]=='') {
			//Se for informado o apenas o rol então traz o nome do banco
			$nomecont = new DBRecord('membro', $_POST["rol"], 'rol');
			$nome = $nomecont -> nome();
			$eclesia = new DBRecord('eclesiastico', $_POST["rol"], 'rol');
		} elseif ($_POST["nome"]!='')  {
			$nome = $_POST["nome"];
		} else {
			$nome = '';
		}
		
		//corrigir os post para oferta...
		for ($i = 0; $i < 13; $i++) {
		
			$campo = 'oferta'.$i;
			printf ("$campo: %s",$_POST["$campo"]);
			
			if ($_POST["$campo"]>0) {
			
				switch ($i) {
					case 0:
					$conta = "'700','1','1'";//Dízimo
					break;
					case 1:
					$conta = "'701','1','2'";//Oferta
					break;
					case 2:
					$conta = "'702','1','3'";//Oferta extra
					break;
					case 3:
					$conta = "'704','1','4'";//Voto
					break;
					case 4:
					$conta = "'{$_POST['acescamp']}','1','6'";//Campanha
					break;
					case 5:
						if ($_POST['igreja']=='1') {
							$conta = "'820','2','5'";//Missões Sede;
						} else {
							$conta = "'821','2','5'";//Missões Congreções;
						}						
					break;
					case 6:
						$conta = "'824','2','5'";//Missões Envelopes
					break;
					case 7:
						$conta = "'823','2','5'";//Missões Cofres
					break;
					case 8:
						$conta = "'822','2','5'";//Missões Carnês
					break;
					case 9:
						$conta = "'720','3','7'";//Oração Adulto
					break;
					case 10:
						$conta = "'722','3','7'";//Oração Mocidade
					break;
					case 11:
						$conta = "'723','3','7'";//Oração Infantil
					break;
					case 12:
						$conta = "'721','3','7'";//Voto em Circ. de Oração 
					break;
					
					default:
						;
					break;
				}
				
				$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );
				$value  = "null,null,$conta,'{$eclesia -> congregacao()}','{$_POST["rol"]}','$nome','$valor',";
				$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
				$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
				$dados = new insert ($value,"dizimooferta");
				$dados->inserir();
			}
			

			
			}
		
		/*if ($_POST['dizimo']>0) {//Lança dizimo no banco
			$valor = strtr( str_replace(".","",$_POST["dizimo"]), ',','. ' );
			$value  = "'','','700','1','1','{$_POST["igreja"]}','{$_POST["rol"]}','$nome','$valor',";
			$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		if ($_POST['oferta']>0) {
			$valor = strtr( str_replace(".","",$_POST["oferta"]), ',','. ' );
			$value  = "'','','701','1','2','{$_POST["igreja"]}','{$_POST["rol"]}','$nome','$valor',";
			$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		if ($_POST['ofertaextra']>0) {
			$valor = strtr( str_replace(".","",$_POST["ofertaextra"]), ',','. ' );
			$value  = "'','','702','1','3','{$_POST["igreja"]}','{$_POST["rol"]}','$nome','$valor',";
			$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		if ($_POST['voto']>0) {
			$valor = strtr( str_replace(".","",$_POST["voto"]), ',','. ' );
			$value  = "'','','704','1','4','{$_POST["igreja"]}','{$_POST["rol"]}','$nome','$valor',";
			$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		if ($_POST['ofmissao']>0) {
			$valor = strtr( str_replace(".","",$_POST["ofmissao"]), ',','. ' );
			$value  = "'','','820','2','5','{$_POST["igreja"]}','{$_POST["rol"]}','$nome','$valor',";
			$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		
	break;*/
	
	case '2':
		if ($_POST['oferta']!='') {
			$valor = strtr( str_replace(".","",$_POST["oferta"]), ',','. ' );
			$value  = "null,null,'701','1','2','{$_POST["igreja"]}','{$_POST["roloferta"]}','{$_POST["nomeoferta"]}','$valor}',";
			$value .= "'$y-$m-$d','$sem','$m','$y','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";	
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		if ($_POST['ofertaext']!='') {
			$valor = strtr( str_replace(".","",$_POST["ofertaext"]), ',','. ' );
			$value  = "null,null,'702','1','3','{$_POST["igreja"]}','{$_POST["rolext"]}','{$_POST["nomeext"]}','$valor',";
			$value .= "'$y-$m-$d','$sem','$m','$y','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obsext"]}',NOW(),'$hist'";	
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
	
	default:
		;
	break;
}

	


	//echo "<h1>".mysql_insert_id()."</h>";//recupera o id do último insert no mysql
	
		echo "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'; </script>";
		echo "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'>Continuar0...<a>";
}elseif ($vlrregistro[0] <> $datalanc) {
	echo "<script>alert('Você não encerrou o caixa do último culto! Faça agora para continuar...');</script>";
	echo "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'; </script>";
	echo "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'>Continuar1...<a>";
} else {
	echo "<script>alert('Valor não Informado!');</script>";
	echo "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'; </script>";
	echo "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'>Continuar2...<a>";
}	
	
	/*
	$value="'{$_SESSION["rol"]}',null,'','','','','','','','','','','','','','','','','','','','','','',''";
	$eclesiastico = new insert ("$value","eclesiastico");
	$eclesiastico->inserir();
	*/

?>
<p>&nbsp;</p>