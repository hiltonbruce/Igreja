<?php
class menutes {

	protected $menuGET;
	protected $escGET;

	function __construct ($menuGET=null, $escGET=null)
	{
		if (empty($menuGET) && !empty($_GET['menu'])) {
			$this->menuGET = $_GET['menu'];
		} else {
			$this->menuGET = null;
		}
		if (empty($escGET) && !empty($_GET['escolha'])) {
			$this->escGET = $_GET['escolha'];
		} else {
			$this->escGET = null;
		}
	}

	function mostra (){
		//Lista todos os recibos
		$this->pag_mostra = (empty($_GET["pag_mostra"])) ? '' : $_GET["pag_mostra"];
		$this->id = (empty($_GET["id"])) ? '' : $_GET["id"];
		$_urlLi_pen='?escolha='.$this->escGET.'&menu='.$this->menuGET.'&id='.$this->id;//Montando o Link para ser passada a classe
		$query_pen = "SELECT * FROM tes_recibo ORDER BY data DESC,id DESC";
		$nmpp_pen="10"; //N?mero de mensagens por p?rginas
		$paginacao_pen = Array();
		$paginacao_pen['link'] = "?"; //Pagina??o na mesma p?gina

		//Faz os calculos na pagina??o
		$sql2_pen = mysql_query ($query_pen) or die (mysql_error());
		$total_pen = mysql_num_rows($sql2_pen) ; //Retorna o total de linha na tabela
		$paginas_pen = ceil ($total_pen/$nmpp_pen); //Retorna o total de p?ginas
		if ($this->pag_mostra<1) {
			$this->pag_mostra = 1;
		} elseif ($this->pag_mostra>$paginas_pen) {
			$this->pag_mostra = $paginas_pen;
		}
		$pagina_pen = $this->pag_mostra-1;
		if ($pagina_pen<0) {$pagina_pen=0;} //Especifica um valor p vari?vel p?gina caso ela esteja setada
		$inicio_pen=$pagina_pen * $nmpp_pen; //Retorna qual ser? a primeira linha a ser mostrada no MySQL
		$sql3_pen = mysql_query ($query_pen." LIMIT $inicio_pen,$nmpp_pen") or die (mysql_error());
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
		 //inicia o cabe?alho de pagina??o
		?>
	  <div class="list-group">
	    <span class="list-group-item active">
			<h4 class="list-group-item-heading">Recibos Recentes</h4>
	    </span>
		<table class='table table-bordered table-striped table-condensed text-center'>
			<colgroup>
				<col id="N&ordm;">
				<col id="Nome">
				<col id="albumCol"/>
			</colgroup>
		<tbody>
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
						$nome = new	DBRecord("credores", $coluna_pen["recebeu"], "id");
						$nome_rec = $nome->razao();
						break;
					default:
						$nome_rec = $coluna_pen["recebeu"];
						break;
				}
				++$inc_pen;
				if ($inc_pen>1)
					{
						echo "<tr>";
						$inc_pen=0;
					}else {
					echo '<tr>';}
					echo '<td><a title="'.$coluna_pen['motivo'].'" href="./?escolha=tesouraria/';
					echo 'rec_alterar.php&menu='.$this->menuGET.'&id='.$coluna_pen['id'];
					echo '&pag_mostra='.$this->pag_mostra.'" data-toggle="tooltip" data-placement="left">';
					printf ("%'03u<a></td>",$coluna_pen['id']);
					echo '<td><a title="'.$nome_rec.'" data-toggle="tooltip" data-placement="left" ';
					echo 'href="./?escolha=tesouraria/rec_alterar.php&menu='.$this->menuGET;
					echo '&id='.$coluna_pen['id'].'&pag_mostra='.$this->pag_mostra.'">';
					echo substr($nome_rec,0,7).'<a></td>';
					echo '<td>'.conv_valor_br($coluna_pen['data']).'</td>';
					echo '</tr>';
			}//loop while produtos
	?>
		</tbody>
	</table>
	<?PHP
	//Classe que monta o rodape
	$_rod_pen = new rodape($paginas_pen,$this->pag_mostra,"pag_mostra",$_urlLi_pen,3);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
	$_rod_pen->getRodape();$_rod_pen->form_rodape("P&aacute;gina",'');
	if ($total_pen>"1"){
		printf ("%s recibos!",number_format($total_pen, 0, ',', '.'));
	}elseif ($total_pen=="1"){
		echo " um recibo!";
	}else{
		echo "Com este crit&eacute;rio n&atilde;o obtivemos nenhum resultado, tente melhorar seu argumento de pesquisa!";
	}
	?>
