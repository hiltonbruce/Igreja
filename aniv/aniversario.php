<?PHP

$anterior=$_GET["proxima"]-1;
$proximo=$_GET["proxima"]+1;

if ($_GET["Submit"]=="Imprimir") {

session_start();
require_once ("../func_class/funcoes.php");
require_once ("../func_class/classes.php");

controle ("consulta");
$igreja = new DBRecord ( 'igreja', '1', 'rol' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo $titTabela;?></title>
<link rel="stylesheet" type="text/css" href="../tabs.css" />
<link rel="icon" type="image/gif" href="../br_igreja.jpg">
</head>
<body>
<div id="header">
	<p>
	<?PHP
	//print_r($igreja);
	echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} <br /> $origem - {$igreja->uf()} - CNPJ: {$igreja->cnpj()}<br />
	CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?>
	<br />Copyright &copy; <a rel="nofollow" href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information">Site&nbsp;</a>
    <br />Email: <a href="mailto: <?PHP echo "{$igreja->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>

<?php

	$fimPagina = ' <div id="footer">
    Copyright &copy; 2016  Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
    </div>
</body>
</html>';

}else {
	$fimPagina = 'Voc&ecirc; pode ordenar por Rol, Nome e Congrega&ccedil;&atilde;o &quot;click&quot; no cabe&ccedil;alho. Por padr&atilde;o ele ordena pelo nome do membro.
';
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
} else {
    $cong_sele = " - Todas as congrega&ccedil;&otilde;es";
}
?>
<table cellspacing="0" id="listTable" class='table' summary="Idade, Rol, Nome, Congregação e Cargo">
<caption>
Lista de Aniversariantes
<?PHP
$aniv = new aniversario;

if ($_GET["proxima"]=="" || $_GET["proxima"]=="0"){
	echo " de hoje";
}else {
	echo "do dia: ".$aniv->data_consulta ();
}
echo $cong_sele;
?>
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
<th id="" scope="col">Idade</th>
<th scope="col"><a href="./?escolha=aniv/aniversario.php&menu=top_aniv&ord=1" title="Ordenar por ROL">Rol
<?PHP if ($_GET["ord"]=="1") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a></th>
<th scope="col"><a href="./?escolha=aniv/aniversario.php&menu=top_aniv" title="Ordenar por nome">Nome<?PHP if ($_GET["ord"]=="") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a></th>
<th scope="col"><a href="./?escolha=aniv/aniversario.php&menu=top_aniv&ord=2" title="Ordenar por Congrega&ccedil;&atilde;o">Congrega&ccedil;&atilde;o
  <?PHP if ($_GET["ord"]=="2") {?>
<img src="img/s_desc.png" width="11" height="9" border="0" />
<?PHP } ?>
</a></th>
<th scope="col">Cargo</th>
</tr>
</thead>
<tbody>
<?PHP
$aniv->nome_dia();
?>
</tbody>
</table>
<?php
	echo $fimPagina ;
?>
