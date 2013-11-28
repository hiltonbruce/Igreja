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
Aniversariantes de Casamento
<?PHP 
$aniv = new aniversario;

if ($_GET["proxima"]=="" || $_GET["proxima"]=="0"){
	echo " de Hoje";
}else {
	echo "do Dia: ".$aniv->data_consulta ();}

?>
 
</caption>

<colgroup>
<col id="PlaylistCol" />
<col id="Anos" />
<col id="Nome" />
<col id="Congrega" />
<col id="albumCol" />
</colgroup>

<thead>
<tr>
<th id="" scope="col">Ano(s)</th>
<th scope="col"><a href="./?escolha=aniv/casamento.php&menu=top_aniv&ord=1" title="Ordenar por ROL">Rol
<?PHP if ($_GET["ord"]=="1") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a></th>
<th scope="col"><a href="./?escolha=aniv/casamento.php&menu=top_aniv" title="Ordenar por nome">Nome<?PHP if ($_GET["ord"]=="") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a></th>
<th scope="col"><a href="./?escolha=aniv/casamento.php&menu=top_aniv&ord=2" title="Ordenar por Congrega&ccedil;&atilde;o">Congrega&ccedil;&atilde;o
  <?PHP if ($_GET["ord"]=="2") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a></th>
<th scope="col">Cargo</th>
</tr>
</thead>

<tbody>

<?PHP
$aniv->casamento();
?>
</tbody>

</table>
Voc&ecirc; pode ordenar por Rol, Nome e Congrega&ccedil;&atilde;o &quot;click&quot; no cabe&ccedil;alho. Por padr&atilde;o ele ordena pelo nome do membro. 