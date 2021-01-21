<?PHP
	session_start();
	//echo $_GET["escolha"]." -----------".$_POST["escolha"];
	require_once ("func_class/classes.php");
	require_once ("func_class/funcoes.php");

	$escGET = (empty($_GET["escolha"])) ? '' : $_GET["escolha"];
	$escPOST = (empty($_POST["escolha"])) ? '' : $_POST["escolha"];
	$linkEsc = ($escPOST=='') ? $escGET:$escPOST;
	$dirGET = (empty($_GET["direita"])) ? '' : $_GET["direita"];
	$dirPOST = (empty($_POST["direita"])) ? '' : $_POST["direita"];
	$menuGET = (empty($_GET["menu"])) ? '' : $_GET["menu"];
	$menuPOST = (empty($_POST["menu"])) ? '' : $_POST["menu"];

	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	date_default_timezone_set('America/Recife');
	setlocale( LC_ALL, 'pt_BR.ISO-8859-1', 'pt_BR', 'Portuguese_Brazil');
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

	function __autoload ($classe) {
    $pos = strpos($classe, '_');
    if ($pos === false) {
      $nomeClasse = $classe;
      $dir='';
    } else {
      list($dir,$nomeClasse) = explode('_', $classe);
    }
		//$dir = strtr( $classe, '_','/' );
		if (file_exists("models/$dir/$classe.class.php")){
			require_once ("models/$dir/$classe.class.php");
		}elseif (file_exists("models/$classe.class.php")){
			require_once ("models/$classe.class.php");
		}
		//echo "<h1>$classe ** $dir</h1>";
		//echo "<h1>$classe ** $dir</h1>";
	}
	$igSede = new DBRecord('igreja', '1', 'rol');
  if (!empty($_GET["bsc_rol"])){
		$bsc_rol = intval($_GET["bsc_rol"]);
		//$_SESSION["rol"]=(int)$_GET["bsc_rol"];
	} elseif (!empty($_POST['bsc_rol'])) {
    $bsc_rol = intval($_POST["bsc_rol"]);
  }else {
		$bsc_rol=false;
		$membro = false;
  }
	if ($bsc_rol) {
			$membro = new DBRecord ("membro",$bsc_rol,"rol");
			if ($membro->rol()=='') {
				$membro = false;
			}
	}
	$titleIgreja = NOMEIGR.' &bull; '.CIDADEIG.'-'.UFIG;
	$campo_rol="Rol N&ordm;:"; //Quando a vari�vel de sess�o rol existir define 'Rol n�:' como legenda para o form listar dados do membro pelo rol
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $titleIgreja; ?></title>
<!-- <script src="js/jquery-3.1.1.min.js"></script> -->

<script type="text/javascript" src="js/funcoes.js"></script>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="menu.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="css/docs.min.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="css/calendario.css" />
<link type="text/css" rel="stylesheet" media="all" href="chat/css/chat.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="style.css" />
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">

<link href="css/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
<link href="css/easy-autocomplete.themes.min.css" rel="stylesheet" type="text/css">

