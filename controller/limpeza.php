<?php
$igreja = ($_GET['igreja']>0) ? $_GET['igreja']:$_POST['igreja'];

switch ($_GET['limpeza']) {
	case '1':
		//Mostrar totalizador geral para impressão
		error_reporting(E_ALL);
		ini_set('display_errors', 'off');
		$scriptCSS  = '<link rel="stylesheet" type="text/css" href="../views/limpeza.css" />';
		require "../func_class/funcoes.php";
		require "../func_class/classes.php";
		function __autoload ($classe) { 
			require_once ("../models/$classe.class.php");
		}
		//montar um cabeçalho padrão e remover as chamadas a cima
		$sede = new DBRecord ("igreja","1","rol");//Traz os dados da sede
		$ref = new ultimoid('limpezpedid');
		$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script
		
		//Dados para montar o cabeçalho do documento para imprimir
		$dadosjgreja  = 'Templo SEDE: '.$sede->rua().', N&ordm; '.$sede->numero();
		$dadosjgreja .= '<br /> '.$sede->cidade().' - '.$sede->uf().' - CNPJ:';
		$dadosjgreja .= $sede->cnpj().'<br />	CEP: '.$sede->cep().' - Fone:';
		$dadosjgreja .= $sede->fone().' - Fax: '.$sede->fax();
		$siteigreja	  = $sede->site();
		$emailigreja  = $sede->email();
		$icone		  = '../ad.ico';
		$titulo		  = 'Totalizador material de limpeza - Todas as Congregações';
		$arquivo	  = '../views/limpezatot.php';
		$todascongreg = '../models/limplisttotcong.php';
		
		require_once '../tesouraria/modeloimpress.php';
		
	break;
	
	case '2':
		//Mostrar totalizador geral para visualizar na tela
		$ref = new ultimoid('limpezpedid');
		$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script
		echo "<style type='text/css'>";
		require_once ("aniv/style.css");
		echo "</style>";
			//Mostrar totalizador dentro da aplicação
		echo '<a href="./controller/limpeza.php?limpeza=1"><button type="button">Imprimir totalizador</button></a>';
		$todascongreg = './models/limplisttotcong.php';//Lista os pedidos das outras congregações
		require_once 'views/limpezatot.php';
	break;
	case '3':
		$ref = new ultimoid('limpezpedid');
		$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script
		echo "<style type='text/css'>";
		require_once ("aniv/style.css");
		echo "</style>";
			//Mostrar totalizador dentro da aplicação
		$aquivo ='../views/limpezatot.php';
	break;
	case '4':
		//Mostrar totalizador geral para impressão
		error_reporting(E_ALL);
		ini_set('display_errors', 'off');
		$scriptCSS  = '<link rel="stylesheet" type="text/css" href="../views/limpeza.css" />';
		require "../func_class/funcoes.php";
		require "../func_class/classes.php";
		function __autoload ($classe) { 
			require_once ("../models/$classe.class.php");
		}
		//montar um cabeçalho padrão e remover as chamadas a cima
		$sede = new DBRecord ("igreja","1","rol");//Traz os dados da sede
		$ref = new ultimoid('limpezpedid');
		$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script
		//Dados para montar o cabeçalho do documento para imprimir
		$dadosjgreja  = 'Templo SEDE: '.$sede->rua().', N&ordm; '.$sede->numero();
		$dadosjgreja .= '<br /> '.$sede->cidade().' - '.$sede->uf().' - CNPJ:';
		$dadosjgreja .= $sede->cnpj().'<br />	CEP: '.$sede->cep().' - Fone:';
		$dadosjgreja .= $sede->fone().' - Fax: '.$sede->fax();
		$siteigreja	  = $sede->site();
		$emailigreja  = $sede->email();
		$dadoscong	  = new DBRecord('igreja',$_GET['igreja'], 'rol');//Traz os dados da congregação
		$icone		  = '../ad.ico';
		$titulo		  = 'Totalizador material de limpeza - Congregação:'. $dadoscong->razao();
		$arquivo	  = '../views/limpezatot.php';
		$todascongreg = '../models/limplisttotcong.php';
		require_once '../tesouraria/modeloimpress.php';
	break;
	case '5'://Formulário para mudança do periodo de cadastro do material
		$ref = new ultimoid('limpezpedid');
		$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script
		require_once 'forms/limpeza/mudarperiodo.php';
	break;
	
	default:
		//Mostra lista por congregação pelo $_GET['igreja']
		$ref = new ultimoid('limpezpedid');
		$mesref = (empty($_GET['mes'])) ? $ref->ultimo('mesref'):$_GET['mes'].'/'.$_GET['ano'];//Remover quando terminar o script
		echo "<style type='text/css'>";
		require_once ("aniv/style.css");
		echo "</style>";
		require_once 'forms/limpeza.php';
	break;
}