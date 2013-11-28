<?php 
class menutes {
	
	function mostra (){
		//Lista todos os recibos
		$_urlLi_pen="?escolha={$_GET["escolha"]}&menu={$_GET["menu"]}&id={$_GET["id"]}";//Montando o Link para ser passada a classe
		$query_pen = "SELECT * FROM tes_recibo ORDER BY id DESC ";
		$nmpp_pen="10"; //N?mero de mensagens por p?rginas
		$paginacao_pen = Array();
		$paginacao_pen['link'] = "?"; //Pagina??o na mesma p?gina
					
		//Faz os calculos na paginação
		$sql2_pen = mysql_query ($query_pen) or die (mysql_error());
		$total_pen = mysql_num_rows($sql2_pen) ; //Retorna o total de linha na tabela
		$paginas_pen = ceil ($total_pen/$nmpp_pen); //Retorna o total de p?ginas
		
		if ($_GET["pag_mostra"]<1) { 
			$_GET["pag_mostra"] = 1;
		} elseif ($_GET["pag_mostra"]>$paginas_pen) {
			$_GET["pag_mostra"] = $paginas_pen;
		}
		
		$pagina_pen = $_GET["pag_mostra"]-1;
			
		if ($pagina_pen<0) {$pagina_pen=0;} //Especifica um valor p vari?vel p?gina caso ela esteja setada
		$inicio_pen=$pagina_pen * $nmpp_pen; //Retorna qual ser? a primeira linha a ser mostrada no MySQL
		$sql3_pen = mysql_query ($query_pen." LIMIT $inicio_pen,$nmpp_pen") or die (mysql_error()); 
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
						
		 //inicia o cabe?alho de pagina??o

		?>
		<br />
		<div class="box">
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
		
		<table cellspacing="0" >
		<caption id="recibos">Recibos Recentes</caption>
		
			<colgroup>
				<col id="N&ordm;">
				<col id="Nome">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">N&ordm;</th>
				<th scope="col">Nome</th>
				<th scope="col">Data</th>
			</tr>
		</thead>
		<tbody id="recibos" >
		<?PHP
			$inc_pen=0;
			while($coluna_pen = mysql_fetch_array($sql3_pen))
			{
				
				switch ($coluna_pen["tipo"])
				{
					case 1;
						$nome = new	DBRecord("membro", $coluna_pen["recebeu"], "rol");
						$nome_rec = $nome->nome();
						break;
					case 2;
						$nome = new	DBRecord("fornecedores", $coluna_pen["recebeu"], "id");
						$nome_rec = $nome->razao();
						break;
					default:
						$nome_rec = $coluna_pen["recebeu"];
						break;
				}
				
				++$inc_pen;
				if ($inc_pen>1)	
					{
						echo "<tr class='odd2'>";
						$inc_pen=0;
					}else {
						echo "<tr>";}
				
					echo "<td><a title = '{$coluna_pen["id"]}' href='./?escolha=tesouraria/rec_alterar.php&menu={$_GET["menu"]}&id={$coluna_pen["id"]}
						&pag_mostra={$_GET["pag_mostra"]}'>";
					printf ("%'03u<a></td>",$coluna_pen["id"]);
					echo "<td><a title = '{$nome_rec}' href='./?escolha=tesouraria/rec_alterar.php&menu={$_GET["menu"]}&id={$coluna_pen["id"]}
						&pag_mostra={$_GET["pag_mostra"]}'>".substr($nome_rec,0,7)."<a></td>";
					echo "<td>".conv_valor_br ($coluna_pen["data"])."</td>";
				echo "</tr>";
					
			}//loop while produtos
			
	?>	
		</tbody>
	</table>
	</div></div></div></div>
	
		<div class="box">
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">

	<?PHP

	//Classe que monta o rodape
	$_rod_pen = new rodape($paginas_pen,$_GET["pag_mostra"],"pag_mostra",$_urlLi_pen,8);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
	$_rod_pen->getRodape(); $_rod_pen->form_rodape ("P&aacute;gina:");
	
	?> 
	</div></div></div></div>
	
	<?php
	//$_rod->getDados();
	if ($paginas_pen>1)
		echo "<br><span class='style4'>Total de $paginas_pen p&aacute;ginas";
		else
		echo "<br><span class='style4'>Total de $paginas_pen p&aacute;gina";
		
	echo "<br />";
	if ($total_pen>"1")
	{
		printf ("Com %s recibos!",number_format($total_pen, 0, ',', '.'));
			
	}elseif ($total_pen=="1"){
		echo "Com apenas um recibo!";
	}else{
		echo "Com este crit&eacute;rio n&atilde;o obtivemos nenhum resultado, tente melhorar seu argumento de pesquisa!";
	}	
		//Fim das informa??es das pendencias 
		
		//Início das pendencias de disciplinados
	}
	
