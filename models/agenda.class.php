<?php
class agenda {

	function  __construct () {
		$this->membro = new membro();
		$this->credor = new tes_credores();
		$this->igreja = new igreja();
	}

	function nomes () {
		$ind = 0;
		while($this->dados = mysql_fetch_array($this->agenda))
		{
			$mud_acent = strtoupper(strtr($this->dados["nome"], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
			$todos[$ind++] = $mud_acent;
		}
		return $todos ;
	}

	function insdespmes(){

		//verifica o mês da ultima conta e inseri as atuais e as que estiverem com
		//vencimento até o dia 10 de cada mês será inserida já para o próximo mês
		$ins_conta = 'SELECT * FROM agenda WHERE frequencia = "1" AND status <> "3" GROUP BY idfatura' ;
		$lista = mysql_query($ins_conta);

		while ($contas = mysql_fetch_array($lista)) {
			//$despesaMes = '';
			list($ano, $mes, $dia) = explode("-", $contas['vencimento']);
			//echo '<br/>dia: '.$dia.' - Mês: '.$mes.' - Ano: '.$ano;

			//$fatura += 1;
			$fatura = ($contas['idfatura']>'0') ? $contas['idfatura']:++$fatura;

			$fatu =  'SELECT * FROM agenda where idfatura='.$contas['idfatura'].' ORDER BY vencimento DESC LIMIT 1';
			$idfatura = mysql_query($fatu);
			$id = mysql_fetch_array($idfatura);
			$fatura = $id['vencimento'];
			list($anov, $mesv, $diav) = explode("-", $id['vencimento']);
			//echo '<br /> Id Fatrura: '.$contas['idfatura'].' - Data atual - ultimo Vencimento: '.$id['ultvenc'].' ---- '. ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24));
			//$query_prox = 'SELECT * FROM agenda  WHERE idfatura = "'.$contas['idfatura'].'" AND (TO_DAYS(vencimento) - TO_DAYS(NOW()) >= "10")';
			if (ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24))>'0' && $id['status']<>'3') {
				$mesvenc = (date('m',mktime() - mktime(0,0,0,$mesv,$diav,$anov)));
				//corrigir os dados da tabela agenda para unificar os fornecedores
				//adiciona campo vencimento na confirmação de pgto da conta e sinalizar qdo conta atualizada ou confimada a fatura
				//Acrescentar busca por igreja, motivo, fonecedor
				for ($i = 1; $i <= $mesvenc; $i++) {
					$value	 = sprintf("null,'%s','%s','%s','%s',null,'%s','%s'",$id['idfatura'],$id['credor'],$id['debitar'],$id['creditar'],$id['frequencia'],$id['igreja']);
					$value 	.=',"'. $id['valor'].'","","'. $id['motivo'].'","'.date('Y-m-d',mktime(0,0,0,$mesv+$i,$diav,$anov));
					$value	.='","'.$id['resppgto'].'","","","'.date('d/m/Y H:i:s').', '.$_SESSION['valid_user'] .', Registro automático"';
					$agendamento = new insert ("$value","agenda");
					$agendamento->inserir();/**/
					if (strstr($id['credor'], '@')) {
						list($tipo,$credor) = explode('@',$id['credor'] );
					}else {
						$credor=(int)$id['credor'];
					}
					if ($tipo=='membro') {
						$nomeMembro = new DBRecord('membro', $credor, 'rol');
					}elseif ($tipo=='membro')
					$despesaMes .= '<br /> Inserida a fatura: '.$id['idfatura'].'-'.$id['nome'].', vencimento para:'.date('d/m/Y',mktime(0,0,0,$mesv+$i,$diav,$anov));
					$despesaMes .= ' - Motivo: '.$id['motivo'];
				}
			}
		}
		return $despesaMes;
	}

