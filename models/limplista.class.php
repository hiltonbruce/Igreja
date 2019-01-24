<?php

class limplista {
   /*****************************************************************************************************
   	* Exemplo de funcionamento desta classe:
	*$rec = new  limplista ($igreja,$mesref); Informe a igreja e o mês de referência
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
		$this->tabtbody = ''; //Limpa variável para receber os dados da tabela


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
		$this->tabtbody = ''; //Limpa variável para receber os dados da tabela
		if (mysql_num_rows($sqlLimp)>0) {
			while($lista = mysql_fetch_array($sqlLimp)){
				//Faz o trabalho de zebrar a tabela
				$this->tabtbody .=  '<tr>';
				++$inclimp;
				//Coluna Item
				$this->tabtbody .= sprintf("<td class='text-center'>%'03u</td>",$inclimp);
				//Coluna Unidade
				$this->tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
				//Coluna Discriminação
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
		//Select mysql na tabela limpeza para listar o total para o período
	  $tot 	 = 'SELECT p.id,l.quant,p.discrim,p.unid,p.quant as qunid ';
	  $tot 	.= 'FROM limpezpedid AS l, limpeza AS p ';
	  $tot 	.= 'WHERE mesref="'.$this->mesref.'" AND ';
	  $tot 	.= 'p.id = l.item GROUP BY l.item ORDER BY p.discrim';
	  $totLimp = mysql_query($tot);
	  $incrrc=0; //indece p/ zebrar tabela
	  $tabtbody = ''; //Limpa variável para receber os dados da tabela
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
			//Coluna Discriminação
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
		//Select mysql na tabela limpeza para listar o total para o período

	  $tot 	 = 'SELECT p.id,l.quant,p.discrim,p.unid,p.quant as qunid ';
	  $tot 	.= 'FROM limpezpedid AS l, limpeza AS p ';
	  $tot 	.= 'WHERE mesref="'.$this->mesref.'" AND l.entrega = "1" AND ';
	  $tot 	.= 'p.id = l.item GROUP BY l.item ORDER BY p.discrim';
	  $totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa variável para receber os dados da tabela
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
			//Coluna Discriminação
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$vlrtot['totitem']);
			//Coluna Quantidade entregue
			$tabtbody .= "<td></td>";
		}
	return $tabtbody;
	}

	public function TotMatPegar() {
		//Select mysql na tabela limpeza para listar o total para o período
	  $tot 	 = 'SELECT p.id,l.quant,p.discrim,p.unid,p.quant as qunid ';
	  $tot 	.= 'FROM limpezpedid AS l, limpeza AS p ';
	  $tot 	.= 'WHERE mesref="'.$this->mesref.'" AND l.entrega = 0 AND ';
	  $tot 	.= 'p.id = l.item GROUP BY l.item ORDER BY p.discrim';
	  $totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa variável para receber os dados da tabela
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
			//Coluna Discriminação
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$vlrtot['totitem']);
			//Coluna Quantidade entregue
			$tabtbody .= "<td></td>";
		}
	return $tabtbody;
	}

	public function ListaMaterial() {
		//Select mysql na tabela limpeza para listar o total para o período
		$tot 	 = 'SELECT p.id,p.discrim,p.unid,p.quant as qunid, p.tempo  ';
		$tot 	.= 'FROM limpeza AS p ORDER BY discrim';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa variável para receber os dados da tabela
		while($lista = mysql_fetch_array($totLimp)){
			$tabtbody .=  '<tr>';
			++$inclimp;
			//Coluna Item
			$tabtbody .= sprintf("<td class='text-center'>%'03u</td>",$inclimp);
			//Coluna Unidade
			$tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
			//Coluna Discriminação
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$lista['tempo']);
		}
		return $tabtbody;
	}

  public function materialFormPed() {
		//Select mysql na tabela limpeza para listar o total para o período
		$tot 	 = 'SELECT p.id,p.discrim,p.unid,p.quant as qunid  ';
		$tot 	.= 'FROM limpeza AS p WHERE p.authorized="1" ORDER BY discrim';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa variável para receber os dados da tabela
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
		//Select mysql na tabela limpeza para listar o total para o período
		$histReg = new datetime ('NOW');
		$tot 	 = 'SELECT l.*,i.matlimpeza,i.rol AS igreja ';
		$tot 	.= 'FROM limpeza AS l,igreja AS i ';
		$tot 	.= 'ORDER BY i.razao';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = false; //Limpa variável para receber os dados da tabela
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
			# Completa e inserção dos dados
				$item=0;
				echo '<script>alert("** Fim dos itens! **");</script>';
				$rest = substr($valores, 0, -3);  // retorna sem os três últimos caracteres
				echo $rest;
				$pedLimpeza= new insert ($rest,"limpezpedid");
				echo $pedLimpeza->inserir();
				$valores='';
		}

		return $tabtbody;
	}
}

?>
