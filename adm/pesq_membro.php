<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Pesquisa rol e nome do conjugue</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../tabs.css" />
<?PHP
$campo = $_GET["campo"];
$rol = $_GET["rol"];
$form = (int)$_GET["form"];//O número da seqência do formulário se o 1 para 1º, 2 para 2º..., dentro da página
//echo " - $form - ";
?>
<script language="JavaScript">

function actualiza(miColor,miColor2){
	window.opener.document.bgColor = miColor
	window.opener.document.forms[<?PHP echo $form;?>].<?PHP echo $campo;?>.value = miColor
	window.opener.document.forms[<?PHP echo $form;?>].<?PHP echo $rol;?>.value = miColor2
}
</script>
<style type="text/css">
<!--
#loading {
 	width: 200px;
 	height: 100px;
 	position: absolute;
	background-color:#FFFF66;
 	left: 50%;
 	top: 50%;
 	margin-top: -150px;
 	margin-left: -100px;
 	text-align: center;
}
-->
</style>


<script type="text/javascript">
<!--
/* This script and many more are available free online at
The JavaScript Source :: http://javascript.internet.com
Created by: Robert Paulson :: http://www.abrahamjoffe.com.au/ */

document.write('<div id="loading"><br><br><img src="../img/loading2.gif" width="20" height="20">Aguarde...</div>');

// Created by: Simon Willison | http://simon.incutio.com/
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(function() {
  document.getElementById("loading").style.display="none";
});

//-->
</script>
</head>

<body bgcolor=#C9E9F8 link=000000 alink=000000 vlink=000000 >
<fieldset>
<legend>Procurar  por Nome teste </legend>
<form id="form" name="form" method="get" action="">
  <input name="nome" type="text" id="nome" size="15" tabindex="1" /> 
  <input name="rol" type="hidden" id="rol" value="<?PHP echo $_GET["rol"];?>" />
  <input name="nome_pesp" type="hidden" id="nome_pesq" value="<?PHP echo $_GET["nome_pesq"];?>" />
  <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
  <input name="form" type="hidden" id="n_form" value="<?PHP echo "$form";?>" /> 
  <input type="image" src="../img/lupa_32x32.png" height="16" width="16" name="Submit" value="submit" alt="procurar" title="Click aqui para fazer a pesquisa"/>
</form>
</fieldset>
<?PHP
require_once ("../func_class/funcoes.php");
require_once ("../func_class/classes.php");
if (!empty($_GET['nome']))
	{
		conectar();
		$query = "SELECT rol, nome FROM membro WHERE nome LIKE '%".trim($_GET["nome"])."%' ORDER BY nome ";
		$nmpp="4"; //Número de mensagens por párginas
		$paginacao = Array();
		$paginacao['link'] = "?"; //Paginação na mesma página
			
		//Faz os calculos na paginação
		$sql2 = mysql_query ("$query") or die (mysql_error());
		$total = mysql_num_rows($sql2) ; //Retorna o total de linha na tabela
		$paginas = ceil ($total/$nmpp); //Retorna o total de páginas
		
		if ($_GET["pagina1"]<1) { 
			$_GET["pagina1"] = 1;
		} elseif ($_GET["pagina1"]>$paginas) {
			$_GET["pagina1"] = $paginas;
		}
				
		$pagina = $_GET["pagina1"]-1;
			
		if ($pagina<1) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
		$inicio=$pagina * $nmpp; //Retorna qual será a primeira linha a ser mostrada no MySQL
		$sql3 = mysql_query ($query." LIMIT $inicio,$nmpp") or die (mysql_error()); 
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
						
		 //inicia o cabeçalho de paginação
		
		{
		?>
		<table cellspacing="0" >
			<caption>Lista de Membros</caption>
			
			<colgroup>
				<col id="foto">
				<col id="rol"/>
				<col id="albumCol"/>
			</colgroup>
			
			<thead>
				<tr>
					<th scope="col">Foto</th>
					<th scope="col">Rol</th>
					<th scope="col">Nome</th>
				</tr>
			</thead>
			<tbody>
		<?PHP
			
			while($coluna = mysql_fetch_array($sql3))
			{
			
			 if (file_exists("../img_membros/".$coluna["rol"].".jpg"))
			 	{
				$img=$coluna["rol"].".jpg";
				//echo "<h3> - img $img </h3>";
				}
				else
				{
				$img="ver_foto.jpg";
				}
				
			$ls+=1;
			if ($ls>1)	
					{
					$cor="class='odd'";
					$ls=0;
					}
					else 
					{$cor="class='od2'";
					}
			?>
            <tr "<?php echo "$cor";?>">
				<td>
				<script>
					var nome="<?PHP echo $coluna["nome"]; ?>";
					var rol="<?PHP echo $coluna["rol"]; ?>";
					document.write("<a href=\"javascript:actualiza('" + nome + "','"+ rol +"');window.close()\">");
					document.write( "<img border='0' src=../img_membros/<?PHP echo $img;?>  width='84' height='107' align='absbottom' title='"+nome+"'>" );
				</script>
				</td>
				<td><?php echo $coluna["rol"];?></td>
				<td><?php echo $coluna["nome"];?></td>
			</tr>
			<?PHP
			
			}//loop while produtos
			
	?>	
		</tbody>
		</table>

	<?PHP
	}

	$_urlLi="pesq_membro.php?nome=".$_GET["nome"]."&campo=".$_GET["campo"]."&rol=".$_GET["rol"]."&form=".$_GET["form"];//Montando o Link para ser passada a classe
	//Classe que monta o rodape
	$_rod = new rodape($paginas,"{$_GET["pagina1"]}","pagina1","$_urlLi",8);//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
	
	$_rod->getRodape();
	
	}

?>

</body>
</html>