	function despesasfixas (){
		$_urlLi_fix="?escolha={$_GET["escolha"]}&menu={$_GET["menu"]}&id={$_GET["id"]}";//Montando o Link para ser passada a classe
		$query_fix  = 'SELECT a.vencimento, a.valor, a.id,a.credor,a.idlanc,';
		$query_fix .= 'a.igreja, a.status, a.idfatura, a.motivo, a.datapgto, a.resppgto ';
		$query_fix .= 'FROM agenda AS a WHERE  a.frequencia="1" ';
		$query_fix .= 'AND TO_DAYS(a.vencimento) - TO_DAYS(NOW()) <= "15" ';
		$query_fix .= 'ORDER BY a.status ASC,a.vencimento DESC ';
		$nmpp_fix="10"; //N?mero de mensagens por p?rginas
		$paginacao_fix = Array();
		$paginacao_fix['link'] = "?"; //Pagina??o na mesma p?gina
		//Faz os calculos na paginação
		$sql2_fix = mysql_query ($query_fix) or die (mysql_error());
		$total_fix = mysql_num_rows($sql2_fix) ; //Retorna o total de linha na tabela
		$paginas_fix = ceil ($total_fix/$nmpp_fix); //Retorna o total de p?ginas
		if ($_GET["pagina1_fix"]<1) {
			$_GET["pagina1_fix"] = 1;
		} elseif ($_GET["pagina1_fix"]>$paginas_fix) {
			$_GET["pagina1_fix"] = $paginas_fix;
		}
		$pagina_fix = $_GET["pagina1_fix"]-1;
		if ($pagina_fix<0) {$pagina_fix=0;} //Especifica um valor p vari?vel p?gina caso ela esteja setada
		$inicio_fix=$pagina_fix * $nmpp_fix; //Retorna qual ser? a primeira linha a ser mostrada no MySQL
		$sql3_fix = mysql_query ($query_fix." LIMIT $inicio_fix,$nmpp_fix") or die (mysql_error());
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
		//inicia o cabe?alho de pagina??o
		?>
<table id="Agenda">
	<colgroup>
		<col id="Credor">
		<col id="Igreja">
		<col id="Motivo">
		<col id="Valor (R$)">
		<col id="situacao">
		<col id="albumCol" />
	</colgroup>
	<thead>
		<tr>
			<th scope="col">Credor(es)</th>
			<th scope="col">Igreja</th>
			<th scope="col">Motivo</th>
			<th scope="col">Valor (R$)</th>
			<th scope="col">Situa&ccedil;&atilde;o</th>
			<th scope="col">Vencimento</th>
		</tr>
	</thead>
	<tbody id="recibos">
	<?PHP
	$inc_fix=0;
	$semLanc = '(<span class="text-danger">S/ Lan&ccedil;amento</span>)';
	while($coluna_fix = mysql_fetch_array($sql3_fix))
	{
		$roligreja = ($coluna_fix['igreja']<1) ? 1:$coluna_fix['igreja'];
		$igreja = new DBRecord('igreja',$roligreja, 'rol');
		if ($coluna_fix["rol"]>"0") {
			$beneficiado = new DBRecord("membro", $coluna_fix["rol"], "rol");
			$nome = $beneficiado->nome();
		}else {
			$nome = $coluna_fix["nome"];
		}
		$status ='<a href = "./?escolha=tesouraria/agenda.php&menu=top_tesouraria&id';
		$status = $coluna_fix['id'].'" title = "Informar pagamento!" >';
		$status ='<span class="glyphicon glyphicon-pencil text-danger"/></span>';
		$status ='Pagar!</a>';
		switch ($coluna_fix['status']) {
			case 1:
				$status .= '<span class="glyphicon glyphicon-warning-sign text-warning"';
				$status .= ' aria-hidden="true" ></span>Saiu p/ Pgto';
				$titulo = 'Pagamento ser&aacute; realizado hoje!';
				break;
			case 2:
				$idLanc = ($coluna_fix['idlanc']>0) ? '(Reg. '.$coluna_fix['idlanc'].') ' : $semLanc ;
				$evento = '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true" ';
				$evento .= 'alt="D&iacute;�vida Paga! Obrigado."></span>'.$idLanc;
				$status = $evento.' Pago em: '.conv_valor_br ($coluna_fix['datapgto']);
				$status .= ' - '.$coluna_fix['resppgto'];
				$titulo = 'D&iacute;�vida Paga! Obrigado.';
				break;
			case 3:
				$status = 'Quitado';
				$titulo = 'Quitado';
				break;
			default:
				if (date("Y-m-d")==$coluna_fix['vencimento']) {
					$status .= '<span class="glyphicon glyphicon-warning-sign text-warning"';
					$status .= ' aria-hidden="true" ></span>Pgto Hoje!';
					$titulo = 'D&iacute;�vida n&atilde;o Paga!';
				}elseif (date("Y-m-d")>$coluna_fix['vencimento']){
					$status .= '<span class="glyphicon glyphicon-remove-sign text-danger"';
					$status .= ' aria-hidden="true" ></span>Vencida!';
					$titulo = 'D&iacute;�vida Vencida!';
				}else {
					$status .= '<span class="glyphicon glyphicon-warning-sign text-warning"';
					$status .= ' aria-hidden="true" ></span>Falta� Pagar';
					$titulo = 'D&iacute;vida a Pagar!';
				}
				break;
		}
		++$inc_fix;
		if ($coluna_fix['credor']!=(int)$coluna_fix['credor']) {
			$membro = new DBRecord('membro',(int)$coluna_fix['rol'],'rol' );
			$evento = 'Membro: '.$membro->nome();
		}else {
			$credor= new DBRecord('credores',$coluna_fix['credor'],'id');
			$evento = ($credor->alias()!='') ? $credor->alias():' *** ';
		}
		if ($inc_fix>1)	{
			echo "<tr class='dados'>";
			$inc_fix=0;
		}else {
			echo "<tr>";}
			echo "<td><a title = '{$coluna_fix["nome"]}' href='./?escolha=tesouraria/agenda.php&menu={$_GET["menu"]}&id={$coluna_fix["id"]}
							&pagina1_fix={$_GET["pagina1_fix"]}'>".substr($evento,0,40)."<a></td>";
			echo '<td> <a title = "'.$titulo.'" href="./?escolha=tesouraria/agenda.php&menu='.$_GET['menu'].
							'&id='.$coluna_fix['id'].'&pagina1_fix='.$_GET['pagina1_fix'].'" >'.$coluna_fix['idfatura'].' - '.$igreja->razao().'<a></td>';
			echo '<td>'.$coluna_fix['motivo'].'</td>';
			echo '<td  style="text-align: right;">'.number_format($coluna_fix['valor']+$coluna_fix['multa'],2,",",".").'</td>';
			echo '<td>'.$status.'</td>';
			echo '<td>'.conv_valor_br ($coluna_fix['vencimento']).'</td>';
			echo "</tr>";
	}//loop while produtos
	?>
	</tbody>
</table>
	<?PHP
	//Classe que monta o rodape
	$_rod_fix = new rodape($paginas_fix,$_GET["pagina1_fix"],"pagina1_fix",$_urlLi_fix,8);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
	$_rod_fix->getRodape(); $_rod_fix->form_rodape ("P&aacute;gina:");
	//Início das pendencias de disciplinados
	}

