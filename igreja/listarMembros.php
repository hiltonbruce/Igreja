<?PHP
controle ("consulta");
$ordenar = new igreja ();
$arrayIg =$ordenar->Arrayigreja();

	$query  = 'SELECT * from membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND ';
	$query .= 'e.situacao_espiritual<=2'.$ordenar->cargo().' ORDER BY '.$ordenar->ordenar();

	//Faz os calculos na paginação
	$sql3 = mysql_query ($query) or die (mysql_error());
	$total = mysql_num_rows($sql3) ; //Retorna o total de linha na tabela
	$paginas = ceil ($total/$nmpp); //Retorna o total de páginas

	//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array

	 //inicia o cabeçalho de paginação
	 	$titTabela = strip_tags($_GET['titTabela']);

		{
		?>
		<table class='table table-hover table-striped table-bordered' >
		<caption>
		Lista de Membros
			<?PHP
			echo $titTabela;
			if ($_GET["id"]>0) {
				echo ' - Igreja: '.$arrayIg[$_GET["id"]]['0'];
			}
			?>
		</caption>
			<colgroup>
				<col id="Rol">
				<col id="Nome">
				<col id="Congrega&ccedil;&atilde;o">
				<col id='Setor'>
				<col id="albumCol"/>
			</colgroup>
			<thead>
				<tr>
				<th scope="col">Rol</th>
				<th scope="col">Nome
					<?PHP if ($_GET["ord"]=="") {?>
				<img src="../img/s_desc.png" width="11" height="9" border="0" />
				<?PHP } ?>
				</th>
				<th scope="col">Congrega&ccedil;&atilde;o
					<?PHP if ($_GET["ord"]=="2") {?>
				<img src="../img/s_desc.png" width="11" height="9" border="0" />
				<?PHP } ?>
				</th>
				<th scope="col">Setor</th>
				<th scope="col">Cargo</th>
				</tr>
			</thead>
			<tbody>
		<?PHP
			while($coluna = mysql_fetch_array($sql3))
			{
				$numRol = sprintf("%'04u", $coluna["rol"]);
			?>
      <tr>
				<td><?php echo $numRol;?></td>
				<td>
						<div class="row">
	  					<div class="col-xs-2">
							<img src='<?php echo foto($coluna["rol"]);?>' class='thumb'
							 alt='Foto do Membro' width='24' height='32' />
						</div>
	  				<div class="col-xs-6">
							<?php echo $coluna["nome"];?>
						</div>
					</div>
				<td>
					<?php
						echo $arrayIg[$coluna["congregacao"]]['0'];
					?>
				</td>
				<td class='text-center'>
					<?php
						echo nRomano($arrayIg[$coluna["congregacao"]]['5']);
					?>
				</td>
				<td>
					<?php
						echo cargo ($coluna["rol"]);
					?>
				</td>
			</tr>
			<?PHP
			}//loop while produtos
	?>
		</tbody>
		</table>
	<?PHP
	}

		echo "<br />";
		if ($total>"1") {
			printf("Com %s membros!",number_format($total, 0, ',', '.'));
		}elseif ($total=="1"){
			echo "Com apenas um Membro!";
		}else{
			echo "Com este crit&eacute;rio n&atilde;o obtivemos nenhum resultado, tente melhorar seu argumento de pesquisa!";
		}
?>
