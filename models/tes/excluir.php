<?php 
	$id = (int)$_GET["id"];
	$tabela = $_GET["tabela"];
?>
<script>
	function pergunta() {
		var p=window.confirm("CONFIRME! Para APAGAR o registro <?PHP echo $id;?>");
		window.location=(p) ? "./?conf=ok&escolha=models/tes/excluir.php&tabela=<?php echo $tabela;?>&id=<?php echo $id;?>" : "./?escolha=tesouraria/receita.php&igreja=&menu=top_tesouraria&rec=1";}
</script>
<?PHP
controle ("tes");

	//Deleta dados na tadela indicada por $_POST['tabela']
	
	if (empty($_GET["conf"])){
		echo "<script>pergunta();</script>";
		echo '<a href="./?conf=ok&escolha=models/tes/excluir.php&tabela=dizimooferta&id='.$id.'">
				Você realmente deseja apagar?</a>';
		exit;
	}
	
	if ($tabela=='dizimooferta') {
		$ver = mysql_query('DELETE FROM '.$tabela.' WHERE id='.$id.' AND lancamento="0" ') or die (mysql_error());
	}else {
		$ver = mysql_query("DELETE FROM $tabela WHERE id=$id ") or die (mysql_error());
	}

		if($ver){
				echo "<script> alert('Apagado com sucesso');window.history.go(-1);</script></a>";
				echo "Item apagado com sucesso<br><a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=9'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "Não foi possível apagar, apresentou o seguite erro:  '$erro'";
				}
				
 ?> 