	function mostra10dias (){
		$_urlLi_pen="?escolha={$_GET["escolha"]}&menu={$_GET["menu"]}&id={$_GET["id"]}";//Montando o Link para ser passada a classe
		$query_pen = 'SELECT a.vencimento, a.valor, a.id, a.credor,a.idlanc,';
		$query_pen .= 'a.igreja, a.status, a.idfatura, a.motivo, a.datapgto, a.resppgto ';
		$query_pen .= 'FROM agenda AS a WHERE ((TO_DAYS(a.vencimento) - TO_DAYS(NOW()) <= 10 ';
		$query_pen .= 'AND TO_DAYS(NOW()) - TO_DAYS(a.vencimento)<= 15 ) ';
			echo "<tr>";
		$query_pen .= 'OR (a.status < 2 AND TO_DAYS(a.vencimento) - TO_DAYS(NOW()) <= 5 )) AND a.frequencia = "2" ';
		$query_pen .= 'ORDER BY a.status ASC,a.vencimento DESC';
		$nmpp_pen="10"; //N?mero de mensagens por p?rginas
		$paginacao_pen = Array();
		$paginacao_pen['link'] = "?"; //Pagina??o na mesma p?gina
		//Faz os calculos na paginação
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
	?>
	<table cellspacing="0" id="Agenda">
		<colgroup>
			<col id="Credor">
			<col id="Motivo">
			<col id="Valor (R$)">
			<col id="situacao">
			<col id="albumCol" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">Credor(es)</th>
				<th scope="col">Motivo</th>
				<th scope="col">Valor(R$)</th>
				<th scope="col">Situação</th>
				<th scope="col">Vencimento</th>
			</tr>
		</thead>
		<tbody id="recibos">
	<?PHP
	$inc_pen=0;
	$semLanc = '(<span class="text-danger">S/ Lan&ccedil;amento</span>)';
	while($coluna_pen = mysql_fetch_array($sql3_pen))
	{
		if ($coluna_pen["rol"]>"0") {
			$beneficiado = new DBRecord("membro", $coluna_pen["rol"], "rol");
			$nome = $beneficiado->nome();
		}else {
			$nome = $coluna_pen["nome"];
		}
		$status ='<a href = "./?escolha=tesouraria/agenda.php&menu=top_tesouraria&id='.$coluna_pen['id'].'" title = "Informar pagamento!" >
		<span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>  Pagar!</a>';
		switch ($coluna_pen['status']) {
			case 1:
				$status .= '<span class="glyphicon glyphicon-warning-sign text-warning" aria-hidden="true" ></span> Saiu p/ Pgto';
				break;
			case 2:
				$idLanc = ($coluna_pen['idlanc']>0) ? '(Reg. '.$coluna_pen['idlanc'].') ' : $semLanc ;
				$evento = '<span class="glyphicon glyphicon-ok text-success"';
				$evento .= ' aria-hidden="true" ></span>  '.$idLanc;
				$status = $evento.' Pago em: '.conv_valor_br ($coluna_pen['datapgto']);
				$status .= ', por '.$coluna_pen['resppgto'];
				break;
			case 3:
				$status = 'Quitado';
				break;
			default:
				if (date("Y-m-d")==$coluna_pen['vencimento']) {
					$status .= '<span class="glyphicon glyphicon-warning-sign text-warning" aria-hidden="true" ></span> Pgto Hoje!';
				}elseif (date("Y-m-d")>$coluna_pen['vencimento']){
					$status .= '<span class="glyphicon glyphicon-remove-sign text-danger" aria-hidden="true" ></span>  Vencida';
				}else {
					$status .= '<span class="glyphicon glyphicon-warning-sign text-warning" aria-hidden="true" ></span>  &Agrave; Pagar';
				}
				break;
		}
		++$inc_pen;
		if ($coluna_pen['credor']!=(int)$coluna_pen['credor']) {
			$membro = new DBRecord('membro',(int)$coluna_pen['rol'],'rol' );
			$evento = 'Membro: '.$membro->nome();
		}else {
			$credor= new DBRecord('credores',$coluna_pen['credor'],'id');
			$evento = ($credor->alias()!='') ? $credor->alias():' *** ';
		}
		if ($inc_pen>1)	{
			echo "<tr id='destac' class='dados'>";
			$inc_pen=0;
		}else {
			echo "<tr id='destac'>";}
			echo "<td><a title = '{$coluna_pen["nome"]}' href='./?escolha=tesouraria/agenda.php&menu={$_GET["menu"]}&id={$coluna_pen["id"]}
							&pagina1_pen={$_GET["pagina1_pen"]}'>".substr($evento,0,40)."<a></td>";
			echo '<td>'.$coluna_pen['motivo'].'</td>';
			echo '<td  style="text-align: right; ">'.number_format($coluna_pen['valor']+$coluna_pen['multa'],2,",",".").'</td>';
			echo '<td>'.$status.'</td>';
			echo '<td>'.conv_valor_br ($coluna_pen['vencimento']).'</td>';
			echo "</tr>";
	}//loop while produtos
	?>
	</tbody>
</table>
	<?PHP
	//Classe que monta o rodape
	$_rod_pen = new rodape($paginas_pen,$_GET["pagina1_pen"],"pagina1_pen",$_urlLi_pen,8);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
	$_rod_pen->getRodape(); $_rod_pen->form_rodape ("P&aacute;gina:");
	//Início das pendencias de disciplinados
	}

