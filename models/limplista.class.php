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
		$sql 	.= ' AND p.id = l.item ORDER BY p.discrim ';
		$sqlLimp = mysql_query($sql);
		$incrrc=0; //indece p/ zebrar tabela
		$this->tabtbody = ''; //Limpa variável para receber os dados da tabela
		
		
		if (mysql_num_rows($sqlLimp)>0) {
			
			$itemInicial='';
			$colAnt02 = '<td></td>';
			$colAnt01 = '<td></td>';
			$colAtual = '<td></td></tr>';
			$linhaTab = array();
			while($lista = mysql_fetch_assoc($sqlLimp)){
				
				if ((count($linhaTab[$lista['item']]))=='') {
					$linhaTab[$lista['item']] =	array('unid'=>$lista['qunid'].' '.$lista['unid'],
				 			'descr'=>$lista['discrim']);
					array_push($linhaTab[$lista['item']], array($lista['mesref']=>$lista['quant']));
				}else {
					array_push($linhaTab[$lista['item']], array($lista['mesref']=>$lista['quant']));
						}
				 
				
				
				/*
				$contaTotItens = array_count_values(array_map ($lista));
				echo ' *****<br/>';
				print_r($lista);
				
				switch ($lista['mesref']) {
					case $this->mesref:
						//Coluna Atual
						$colAtual = sprintf("<td>%s</td></tr>",$lista['quant']);
						break;
					case $this->anterior1:
						//Coluna Anterior01
						$colAnt01 = sprintf("<td>%s</td>",$lista['quant']);
						break;
					case $this->anterior2:
						//Coluna Anterior02
						$colAnt02 = sprintf("<td>%s</td>",$lista['quant']);
						break;
				}
				
				
				//Faz o trabalho de zebrar a tabela
				$itemColuna++;
				
				if ($itemInicial!=$lista['item']) {
					
					$inclimp++;
					
					if ($inclimp%2=="0" && $itemColuna=='1') {
						$colInicio = "<tr class='odd' >";
					} elseif ($itemColuna=='1') { 
						$colInicio =  '<tr>';
					}
					
					
					$itemInicial = $lista['item'];
					
				}
					//Coluna Item
					$colItem = sprintf("<td>%'03u  item - %s  itemInicial - %s *</td>",$inclimp,$lista['item'],$itemInicial);
					$colUnid = sprintf("<td>%s %s anterior1 %s</td>",$lista['qunid'],$lista['unid'],$this->anterior2);
					$colDescr= sprintf("<td>%s %s anterior2 %s</td>",$lista['discrim'],$lista['unid'],$this->anterior1);
				
					if ($itemInicial!=$linha['item'] && $itemColuna>'3') {
						$this->tabtbody .= $colInicio.$colItem.$colAnt02.$colAnt01.$colUnid.$colDescr.$colAtual;
						$itemColuna = 0;
					}
				*/
			}
			
		
		}else {
			//Coluna Quantidade entregue
				$this->tabtbody .= "<td colspan='5'> Nenhum item Solicitado</td>";
			
		}
		
		echo ' *****<br/>';

		$ar = array('J. Karjalainen', 'J. Karjalainen', 60, '60', 'J. Karjalainen', 'j. karjalainen', 'Fastway', 'FASTWAY', 'Fastway', 'fastway', 'YUP', 60, array(60,60));
		
		print_r( array_count_values(array_map('strtolower', $ar)));
		echo '<br/> ++++ -> ';
		print_r($linhaTab);
		
		
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
			
		while($lista = mysql_fetch_array($totLimp)){
			
			$item 		 = "SELECT SUM(quant) as totitem ";
			$item 		.= "FROM limpezpedid WHERE ";
			$item 		.= "mesref='".$this->mesref."' AND item=".$lista['id'];
	  		$quanttot 	 = mysql_query($item);
	  		$vlrtot 	 = mysql_fetch_array($quanttot);
			
			//Faz o trabalho de zebrar a tabela
			if ($inclimp%2=="0") {
				$tabtbody .= "<tr class='odd' >";
			} else { 
				$tabtbody .=  '<tr>';
			}
		
			++$inclimp;
			
			//Coluna Item
			$tabtbody .= sprintf("<td>%'03u</td>",$inclimp);
			
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
			
			//Faz o trabalho de zebrar a tabela
			if ($inclimp%2=="0") {
				$tabtbody .= "<tr class='odd' >";
			} else { 
				$tabtbody .=  '<tr>';
			}
		
			++$inclimp;
			
			//Coluna Item
			$tabtbody .= sprintf("<td>%'03u</td>",$inclimp);
			
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
			
			//Faz o trabalho de zebrar a tabela
			if ($inclimp%2=="0") {
				$tabtbody .= "<tr class='odd' >";
			} else { 
				$tabtbody .=  '<tr>';
			}
		
			++$inclimp;
			
			//Coluna Item
			$tabtbody .= sprintf("<td>%'03u</td>",$inclimp);
			
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
		$tot 	.= 'FROM limpeza AS p ';
		$totLimp = mysql_query($tot);
		$incrrc=0; //indece p/ zebrar tabela
		$tabtbody = ''; //Limpa variável para receber os dados da tabela
			
		while($lista = mysql_fetch_array($totLimp)){
								
			//Faz o trabalho de zebrar a tabela
			if ($inclimp%2=="0") {
				$tabtbody .= "<tr class='odd' >";
			} else {
				$tabtbody .=  '<tr>';
			}
	
			++$inclimp;
				
			//Coluna Item
			$tabtbody .= sprintf("<td>%'03u</td>",$inclimp);
				
			//Coluna Unidade
			$tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
				
			//Coluna Discriminação
			$tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
				
			//Coluna Quantidade Solicitada
			$tabtbody .= sprintf("<td style='text-align: center;'>%s</td>",$lista['tempo']);
		}
	
		return $tabtbody;
	
	}
}

?>
