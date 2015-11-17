<?php
$igreja = ($_GET['igreja']>0) ? $_GET['igreja']:$_POST['igreja'];
$saltoPagina = '<div style="page-break-before: always;"> </div>';

if ($_GET['limpeza']=='1' || $_GET['limpeza']=='4' || ($_GET['limpeza']>='6' && $_GET['limpeza']<'12' )) {
 	error_reporting(E_ALL);
		ini_set('display_errors', 'off');
		$scriptCSS  = '<link rel="stylesheet" type="text/css" href="../views/limpeza.css" />';
		require "../func_class/funcoes.php";
		require "../func_class/classes.php";
		function __autoload ($classe) {

		list($dir,$nomeClasse) = explode('_', $classe);
		//$dir = strtr( $classe, '_','/' );

			if (file_exists("../models/$dir/$classe.class.php")){

				require_once ("../models/$dir/$classe.class.php");
			}elseif (file_exists("../models/$classe.class.php")){
				require_once ("../models/$classe.class.php");
			}
		}

		//montar um cabeçalho padrão e remover as chamadas a cima
		$sede = new DBRecord ("igreja","1","rol");//Traz os dados da sede

			if (!empty($_GET['mesref'])) {
				$mesref = $_GET['mesref'];
			} elseif (!empty($_POST['mesref'])) {
				$mesref = $_POST['mesref'];
			}elseif (!empty($_GET['mes'])) {
				$mesref = $_GET['mes'].'/'.$_GET['ano'];
			} else {
				$ref = new ultimoid('limpezpedid');
				$mesref = $ref->ultimo('mesref');
			}

		//Dados para montar o cabeçalho do documento para imprimir
		$dadosjgreja  = 'Templo SEDE: '.$sede->rua().', N&ordm; '.$sede->numero();
		$dadosjgreja .= '<br /> '.$sede->cidade().' - '.$sede->uf().' - CNPJ:';
		$dadosjgreja .= $sede->cnpj().'<br />	CEP: '.$sede->cep().' - Fone:';
		$dadosjgreja .= $sede->fone().' - Fax: '.$sede->fax();
		$siteigreja	  = $sede->site();
		$emailigreja  = $sede->email();
		$icone		  = '../ad.ico';
}else {
	if (!empty($_GET['mesref'])) {
		$mesref = $_GET['mesref'];
	} elseif (!empty($_POST['mesref'])) {
		$mesref = $_POST['mesref'];
	} elseif (!empty($_GET['mes'])) {
		$mesref = $_GET['mes'].'/'.$_GET['ano'];
	} else {
		$ref = new ultimoid('limpezpedid');
		$mesref = $ref->ultimo('mesref');
	}
}

if (empty($_GET['mes']) && empty($_GET['ano'])) {
	$periodo = periodoLimp($mesref);
}else {
	$periodo = periodoLimp($_GET['mesref']);
}

//Mês e ano do relatório
if (!empty($_GET['mes'])) {
	$mesPed = $_GET['mes'];
	$anoPed = $_GET['ano'];
	$mesref=$mesPed.'/'.$anoPed;
	$linkperido = 'mes='.$mesPed.'&ano='.$anoPed.'&mesref='.$mesref;
} elseif (!empty($_POST['mes'])) {
	$mesPed = $_POST['mes'];
	$anoPed = $_POST['ano'];
	$mesref=$mesPed.'/'.$anoPed;
	$linkperido = 'mes='.$mesPed.'&ano='.$anoPed.'&mesref='.$mesref;
} elseif (!empty($_GET['mesref'])) {
	list($mesPed,$anoPed) = explode('/', $_POST['mesref']);
	$mesref=$mesPed.'/'.$anoPed;
	$linkperido = 'mes='.$mesPed.'&ano='.$anoPed.'&mesref='.$mesref;
}  else {
	$linkperido = '';
}