	function periodo ($dia,$credor,$pagamento) {
		$periodo  = 'SELECT a.vencimento, a.valor, a.id, a.credor,';
		$periodo .= 'a.igreja, a.status, a.motivo, a.idlanc ';
		$periodo .= 'FROM agenda AS a WHERE ';
		if ($credor>'0') {
			$periodo .= ' a.credor='.$credor.' AND ';
			$linkcredor = '&data="'.$dia.'"&credor='.$credor;
		}else {
			$linkcredor = '&data='.$pagamento;
		}
		if (!empty($_GET['igreja'])){
			$igRol = intval($_GET['igreja']);
			$periodo .= ' a.igreja='.$igRol.' AND ';
			}
		$periodo .= ' a.vencimento = "'.$dia.'"';
		$periodo_array = mysql_query($periodo)  or die (mysql_error());
		$numLinhas	= mysql_num_rows($periodo_array);
		//echo "<h1>Linhas Afetadas $numLinhas</h1>";
		$semLanc = '(<span class="text-danger">S/ Lan&ccedil;amento</span>)';
		if ($numLinhas>0) {
		while ($periodo_dados =mysql_fetch_array($periodo_array)) {
			if ($periodo_dados['status']=='2') {//Marca os já pagos
				$idLanc = ($periodo_dados['idlanc']>0) ? '(Reg. '.$periodo_dados['idlanc'].') ' : $semLanc;
				$evento = '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true" ></span> '.$idLanc;
				$titulo = 'D&iacute;�vida Paga! Obrigado.';
			}elseif ($periodo_dados['status']=='1'){
				$evento  = '<span class="glyphicon glyphicon-warning-sign text-warning"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'Atualizado. Aguardado confirma&ccedil;&atilde;o de pgto!';
			}elseif ($periodo_dados['status']<'2' && $periodo_dados['vencimento'] < date ('Y-m-d') ){
				$evento  = '<span class="glyphicon glyphicon-remove-sign text-danger"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'D&iacute;vida vencida!';
			}else {
				$evento ='';
				$titulo = 'Click aqui atualizar! Motivo: '.$periodo_dados['motivo'];
			}
			if ($periodo_dados['igreja']<'1') {
				$evento .= 'Templo Sede - ';
			}else {
				$igreja_ev = new DBRecord('igreja',$periodo_dados['igreja'], 'rol');
				$evento .= $igreja_ev->razao();
			}
			if (strstr($periodo_dados['credor'],'r')) {
				$rolCredor = str_replace('r', "", $periodo_dados['credor']);
				$membro = new DBRecord('membro',$rolCredor,'rol' );
				$evento .= ' &rarr; '.$membro->nome();
			}else {
				$credor= new DBRecord('credores',$periodo_dados['credor'],'id');
				$evento .= ' &rarr; '.$credor->alias();
			}
			echo '<a title="'.$titulo.'" href="./?escolha=tesouraria/agenda.php&
			menu=top_tesouraria&id='.$periodo_dados['id'].'&pagina1_fix='.$_GET['pagina1_fix'].$linkcredor.'">';
			echo $evento;
			echo ' &rarr; R$ '.number_format($periodo_dados['valor'],2,",",".").
			'</a> (<span class="text-info">'.$periodo_dados['motivo'].'</span>)<br />';
			$total += $periodo_dados['valor'];
		}
	}else {
		$total=0;
	}
		echo '</td><td  class="text-right" >'.number_format($total,2,",",".").'</td>';
	}

