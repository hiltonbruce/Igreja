<script>
	function pergunta() {
		var p=window.confirm("OK para APAGAR?");
		window.location=(p) ? "./?conf=ok&escolha=tesouraria/receita.php&menu=top_tesouraria&rec=10&idDizOf=<?php echo $id;?>" : "./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=9&idDizOf=<?php echo $id;?>";}
</script>
<?PHP
controle ("tes");

	//Deleta dados na tadela indicada por $_POST['tabela']
	
	if (empty($_GET["conf"])){
		echo "<script>pergunta();</script>";
		echo '<a href="./?conf=ok&escolha=tesouraria/receita.php&menu=top_tesouraria&rec=10&idDizOf='.$id.'">
				Você realmente deseja apagar?</a>';
		exit;
	}
	

		$ver = mysql_query("DELETE FROM $tabela WHERE $campo=$id LIMIT 1") or die (mysql_error());

		if($ver){
				echo "<script> alert('Apagado com sucesso');window.history.go(-2);</script></a>";
				echo "Item apagado com sucesso<br><a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=9'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "Não foi possível apagar, apresentou o seguite erro:  '$erro'";
				}
				
 ?> 