</div>
	<?php
	//Fim das informa??es das pendencias
	//In?cio das pendencias de disciplinados
	}

	function buscarecibo() {
		//formul?rios laterais de busca de recido da tesouraria
		$ind =0;
		?>
	  <div class="list-group">
	    <span class="list-group-item active">
			 <h4 class="list-group-item-heading">Busca de Recibos</h4>
	    </span>
		<fieldset>
		<legend>Membros</legend>
		<?php
			$tab_edit = (empty($tab_edit)) ? '' : $tab_edit ;
			$tab = (empty($tab)) ? '' : $tab ;
			$form = new formrecbusca("recebeu","nome",$tab,$tab_edit);
			$form->formcab();
			$form->getMostrar();
		?>
		</fieldset>
		<fieldset>
		<legend>Credores</legend>
		<form action="" method="get">
			<div class="row">
			  <div class="col-xs-8">
				<?php
					$for_num = new List_sele("credores", "alias", "recebeu");
					echo $for_num->List_sel($ind++,'class="form-control input-sm"');
				?>
			  </div>
			  <div class="col-xs-2">
					<input type="hidden" name="tipo" id="tipo" value="2">
					<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receber? os dados -->
					<input type="hidden" name="menu" value="top_tesouraria" />
					<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Listar" />
			  </div>
			</div>
		</form>
		</fieldset>
		<fieldset>
		<legend>N&atilde;o Membros</legend>
		<form action="" method="get">
		<div class="row">
			<div class="col-sm-12">
					<label>Por Nome</label>
					<input type="text" name="nome" class="form-control input-sm" id="nome" >
			</div>
			<div class="col-sm-7">
				<label>ou por CPF</label>
				<input type="text" name="cpf" class="form-control input-sm" id="cpf" >
			</div>
			<div class="col-sm-7">
				<label>ou por RG</label>
				<input type="text" name="rg" class="form-control input-sm" id="rg" >
			</div>
			<div class="col-sm-1">
				<label>&nbsp;</label>
				<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receber? os dados -->
				<input type="hidden" name="menu" value="top_tesouraria" />
				<input type="hidden" name="tipo" id="tipo" value="3">
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Listar" />
			</div>
		</div>
		</form>
		</fieldset>
		<fieldset>
		<legend>Recibo por N&uacute;mero</legend>
		<form action="" method="get">
			<div class="row">
				<div class="col-sm-7">
				<label>N&ordm;</label>
					<input type="text" class="form-control" name="id" id="id" size="10" >
				</div>
			<div class="col-xs-2">
				<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receber? os dados -->
				<input type="hidden" name="menu" value="top_tesouraria" />
				<label>&nbsp;</label>
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Mostrar!" />
			</div>
		</div>
		</form>
		</fieldset>
		</div>
		<?php
	}

