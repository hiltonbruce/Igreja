<?PHP
	session_start();
	//echo $_GET["escolha"]." -----------".$_POST["escolha"];
	require_once ("func_class/classes.php");
	require_once ("func_class/funcoes.php");
	
	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	
	date_default_timezone_set('America/Recife');
	
	    
	function __autoload ($classe) {
		
		list($dir,$nomeClasse) = explode('_', $classe);
		//$dir = strtr( $classe, '_','/' );
		
		if (file_exists("models/$dir/$classe.class.php")){
			
			require_once ("models/$dir/$classe.class.php");
		}elseif (file_exists("models/$classe.class.php")){
			require_once ("models/$classe.class.php");
		}

		//echo "<h1>$classe ** $dir</h1>";
		//echo "<h1>$classe ** $dir</h1>";
	}
	
	  if (!empty($_GET["bsc_rol"])){
			$bsc_rol = (int)$_GET["bsc_rol"];
			$_SESSION["rol"]=(int)$_GET["bsc_rol"];		
		}

	if (strstr($_GET["escolha"],"cadastro_membro.php") || strstr($_POST["escolha"],"cadastro_membro.php"))
	{
		unset($_SESSION["rol"]);//se for cadastrar um novo membro a variï¿½vel ï¿½ limpa e define a legenda para o form listar dados do membro pelo rol
		unset($_SESSION["membro"]);
		$campo_rol="Insira o Rol:";
	}else{
		$membro = new DBRecord ("membro",$bsc_rol,"rol");
		$_SESSION["membro"]=$membro->nome();
		$campo_rol="Rol Nº:"; //Quando a variï¿½vel de sessão rol existir define 'Rol nº:' como legenda para o form listar dados do membro pelo rol
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Assembleia de Deus - Bayeux - PB</title>

<script type="text/javascript" src="js/funcoes.js"></script>
<script type="text/javascript" src="js/maskedinput.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="menu.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="style.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
<link rel="icon" type="image/gif" href="br_igreja.jpg">
</head>
<body>
<div class="wrap1">
  <div class="wrap2">
    <div class="logo"></div>
    <div id="menu">
          <?php require_once 'menu.php';?>
    </div>
      <div class="info1">
	  <?php //echo "Sessï¿½o ".$_SESSION["setor"];?>
        <marquee direction="left" scrollamount="3" height="25">
          E n&atilde;o vos embriagueis com vinho, em que h&aacute; contenda, mas enchei-vos do Esp&iacute;rito (Ef 5.18)
        </marquee>
      </div>
      <div class="leftpanel">
	  <?PHP
	  
	// echo '<h1> SESSION[valid_user]- '.$_SESSION['valid_user'].'--Session[setor]-- '.$_SESSION['setor'].' - '.$_SESSION['nome'].'--Session[cid_end]-- '.$_SESSION['cid_end'].'</h1>';
		  if (!empty($_SESSION['valid_user']))
		  {
		  ?>

        <div class="header">Sistemas</div>
        <ul id="categories">
          <li <?PHP id_left ("adm/");?> ><a href="./?escolha=adm/cadastro_membro.php&uf=PB"><span class="glyphicon glyphicon-user" >&nbsp;</span>&nbsp;Membros</a></li>
          <li <?PHP id_left ("nv_convertido/");?>><a href="./?escolha=nv_convertido/cad_nv_convert.php&uf=PB"><span class="glyphicon glyphicon-hand-right" >&nbsp;</span>&nbsp;Novos&nbsp;Convertidos</a></li>
          <li <?PHP id_left ("igreja/");?>><a href="./?escolha=igreja/list_membro.php&menu=top_igreja"><span class="glyphicon glyphicon-fire">&nbsp;</span>&nbsp;Igrejas</a></li>
          <li <?PHP id_left ("tab_auxiliar/");?>><a href="./?escolha=tab_auxiliar/cadastro_bairro.php"><span class="glyphicon glyphicon-picture" >&nbsp;</span>&nbsp;Cadastrar Bairro</a></li>
          <li <?PHP id_left ("relatorio/");?>><a href="./?escolha=relatorio/formularios.php&menu=top_formulario"><span class="glyphicon glyphicon-list-alt" >&nbsp;</span>&nbsp;Ficha, Recibo e Certid&otilde;es</a></li>
          <li <?PHP id_left ("aniv/");?>><a href="./?escolha=aniv/aniversario.php&menu=top_aniv"><span class="glyphicon glyphicon-gift" >&nbsp;</span>&nbsp;Aniversariantes</a></li>
          <li <?PHP id_left ("cetad");?>><a href="./?escolha=cetad/pgto.php&menu=top_cetad"><span class="glyphicon glyphicon-pencil" >&nbsp;</span>&nbsp;CETAD</a></li>
          <?php 
          	if ($_SESSION['nivel']>'10') {
         	 ?>
         		<li <?PHP id_left ("backup");?>><a href="./backup/"><span class="glyphicon glyphicon-export" >&nbsp;</span>&nbsp;Backup de Dados</a></li>
		   	 <?php	
          	}
          ?>
		  <?PHP
		  }
		  	else
		  {
		  echo "<div class='header'>Departamentos</div>";     
       	  echo '<ul id="categories">';
		  ?>

          <li style="border-top:0;"  class='selected'><a href="./">Home - selecionado</a></li>
          <li><a href="#">COMADEBY</a></li>
          <li><a href="infantil/">Infantil</a></li>
          <li><a href="#">Item 4 </a></li>
          <li><a href="#">USADEBY</a></li>
          <li><a href="#">Item 6</a></li>
          <li><a href="#">Item 7</a></li>
          <?PHP  } ?>
          <li <?PHP id_left ("caledario.php");?>><a href="./?escolha=calendario/caledario.php" 
          title="Calend&aacute;rio da Sede e Congrega&ccedil;&otilde;es"
          ><span class="glyphicon glyphicon-tree-deciduous" >&nbsp;</span>&nbsp;Santa&nbsp;Ceia</a></li>
        </ul>
        <br />
        <div class="header">Administra&ccedil;&atilde;o:</div>
          <?PHP
				//echo "<h2>{$_SESSION["rol"]}</h2>";
				require_once ("autentica.php");
			?>
          <br />
          <br />
      </div>
 <div id="content">
      <div class="mainpanel">
        <?PHP
		
		if ($_SESSION["valid_user"]){	
			if (strstr($_GET["escolha"],"adm/")){
				if (strstr($_GET["escolha"],"adm/dados_pessoais"))
					require_once ("top_dados.php");
				else 
					require_once ("views/secretaria/menuTopDados.php");				
			}elseif (strstr($_POST["escolha"], "adm/")){
				if (strstr($_POST["escolha"],"adm/dados_pessoais"))
					require_once ("top_dados.php");
				else
					require_once ("views/secretaria/menuTopDados.php");
			}elseif (isset ($_GET["menu"])) {
				require_once ("{$_GET["menu"]}.php");		
			}elseif (isset ($_POST["menu"])){
				require_once ("{$_GET["menu"]}.php");
			}elseif (strstr($_GET["escolha"],"aniv/")){
				require_once ("top_aniv.php");			
			}
			
			$cent = new central();//Chama o script da pagina de acordo com $_get ou $_post ["escolha"]
			require ($cent->get());
			
		}else {
				require_once ('noticias/painel.php');			
		}
		
	   ?>
      </div>
	  
	  <!-- rightpanel -->
	 	<?PHP if ($_GET["escolha"]<>"cetad/caixa.php" && $_GET['direita']=='') {
		require_once ("painel_direito.php");
		}?>
		<!-- Fim do rightpanel -->		
    </div>
</div> 

    <div class="info1">
      <div style="display:inline; float:left;">&copy; 2010 <a href="http://www.adpb.com.br/">www.adpb.com.br</a>. Design <a href="http:#">Joseilton Costa Bruce</a>.</div>
      <div style="display:inline; float:right;"><a href="http://jigsaw.w3.org/css-validator/check/referer"></a><a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="img/valid-xhtml11-blue.png" alt="Validar XHTML 1.1" /></a><img style="border:0;width:88px;height:31px" src="img/vcss.gif" alt="Validar CSS!" align="bottom"/> <a href="mailto:hiltonbruce@gmail.com">Joseilton</a></div>
    </div>
  </div>
</body>

<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/alert.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.3.1.min_.js"></script>
<script type="text/javascript">// <![CDATA[
jQuery(function($) {
      $.mask.definitions['~']='[+-]';
      $('#data').mask('99/99/9999');
      $('#expedicao').mask('99/99/9999');
      $('#venc').mask('99/99/9999');
      $('#ano').mask('9999');
      $('#mesnum').mask('99');
      $('#fone').mask('(99) 9999-9999');
      $('#celular').mask('(99) 9999-9999');
      $('#cpf').mask("999.999.999-99");
      $('#cpf_val').mask("999.999.999-99");
      $('#br').mask("999");
      $('#cep').mask("99.999-999");
      $('#cnpj').mask("99.999.999/9999-99");
      $('#sigla_val').mask("99.999.999/9999-99");
   });
// ]]&gt;</script>

<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</html>