	function vencidas() { //Quantidade de contas vencidas as mais de cinco dias
		$venc  = 'SELECT * FROM agenda ';
		$venc .= 'WHERE status<"2" AND (TO_DAYS(vencimento) - TO_DAYS(NOW())) < -5';
		$venc_array = mysql_query($venc);
		$venc_linhas = mysql_num_rows ($venc_array);
		return $venc_linhas;
	}

	function listavencidas($data) { //Contas vencidas
		$listvenc  = 'SELECT f.razao, DATE_FORMAT(a.vencimento,"%d/%m/%Y") AS vencimento, a.valor, a.id, ';
		$listvenc .= 'i.razao AS igreja, DATE_FORMAT(a.datapgto,"%d/%m/%Y") AS pgto, a.motivo, f.alias AS nome, ';
		$listvenc .= 'a.idlanc FROM agenda AS a, credores AS f, igreja AS i  WHERE f.id=a.credor AND ';
		$listvenc .= 'i.rol=a.igreja AND a.status<"2" AND TO_DAYS(a.vencimento) < TO_DAYS(NOW())';
		$listvenc_array = mysql_query($listvenc);

		while ($contas = mysql_fetch_array($listvenc_array)) {
			$p++;
			$trtab = ($p % 2) == 0 ? '<tr class="dados" >' : '<tr >';
			$tabela .= $trtab;
			$tabela .= '<td>'.$contas ['vencimento'].'</td><td>';
			$tabela .= '<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria';
			$tabela .= '&id='.$contas['id'].'&pagina1_fix='.$_GET['pagina1_fix'].'&data='.$data.'">';
			$tabela .= $contas['nome'].' &rarr; '.$contas ['igreja'];
			$tabela .= ' &rarr; '.$contas['motivo'].'<a></td>';
			$tabela .= '<td>'.$contas['pgto'].'<a></td>';
			$tabela .= '<td style="text-align: right;" >'.number_format($contas['valor'],2,",",".").'</td>';
			$tabela .= '</tr>';
		}
		return $tabela;
	}

