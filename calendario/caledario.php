<?PHP
$imprimir = false;
if ($_GET['imp']>'0') {
	require_once ("../help/impressao.php");
	$sede	= $igSede;
	if (empty($_GET['id']) || ($_GET['id'])=='1') {
		$roligreja = 1;
		$igreja 	= $sede;
	} else {
		$roligreja = intval($_GET['id']);
		$igreja 	= new DBRecord ('igreja',$roligreja,'rol');
	}
	$cidade 	= new DBRecord ("cidade",$sede->cidade(),"id");
	$colunas 	= 6;
	if ($roligreja=='1') {
		//Sede
		$dircon		= $sede->pastor();
		$templo		= '<b>Templo Sede </b> ';
	}else {
		//Congrega��es
		$dadocong 	= $igreja;
		$igreja_rodape = $dadocong;
		$dirigente 	= new DBRecord ('membro',$dadocong->pastor(),'rol');
		$dircon		= '<b>Dirig. </b>'.cargo($dadocong->pastor())['1'].' '.$dirigente->nome();
		$templo		= '<b>Congreg.: </b>'.$igreja->razao();
	}
$ano = (empty($_GET['ano'])) ? date ('Y'):$_GET['ano'];
$templo = '<div style="background:#CCC;width:100%; text-align:left;">'.$templo.' - Santa Ceia - Calend&aacute;rio '.$ano.'</div> ';
$imprimir = true; //permite o impress�o do rodap�
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Santa Ceia</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">
<?PHP
	if ($_GET['imp']=='2') {
		require 'imprSantaCeiaTodas.php';
	}else {
		require("funcs_impress.php");
	}
?>
</head>
<body>
	<span ><?php echo $templo.$dircon;?></span>
	<?PHP
}else {
	$sede	= $igSede;
	if (empty($_GET['id'])) {
		$roligreja = 1;
		$igreja 	= $sede;
	} else {
		$roligreja = intval($_GET['id']);
		$igreja 	= new DBRecord ('igreja',$roligreja,'rol');
	}
	require("calendario/funcs.php");
	$colunas = 2;
}
	/*
	Fun��o geradora de calend�rio.
	Par�metros:

	string
	gerarCalendario([M�S],[ANO],[N�MERO_DE_M�SES],[N�MERO_DE_TABELAS_POR_LINHA],
																	[CONJUTO DE DATAS1]...[CONJUTO DE DATASn],
																	[RODAP�S],
																	[DESCRI��ES DA LEGENDA])

	Os tr�s �ltimos par�metros s�o arrays.
	A marca��o dos dias � feita da seguinte forma:
	dd/mm, para um dia espec�fico ou dd-dd/mm para um intervalo de dias.

	Podem ser criadas marca��es de datas indefinidamente, basta adicion�-las no arquivo
	'calendario.css', usando o nome de classe td_marcadoX, onde X � o n�mero da marca��o.

	*/
	  $marc0=array();//Santa ceia
	  $marc1=array();//Circulo de Ora��o
	  $marc2=array();//dias de culto
	  $marc3=array();//Escola B�blica
	  $marc4=array();
	  $marc5=array();
	  $marc6=array();
	  //Define a Igreja do rodap� dos calendarios
	  $id_igreja = intval( $_GET ["id"]);
	  if (empty($id_igreja)){$id_igreja =1;}
	  $ceia = $igreja->ceia();
	  $nome_igreja = $igreja->razao();
	  /*if ($id_igreja<>1) {
	  $nome_igreja="Congrega&ccedil;&atilde;o: ".$nome_igreja;
	  }else {
	  $nome_igreja="Templo ".$nome_igreja;
	  }
	  */
	  $dia_ceia = substr ($ceia,-1);
	  $semana_ceia = substr ($ceia,-2,1);
	//  $todos = "1";
	 if($_GET["mes"]=="") //Caso a classe ainda n�o esteja definida ap�s o for acima
	 $mes= "1"; else $mes=(int)$_GET["mes"];
	 //$mes= "1";
	 $todos ="12";
	if ($mes==""){$mes = date("n");}
	if (empty($_GET["ano"]))
	  $y = date("Y");
	  else
	  $y = (int)$_GET["ano"];

	  if ($_GET['imp']=='') {
	  	prox_ant_ano ();//Gera cabelho de altera��o de ano e a lista de congrega��es
	  }

	  if ($_GET['imp']!='2') {
		 echo gerarCalendario($mes,$y,$todos,$colunas,
		                 array(array()),
	                     $nome_igreja,/*Define o texto do Rodap� do calend�rio*/
	                    "Santa Ceia"/*Define o texto da legenda*/,$dia_ceia,$semana_ceia);
	  }

	//Mostra todas as ceias de todas as igrejas
	if ($_GET['imp']=='2') {
		$todasCeias = new igreja('');
		$arrayIgrejas = $todasCeias->ArrayIgrejaDados();
		$meses=array("Jan","Fev","Mar","Abr","Mai","Jun",
				"Jul","Ago","Set","Out","Nov","Dez");
		$cabMes = '<table class="tabela" height=220><tr><td width=300></td>';
		for($ms=0; $ms<12; $ms++){
		$cabMes .='<td class="cabecalho">'.$meses[$ms].'</td>'; //Cria uma tabela para o m�s atual
		}
		$cabMes .= '</tr>';
		//Monta as linhas
		foreach ($igreja as $key => $vlDia){
			$tabTodasCeias .= $key.'->'.$vlDia.' ; ';
		}
		//print_r($arrayIgrejas);
		foreach ($arrayIgrejas AS $key => $dadosCong){
			//echo $key.' - rol: '.$dadosCong['rol'].' --> '.$dadosCong['razao'].' <---> ';

		if ($dadosCong['rol']==$_GET['id']) {
			$classIgreja = 'td_marcado8';
			$classDias 	 = 'td_marcado5';
		}else {
			$classIgreja = 'td_marcado1';
			$classDias 	 = 'td_marcado7';
		}
		$todCeias ='<tr><td class="'.$classIgreja.'">'.$dadosCong['razao'].'</td>';
		$dia_ceia = substr ($dadosCong['ceia'],-1);
		$semana_ceia = substr ($dadosCong['ceia'],-2,1);
		 $todCeias .= gerarCalendario($mes,$y,$todos,$colunas,
				array(array()),
				$dadosCong['razao'],/*Define o texto do Rodap� do calend�rio*/
				"Santa Ceia"/*Define o texto da legenda*/,$dia_ceia,$semana_ceia,$classDias);
		 $diasCeias .= $todCeias.'</tr>';
		}
		$diasCeias .= '</table>';
		echo $cabMes.$diasCeias;
	}

	$frase  = $igreja->cultos();
	$numDias = array(1, 2, 3, 4, 5, 6, 7);
	$nomeDias   = array('Segundas','Ter&ccedil;as','Quartas','Quintas','Sextas','S&aacute;bados','Domingos' );
	$diasDeCulto = str_replace($numDias, $nomeDias, $frase);
	$diasDeCulto = ($diasDeCulto=='') ? 'Adicione os dias de culto pela Administra&ccedil;&atilde;o...':$diasDeCulto;
	echo '<div>&nbsp;'.$diasDeCulto.'.&nbsp;Das 19h &agrave;s 21h</div>';

   if (isset($_GET['imp']) && $_GET['imp']>'0') {
   	echo '</body></html>';
	?>
 <div id="footer">
	<?PHP
	echo 'Templo: '.$sede->razao().': '.$sede->rua().', N&ordm; '.$sede->numero().' - '.$cidade->nome().' - '.$sede->uf().' - ';
	echo 'CNPJ: '.$sede->cnpj();
   	echo "CEP: {$sede->cep()} - Fone: {$sede->fone()} ";
	?>
      <br />Email: <a rel="nofollow" href="mailto: <?PHP echo "{$sede->email()}";?>" onclick='target="_blank"'><?PHP echo "{$sede->email()}";?></a>
	   <p>Copyright &copy; 2016 <a onclick='target="_blank"' href="http://<?PHP echo "{$sede->site()}";?>/" title="Copyright information"></a>
	   &bull;Designed by <a rel="nofollow"  onclick='target="_blank"' href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
    </div>
	<?PHP
   }
   ?>
