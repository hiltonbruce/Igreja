<?php

class limplista {
   /*****************************************************************************************************
   	* Exemplo de funcionamento desta classe:
	*$rec = new  limplista ($igreja,$mesref); Informe a igreja e o m�s de refer�ncia
	* para montar o corpo da tabela
	*
	*****************************************************************************************************
	*/

	var $mesref;

	function limplista ($mesref,$mesAnt01,$mesAnt02){
		//Select mysql na tabela limpeza, limpezpedid e igreja
		  $this->mesref	 	= $mesref;
		  $this->anterior1	= $mesAnt01;
		  $this->anterior2  = $mesAnt02;
		  $this->igreja	 = $igreja;

	}

	function tabelaLimp ($igreja) {
		$sql 	 = 'SELECT l.quant,p.discrim,p.unid,p.quant as qunid, l.item AS item, l.mesref ';
		$sql 	.= 'FROM limpezpedid AS l, limpeza AS p ';
		$sql 	.= 'WHERE igreja = "'.$igreja.'" AND ';
		$sql 	.= '(mesref="'.$this->mesref.'" OR mesref="'.$this->anterior1.'" OR mesref="'.$this->anterior2.'")';
		$sql 	.= ' AND p.id = l.item ORDER BY p.discrim,l.id DESC ';
		$sqlLimp = mysql_query($sql);
		$incrrc=0; //indece p/ zebrar tabela
		$this->tabtbody = ''; //Limpa vari�vel para receber os dados da tabela


		if (mysql_num_rows($sqlLimp)>0) {

			while($lista = mysql_fetch_array($sqlLimp)){

				$indice = $lista['item'];

				if ($linhaTab[$indice] =='') {
					$linhaTab[$indice] = $lista['qunid'].' '.$lista['unid'].
							','.$lista['discrim'].
							','.$lista['mesref'].' '.$lista['quant'];
					//array_push($linhaTab[$lista['item']], array($lista['mesref']=>$lista['quant']));
				}else {
					$linhaTab[$indice] .=','.$lista['mesref'].' '.$lista['quant'];
						}
			}

		}else {
			//Coluna Quantidade entregue
				$this->tabtbody .= "<td colspan='5'> Nenhum item Solicitado</td>";

		}

	return $linhaTab;

	}

