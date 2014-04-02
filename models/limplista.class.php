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
		$sql 	 = 'SELECT l.quant,p.discrim,p.unid,p.quant as qunid, l.item AS item ';
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
			
			while($lista = mysql_fetch_array($sqlLimp)){
				
				
				
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
				
				if ($itemInicial!=$linha['item']) {
					
					if ($inclimp%2=="0" && $itemColuna=='1') {
						$colInicio = "<tr class='odd' >";
					} elseif ($itemColuna=='1') { 
						$colInicio =  '<tr>';
					}
					
					
					
					$itemInicial = $linha['item'];
					++$inclimp;
					
				}
					//Coluna Item
					$colItem = sprintf("<td>%'03u</td>",$inclimp);
					$colUnid = sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
					$colDescr= '<td> '.$lista['discrim'].' </td>';
				
					if ($itemInicial==$linha['item'] && $itemColuna>'3') {
						$this->tabtbody .= $colInicio.$colAnt02.$colAnt01.$colItem.$colUnid.$colDescr.$colAtual;
						$itemColuna = 0;
					}
				/*
				if ($itemColuna=='1' && $lista['mesref']==$this->anterior2) {
					//Coluna Anterior02
					$anterior2 = sprintf("<td>%s</td>",$lista['quant']);
				}
				
				if ($lista['mesref']==$this->anterior1) {
					if ($anterior2=='') {
						//Coluna Anterior02
						$anterior2 = '<td></td>';
						$itemColuna = 2;
					}
					//Coluna Anterior01
					$anterior1 .= sprintf("<td>%s</td>",$lista['quant']);
				}elseif ($itemColuna!='2' && $lista['mesref']==$this->anterior1) {
					$anterior1 = sprintf("<td>%s</td>",$lista['quant']);
				}
				
				if ($lista['mesref']==$this->mesref) {
					if ($anterior2=='') {
						//Coluna Anterior02
						$anterior2 = '<td></td>';
					}
					if ($anterior1=='') {
					//Coluna Anterior01
					$anterior1 = '<td></td>';
					}
					if ($lista['quant']=='' AND $lista['mesref']==$this->mesref) {
						$colAtual = '<td></td>';
						++$inclimp;
						$itemColuna = 2;
					}else {
						$colAtual = sprintf("<td style='text-align: center;'>%s</td>",$lista['quant']);
						++$inclimp;
						$itemColuna = 2;
					}
				}
				
				
				
				//Coluna Anterior02
				$this->tabtbody .= sprintf("<td>%s</td>",$itemColuna);
				//Coluna Anterior01
				$this->tabtbody .= sprintf("<td>%s</td>",$itemColuna);
				
				
				//Coluna Unidade
				$this->tabtbody .= sprintf("<td>%s %s</td>",$lista['qunid'],$lista['unid']);
				
				//Coluna Discriminação
				$this->tabtbody .= '<td> '.$lista['discrim'].' </td>';//Modificar qdo apliar para outros documentos
				
				//Coluna Quantidade Atual
				
				$this->tabtbody .= $colAtual;
				*/
				
				
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
