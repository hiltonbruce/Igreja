 <?PHP 
			$sql="select * from noticia ORDER BY id DESC"; //traz os dados do banco conforme pesquisa
			$nmpp="1"; //N&uacute;mero de mensagens por p&aacute;rginas
			$paginacao = Array();
			$paginacao['link'] = "?"; //Pagina&ccedil;&atilde;o na mesma p&aacute;gina
				
			//Faz os calculos na pagina&ccedil;&atilde;o
			$sql2 = mysql_query ("select * from noticia ORDER BY id DESC") or die (mysql_error());
			$total = mysql_num_rows($sql2); //Retorna o total de linha na tabela
			$paginas = ceil ($total/$nmpp); //Retorna o total de p&aacute;ginas
		
		if ($_GET["pagina1"]<1) { 
			$_GET["pagina1"] = 1;
		} elseif ($_GET["pagina1"]>$paginas) {
			$_GET["pagina1"] = $paginas;
			}
		
		$pagina = $_GET["pagina1"]-1;
			
			if ($pagina<1) {$pagina=0;} //Especifica um valor p vari&aacute;vel p&aacute;gina caso ela esteja setada
			$inicio=$pagina * $nmpp; //Retorna qual ser&aacute; a primeira linha a ser mostrada no MySQL
			$sql3 = mysql_query ("select * from noticia  ORDER BY id DESC LIMIT $inicio, $nmpp "); //Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
			//$data_br= mysql_query ("select (DATE_FORMAT(saida,'%d %m %Y %H %i %s)");
						

		  
		 //inicia o cabe&ccedil;alho de pagina&ccedil;&atilde;o
					
		  				while($coluna = mysql_fetch_array($sql3))
						{
						$noticia = $coluna["noticia"];
						$titulo = $coluna["titulo"];
						$autor = $coluna["autor"];
						$data = $coluna["data"];
						
				?>
  <h2><?php echo "$titulo"; ?></h2>
  <h3><?PHP echo "$noticia"; ?></h3>
  <h5><?PHP echo "$autor"; ?></h5>
  <h4>Em: <?PHP echo conv_valor_br ($data); ?></h4>

 <?php }
	
	$_urlLi="?escolha=relatorio/formularios.php&menu=".trim($_GET["menu"]);//Montando o Link para ser passada a classe
	//Classe que monta o rodape
	$_rod = new rodape($paginas,$_GET["pagina1"],"pagina1",$_urlLi,3);//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
	$_rod->getRodape();
	//$_rod->getDados();
	if ($paginas>1)
		echo "<br>Total de $paginas mensagens";
		else
		echo "<br>Total de $paginas mensagem";
		
		$_rod->form_rodape ("Listar Mensagem:");

?>