	function vencidasMotivo($motivo,$credor) { //Contas vencidas por motivo

		$dadosMembros	= $this->membro->nomes();
		$dadosCredores	= $this->credor->dados();
		$dadosIgreja	= $this->igreja->Arrayigreja();
		//print_r ($dadosMembros);
		$filtrarCredor = ((int)$credor!='') ? ' a.credor = "'.$credor.'" AND ':'';
		$listvenc  = 'SELECT vencimento,valor,id,igreja,credor,';
		$listvenc .= 'DATE_FORMAT(datapgto,"%d/%m/%Y") AS pgto,motivo,status ';
		$listvenc .= 'FROM agenda WHERE '.$filtrarCredor;
		$listvenc .= ' status<"2" AND TO_DAYS(vencimento) < TO_DAYS(NOW())';
		$listvenc .= 'AND motivo LIKE "%'.$motivo.'%" ORDER BY vencimento ';
		$listvenc_array = mysql_query($listvenc);
		$semLanc = '(<span class="text-danger">S/ Lan&ccedil;amento</span>)';
		while ($contas = mysql_fetch_array($listvenc_array)) {
			if ($contas['status']=='2') {//Marca os já pagos
				$idLanc = ($contas['idlanc']>0) ? '(Reg. '.$contas['idlanc'].') ' : $semLanc;
				$evento = '<span class="glyphicon glyphicon-ok text-success"';
				$evento .= ' aria-hidden="true" ></span>  '.$idLanc;
				$titulo = 'D&iacute;�vida Paga! Obrigado.';
			}elseif ($contas['status']=='1'){
				$evento  = '<span class="glyphicon glyphicon-warning-sign text-warning"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'Atualizado. Aguardado confirma&ccedil;&atilde;o de pgto!';
			}elseif ($contas['status']<'2' && $contas['vencimento'] < date ('Y-m-d') ){
				$evento  = '<span class="glyphicon glyphicon-remove-sign text-danger"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'D&iacute;�vida vencida!';
			}else {
				$evento ='';
				$titulo = 'Click aqui atualizar!';
			}
			if (strstr($contas['credor'], 'r')) {
				$rolMembro = trim ($contas['credor'], 'r');
				$nome = $dadosMembros[(int)$rolMembro]['0'];
			}elseif (strstr($contas['credor'], '@')) {
				list ($r,$rolMembro) = explode ('@',$contas['credor']);
				$nome = $dadosMembros[(int)$rolMembro]['0'];
			}else {
				$nome = $dadosCredores[$contas['credor']]['0'];
			}
			$p++;
			$trtab = ($p % 2) == 0 ? '<tr class="dados" >' : '<tr >';
			$tabela .=  $trtab;
			$tabela .=  '<td>'.conv_valor_br($contas ['vencimento']).'</td><td>';
			$tabela .=  '<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria
				&id='.$contas['id'].'&pagina1_fix='.$_GET['pagina1_fix'].'" title="'.$titulo.'">';
			$tabela .=  $evento.$nome.':'.$dadosIgreja[$contas ['igreja']]['0'];
			$tabela .=  ' &rarr; '.$contas['motivo'].'<a></td>';
			$tabela .= '<td>'.$contas['pgto'].'<a></td>';
			$tabela .=  '<td style="text-align: right;" >'.number_format($contas['valor'],2,",",".").'</td>';
			$tabela .=  '</tr>';
		}
		return $tabela;
	}

