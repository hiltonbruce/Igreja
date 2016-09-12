<div class="rightpanel">
 <div class="inquiry">
 	<?PHP
 		$igreja = new DBRecord ("igreja","1","rol");
		$pendencias = new pendencias ();
		$disp_pend = '';
		// Se n?o houver pend?ncia no cadasdtro ? mostrador os dados da igreja matriz
		if (empty($_SESSION["valid_user"]) || $pendencias->quant_pendecias()<"0" && ( !ver_nome ("adm") || !ver_nome ("tesouraria"))) {
		?>
		<div class="box" align="center">
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
		    <?PHP echo "Pastor Local:<br /> {$igreja->pastor()}<br /><br /> Templo SEDE:<br /> {$igreja->rua()}, N&ordm; {$igreja->numero()} <br /> {$igreja->cidade()} - {$igreja->uf()}<br />
			CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?>
			<br />Email: <a rel="nofollow" target="_blank" href="mailton: <?PHP echo "{$igreja->email()}";?>"><?PHP echo "{$igreja->email()}";?></a>
    		<br /><br />Filiada &agrave;:<br /><img src="img/logo_comadep.jpg" alt="COMADEP" /><br />
		    Pastor Presidente:<br />Jos&eacute; Carlos de Lima
    </div></div></div></div>
    <ul class="list-group">
      <li class="list-group-item list-group-item-primary"><strong>Congrega&ccedil;&otilde;es:</strong></li>
    </ul>
		<div class="box" align="center">
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
		<?PHP
			$lst_igreja = new List_congr("igreja","razao");
			$lst_igreja->get();
		?>
 	 </div></div></div></div>
	<?PHP
		if (isset($_SESSION["valid_user"]) && $pendencias->quant_pendecias()<"0"){
			echo "</div><h4>Parabens n&atilde;o h&aacute; Pend&ecirc;ncias no Cadasdtro!</h4>";
		}

		}elseif (ver_nome ("tesouraria")){//Menu Tesouraria
			echo "</div>";
	?>
			<?php
      $menu = new menutes();
			$menu->mostra();
			$menu->buscarecibo();
		}elseif (!empty($painelDireito) && file_exists($painelDireito)) {
			//Verifica se h� uma chamada a um painel espec�fico
			require_once $painelDireito;
		}else {
		echo "</div>";
		//In�cio da pend�ncia
		$_urlLi_pen="?escolha={$_GET["escolha"]}&bsc_rol={$_GET["bsc_rol"]}";//Montando o Link para ser passada a classe
		$query_pen = "SELECT rol,nome,obs FROM membro WHERE OBS<>'' ";
		$nmpp_pen="40"; //N?mero de mensagens por p?rginas
		$paginacao_pen = Array();
		$paginacao_pen['link'] = "?"; //Pagina??o na mesma p?gina

		//Faz os calculos na pagina��o
		$sql2_pen = mysql_query ($query_pen) or die (mysql_error());
		$total_pen = mysql_num_rows($sql2_pen) ; //Retorna o total de linha na tabela
		$paginas_pen = ceil ($total_pen/$nmpp_pen); //Retorna o total de p?ginas

		if ($_GET["pagina1_pen"]<1) {
			$_GET["pagina1_pen"] = 1;
		} elseif ($_GET["pagina1_pen"]>$paginas_pen) {
			$_GET["pagina1_pen"] = $paginas_pen;
		}

		$pagina_pen = $_GET["pagina1_pen"]-1;

		if ($pagina_pen<0) {$pagina_pen=0;} //Especifica um valor p vari?vel p?gina caso ela esteja setada
		$inicio_pen=$pagina_pen * $nmpp_pen; //Retorna qual ser? a primeira linha a ser mostrada no MySQL
		$sql3_pen = mysql_query ($query_pen." LIMIT $inicio_pen,$nmpp_pen") or die (mysql_error());
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
		 //inicia o cabe?alho de pagina??o

		$dadosMembro = new membro();
		$detMemb = $dadosMembro->nomes();
		?>
		<div class="box" align="center">
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
		<table class='table table-bordered' >
		<caption>Rol's com Pend&ecirc;ncias</caption>
			<colgroup>
				<col id="Rol">
				<col id="Rol">
				<col id="Rol">
				<col id="albumCol"/>
			</colgroup>
		<tbody id="pendencia" >
		<?PHP
			$inc_pen=0;
			while($coluna_pen = mysql_fetch_array($sql3_pen))
			{
			if ($inc_pen=="0") { echo "<tr>"; }
			$inc_pen++;
			echo "<td class='text-center'><a title = '{$coluna_pen["nome"]}' href='./?escolha=adm/dados_pessoais.php&bsc_rol={$coluna_pen["rol"]}&pagina1_pen={$_GET["pagina1_pen"]}'>{$coluna_pen["rol"]}<a></td>";
			if ($inc_pen=="4") { echo "</tr>";$inc_pen=0; }
			}//loop while produtos
	?>
		</tbody>
	</table>
	</div></div></div></div>
		<div class="box" >
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
	<?PHP
	//Classe que monta o rodape
	$_rod_pen = new rodape($paginas_pen,$_GET["pagina1_pen"],"pagina1_pen",$_urlLi_pen,4);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
	$_rod_pen->getRodape(); $_rod_pen->form_rodape ("P&aacute;gina:");

	if ($paginas_pen>1)
		echo "<br><span class='style4'>Total de $paginas_pen p&aacute;ginas";
		else
		echo "<br><span class='style4'>Total de $paginas_pen p&aacute;gina";

	echo "<br />";
	if ($total_pen>"1")
	{
		printf ("Com %s cadastros de membros, com algum tipo de pend&ecirc;ncia!",number_format($total_pen, 0, ',', '.'));

	}elseif ($total_pen=="1"){
		echo "Com apenas um cadastros de membro!";
	}else{
		echo "Com este crit&eacute;rio n&atilde;o obtivemos nenhum resultado, tente melhorar seu argumento de pesquisa!";
	}
	?>
	</div></div></div></div><br />
	 	 <ul class="list-group">
          <li class="list-group-item list-group-item-primary"><strong>Disciplinados</strong></li>
      </ul>
	<?php
		//Fim das informa??es das pendencias
		//In�cio das pendencias de disciplinados
		//In�cio Disciplinas Expiradas
		$_urlLi_disc="?escolha={$_GET["escolha"]}&bsc_rol={$_GET["bsc_rol"]}";//Montando o Link para ser passada a classe
		$query_disc = "SELECT * FROM eclesiastico WHERE situacao_espiritual='2' ";
		$nmpp_disc="40"; //N?mero de mensagens por p?rginas
		$paginacao_disc = Array();
		$paginacao_disc['link'] = "?"; //Pagina??o na mesma p?gina
		//Faz os calculos na pagina��o
		$sql2_disc = mysql_query ($query_disc) or die (mysql_error());
		$total_disc = mysql_num_rows($sql2_disc) ; //Retorna o total de linha na tabela
		$paginas_disc = ceil ($total_disc/$nmpp_disc); //Retorna o total de p?ginas

		$pgDisc = (empty($_GET["pagina1_disc"])) ? '' : $_GET["pagina1_disc"] ;

		if ($pgDisc<1) {
			$pgDisc= 1;
		} elseif ($pgDisc>$paginas_disc) {
			$pgDisc = $paginas_disc;
		}
		$pagina_disc = $pgDisc-1;
		if ($pagina_disc<0) {$pagina_disc=0;} //Especifica um valor p vari?vel p?gina caso ela esteja setada
		$inicio_disc=$pagina_disc * $nmpp_disc; //Retorna qual ser? a primeira linha a ser mostrada no MySQL
		$sql3_disc = mysql_query ($query_disc." LIMIT $inicio_disc,$nmpp_disc") or die (mysql_error());
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
		 //inicia o cabe?alho de pagina??o
		?>
		<div class="box" align="center">
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
		<table class='table table-bordered' cellspacing="0" id="pendencia" >
		<caption>Rol's</caption>
			<colgroup>
				<col id="Rol">
				<col id="Rol">
				<col id="Rol">
				<col id="albumCol"/>
			</colgroup>
		<thead></thead>
		<tbody id="pendencia" >
			<?PHP
			$inc_disc=0;
			#print_r($detMemb);
			while($coluna_disc = mysql_fetch_array($sql3_disc))
			{
			if ($inc_disc=="0") { echo "<tr id='pendencia'>"; }

			$inc_disc++;
			$exp = mysql_query ("SELECT * FROM disciplina WHERE rol = '{$coluna_disc["rol"]}' ORDER BY id DESC LIMIT 1 ");
			$array_exp = mysql_fetch_array($exp);
			$membro_disc = $detMemb[$coluna_disc['rol']]['5'];
			if ($array_exp["data_fim"]<date("Y-m-d") AND $array_exp["data_fim"]<>"0000-00-00") {
				echo "<td id='pendencia' class='text-center' ><a title = '$membro_disc - Disciplina Conclu&iacute;da' href='./?escolha=adm/dados_pessoais.php&bsc_rol={$coluna_disc["rol"]}&pagina1_disc=$pgDisc'><span style='color:#009900'><blink>{$coluna_disc["rol"]}</blink></span><a></td>";
				$disp_pend++;
			}else {
				echo "<td id='pendencia' class='text-center' ><a title = '$membro_disc' href='./?escolha=adm/dados_pessoais.php&bsc_rol={$coluna_disc["rol"]}&pagina1_disc=$pgDisc'>{$coluna_disc["rol"]}<a></td>";
			}


			if ($inc_disc=="4") { echo "</tr>";$inc_disc=0; }
			}//loop while produtos
			?>
		</tbody>
	</table>
	</div></div></div></div>
		<div class="box" >
		<div class="box-outer">
		<div class="box-inner">
		<div class="box-titulo">
	<?PHP
		//Classe que monta o rodape
		$_rod_disc = new rodape($paginas_disc,$pgDisc,"pagina1_disc",$_urlLi_disc,4);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
		$_rod_disc->getRodape(); $_rod_disc->form_rodape ("P&aacute;gina:");

		if ($paginas_disc>1)
			echo "<br><span class='style4'>Total de $paginas_disc p&aacute;ginas.";
		else
			echo "<br><span class='style4'>Total de $paginas_disc p&aacute;gina.";

		if ($disp_pend>1)
			echo "<br><span class='style4'>$disp_pend disciplinados com algum tipo de pend&ecirc;ncia.";
		elseif ($disp_pend==1)
			echo "<br><span class='style4'>Um disciplinados com pend&ecirc;ncia!";

		echo "<br />";
		if ($total_disc>"1")
		{
			printf ("%s disciplinados!",number_format($total_disc, 0, ',', '.'));

		}elseif ($total_disc=="1"){
			echo "Com um membro disciplinado!";
		}else{
			echo "N&atilde;o h&aacute; nenhum disciplinado!";
		}

		}//Fim das pendencias de disciplinados
		?>
			</div></div></div></div>
		<?php
	?>
	</div>
  </div>
