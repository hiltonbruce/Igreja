<?php

$incluiPessoa ='';

if (!empty($_GET['membro']) && $_GET['membro']==true) {
	
	if (!empty($_GET['membro']) && $_GET['membro']==true && $_GET['rol']>0) {
		$incluiPessoa =' AND d.rol = "'.(int)$_GET['rol'].'" ';
	}elseif (!empty($_GET['membro']) && $_GET['membro']==true && (strlen($_GET['nome']))>'3'){
		$incluiPessoa =' AND d.nome LIKE "%'.$_GET['nome'].'%" ';
	}elseif (!empty($_GET['membro']) && $_GET['membro']==true) {
		$incluiPessoa =' AND d.nome = "" AND d.rol = "0" ';
	}
	
}

	if ($dataValid && $mes>0 && $mes<12 && $ano>2000 && $ano<2050 && ($tipo=='9' || $tipo=='0')) {
		$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
		$consulta .= $incluiPessoa;
		$consulta .= ' AND d.data = "'.$dataValid.'"';
		$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.data ';
		$this->dquery = mysql_query( $consulta ) or die (mysql_error());
		$lancConfirmado = true;
	}elseif ($mes>0 && $mes<12 && $ano>2000 && $ano<2050 && ($tipo=='9' || $tipo=='0')) {
		$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
		$consulta .= $incluiPessoa;
		$consulta .= ' AND mesrefer = '.$mes.' AND anorefer='.$ano;
		$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ';
		$this->dquery = mysql_query( $consulta ) or die (mysql_error());
		$lancConfirmado = true;
	}elseif (($mes=='0' || empty($mes)) && $mes<12 && $ano>2000 && $ano<2050 && ($tipo=='9' || $tipo=='0')) {
		$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
		$consulta .= $incluiPessoa;
		$consulta .= ' AND anorefer='.$ano;
		$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ';
		$this->dquery = mysql_query( $consulta ) or die (mysql_error());
		$lancConfirmado = true;
	}elseif ($incluiPessoa!='') {
		$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento>"0"'.$incluiPessoa.
				$filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ') or die (mysql_error());
		$lancConfirmado = true;
	}else {
		$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento="0"'.
				$filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ') or die (mysql_error());
			$lancConfirmado = false;
	}
	
?>