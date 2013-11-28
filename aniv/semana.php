<?PHP
  
$anterior=$_GET["proxima"]-1;
$proximo=$_GET["proxima"]+1;

if ($_GET["Submit"]=="Imprimir") {

	session_start();
	require_once ("../func_class/funcoes.php");
	require_once ("../func_class/classes.php"); 
	controle ("consulta");
	echo "<style type='text/css'> <!--";
	require_once ("style.css");
	echo "</style>";
}else {
echo "<style type='text/css'> <!--";
	require_once ("aniv/style.css");
?>
</style>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<?PHP 
	require_once ("aniv/navega.php");
} 
//Código para exibir de qual congregação é a lista de aniversariantes
$congrega = new DBRecord ("igreja","{$_GET["congregacao"]}","rol");
if ($_GET["congregacao"]>"0" ) {
	$cong_sele = " - Congrega&ccedil;&atilde;o: ".$congrega->razao();
}
?>
<table cellspacing="0" id="playlistTable" summary="Top 15 songs played. Top artitst include Coldplay, Yeah Yeah Yeahs, Snow Patrol, Deeper Water, Kings of Leon, Embrace, Oasis, Franz Ferdinand, Jet, The Bees, Blue States, Kaiser Chiefs and Athlete.">
<caption>
Lista de Aniversariantes da Semana <?PHP echo $cong_sele;?>
</caption>

<colgroup>
<col id="PlaylistCol" />
<col id="Rol" />
<col id="Nome" />
<col id="Congrega" />
<col id="albumCol" />
</colgroup>

<thead>
<tr>
<th scope="col">
<?PHP if ($_GET["Submit"]!=="Imprimir") {?>
	<a href="./?escolha=aniv/semana.php&menu=top_aniv&ord=3&proxima=<?PHP echo $_GET["proxima"];?>&congregacao=<?PHP echo $_GET["congregacao"];?>" title="Ordenar por Data">Dia 
	<?PHP if ($_GET["ord"]=="3") {?>
	<img src="img/s_desc.png" width="11" height="9" border="0" />
	<?PHP } ?>
	</a>
<?PHP
	}else { echo "<strong>Dia</strong>"; }
?> 

</th>
<th scope="col">
<?PHP if ($_GET["Submit"]!=="Imprimir") {?>
	<a href="./?escolha=aniv/semana.php&menu=top_aniv&ord=1&proxima=<?PHP echo $_GET["proxima"];?>&congregacao=<?PHP echo $_GET["congregacao"];?>" title="Ordenar por ROL">Rol
	<?PHP if ($_GET["ord"]=="1") {?>
		<img src="img/s_desc.png" width="11" height="9" border="0" />
	<?PHP } ?>
	</a>

<?PHP
	}else { echo "<strong>Rol</strong>"; }
?>

</th>
<th scope="col">
<?PHP if ($_GET["Submit"]!=="Imprimir") {?>
<a href="./?escolha=aniv/semana.php&menu=top_aniv&proxima=<?PHP echo $_GET["proxima"];?>&congregacao=<?PHP echo $_GET["congregacao"];?>" title="Ordenar por nome">Nome<?PHP if ($_GET["ord"]=="") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a>
<?PHP
	}else { echo "<strong>Nome</strong>"; }
?>
</th>
<th scope="col">
<?PHP if ($_GET["Submit"]!=="Imprimir") {?>
<a href="./?escolha=aniv/semana.php&menu=top_aniv&ord=2&proxima=<?PHP echo $_GET["proxima"];?>&congregacao=<?PHP echo $_GET["congregacao"];?>" title="Ordenar por Congrega&ccedil;&atilde;o">Congrega&ccedil;&atilde;o
  <?PHP if ($_GET["ord"]=="2") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a>
<?PHP
	}else { echo "<strong>Congrega&ccedil;&atilde;o</strong>"; }
?>
</th>
<th scope="col"><strong>Cargo</strong></th>
</tr>
</thead>

<tbody>

<?PHP
$aniv= new aniversario;
$aniv->semana();
?>
</tbody>

</table>
<?PHP if ($_GET["Submit"]!=="Imprimir") {?>
<p>Voc&ecirc; pode ordenar por Rol, Nome e Congrega&ccedil;&atilde;o &quot;click&quot; no cabe&ccedil;alho. Por padr&atilde;o ele ordena pela data.</p>
<?PHP } ?>