	function motivo($motivo,$credor) { //Lista contas agendas por motivo

		$dadosMembros	= $this->membro->nomes();
		$dadosCredores	= $this->credor->dados();
		$dadosIgreja	= $this->igreja->Arrayigreja();

		$filtrarCredor = ((int)$credor!='') ? ' a.credor = "'.$credor.'" AND ':'';
		if (strstr($credor, 'r')) {
			$credor = trim($credor,"membro@");
			$opCredor = 'f.id=a.credor';
		} else {
			$opCredor = 'f.id=a.credor';
		}
		$listvenc  = 'SELECT a.vencimento, a.valor, a.id, a.status,a.credor, ';
		$listvenc .= 'i.razao AS igreja, DATE_FORMAT(a.datapgto,"%d/%m/%Y") AS pgto, a.motivo, a.status,';
		$listvenc .= 'a.idlanc FROM agenda AS a, igreja AS i  WHERE '.$filtrarCredor;
		$listvenc .= 'i.rol=a.igreja AND motivo LIKE "%'.$motivo.'%"';
		$listvenc_array = mysql_query($listvenc);
		$semLanc = '(<span class="text-danger">S/ Lan&ccedil;amento</span>)';
		while ($contas = mysql_fetch_array($listvenc_array)) {
			if ($contas['status']=='2') {//Marca os já pagos
				$idLanc = ($contas['idlanc']>0) ? '(Reg. '.$contas['idlanc'].') ' : $semLanc;
				$evento = '<span class="glyphicon glyphicon-ok text-success"';
				$evento .= ' aria-hidden="true" ></span>  '.$idLanc;
				$titulo = 'D&acute;�vida Paga! Obrigado. Motivo:'.$contas['motivo'];
			}elseif ($contas['status']=='1'){
				$evento  = '<span class="glyphicon glyphicon-warning-sign text-warning"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'Atualizado. Aguardado confirma&ccedil;o de pgto! Motivo:'.$contas['motivo'];
			}elseif ($contas['status']<'2' && $contas['vencimento'] < date ('Y-m-d') ){
				$evento  = '<span class="glyphicon glyphicon-remove-sign text-danger"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'D&iacute;�vida vencida! Motivo:'.$contas['motivo'];
			}else {
				$evento ='';
				$titulo = 'Click aqui atualizar!';
			}
			if (strstr($contas['credor'], 'r')) {
				$rolMembro = trim ($contas['credor'], 'r');
				$nome = $dadosMembros[intval($rolMembro)]['0'];
			}elseif (strstr($contas['credor'], '@')) {
				list ($r,$rolMembro) = explode ('@',$contas['credor']);
				$nome = $dadosMembros[intval($rolMembro)]['0'];
			}else {
				$nome = $dadosCredores[$contas['credor']]['0'];
			}

			$p++;
			$trtab = ($p % 2) == 0 ? '<tr class="dados" >' : '<tr >';
			$tabela .=  $trtab;
			$tabela .=  '<td>'.conv_valor_br($contas ['vencimento']).'</td><td>';
			$tabela .=  '<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&
				id='.$contas['id'].'&pagina1_fix='.$_GET['pagina1_fix'].'" title="'.$titulo.'">';
			$tabela .=  $contas['nome'].$evento.$nome.':'.$contas ['igreja'];
			$tabela .=  ' &rarr; '.$contas['motivo'].'<a></td>';
			$tabela .= '<td>'.$contas['pgto'].'<a></td>';
			$tabela .=  '<td style="text-align: right;" >'.number_format($contas['valor'],2,",",".").'</td>';
			$tabela .=  '</tr>';
		}
		return $tabela;
	}

