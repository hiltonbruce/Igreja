<fieldset>
<legend>Busca por trechos do Nome</legend>
<?PHP
if (!empty($_GET['nome']))
	{

		$query = "SELECT rol, nome FROM membro WHERE ";

		//remoção de s e r triplo
		$sss =  str_replace('sss', 'ss', trim($_GET['nome']));
		$sss =  str_replace('rrr', 'rr', $sss);

		//Expassão de busca para nome Kassia ou Cassia
		if (substr_count($sss, 'kassia')==1) {
			$ks =  str_replace('k', 'c', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'cassia')==1){
			$ks =  str_replace('c', 'k', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		if (substr_count($sss, 'ss')==1) {
			$ks =  str_replace('ss', 'c', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'c')==1){
			$ks =  str_replace('c', 'ss', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para nome souza ou sousa
		if (substr_count($sss, 'sousa')==1){
			$ks =  str_replace('sousa', 'souza', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'souza')==1){
			$ks =  str_replace('souza', 'sousa', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para ch e x
		if (substr_count($sss, 'ch')==1){
			$ks =  str_replace('ch', 'x', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'x')==1){
			$ks =  str_replace('x', 'ch', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para y
		if (substr_count($sss, 'li')==1){
			$ks =  str_replace('li', 'ly', $sss);
			$query .= "nome LIKE '%".trim($ks)."%' OR ";
		}elseif (substr_count($sss, 'ly')==1){
			$ks =  str_replace('y', 'li', $sss);
			$query .= "nome LIKE '%".trim($ks)."%' OR ";
		}

		//Expassão de busca para keli
		if (substr_count($sss, 'keli')==1){
			$ks =  str_replace('keli', 'kely', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('keli', 'kelly', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('keli', 'kelli', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";

		}elseif (substr_count($sss, 'kely')==1){
			$ks =  str_replace('kely', 'keli', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kely', 'kelly', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kely', 'kelli', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";

		}elseif (substr_count($sss, 'kelly')==1){
			$ks =  str_replace('kelly', 'keli', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelly', 'kelli', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelly', 'kely', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";

		}elseif (substr_count($sss, 'kelli')==1){
			$ks =  str_replace('kelli', 'keli', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelli', 'kelly', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelli', 'kely', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para tais
		if (substr_count($sss, 'tais')==1){
			$ks =  str_replace('tais', 'thais', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('tais', 'thays', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'thais')==1){
			$ks =  str_replace('thais', 'tais', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('thais', 'tays', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'thays')==1){
			$ks =  str_replace('thays', 'thais', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('thays', 'tais', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		if (substr_count($sss, 'l')==1){
			$ks =  str_replace('l', 'll', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'n')==1){
			$ks =  str_replace('n', 'nn', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		if (substr_count($sss, 'll')==1){
			$ks =  str_replace('ll', 'l', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'nn')==1){
			$ks =  str_replace('nn', 'n', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}
		//Expassão de busca para ana
		if (substr_count($sss, 'ana')==1){
			$ks =  str_replace('ana', 'anna', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'anna')==1){
			$ks =  str_replace('anna', 'ana', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}
		//Expassão de busca para Valter
		if (substr_count($sss, 'walter')==1){
			$ks =  str_replace('walter', 'valter', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'valter')==1){
			$ks =  str_replace('valter', 'walter', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para diana
		if (substr_count($sss, 'diana')==1){
			$ks =  str_replace('dianna', 'dyanna', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('diana', 'dyana', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('diana', 'dianna', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'dyanna')==1){
			$ks =  str_replace('dyanna', 'diana', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyanna', 'dyana', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyanna', 'dianna', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'dyana')==1){
			$ks =  str_replace('dyana', 'dyanna', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyana', 'diana', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyana', 'dianna', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'dianna')==1){
			$ks =  str_replace('dianna', 'dyanna', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dianna', 'diana', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dianna', 'dyana', $sss);
			$query .= "nome LIKE '%".$ks."%' OR ";
		}

		$query .= "nome LIKE '%".trim($sss)."%' ORDER BY nome";
		$nmpp="15"; //Número de mensagens por párginas
		$paginacao = Array();
		$paginacao['link'] = "?"; //Paginação na mesma página

		//Faz os calculos na paginação
		$sql2 = mysql_query ("$query") or die (mysql_error());
		$total = mysql_num_rows($sql2); //Retorna o total de linha na tabela
		$paginas = ceil ($total/$nmpp); //Retorna o total de páginas

		if ($_GET["pagina1"]<1) {
			$_GET["pagina1"] = 1;
		} elseif ($_GET["pagina1"]>$paginas) {
			$_GET["pagina1"] = $paginas;
		}

		$pagina = $_GET["pagina1"]-1;

		if ($pagina<1) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
		$inicio=$pagina * $nmpp; //Retorna qual será a primeira linha a ser mostrada no MySQL
		$sql3 = mysql_query ("$query"." LIMIT $inicio,$nmpp") or die (mysql_error());
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array

		 //inicia o cabeçalho de paginação

		{
		//echo('Você digitou: <h2>'.$_GET['nome'].'</h2>');

		?>
		<table class='table table-striped table-hover' >

			<colgroup>
				<col id="foto">
				<col id="albumCol"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">Foto</th>
					<th scope="col">Nome</th>
				</tr>
			</thead>
			<tbody>
		<?PHP

			while($coluna = mysql_fetch_array($sql3))
			{

			if ($total==1) {
			echo '<script> alert("Apenas um membro encontrado!"); location.href="./?escolha=adm/dados_pessoais.php&bsc_rol='.$coluna["rol"].'"</script>';
				}

			 if (file_exists("img_membros/".$coluna["rol"].".jpg"))
			 	{
					$img=$coluna["rol"].".jpg"; }
				else {
					$img="ver_foto.jpg";
				}

			$html = preg_replace("/(" . $sss . ")/i", "<span style=\"font-weight:bold; color:blue;\">\$1</span>", $coluna["nome"]);
			$linkMb = '<a href="./?escolha=adm/dados_pessoais.php&bsc_rol='.$coluna['rol'].'">';
			?>
        <tr>
				<td><?php echo $linkMb; ?><img class="img-circle" src=img_membros/<?PHP echo $img;?>  width='46' title="<?PHP echo " Rol: ".$coluna["rol"]." - ".$coluna["nome"]; ?>" /></a></td>
				<td><?php echo $linkMb.$html;?></a></td>
			</tr>
			<?PHP
			}//loop while produtos
	?>
		</tbody>
		</table>
	<?PHP
	}

	$_urlLi="?escolha=adm/rest_busca.php&nome=".trim($_GET["nome"]);//Montando o Link para ser passada a classe
	//Classe que monta o rodape
	$_rod = new rodape($paginas,$_GET["pagina1"],"pagina1",$_urlLi,8);//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
	$_rod->getRodape();	$_rod->form_rodape ("Ir para P&aacute;gina: ");
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