<link rel="icon" type="image/gif" href="brasao.jpg">
</head>
<body>
<div class="wrap1">
  <div class="wrap2">
    <?php require_once 'menu.php';?>
      <div class="info1">
        <span class='text-marquee text-primary'>
          	E n&atilde;o vos embriagueis com vinho, em que h&aacute;
						contenda, mas enchei-vos do Esp&iacute;rito (Ef 5.18)
		 		</span>
      </div>
	  <?PHP
	// echo '<h1> SESSION[valid_user]- '.$_SESSION['valid_user'].'--Session[setor]-- '.$_SESSION['setor'].' - '.$_SESSION['nome'].'--Session[cid_end]-- '.$_SESSION['cid_end'].'</h1>';
       $mainpanelIni = '<div class="mainpanel">';
       $mainpanelFim = '</div>';
      if (!empty($_SESSION['valid_user'])) {
        if (!empty($dirGET) && !empty($dirPOST)) {
           $mainpanelIni = '';
           $mainpanelFim = '';
        }
      $secGET = (empty($_GET["sec"])) ? '' : $_GET["sec"];
		?>
<div class="leftpanel">
  <ul class="list-group">
	    <span class="list-group-item active">
			<h4 class="list-group-item-heading">Administra&ccedil;&atilde;o</h4>
	    </span>

			<div class="list-group">
				<a type="button" href="./?escolha=adm/dados_pessoais.php"
				class="list-group-item <?PHP echo item_info ("dados_pessoais");?>">
						<span class="glyphicon glyphicon-user text-info" ></span>&nbsp;Membros
				</a>

				<a type="button" href="./?escolha=adm/cadastro_membro.php&uf=PB"
				class="list-group-item <?PHP echo item_info ("cadastro_membro");?>">
						<span class="glyphicon glyphicon-download-alt text-info" ></span>&nbsp;Novo Cadastro
				</a>
				<a type="button" href="./?escolha=controller/secretaria.php&sec=1&uf=PB"
				class="list-group-item <?PHP echo item_ativo ($secGET, '1');?>">
				<span class="glyphicon glyphicon-hand-right text-info" >
				</span>&nbsp;Novos&nbsp;Convertidos
				</a>
				<a type="button" href="./?escolha=igreja/list_membro.php&menu=top_igreja"
				class="list-group-item <?PHP echo item_info ("igreja/");?>">
				<span class="glyphicon glyphicon-fire text-info"></span>&nbsp;Igrejas
				</a>
				<a type="button" href="./?escolha=controller/secretaria.php&sec=2&mes=<?PHP echo date('m');?>"
				class="list-group-item <?PHP echo item_ativo ($secGET, '2');?>">
				<span class="glyphicon glyphicon-calendar text-info" ></span>&nbsp;Agenda
				</a>
				<a type="button" href="./?escolha=tab_auxiliar/cadastro_bairro.php"
				class="list-group-item <?PHP echo item_info ("tab_auxiliar/");?>">
				<span class="glyphicon glyphicon-picture text-info" >
				</span>&nbsp;Cadastrar Bairro
				</a>
				<a type="button" href="./?escolha=relatorio/formularios.php&menu=top_formulario"
				class="list-group-item <?PHP echo item_info ("relatorio/");?>">
					<span class="glyphicon glyphicon-list-alt text-info" >
					</span>&nbsp;Ficha, Recibo e Certid&otilde;es
				</a>
				<a type="button" href="./?escolha=aniv/aniversario.php&menu=top_aniv"
				class="list-group-item <?PHP echo item_info ("aniv/");?>">
				<span class="glyphicon glyphicon-gift text-info" ></span>
				&nbsp;Aniversariantes
				</a>
				<a type="button" href="./?escolha=calendario/caledario.php"
				class="list-group-item <?PHP echo item_info ("caledario.php");?>">
				<span class="glyphicon glyphicon-tree-deciduous text-info" ></span>
				&nbsp;Santa&nbsp;Ceia
			</a>
	    <?php
	    	if ($_SESSION['nivel']>'10') {
	        $selItem = ($_GET['rec']=='25' || $_GET['rec']=='26') ?  'list-group-item-info': '' ;
	   	 ?>
				<a type="button" href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=25"
				class="list-group-item <?PHP echo item_info ("");?>">
				<span class="glyphicon glyphicon-save-file text-info" ></span>&nbsp;Backup
			</a>
	 	 <?php
	    	}
	    ?>
			</div>
		</ul>
     <?PHP
    // require_once ("autentica.php");
    ?>
</div>
<div id="content">
<?PHP
	} else {
	  echo '<div id="main-content">';
	}
	//Painel direito
	echo $mainpanelIni;
	if (!empty($_SESSION["valid_user"])){
		if (strstr($escGET,"adm/")){
			if (strstr($escGET,"adm/dados_pessoais"))
				require_once ("top_dados.php");
			else
				require_once ("views/secretaria/menuTopDados.php");
		}elseif (strstr($escPOST, "adm/")){
			if (strstr($escPOST,"adm/dados_pessoais"))
				require_once ("top_dados.php");
			else
				require_once ("views/secretaria/menuTopDados.php");
		}elseif ($menuGET!='') {
			require_once ($menuGET.'.php');
		}elseif (!empty($menuPOST)){
			require_once ($menuPOST.'.php');
		}elseif (strstr($escGET,"aniv/")){
			require_once ("top_aniv.php");
		}
		$cent = new central();//Chama o script da pagina de acordo com $_get ou $_post ["escolha"]
		require ($cent->get());
	}else {
		require_once ('views/login.php');
	}
	echo $mainpanelFim;
	if ($escGET<>"cetad/caixa.php" && $dirGET=='' && !empty($_SESSION['valid_user'])) {
	require_once ("painel_direito.php");
	}