	function tabLimp ($igreja) {
		$sql 	 = 'SELECT l.quant,p.discrim,p.unid,p.quant as qunid ';
		$sql 	.= 'FROM limpezpedid AS l, limpeza AS p ';
		$sql 	.= 'WHERE igreja = "'.$igreja.'" AND mesref="'.$this->mesref.'" AND ';
		$sql 	.= 'p.id = l.item ORDER BY p.discrim ';
		$sqlLimp = mysql_query($sql);
		$incrrc=0; //indece p/ zebrar tabela
		$this->tabtbody = ''; //Limpa vari�vel para receber os dados da tabela
		if (mysql_num_rows($sqlLimp)>0) {
			while($lista = mysql_fetch_array($sqlLimp)){
				//Faz o trabalho de zebrar a tabela
				$this->tabtbody .=  '<tr>';
				++$inclimp;
				//Coluna Item
				$this->tabtbody .= sprintf("<td class='text-center'>%'03u</td>",$inclimp);
				//Coluna Unidade
				$this->tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
				//Coluna Discrimina��o
				$this->tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
				//Coluna Quantidade Solicitada
				$this->tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$lista['quant']);
				//Coluna Quantidade entregue
				$this->tabtbody .= "<td></td>";
			}
		}else {
			//Coluna Quantidade entregue
			$this->tabtbody .= "<td colspan='5'> Nenhum item Solicitado</td>";
		}
		return $this->tabtbody;
	}

	public function TotMaterial() {
		//Select mysql na tabela limpeza para listar o total para o per�odo
	  $tot 	 = 'SELECT p.id,l.quant,p.discrim,p.unid,p.quant as qunid ';
	  $tot 	.= 'FROM limpezpedid AS l, limpeza AS p ';
	  $tot 	.= 'WHERE mesref="'.$this->mesref.'" AND ';
	  $tot 	.= 'p.id = l.item GROUP BY l.item ORDER BY p.discrim';
	  $totLimp = mysql_query($tot);
	  $incrrc=0; //indece p/ zebrar tabela
	  $tabtbody = ''; //Limpa vari�vel para receber os dados da tabela
	  if (mysql_num_rows($totLimp)>'0') {
		while($lista = mysql_fetch_array($totLimp)){

			$item 		 = "SELECT SUM(quant) as totitem ";
			$item 		.= "FROM limpezpedid WHERE ";
			$item 		.= "mesref='".$this->mesref."' AND item=".$lista['id'];
  		$quanttot 	 = mysql_query($item);
  		$vlrtot 	 = mysql_fetch_array($quanttot);
			$tabtbody .=  '<tr>';
			++$inclimp;
			//Coluna Item
			$tabtbody .= sprintf("<td class='text-center'>%'03u</td>",$inclimp);
			//Coluna Unidade
			$tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
			//Coluna Discrimina��o
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$vlrtot['totitem']);
			//Coluna Quantidade entregue
			$tabtbody .= "<td></td>";
		}
	}else {
		$tabtbody = false;
	}

	return $tabtbody;

	}

	public function TotMatEntregar() {
		//Select mysql na tabela limpeza para listar o total para o per�odo

	  $tot 	 = 'SELECT p.id,l.quant,p.discrim,p.unid,p.quant as qunid ';
	  $tot 	.= 'FROM limpezpedid AS l, limpeza AS p ';
	  $tot 	.= 'WHERE mesref="'.$this->mesref.'" AND l.entrega = "1" AND ';
	  $tot 	.= 'p.id = l.item GROUP BY l.item ORDER BY p.discrim';
	  $totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa vari�vel para receber os dados da tabela
		while($lista = mysql_fetch_array($totLimp)){
			$item 		 = "SELECT SUM(quant) as totitem ";
			$item 		.= "FROM limpezpedid WHERE entrega = '1' AND ";
			$item 		.= "mesref='".$this->mesref."' AND item=".$lista['id'];
  		$quanttot 	 = mysql_query($item);
  		$vlrtot 	 = mysql_fetch_array($quanttot);

			$tabtbody .=  '<tr>';
			++$inclimp;
			//Coluna Item
			$tabtbody .= sprintf("<td class='text-center'>%'03u</td>",$inclimp);
			//Coluna Unidade
			$tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
			//Coluna Discrimina��o
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$vlrtot['totitem']);
			//Coluna Quantidade entregue
			$tabtbody .= "<td></td>";
		}
	return $tabtbody;
	}

	public function TotMatPegar() {
		//Select mysql na tabela limpeza para listar o total para o per�odo
	  $tot 	 = 'SELECT p.id,l.quant,p.discrim,p.unid,p.quant as qunid ';
	  $tot 	.= 'FROM limpezpedid AS l, limpeza AS p ';
	  $tot 	.= 'WHERE mesref="'.$this->mesref.'" AND l.entrega = 0 AND ';
	  $tot 	.= 'p.id = l.item GROUP BY l.item ORDER BY p.discrim';
	  $totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa vari�vel para receber os dados da tabela
		while($lista = mysql_fetch_array($totLimp)){
			$item 		 = "SELECT SUM(quant) as totitem ";
			$item 		.= "FROM limpezpedid WHERE entrega = 0 AND ";
			$item 		.= "mesref='".$this->mesref."' AND item=".$lista['id'];
  		$quanttot 	 = mysql_query($item);
  		$vlrtot 	 = mysql_fetch_array($quanttot);
			$tabtbody .=  '<tr>';
			++$inclimp;
			//Coluna Item
			$tabtbody .= sprintf("<td class='text-center'>%'03u</td>",$inclimp);
			//Coluna Unidade
			$tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
			//Coluna Discrimina��o
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$vlrtot['totitem']);
			//Coluna Quantidade entregue
			$tabtbody .= "<td></td>";
		}
	return $tabtbody;
	}

	public function ListaMaterial() {
		//Select mysql na tabela limpeza para listar o total para o per�odo
		$tot 	 = 'SELECT p.id,p.discrim,p.unid,p.quant as qunid, p.tempo  ';
		$tot 	.= 'FROM limpeza AS p WHERE p.status<>"0" ORDER BY discrim';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa vari�vel para receber os dados da tabela
		while($lista = mysql_fetch_array($totLimp)){
			$tabtbody .=  '<tr>';
			++$inclimp;
			//Coluna Item
			$tabtbody .= sprintf("<td class='text-center'>%'03u</td>",$inclimp);
			//Coluna Unidade
			$tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
			//Coluna Discrimina��o
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$lista['tempo']);
		}
		return $tabtbody;
	}

	public function FormMaterial($id=NULL) {
		global $conn;
		//Select mysql na tabela limpeza para listar o total para o per�odo
		$tot 	 = 'SELECT * ';
		$tot 	.= 'FROM limpeza AS p ORDER BY discrim';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa vari�vel para receber os dados da tabela

		// Verifica se há Registros já feitos para liberar edição de nome do Item
		if ($id >'0') {
		$materialRow = "SELECT * FROM limpezpedid WHERE item='$id'";
		$stmtRow = $conn->query($materialRow);
		$resultsRow = $stmtRow->rowCount();
	}

	$discrimDisab = ($resultsRow>0) ? 'disabled' : '' ;

		while($lista = mysql_fetch_array($totLimp)){
			// var_dump($lista);
			++$inclimp;
			$campoIncl = sprintf("<td class='text-center'>%'03u</td>",$inclimp);
			//Coluna Status
			switch ($lista['status']) {
				case '0':
					$msg = '<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Indispon&iacute;vel';
					$verStatus = '<button type="button" class="btn btn-danger btn-xs">'.$msg.'</button>';
					$verStatusLin = '<p class="text-danger">'.$msg.'</p>';
					break;
				case '1':
					$msg = '<span class="glyphicon glyphicon-check" aria-hidden="true"></span> Vis&iacute;vel';
					$verStatus = '<button type="button" class="btn btn-info btn-xs">'.$msg.'</button>';
					$verStatusLin = '<p class="text-info">'.$msg.'</p>';
					break;
				case '2':
					$msg = '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> oculto';
					$verStatus = '<button type="button" class="btn btn-warning btn-xs">'.$msg.'</button>';
					$verStatusLin = '<p class="text-warning">'.$msg.'</p>';
					break;

				default:
					$msg = '<span class="glyphicon glyphicon-check" aria-hidden="true"></span> Exibição não definida';
					$verStatus = '<button type="button" class="btn btn-info btn-xs">'.$msg.'</button>';
					$verStatusLin = '<p class="text-muted">'.$msg.'</p>';
					break;
			}
			$tabtbody .=  '<tr>';
			if ($id==$lista['id']) {
						//Coluna Item
			$tabtbody .= '<td class="text-center"><br />';
			if ($lista['status']!='1') {
				$tabtbody .=  '<p><a href="./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=13&id='.$lista['id'].'&status=1" ><button class="btn btn-primary btn-xs">Ativar</button> </a></p>';
			}
			if ($lista['status']!='0') {
				$tabtbody .=  '<p><a href="./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=13&id='.$lista['id'].'&status=0" ><button class="btn btn-danger btn-xs">Desativar</button> </a></p>';
			}
			if ($lista['status']!='2') {
				$tabtbody .=  '<a href="./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=13&id='.$lista['id'].'&status=2" ><button class="btn btn-warning btn-xs">Ocultar</button> </a></td>';
			}

			$tabtbody .= '<form class="" action="./" method="get">';

			$tabtbody .= '<td colspan="11"><input type="hidden" name="id" value="'.$lista['id'].'">';
			//Coluna Quantidade
			$tabtbody .= '<div class="row"> <div class="col-xs-1"><label><small>Item</small></label><input type="text" class="form-control input-sm" disabled value="'.$lista['id'].'"></div>';
			//Coluna Quantidade
			$tabtbody .= '<div class="col-xs-2"><label><small>Conte&uacute;do <span class="glyphicon glyphicon-question-sign text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Conte&uacute;do por unidade"></span></small></label><input type="text" name="quant" class="form-control input-sm" autofocus value="'.$lista['quant'].'"></div>';
			//Coluna Unidade
			$unid = $lista['unid'];
			require_once ('forms/tes/selecMedida.php');
			// echo $selMat;
			$tabtbody .= '<div class="col-xs-2">'.$selMat.'</div>';
			//Coluna Discrimina��o
			$tabtbody .= '<div class="col-xs-3"><label><small>Discrimina&ccedil;&atilde;o</small></label><input type="text" name="discrim" class="form-control input-sm" placeholder="Discriminação" '.$discrimDisab.' value="'.$lista['discrim'].'"></div>';
			//Coluna Tempo
			$tabtbody .= '<div class="col-xs-1"><label><small>Tempo <span class="glyphicon glyphicon-question-sign text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Valor em m&ecirc;s(es)"></span></small></label><input type="text" name="tempo" class="form-control input-sm" value="'.$lista['tempo'].'" ></div>';
			//Coluna Tipo 1
			$tabtbody .= '<div class="col-xs-1"><label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 1 - Ver Cadastro">Tipo 1</small></label><input type="text" name="tipo1" class="form-control input-sm" value="'.$lista['tipo1'].'"></div>';
			//Coluna Tipo 2
			$tabtbody .= '<div class="col-xs-1"><label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 2 - Ver Cadastro">Tipo 2</small></label><input type="text" name="tipo2" class="form-control input-sm" value="'.$lista['tipo2'].'"></div>';
			//Coluna Tipo 3
			$tabtbody .= '<div class="col-xs-1"><label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 3 - Ver Cadastro">Tipo 3</small></label><input type="text" name="tipo3" class="form-control input-sm" value="'.$lista['tipo3'].'"></div>';
			//Coluna Tipo 4
			$tabtbody .= '<div class="col-xs-1"><label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 4 - Ver Cadastro">Tipo 4</small></label><input type="text" name="tipo4" class="form-control input-sm" value="'.$lista['tipo4'].'"></div>';
			//Coluna Tipo 5
			$tabtbody .= '<div class="col-xs-1"><label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 5 - Ver Cadastro">Tipo 5</small></label><input type="text" name="tipo5" class="form-control input-sm" value="'.$lista['tipo5'].'"></div>';
			//Coluna Valor
			$tabtbody .= '<div class="col-xs-1"><label><small data-toggle="tooltip" data-placement="top" title="Valor unit&aacute;rio em R$">Valor</small></label><input type="text" name="valor" class="form-control input-sm" value="'.number_format($lista['valor'], 2, ',', ' ').'"></div>';
			//Coluna Status
			$tabtbody .= '<div class="col-xs-2"><label><small data-toggle="tooltip" data-placement="top" title="Status de exibi&ccedil;&atilde;o">Status</small></label><br />'.$verStatus.'</div>';
			//Coluna Tipo 5
			$tabtbody .= '<div class="col-xs-2"><label><small>&nbsp;</small></label><input type="submit" class=" form-control input-sm btn-primary btn-xs" value="Alterar!"></div></div>';

			$tabtbody .=  '<input type="hidden" name="escolha" value="controller/limpeza.php">';
			$tabtbody .=  '<input type="hidden" name="menu" value="top_tesouraria">';
			$tabtbody .=  '<input type="hidden" name="limpeza" value="13">';

			$tabtbody .=  '</form>';
			if ($discrimDisab=='disabled') {
				$tabtbody .=  '<p><div class="alert alert-danger alert-dismissible fade in" role="alert">';
				$tabtbody .=  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
				$tabtbody .=  '<h3>Exite '.$resultsRow.' lan&ccedil;amento(s) deste item!</h3>';
				$tabtbody .=  '<p>Portanto &eacute; necess&aacute;rio o cancelamento de todos os lan&ccedil;amentos anteriores, <strong>e n&atilde;o recomendados que isto seja ';
				$tabtbody .=  'realizado</strong>, pois prejudicaria todos os relat&oacute;rios de pedidos afetados pela mudan&ccedil;a!</p>';
				$tabtbody .=  '<p>Portanto s&oacute; podermos liberar a edi&ccedil;&atilde;o do T&iacute;tulo e da Unidade quando h&atilde;o ';
				$tabtbody .=  'h&aacute; nenhum registro anterior.	</p></div></p>';
			}
			$tabtbody .=  '</form>';

			} else {
				$tabtbody .=  '<td class="text-center"><a href="./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=13&id='.$lista['id'].'" ><button class="btn btn-success btn-xs">Editar</button> </a></td>';
			//Coluna Quantidade
			$tabtbody .= '<td class="text-center"> '.$lista['quant'].' </td>';
			// //Coluna Unidade
			$tabtbody .= '<td> '.$lista['unid'].' </td>';
			//Coluna Discrimina��o
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';
			//Coluna Tempo
			$tabtbody .= '<td class="text-center"> '.$lista['tempo'].' </td>';
			//Coluna Tipo 1
			$tabtbody .= '<td class="text-center"> '.$lista['tipo1'].' </td>';
			//Coluna Tipo 2
			$tabtbody .= '<td class="text-center"> '.$lista['tipo2'].' </td>';
			//Coluna Tipo 3
			$tabtbody .= '<td class="text-center"> '.$lista['tipo3'].' </td>';
			//Coluna Tipo 4
			$tabtbody .= '<td class="text-center"> '.$lista['tipo4'].' </td>';
			//Coluna Tipo 5
			$tabtbody .= '<td class="text-center"> '.$lista['tipo5'].' </td>';
			//Coluna Valor
			$tabtbody .= '<td class="text-right"> '.number_format($lista['valor'], 2, ',', ' ').' </td>';
			//Coluna Status
			$tabtbody .= '<td class="text-center"> '.$verStatusLin.' </td>';
			}
			$tabtbody .=  '</tr>';
		}
		return $tabtbody;
	}

  public function materialFormPed() {
		//Select mysql na tabela limpeza para listar o total para o per�odo
		$tot 	 = 'SELECT p.id,p.discrim,p.unid,p.quant as qunid  ';
		$tot 	.= 'FROM limpeza AS p WHERE p.status="1" ORDER BY discrim';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa vari�vel para receber os dados da tabela
		while($lista = mysql_fetch_array($totLimp)){
			//Faz o trabalho de zebrar a tabela
			if ($inclimp%2=="0") {
				$tabtbody .=  '<tr>';
			}
			++$inclimp;
			//Coluna Unidade
			$tabtbody .= sprintf("<td>(%s %s) %s</td>",$lista['qunid'],$lista['unid'],$lista['discrim']);
			//Coluna Quantidade
			$tabtbody .= '<td> &nbsp;&nbsp;&nbsp; </td>';//Modificar qdo apliar para outros documentos
		}
		return $tabtbody;
	}

	public function geraLista() {
		//Select mysql na tabela limpeza para listar o total para o per�odo
		$histReg = new datetime ('NOW');
		$tot 	 = 'SELECT l.*,i.matlimpeza,i.rol AS igreja ';
		$tot 	.= 'FROM limpeza AS l,igreja AS i ';
		$tot 	.= 'ORDER BY i.razao';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = false; //Limpa vari�vel para receber os dados da tabela
		while($lista = mysql_fetch_array($totLimp)){

			$tipo = 'tipo'.$lista['matlimpeza'];
			if ($item=='50' && $lista[$tipo]>'0') {
				$valores .= '"", "'.$lista['id'].'", "'.$lista[$tipo].'", "'.$this->mesref.'", "'.$histReg->format('Y-m-d H:i:s').'",';
				$valores .= ' "'.$lista['igreja'].'", "1", "'.$_SESSION['valid_user'].' '.$histReg->format('Y-m-d H:i:s').'"';

				$item=0;
				echo '<script>alert("** 150 itens! **");</script>';
				echo $valores;

				$pedLimpeza= new insert ($valores,"limpezpedid");
				echo $pedLimpeza->inserir();
				$valores='';
			}elseif ($lista[$tipo]>'0') {
				++$item;
				$valores .= '"", "'.$lista['id'].'", "'.$lista[$tipo].'", "'.$this->mesref.'", "'.$histReg->format('Y-m-d H:i:s').'",';
				$valores .= ' "'.$lista['igreja'].'", "1", "'.$_SESSION['valid_user'].' '.$histReg->format('Y-m-d H:i:s').'"),(';
				//Faz o trabalho de zebrar a tabela
				$tabtbody = true;
			}
		}

		if ($valores!='') {
			# Completa e inser��o dos dados
				$item=0;
				echo '<script>alert("** Fim dos itens! **");</script>';
				$rest = substr($valores, 0, -3);  // retorna sem os tr�s �ltimos caracteres
				echo $rest;
				$pedLimpeza= new insert ($rest,"limpezpedid");
				echo $pedLimpeza->inserir();
				$valores='';
		}

		return $tabtbody;
	}
}

?>
