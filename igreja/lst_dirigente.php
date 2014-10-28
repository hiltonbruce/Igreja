<?php

$query = "SELECT * from igreja ORDER BY razao";

$nmpp="20"; //Número de mensagens por párginas
$paginacao = Array();
$paginacao['link'] = "?"; //Paginação na mesma página
			
		//Faz os calculos na paginação
		$sql2 = mysql_query ($query) or die (mysql_error());
		$total = mysql_num_rows($sql2) ; //Retorna o total de linha na tabela
		$paginas = ceil ($total/$nmpp); //Retorna o total de páginas
		
		if ($_GET["pagina1"]<1) { 
			$_GET["pagina1"] = 1;
		} elseif ($_GET["pagina1"]>$paginas) {
			$_GET["pagina1"] = $paginas;
		}
		
		$pagina = $_GET["pagina1"]-1;
			
		if ($pagina<0) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
		$inicio=$pagina * $nmpp; //Retorna qual será a primeira linha a ser mostrada no MySQL
		$sql3 = mysql_query ($query." LIMIT $inicio,$nmpp") or die (mysql_error()); 
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
						
		 //inicia o cabeçalho de paginação
		
		{
		?>
		<table class='table table-hover table-striped table-bordered'>
		
		<caption>Lista de Dirigentes</caption>
		
			<colgroup>
				<col id="Rol">
				<col id="Nome">
				<col id="Dirigente Atual">
				<col id="albumCol"/>
			</colgroup>
			
			<thead>
				<tr>
				<th scope="col"><a href="./?escolha=igreja/list_membro.php&menu=top_igreja&ord=1&cargo=<?PHP echo $_GET["cargo"];?>&id=<?PHP echo $_GET["id"];?>&pagina1=<?PHP echo $_GET["pagina1"];?>" title="Ordenar por ROL">Rol
				<?PHP if ($_GET["ord"]=="1") {?>
				<img src="img/s_desc.png" width="11" height="9" border="0" />
				<?PHP } ?>
				</a></th>
				<th scope="col"><a href="./?escolha=igreja/list_membro.php&menu=top_igreja&cargo=<?PHP echo $_GET["cargo"];?>&id=<?PHP echo $_GET["id"];?>&pagina1=<?PHP echo $_GET["pagina1"];?>" title="Ordenar por nome">Dire&ccedil;&atilde;o - Atual<?PHP if ($_GET["ord"]=="") {?>
				<img src="img/s_desc.png" width="11" height="9" border="0" />
				<?PHP } ?>
				</a></th>
				<th scope="col">Congre&ccedil;&atilde;o</th>
				<th scope="col">Cargo</th>
				</tr>
			</thead>
			<tbody>
		<?PHP
			
			while($coluna = mysql_fetch_array($sql3))
			{
			
			?>
            <tr>

				<td><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo (int)$coluna["pastor"];?>"><?php echo (int)$coluna["pastor"];?></a></td>
				
				<td><?php
					$rol_dirigente = (int) $coluna["pastor"];
					if ($rol_dirigente>0){
						$nome = new DBRecord ("membro",$coluna["pastor"],"rol");
						$nome_dirigente = $nome->nome();}
					else{
						$nome_dirigente = $coluna["pastor"];}
						
					?>					
					<a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $coluna["pastor"];?>"><?php echo $nome_dirigente;?></a></td>
				<td><?php echo $coluna["razao"];?></td>
				<td><?php echo cargo ($coluna["pastor"]);?></td>
				
			<?PHP 
			
			}//loop while produtos
			
	?>	
		</tbody>
		</table>

	<?PHP
	}

	//Classe que monta o rodape
	$_rod = new rodape($paginas,$_GET["pagina1"],"pagina1",$_urlLi,8);//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
	$_rod->getRodape(); $_rod->form_rodape ("Ir para P&aacute;gina: ");
	//$_rod->getDados();
	if ($paginas>1)
		echo "<br><span class='style4'>Total de $paginas p&aacute;ginas";
		else
		echo "<br><span class='style4'>Total de $paginas p&aacute;gina";
		
	echo "<br />";
	if ($total>"1")
	{
		if ($total>"100")
			printf("Com %s dirigentes!",number_format($total, 0, ',', '.'));
		else
			printf("Com %s dirigentes!",number_format($total, 0, ',', '.'));
			
	}elseif ($total=="1"){
		echo "Com apenas um dirigente!";
	}else{
		echo "N&atilde;o obtivemos nenhum resultado!";
	}