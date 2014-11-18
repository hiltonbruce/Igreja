<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />

<?PHP

controle ("consulta");
$ordenar = new igreja ();

if ($_GET["foto"]=='1')
	$com_sem = "com";
	elseif ($_GET["foto"]=='2')
	$com_sem = "sem";

$_urlLi="?escolha=igreja/list_membro.php&menu=top_igreja&ord={$_GET["ord"]}&cargo={$_GET["cargo"]}&id=".($_GET["id"]);//Montando o Link para ser passada a classe

$query = "SELECT * from membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND e.situacao_espiritual<2 ".$ordenar->cargo()." ORDER BY ".$ordenar->ordenar();

		//Faz os calculos na paginação
		$sql2 = mysql_query ($query) or die (mysql_error());

		$contador_array = array ();

		?>
		<table class='table table-striped table-hover' >
		<caption>
		Lista de Membros <?php echo $com_sem;?> Fotos
			<?PHP
			$igreja = new DBRecord ("igreja",$_GET["id"],"rol");

			if ($_GET["id"]>0) {
				echo " - Igreja: {$igreja->razao()}";
			}

			?>
		</caption>

			<colgroup>
				<col id="Rol">
				<col id="Nome">
				<col id="Congrega&ccedil;&atilde;o">
				<col id="albumCol"/>
			</colgroup>

			<thead>
				<tr>
				<th scope="col"><a href="./?escolha=igreja/list_membro.php&menu=top_igreja&ord=1&cargo=<?PHP echo $_GET["cargo"];?>&id=<?PHP echo $_GET["id"];?>&pagina1=<?PHP echo $_GET["pagina1"];?>" title="Ordenar por ROL">Rol
				<?PHP if ($_GET["ord"]=="1") {?>
				<img src="img/s_desc.png" width="11" height="9" border="0" />
				<?PHP } ?>
				</a></th>
				<th scope="col"><a href="./?escolha=igreja/list_membro.php&menu=top_igreja&cargo=<?PHP echo $_GET["cargo"];?>&id=<?PHP echo $_GET["id"];?>&pagina1=<?PHP echo $_GET["pagina1"];?>" title="Ordenar por nome">Nome<?PHP if ($_GET["ord"]=="") {?>
				<img src="img/s_desc.png" width="11" height="9" border="0" />
				<?PHP } ?>
				</a></th>
				<th scope="col"><a href="./?escolha=igreja/list_membro.php&menu=top_igreja&cargo=<?PHP echo $_GET["cargo"];?>&ord=2&id=<?PHP echo $_GET["id"];?>&pagina1=<?PHP echo $_GET["pagina1"];?>" title="Ordenar por Congrega&ccedil;&atilde;o">Congrega&ccedil;&atilde;o<?PHP if ($_GET["ord"]=="2") {?>
				<img src="img/s_desc.png" width="11" height="9" border="0" />
				<?PHP } ?>
				</a></th>
				<th scope="col">Cargo</th>
				</tr>
			</thead>
			<tbody>
		<?PHP
	/*echo '<pre>';
      print_r ($contador_array);
    echo '</pre>';
	*/




	while($coluna = mysql_fetch_array($sql2)){

			if (!(file_exists("img_membros/".$coluna["rol"].".jpg")) AND $_GET["foto"]=='2'){
				array_push($contador_array, array("rol" => $col_array["rol"],"nome"=>$col_array["nome"],"congrecao"=>$col_array["congrecao"]));

		//$contador_array = count($coluna);

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
				<td class='text-center'><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $coluna["rol"];?>"><?php echo $coluna["rol"];?></a></td>
				<td><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $coluna["rol"];?>"><?php echo $coluna["nome"];?></a></td>
				<td>
					<?php
						$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
						echo $congregacao->razao();
					?>
				</td>
				<td>
					<?php
						echo cargo ($coluna["rol"]);
					?>
				</td>
			</tr>
			<?PHP
			}
			elseif (file_exists("img_membros/".$coluna["rol"].".jpg") AND $_GET["foto"]=='1'){
			array_push($contador_array, array("rol" => $col_array["rol"],"nome"=>$col_array["nome"],"congrecao"=>$col_array["congrecao"]));

		//$contador_array = count($coluna);

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
				<td><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $coluna["rol"];?>"><?php echo $coluna["rol"];?></a></td>
				<td><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $coluna["rol"];?>"><?php echo $coluna["nome"];?></a></td>
				<td>
					<?php
						$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
						echo $congregacao->razao();
					?>
				</td>
				<td>
					<?php
						echo cargo ($coluna["rol"]);
					?>
				</td>
			</tr>
			<?PHP
			}//Fim if file_exists fotos
			}//loop while produtos

	?>
		</tbody>
		</table>

	<?PHP
	$total = mysql_num_rows($sql2);
	$contador_ = count($contador_array);

	if ($contador_>1)
		echo "<h3>Temos $contador_ membros $com_sem foto nesta congrega&ccedil;&atilde;o! Num total de $total.</h3>";
	elseif ($contador_==1)
		echo "<h3>Temos um membro $com_sem foto! Num total de $total.</h3>";
	elseif ($contador_==0)
		echo "<h3>N&atilde;o Temos nenhum membro $com_sem foto nesta congrega&ccedil;&atilde;o! Num total de $total.</h3>";

?>