function recibosmembros (){
		//Lista os valores m?ximo, m?nimo, m?dio e total de determinado beneficiado
		//Lista os recibos de um determinado membro
		$id =(int)$_GET ['recebeu'];
		$_urlLi_pen='./?escolha='.$this->escGET.'&menu='.$this->menuGET.'&recebeu='.$_GET['recebeu'];//Montando o Link para ser passada a classe
		$extr  = 'SELECT MAX(valor) AS maximo, MIN(valor) AS minimo, AVG(valor)';
		$extr .= ' AS media, SUM(valor) as total FROM tes_recibo WHERE recebeu='.$id ;
		$extr .= ' AND recebeu>0 AND lancamento>0';
		if ($_GET['tipo']=='2') {
			//Recibos Credores - altera a string $extr
			$extr .= ' AND tipo="2"';
		}elseif ($_GET['tipo']=='3') {
			//Recibos de n?o Membros ou que n?o eram na epoca ou feitos como tal
			//Altera a string $extr
			$nome = ($_GET['nome']!='') ? 'recebeu LIKE "%'.$_GET['nome'].'%" ':'';
			$cpf = ($_GET['cpf']!='') ? 'recebeu LIKE "%'.$_GET['cpf'].'%" ':'';
			if ($nome!='' && $cpf!='') {
				$cpf = 'OR '.$cpf;
			}
			$rg = ($_GET['rg']!='') ? 'recebeu LIKE "%'.$_GET['rg'].'%" ':'';
			if (($nome!='' || $cpf!='') && $rg!='') {
				$rg = 'OR '.$rg;
			}
			$extr  = 'SELECT MAX(valor) AS maximo, MIN(valor) AS minimo, AVG(valor)';
			if ($nome=='' && $cpf=='' && $rg=='') {
				$extr .= ' AS media, SUM(valor) as total FROM tes_recibo ';
			}else {
				$extr .= ' AS media, SUM(valor) as total FROM tes_recibo WHERE ( ';
				$extr .= $nome.$cpf.$rg.')';
			}
			$_urlLi_pen .= '&nome='.$_GET['nome'].'&cpf='.$_GET['cpf'].'&rg='.$_GET['rg'].'&tipo='.$_GET['tipo'];
			//Adicionar ao link do rodap? para o tipo 3
		}
		$extr_rec = mysql_query($extr);
		$valores = mysql_fetch_array($extr_rec);
		$maximo = $valores['maximo'];
		$minimo = $valores['minimo'];
		$media = $valores['media'];
		$total = $valores['total'];
		/**/
		if ($_GET['tipo']==2) {
			$query_pen  = 'SELECT t.id, t.recebeu, t.valor, t.data, t.motivo, t.tipo, f.razao, t.igreja ';
			$query_pen .= 'FROM tes_recibo AS t, credores AS f WHERE t.recebeu='.$id;
			$query_pen .= ' AND t.tipo=2 AND t.recebeu = f.id ORDER BY  t.data DESC,t.id DESC ';
		}elseif ($_GET['tipo']==3) {
			//Recibos n?o membros
			if ($nome=='' && $cpf=='' && $rg=='') {
					$query_pen  = 'SELECT * FROM tes_recibo AND tipo=3 ORDER BY recebeu ASC,id DESC ';
			}else {
					$query_pen  = 'SELECT * FROM tes_recibo WHERE ('.$nome.$cpf.$rg.') AND tipo=3 ORDER BY recebeu ASC,id DESC ';
				}
		} else {
		$query_pen = 'SELECT * FROM tes_recibo AS t, membro AS m WHERE t.recebeu="'.$id;
		$query_pen .= '" AND t.recebeu = m.rol ORDER BY t.data DESC,t.id DESC ';
		}
		$nmpp_pen="10"; //N?mero de mensagens por p?rginas
		$paginacao_pen = Array();
		$paginacao_pen['link'] = "?"; //Pagina??o na mesma p?gina
		//Faz os calculos na pagina??o
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
		<table class="table table-striped table-hover">
		<caption>Lista de Recibos</caption>
			<colgroup>
				<col id="N&ordm;">
				<col id="Nome">
				<col id="Motivo">
				<col id="Valor(R$)">
				<col id="igreja">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">N&ordm;</th>
				<th scope="col">Nome</th>
				<th scope="col">Motivo</th>
				<th scope="col">Valor(R$)</th>
				<th scope="col">Igreja</th>
				<th scope="col">Data</th>
			</tr>
		</thead>
		<tbody id="recibos" >
		<?PHP
			$inc_pen=0;
			while($coluna_pen = mysql_fetch_array($sql3_pen))
			{
		    if ($coluna_pen['lancamento']>0) {
		      $status  = '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span> ';
					$msgLanc ='lan&ccedil;amento confirmado!';
		    }elseif ($coluna_pen['lancamento']=='Cancelado') {
		      $status  = '&nbsp;<span class="glyphicon glyphicon-ok text-info" aria-hidden="true"></span>';
		      $status .= '<span class="text-danger">&nbsp;Recibo Cancelado&nbsp;</span>';
		      $aviso = 'Recibo cancelado!';
		    }else {
		      $status  = '<span class="glyphicon glyphicon-alert text-danger" aria-hidden="true"></span> ';
					$msgLanc ='lan&ccedil;amento pendente!';
		    }
				switch ($coluna_pen["tipo"])
				{
					case 1;
						$nome = new	DBRecord("membro", $coluna_pen["recebeu"], "rol");
						$nome_rec = $nome->nome();
						break;
					case 2;
						$nome = new	DBRecord("credores", $coluna_pen["recebeu"], "id");
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
					echo '<td><a title="Cria&ccedil;&atilde;o : '.$coluna_pen['hist'].'" data-toggle="tooltip" data-placement="left" ';
					echo "href='./?escolha=tesouraria/rec_alterar.php&menu={$this->menuGET}&id={$coluna_pen["id"]}
						&pag_rec={$_GET["pag_rec"]}'>";
					printf ("%'03u<a></td>",$coluna_pen["id"]);
					echo '<td><a title = "'.$msgLanc.'" data-toggle="tooltip" data-placement="left" ';
					echo " href='./?escolha=tesouraria/rec_alterar.php&menu={$this->menuGET}&id={$coluna_pen["id"]}
						&pag_rec={$_GET["pag_rec"]}'>".$status.$nome_rec."<a></td>";
					echo "<td>".$coluna_pen["motivo"]."</td>";
					echo "<td style=' text-align: right;'>".number_format($coluna_pen["valor"],2,",",".")."</td>";
					if ($idCongPgto!=$coluna_pen["igreja"]) {
						$idCongPgto = $coluna_pen["igreja"];
						$dadosCong = new DBRecord('igreja',$idCongPgto,'rol');
						$nomeCongPgto = $dadosCong->razao();
					}
					echo "<td>".$nomeCongPgto."</td>";
					echo "<td>".conv_valor_br ($coluna_pen["data"])."</td>";
				echo "</tr>";
			}//loop while produtos
	?>
		</tbody>
	</table>
	<?PHP
	echo'<div class="alert alert-success"><p><strong>Maior valor:</strong> R$ '.number_format($maximo,2,",",".").' &bull; <strong>Menor valor:</strong> R$ '.number_format($minimo,2,",",".");
	echo ' &bull; <strong>Valor m&eacute;dio:</strong> R$ '.number_format($media,2,",",".");
	echo ' &bull; <strong>Total de:</strong> R$ '.number_format($total,2,",",".").' confirmados!</p>';
	//Classe que monta o rodape
	$_rod_pen = new rodape($paginas_pen,$_GET["pag_rec"],"pag_rec",$_urlLi_pen,15);//(Quantidade de p?ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p?gina)
	$_rod_pen->getRodape();
	$_rod_pen->form_rodape('P&aacute;gina','recebeu');
	//$_rod->getDados();
	echo "<p>";
	if ($paginas_pen>1){
		echo "<span class='style4'>$paginas_pen p&aacute;ginas ";
	}elseif ($paginas_pen==1){
		echo "<span class='style4'>$paginas_pen p&aacute;gina ";
		}else{
		echo "<span class='style4'>Nenhuma registro encontrado! ";}
	if ($total_pen>"1"){
		printf (", com %s recibos!</div>",number_format($total_pen, 0, ',', '.'));
	}elseif ($total_pen=="1"){
		echo "Com apenas um recibo!</div>";
	}else{
		echo "Com este crit&eacute;rio n&atilde;o obti t.recebeu='.$id t.recebeu='.$id t.recebeu='.$id t.recebeu='.$id t.recebeu='.$id t.recebeu='.$id t.recebeu='.$id t.recebeu='.$idvemos nenhum resultado, tente melhorar seu argumento de pesquisa!</div>";
	}
		//Fim das informa??es das pendencias
	echo "</p>";
		//In?cio das pendencias de disciplinados
	}
	public function periodo ($dia=NULL,$mes=NULL,$ano=NULL,$motivo=NULL,$nome=NUL,$lanc=NULLL)
	{
		$retorno = array();
		if (checkdate($mes,$dia,$ano)) {
			$op = 'DATE_FORMAT(t.data,"%Y%m%d")="'.$ano.$mes.$dia.'" AND ';
		} elseif($mes>0 && $mes<13 && $ano>2000) {
			$op = 'DATE_FORMAT(t.data,"%Y%m")="'.$ano.$mes.'" AND ';
		}elseif($mes>0 && $mes<13 ) {
			$op = 'DATE_FORMAT(t.data,"%m")="'.$mes.'" AND ';
		}elseif ($dia>0 AND $dia<32 AND $ano>2000) {
			$op = 'DATE_FORMAT(t.data,"%Y%d")="'.$ano.$dia.'" AND ';
		}elseif ($ano>2000) {
			$op = 'DATE_FORMAT(t.data,"%Y")="'.$ano.'" AND ';
		}elseif ($dia>0 AND $dia<32) {
			$op = 'DATE_FORMAT(t.data,"%d")="'.$dia.'" AND ';
		}/*else {
			$op = 'DATE_FORMAT(t.data,"%Y")="'.date('Y').'" AND ';
		}*/
		//Inclui o na consulta o motivo
		if (isset($motivo)) {
		$escMotivo = mysql_escape_string($motivo);
		$op .= 't.motivo LIKE "%'.$escMotivo.'%" AND ';
	}
		if ($lanc!=NULL && $lanc==1) {
			//Lista apenas recibos pendentes de lançamentos
			$op .= 't.lancamento="0" AND';
		}elseif ($lanc==2) {
			//Lista apenas recibos com lançamentos
			$op .= 't.lancamento>"0" AND t.lancamento<>"Cancelado" AND ';
		}
	if (intval($nome)!='0') {
		// $escRol = mysql_escape_string($nome);
		$op .= 't.recebeu = "'.$nome.'" AND ';
	} elseif ($nome!='') {
		$escNome  = mysql_escape_string($nome);
		$op .= 't.recebeu LIKE "%'.$escNome.'%" AND ';
	}

		$sqlPer  = 'SELECT t.*,i.razao FROM tes_recibo AS t, igreja AS i WHERE '.$op;
		$sqlPer .= '(t.igreja=i.rol OR t.igreja="0") ORDER BY t.data DESC,t.id DESC';
		$resQueryPer = mysql_query($sqlPer);
		while ($resSql = mysql_fetch_array($resQueryPer)) {
			$retorno [$resSql['id']] = array('igreja'=>$resSql['igreja'],'tipo'=>$resSql['tipo'],
				'recebeu'=>$resSql['recebeu'],'valor'=>$resSql['valor'],'conta'=>$resSql['conta'],
				'fonte'=>$resSql['fonte'],'lancamento'=>$resSql['lancamento'],'motivo'=>$resSql['motivo'],
				'data'=>$resSql['data'],'hist'=>$resSql['hist'],'nIgreja'=>$resSql['razao']);
		}
		return $retorno;
		// DATE_FORMAT(data,"%Y%m")<="'.$a.$m.'"'
	}
}
?>