	function buscarecibo() {
		//formulários laterais de busca de recido da tesouraria
		?>
		<div class="box">
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
		<h1>Busca de Recibos</h1>
		<h3>Membros</h3>
		
		<?php
			$form = new formrecbusca("recebeu","nome",$tab,$tab_edit);
			$form->formcab();
			$form->getMostrar();	
		?>
		<h3>Fornecedores</h3>
		<form action="" method="post">
		<?php
			$for_num = new List_sele("fornecedores", "alias", "recebeu");
			echo $for_num->List_sel($ind++);
		?>
			<input type="hidden" name="tipo" id="tipo" value="2">
			<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receberá os dados -->
			<input type="hidden" name="menu" value="top_tesouraria" />
			<input type="submit" name="Submit" value="Listar Recibos..." />
				
		</form>
		<h3>Não Membros</h3>
		</div></div></div></div>
		
		<?php
	}
	
function recibosmembros (){
		//Lista os valores máximo, mínimo, médio e total de determinado beneficiado
		//Lista os recibos de um determinado membro
		
		$id =(int) $_POST ['recebeu'];		
		
		$extr  = 'SELECT MAX(valor) AS maximo, MIN(valor) AS minimo, AVG(valor)';
		$extr .= ' AS media, SUM(valor) as total FROM tes_recibo WHERE recebeu='.$id ;
		$extr .= ' AND recebeu>0';
		if ($_POST['tipo']==2) {
			$extr .= ' AND tipo="2"';	
		}
		$extr_rec = mysql_query($extr);
		$valores = mysql_fetch_array($extr_rec);
		$maximo = $valores['maximo'];
		$minimo = $valores['minimo'];
		$media = $valores['media'];
		$total = $valores['total'];
		/**/
		
		$_urlLi_pen="?escolha={$_GET["escolha"]}&menu={$_GET["menu"]}&id={$_GET["id"]}";//Montando o Link para ser passada a classe
		if ($_POST['tipo']==2) {
			$query_pen  = 'SELECT t.id, t.recebeu, t.valor, t.data, t.motivo, t.tipo, f.razao ';
			$query_pen .= 'FROM tes_recibo AS t, fornecedores AS f WHERE t.recebeu='.$id;
			$query_pen .= ' AND t.tipo=2 AND t.recebeu = f.id ORDER BY t.id DESC ';	
		} else {
		$query_pen = 'SELECT * FROM tes_recibo AS t, membro AS m WHERE t.recebeu="'.$id;
		$query_pen .= '" AND t.recebeu = m.rol ORDER BY t.id DESC ';
		}
		$nmpp_pen="30"; //N?mero de mensagens por p?rginas
		$paginacao_pen = Array();
		$paginacao_pen['link'] = "?"; //Pagina??o na mesma p?gina
					
		//Faz os calculos na paginação
		$sql2_pen = mysql_query ($query_pen) or die (mysql_error());
		$total_pen = mysql_num_rows($sql2_pen) ; //Retorna o total de linha na tabela
		$paginas_pen = ceil ($total_pen/$nmpp_pen); //Retorna o total de p?ginas
		
		if ($_GET["pag_rec"]<1) { 
			$_GET["pag_rec"] = 1;
		} elseif ($_GET["pag_rec"]>$paginas_pen) {
			$_GET["pag_rec"] = $paginas_pen;
		}
		
		$pagina_pen = $_GET["pag_rec"]-1;
			
		if ($pagina_pen<0) {$pagina_pen=0;} //Especifica um valor p vari?vel p?gina caso ela esteja setada
		$inicio_pen=$pagina_pen * $nmpp_pen; //Retorna qual ser? a primeira linha a ser mostrada no MySQL
		$sql3_pen = mysql_query ($query_pen." LIMIT $inicio_pen,$nmpp_pen") or die (mysql_error()); 
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
						
		 //inicia o cabe?alho de pagina??o

		?>
		<br />
		
		<table cellspacing="0" >
		<caption id="recibos">Lista de Recibos</caption>
		
			<colgroup>
				<col id="N&ordm;">
				<col id="Nome">
				<col id="Motivo">
				<col id="Valor(R$)">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">N&ordm;</th>
				<th scope="col">Nome</th>
				<th scope="col">Motivo</th>
				<th scope="col">Valor(R$)</th>
				<th scope="col">Data</th>
			</tr>
		</thead>
		<tbody id="recibos" >
		<?PHP
			$inc_pen=0;
			while($coluna_pen = mysql_fetch_array($sql3_pen))
			{
				
				switch ($coluna_pen["tipo"])
				{
					case 1;
						$nome = new	DBRecord("membro", $coluna_pen["recebeu"], "rol");
						$nome_rec = $nome->nome();
						break;
					case 2;
						$nome = new	DBRecord("fornecedores", $coluna_pen["recebeu"], "id");
						$nome_rec = $nome->razao();
						break;
					default:
						$nome_rec = $coluna_pen["recebeu"];
						break;
				}
				
				++$inc_pen;
				if ($inc_pen>1)	
					{
						echo "<tr class='dados'>";
						$inc_pen=0;
					}else {
						echo "<tr>";}
				
					echo "<td><a title = '{$coluna_pen["id"]}' href='./?escolha=tesouraria/rec_alterar.php&menu={$_GET["menu"]}&id={$coluna_pen["id"]}
						&pag_rec={$_GET["pag_rec"]}'>";
					printf ("%'03u<a></td>",$coluna_pen["id"]);
					echo "<td><a title = '{$nome_rec}' href='./?escolha=tesouraria/rec_alterar.php&menu={$_GET["menu"]}&id={$coluna_pen["id"]}
						&pag_rec={$_GET["pag_rec"]}'>".$nome_rec."<a></td>";
					echo "<td>".$coluna_pen["motivo"]."</td>";
					echo "<td style=' text-align: right;'>".number_format($coluna_pen["valor"],2,",",".")."</td>";
					echo "<td>".conv_valor_br ($coluna_pen["data"])."</td>";
				echo "</tr>";
					
			}//loop while produtos
			
	?>
		</tbody>
	</table>

	<?PHP
	echo'Maior valor: R$ '.number_format($maximo,2,",",".").' - Menor valor: R$ '.number_format($minimo,2,",",".");
	echo ' - Valor m&eacute;dio: R$ '.number_format($media,2,",",".").' - Total de: R$ '.number_format($total,2,",",".").'<br />';
	//Classe que monta o rodape
	$_rod_pen = new rodape($paginas_pen,$_GET["pag_rec"],"pag_rec",$_urlLi_pen,8);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
	$_rod_pen->getRodape(); $_rod_pen->form_rodape ("P&aacute;gina:");
	
	//$_rod->getDados();
	
	
	if ($paginas_pen>1)
		echo "<br><span class='style4'>Total de $paginas_pen p&aacute;ginas";
		else
		echo "<br><span class='style4'>Total de $paginas_pen p&aacute;gina";
		
	echo "<br />";
	if ($total_pen>"1")
	{
		printf ("Com %s recibos!",number_format($total_pen, 0, ',', '.'));
			
	}elseif ($total_pen=="1"){
		echo "Com apenas um recibo!";
	}else{
		echo "Com este crit&eacute;rio n&atilde;o obtivemos nenhum resultado, tente melhorar seu argumento de pesquisa!";
	}	
		//Fim das informa??es das pendencias 
		
		//Início das pendencias de disciplinados
	}
}

?>