?>
<!-- Fim do rightpanel -->
</div>
</div>
    <div class="info1">

	<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">

            <div class="info-box-content">
              <span class="info-box-text">&copy; 2016 Joseilton Costa Bruce Design</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">

            <div class="info-box-content">
              
			<span class="info-box-number">
				<span class="info-box-text"><a href="http://<?php echo $igSede->site();?>/"><?php echo $igSede->site();?></a></span>
			 </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">

            <div class="info-box-content">
              <span class="info-box-text"><a href="http://jigsaw.w3.org/css-validator/check/referer"></a></span>
              <a href="mailto:hiltonbruce@gmail.com"><span class="info-box-number">
      		</span> Joseilton - Bayeux - PB - Brasil</a> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">

            <div class="info-box-content">
              <span class="info-box-text"><img src="img/Eliu.png" alt="" width="88px"> </span>
              <span class="info-box-number">Sistema de controle para Igrejas Evang&eacute;licas</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>



	  <div style="display:inline; float:left;">
	   
	   </div>
	  <div style="display:inline; float:left; width:300px">
	 
	   </div>
	  <div style="display:inline; float:right;">
	  
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">// <![CDATA[
jQuery(function($) {
      $.mask.definitions['~']='[+-]';
			$('.money2').mask("~9.99 ~9.99 999", {reverse: true});
      $('#data').mask('99/99/9999');
      $('.dataclass').mask('99/99/9999');
      $('#expedicao').mask('99/99/9999');
      $('#venc').mask('99/99/9999');
      $('#ano').mask('9999');
      $('#mesnum').mask('99');
      $('#fone').mask('(99) 9999-9999');
      $('.fone').mask('(99) 9999-9999');
      $('#celular').mask('(99) 99999-9999');
      $('.celular').mask('(99) 99999-9999');
      $('#cpf').mask("999.999.999-99");
      $('.cpf').mask("999.999.999-99");
      $('#cpf_val').mask("999.999.999-99");
      $('#br').mask("999");
      $('#cep').mask("99.999-999");
      $('#cnpj').mask("99.999.999/9999-99");
      $('.cnpj').mask("99.999.999/9999-99");
   		$(".money").maskMoney({allowNegative: false, thousands:'.', decimal:','});
   });
// ]]&gt;</script>
<!-- <script type="text/javascript" src="js/funcoes.js"></script> -->
<!-- <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script> -->
<script type="text/javascript" src="js/jquery.maskedinput-1.4.1.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/alert.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>
<?php
  #Chamada para o Chat
  if (!empty($_SESSION['valid_user'])){
    //Descomenta para o chat funcionar
    echo '<script type="text/javascript" src="chat/js/chat.js"></script>';
    $batepapo = new chat('');
    echo $batepapo->incluir();
  }
?>
</html>
