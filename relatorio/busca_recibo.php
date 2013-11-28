<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
<fieldset>
<legend>Recibos</legend>
<?PHP
controle ("consulta");
//echo "<h1>".trim($_GET["valor"])."</h1>";
if (!empty($_GET['campo']))
	{
		$query = "SELECT * FROM recibos WHERE ";
		switch ($_GET["campo"]) {
			case "dt_nasc":
				$query .= " DATE_FORMAT(dt_nasc,'%d/%m/%Y') = '".trim($_GET["valor"])."' ORDER BY nome ";
				break;
			case "data":
				$query .= " DATE_FORMAT(data,'%d/%m/%Y') = '".trim($_GET["valor"])."' ORDER BY nome ";
				break;
			default:
				$query .= "{$_GET["campo"]} LIKE '%".trim($_GET["valor"])."%' ORDER BY nome ";
				break;		
		}
		$nmpp="5"; //Número de mensagens por párginas
		$paginacao = Array();
		$paginacao['link'] = "?"; //Paginação na mesma página
			
		//Faz os calculos na paginação
		$sql2 = mysql_query ("$query") or die (mysql_error());
		$total = mysql_num_rows($sql2) ; //Retorna o total de linha na tabela
		$paginas = ceil ($total/$nmpp); //Retorna o total de páginas
		$pagina = $_GET["pagina1"];
			
		if (!isset($pagina)) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
		$inicio=$pagina * $nmpp; //Retorna qual será a primeira linha a ser mostrada no MySQL
		$sql3 = mysql_query ("$query"." LIMIT $inicio,$nmpp") or die (mysql_error()); 
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
						
		 //inicia o cabeçalho de paginação
		
		{
		?>
		<table cellspacing="0" >
		
			<colgroup>
				<col id="Data">
				<col id="Nome">
				<col id="Tipo">
				<col id="albumCol"/>
			</colgroup>
			
			<thead>
				<tr>
					<th scope="col">Data</th>
					<th scope="col">Nome</th>
					<th scope="col">Tipo</th>					
					<th scope="col">Recebeu</th>					
				</tr>
			</thead>
			<tbody>
		<?PHP
			
			while($coluna = mysql_fetch_array($sql3))
			{
			
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
				<td><?php echo conv_valor_br ($coluna["dt_apresent"]);?></td>
				<td><a href="./?escolha=relatorio/dados_apresent.php&menu=top_formulario&rol=<?php echo $coluna["rol"];?>"><?php echo $coluna["nome"];?></a></td>
				<td><?php echo $coluna["pai"];?></td>
				<td><?php echo $coluna["mae"];?></td>
			</tr>
			<?PHP
			
			}//loop while produtos
			
	?>	
		</tbody>
		</table>

	<?PHP
	}

	$_urlLi="escolha=adm/rest_busca.php&nome=".trim($_GET["nome"]);//Montando o Link para ser passada a classe
	//Classe que monta o rodape
	$_rod = new rodape($paginas,$_GET["pagina1"],"pagina1",$_urlLi,8);//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
	$_rod->getRodape();
	//$_rod->getDados();
	if ($paginas>1)
		echo "<br><span class='style4'>Total de $paginas p&aacute;ginas";
		else
		echo "<br><span class='style4'>Total de $paginas p&aacute;gina";
		
	echo "<br />";
	if ($total>"1")
	{
		if ($total>"100")
			printf("Com %s ocorr&ecirc;ncias! Tente melhorar seu argumento de pesquisa, para restringir um pouco mais o resultado!",number_format($total, 0, ',', '.'));
		else
			printf("Com %s ocorr&ecirc;ncias!",number_format($total, 0, ',', '.'));
			
	}elseif ($total=="1")
	{
		echo "Com apenas uma ocorr&ecirc;ncias!";
	}else
	{
		echo "Com este crit&eacute;rio n&atilde;o obtivemos nenhum resultado, tente melhorar seu argumento de pesquisa!";
	}
}else
{
	echo "Voc&ecirc; n&atilde;o colocou nenhum crit&eacute;rio de pesquisa!";	
}

?>
</fieldset>