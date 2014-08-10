<?php
class tes_relatorioLanc {
	
function __construct($tesoureiro='',$print='') {
		$this->var_string  = 'SELECT l.lancamento,DATE_FORMAT(l.data,"%d/%m/%Y") AS data,l.igreja,';
		$this->var_string .= 'l.valor,l.hist,i.referente ';
		$this->var_string .= 'FROM lancamento AS l, lanchist AS i ';
		$this->var_string .= 'WHERE l.lancamento=i.idlanca';
	}
	
function histLancamentos ($igreja,$mes,$ano) {
	
			$this->dquery = mysql_query($this->var_string.' AND l.igreja = "0" AND DATE_FORMAT(l.data,"%m/%Y")="2/2014" ') or die (mysql_error());
		
		$tabela = '<tbody id="periodo">';
		while ($linha = mysql_fetch_array($this->dquery)) {
			
						
			$valor = number_format($linha['valor'],2,',','.');
			
			$bgcolor = $cor ? '#d0d0d0' : '#ffffff';			
			
			if ($congMembro!=$linha['congcadastro'] ) {
				$congMembro = $linha['congcadastro'];
				$dadosCongMembro = new DBRecord ('igreja',$linha['igreja'],'rol');
				$nomeCongMembro = $dadosCongMembro->razao();
			}
			
			$tabela .= '<tr style="background:'.$bgcolor.'"><td>'.$linha['refetente'].'</td>
				<td id="moeda">'.$valor.'</td></tr>';
			
			$cor = !$cor;
		}
		
		$resultado = array($tabela,$lancConfirmado);
		return $resultado;
	}
	
}