switch ($_GET['limpeza']) {
	case '1':
		$dadoscong	= new DBRecord('igreja','1', 'rol');//Traz os dados da congregação
		//Mostrar totalizador geral para impressão

		$titulo		  = 'Totalizador material de limpeza - Todas as Congregações';
		$arquivo	  = '../views/limpezatot.php';
		$todascongreg = '../models/limplisttotcong.php';

		require_once '../tesouraria/modeloimpress.php';
	break;
	case '2':
		$dadoscong	= new DBRecord('igreja','1', 'rol');//Traz os dados da congregação
		//Mostrar totalizador dentro da aplicação
		echo '<a href="controller/limpeza.php?limpeza=1&'.$linkperido.'"><button type="button" class="btn btn-primary">Imprimir totalizador</button></a>';
		$todascongreg = 'models/limplisttotcong.php';//Lista os pedidos das outras congregações
		require_once 'views/limpezatot.php';
	break;
	case '3':
		echo "<style type='text/css'>";
		require_once ("aniv/style.css");
		echo "</style>";
			//Mostrar totalizador dentro da aplicação
		$aquivo ='../views/limpezatot.php';
	break;
	case '4':
		$dadoscong	  = new DBRecord('igreja',$_GET['igreja'], 'rol');//Traz os dados da congregação
		$icone		  = '../ad.ico';
		$titulo		  = 'Totalizador material de limpeza - Congregação:'. $dadoscong->razao();
		$arquivo	  = '../views/limpezatot.php';
		$todascongreg = '../models/limplisttotcong.php';
		$saltoPagina  = '';
		require_once '../tesouraria/modeloimpress.php';
	break;
	case '5'://Formulário para mudança do periodo de cadastro do material
		//$ref = new ultimoid('limpezpedid');
		//$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script
		require_once 'forms/limpeza/mudarperiodo.php';
	break;
	case '6':
		//Mostrar Lista de todos os materiais disponíveis
		$titulo		  = 'Material de limpeza Disponibilizado';
		$arquivo	  = '../views/limpezaLista.php';

		require_once '../tesouraria/modeloimpress.php';
	break;
	case '7':
		//Mostrar Lista de todos os materiais disponíveis$ref = new ultimoid('limpezpedid');
		//$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script

		$scriptCSS  = '<link rel="stylesheet" type="text/css" href="../views/limpeza.css" />';

		//montar um cabeçalho padrão e remover as chamadas a cima
		$sede = new DBRecord ("igreja","1","rol");//Traz os dados da sede

		//Dados para montar o cabeçalho do documento para imprimir
		$dadosjgreja  = 'Templo SEDE: '.$sede->rua().', N&ordm; '.$sede->numero();
		$dadosjgreja .= '<br /> '.$sede->cidade().' - '.$sede->uf().' - CNPJ:';
		$dadosjgreja .= $sede->cnpj().'<br />	CEP: '.$sede->cep().' - Fone:';
		$dadosjgreja .= $sede->fone().' - Fax: '.$sede->fax();
		$siteigreja	  = $sede->site();
		$emailigreja  = $sede->email();

		$tbodytab = new limplista();
		//Variável com a lista
		$tabMaterial = $tbodytab->materialFormPed();

		$arrayComIgrejas = new igreja();
		//print_r ($arrayComIgrejas->ArrayIgrejaDados());
		$icone		  = '../ad.ico';
		$titulo		  = 'Formul&aacute;rio para pedido de Material de limpeza';
		$arquivo	  = '../views/tesouraria/limpezaFormPedido.php';

		foreach ($arrayComIgrejas->ArrayIgrejaDados() as $chave => $valor) {
			$nomeIgreja =$valor['razao'];
			require '../views/modImprRodape.php';
		}
	break;
	case '12':
		//Gerar lista de material do período
		$verRegistro = new limplista($mesref);
		if ($verRegistro->TotMaterial()==false) {
			if (empty($mesPed)) {
				$periodoAnt = new datetime ('NOW');
				$periodoAnt->modify('-2 month');
				$ref = $periodoAnt->format ('m/Y');
				echo $periodoAnt->format ('d-m-Y').' **';
			}else {
				$periodoAtual = '01/'.$mesPed.'/'.$anoPed;
				$periodoAnt = new datetime ($periodoAtual);
				$periodoAnt->modify('-3 month');
				$ref = $periodoAnt->format ('m/Y');
				echo $periodoAnt->format ('d-m-Y').' **'.$ref;
			}
			$GeraPedidos = new limplista($mesref);
			$verRegistro->geraLista($ref);
			$dadoscong	= new DBRecord('igreja','1', 'rol');//Traz os dados da congregação
			//Mostrar totalizador dentro da aplicação
			echo '<a href="controller/limpeza.php?limpeza=1&'.$linkperido.'"><button type="button" class="btn btn-primary">Imprimir totalizador</button></a>';
			$todascongreg = 'models/limplisttotcong.php';//Lista os pedidos das outras congregações
			require_once 'views/limpezatot.php';
		} else {
			echo '<script>alert("** Período já foi gerado! **");</script>';
			require_once 'forms/limpeza.php';
		}
	break;
	default:
		//Mostra lista por congregação pelo $_GET['igreja']
		require_once 'forms/limpeza.php';
	break;
}