	function demonstrativo ($dia,$credor,$pagamento) {
		
		$linhaResult='';
		$periodo  = 'SELECT a.vencimento, a.valor, a.id, a.credor,';
		$periodo .= 'a.igreja, a.status, a.motivo, a.idlanc ';
		$periodo .= 'FROM agenda AS a WHERE ';
		if ($credor>'0') {
			$periodo .= ' a.credor='.$credor.' AND ';
			$linkcredor = '&data="'.$dia.'&credor='.$credor;
		}else {
			$linkcredor = '&data='.$pagamento;
		}
		if (!empty($_GET['igreja'])){
			$igRol = intval($_GET['igreja']);
			$periodo .= ' a.igreja='.$igRol.' AND ';
			}
		$periodo .= ' a.vencimento = "'.$dia.'"';
		$periodo_array = mysql_query($periodo)  or die (mysql_error());
		$numLinhas	= mysql_num_rows($periodo_array);
		//echo "<h1>Linhas Afetadas $numLinhas</h1>";
		$semLanc = '(<span class="text-danger">S/ Lan&ccedil;amento</span>)';
		if ($numLinhas>0) {
		while ($periodo_dados =mysql_fetch_array($periodo_array)) {
			if ($periodo_dados['status']=='2') {//Marca os já pagos
				$idLanc = ($periodo_dados['idlanc']>0) ? '(Reg. '.$periodo_dados['idlanc'].') ' : $semLanc;
				$evento = '<span class="glyphicon glyphicon-ok text-success"';
				$evento .= ' aria-hidden="true" ></span>  '.$idLanc;
				$titulo = 'D&iacute;�vida Paga! Obrigado. Motivo: '.$periodo_dados['motivo'];
			}elseif ($periodo_dados['status']=='1'){
				$evento  = '<span class="glyphicon glyphicon-warning-sign text-warning"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'Atualizado. Aguardado confirma&ccedil;&atilde;o de pgto! Motivo: '.$periodo_dados['motivo'];
			}elseif ($periodo_dados['status']<'2' && $periodo_dados['vencimento'] < date ('Y-m-d') ){
				$evento  = '<span class="glyphicon glyphicon-remove-sign text-danger"';
				$evento .= ' aria-hidden="true" ></span> ';
				$titulo = 'D&iacute;�vida vencida! Motivo: '.$periodo_dados['motivo'];
			}else {
				$evento ='';
				$titulo = 'Click aqui atualizar! Motivo: '.$periodo_dados['motivo'];
			}

			if ($periodo_dados['igreja']<'1') {
				$evento .= 'Templo Sede - ';
			}else {
				$igreja_ev = new DBRecord('igreja',$periodo_dados['igreja'], 'rol');
				$evento .= $igreja_ev->razao();
			}
			if (strstr($periodo_dados['credor'],'r')) {
				$rolCredor = str_replace('r', "", $periodo_dados['credor']);
				$membro = new DBRecord('membro',$rolCredor,'rol' );
				$evento .= ' &rarr; '.$membro->nome();
			}else {
				$credor= new DBRecord('credores',$periodo_dados['credor'],'id');
				$evento .= ' &rarr; '.$credor->alias();
			}
			$linhaResult .= '<a title="'.$titulo.'" href="./?escolha=tesouraria/agenda.php&
			menu=top_tesouraria&id='.$periodo_dados['id'].'&pagina1_fix='.$_GET['pagina1_fix'].$linkcredor.'">';
			$linhaResult .= $evento;
			$linhaResult .= ' &rarr; R$ '.number_format($periodo_dados['valor'],2,",",".").
			'</a> (<span class="text-info">'.$periodo_dados['motivo'].'</span>)<br />';
			$total += $periodo_dados['valor'];
		}
	}else {
		$total=0;
	}
		$linhaResult .= '</td><td  class="text-right" >'.number_format($total,2,",",".").'</td>';
		return array($linhaResult,$total);
	}
}
?>
