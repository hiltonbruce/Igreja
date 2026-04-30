<!-- Lan�amento para o caixa do Dep de Ensino -->
<?php
if ($_POST["rol"]!='') {
	//Se for informado o rol, ent�o traz o nome do banco
	$nomecont = new DBRecord('membro', $_POST["rol"], 'rol');
	$rolMembro = $nomecont -> rol();
	if ($_POST["nome"]!='')  {
		$nome = $_POST["nome"];
	}else {
		$nome = $nomecont -> nome();
	}
	$eclesia = new DBRecord('eclesiastico', $_POST["rol"], 'rol');
	$congcontrib = $eclesia->congregacao();
} else {
	$nome = '';
}
//corrigir os post para oferta...
for ($i = 0; $i < 3; $i++) {

	$campo = 'oferta'.$i;
	//printf ("$campo: %s",$_POST["$campo"]);

	$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );//Captura o valor e vonverte p o padr�o americano

	if ($valor>0) {

		switch ($i) {
			case 1:
				$conta = "'801','4','1'";//Corpo de Professores da EBD
				break;
			case 2:
				$conta = "'803','4','9'";//Revistas sem provis�o p caixa de evangeliza��o
				break;
			default:
				$conta = "'800','4','1'";//Ofertas
				break;
		}

		$congcontrib = ($congcontrib=='') ? $_POST["igreja"]:$congcontrib;

		//$valor = strtr( str_replace(".","",$_POST["$campo"]), ',','. ' );
		$value  = "NULL,NULL,$conta,'".$congcontrib."','$rolMembro','$nome','$valor',";
		$value .= "'$y-$m-$d','$sem','{$_POST["mes"]}','{$_POST["ano"]}','{$rolIgreja}','{$_SESSION['valid_user']}',";
		$value .= "'".$confirma."','{$_POST["obs"]}',NOW(),'$hist'";
		$dados = new insert ($value,"dizimooferta");
		$dados->inserir();
	}

}
?>
