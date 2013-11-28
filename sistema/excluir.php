<?PHP

controle ("deletar");

	//Deleta dados na tadela indicada por $_POST['tabela']
		
	$id = (int)$_GET["id"];
	$tabela = htmlEntities ($_GET["tabela"], ENT_QUOTES, "ISO-8859-1" );
	$campo = htmlEntities ($_GET["campo"], ENT_QUOTES, "ISO-8859-1");
	

		$ver = mysql_query("DELETE FROM $tabela WHERE $campo =$id LIMIT 1") or die (mysql_error());

		if($ver){
				echo "<script> alert('Apagado com sucesso');window.history.go(-1);</script></a>";
				echo "Item apagado com sucesso<br><a href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf=PB'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "Não foi possível apagar, apresentou o seguite erro:  '$erro'";
				}
				
 ?> 