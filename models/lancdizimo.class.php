<?php
class lancdizimo {
	function __construct($igreja=''){
		$this->igreja = $igreja;
	}

	function lancamento($valor,$id,$dc) {
		$this->conta = new DBRecord('contas', $id, 'id');
		if ($this->conta->tipo() != strtoupper($dc)){
			if (($this->conta->saldo()-$valor)<'0') {
					$status = 'N&atilde;o permitido';
					$_SESSION['lancar']=false;
				} else {
					$status = 'Permitido!';
				}
		} else {
			$status = 'Permitido!';
		}
		if (strtoupper($dc)=='D') {
			$fundo = 'style="background:#CDC9A5;"';
			$debitar = sprintf('R$ %s',number_format($valor,2,',','.'));
			$_SESSION['debito'] += $valor;
			$creditar = '';
		} else {
			$debitar = '';
			$creditar = sprintf('R$ %s',number_format($valor,2,',','.'));
			$_SESSION['credito'] += $valor;
			$fundo = 'style="background:#E6E6FA;"';
		}
		$exibir = sprintf("<tr %s><td>%s</td><td>%s</td><td class='text-right'> %s</td>",$fundo,$this->conta->codigo(),$this->conta->titulo(),$debitar);
		$exibir.= sprintf("<td  class='text-right'>%s</td><td  class='text-right'>R$ %s</td><td>%s</td></tr>",$creditar,number_format($this->conta->saldo(),2,',','.'),$status);
		return $exibir;
	}

	function lancamacesso($valor,$acesso,$dc) {
		$contaNome='';
		if ($acesso>0) {
		$this->conta = new DBRecord('contas', $acesso, 'acesso');
		$contaNome=$this->conta->titulo();
		if ($this->conta->tipo() != strtoupper($dc)){
			if (($this->conta->saldo()-$valor)<'0') {
					$status = 'N&atilde;o permitido';
					$_SESSION['lancar']=false;
				} else {
					$status = 'Permitido!';
				}
		} else {
			$status = 'Permitido!';
		}
		if (strtoupper($dc)=='D') {
			$fundo = 'class="primary"';
			$debitar = sprintf('%s',number_format($valor,2,',','.'));
			$_SESSION['debito'] += $valor;
			$creditar = '';
		} else {
			$debitar = '';
			$creditar = sprintf('%s',number_format($valor,2,',','.'));
			$_SESSION['credito'] += $valor;
			$fundo = 'class="info"';
		}
		$exibir = sprintf("<tr %s><td>%s</td><td>%s</td><td style='text-align:right;'> %s</td>",$fundo,$this->conta->codigo(),$contaNome,$debitar);
		$exibir.= sprintf("<td style='text-align:right;'>%s</td><td style='text-align:right;'> %s</td><td>%s</td></tr>",$creditar,number_format($this->conta->saldo(),2,',','.'),$status);
		}else {
		$mens = 'Conta Inv&aacute;lida';
		$exibir = sprintf("<tr %s><td>%s</td><td>%s</td><td style='text-align:right;'> %s</td>",'style="background:#red;"',$mens,$mens,$mens);
		$exibir.= sprintf("<td style='text-align:right;'>%s</td><td style='text-align:right;'> %s</td><td>%s</td></tr>",$mens,$mens,$mens);
		}
		return array($exibir,$this->conta->histlancam());
	}
}
?>
