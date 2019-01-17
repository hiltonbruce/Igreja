<?php
class fonetica {
	var $nome;
	var $campo;
	function fonetica ($nome,$campo){
		if ($campo=='') {
			$campo='nome';
		}

		$query='';
		//remoção de s e r triplo
		$sss =  str_replace('sss', 'ss', $nome);
		$sss =  str_replace('rrr', 'rr', $sss);

		//Expassão de busca para nome Kassia ou Cassia
		if (substr_count($sss, 'kassia')==1) {
			$ks =  str_replace('k', 'c', $sss);
			$query .= $campo."LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'cassia')==1){
			$ks =  str_replace('c', 'k', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		if (substr_count($sss, 'ss')==1) {
			$ks =  str_replace('ss', 'c', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'c')==1){
			$ks =  str_replace('c', 'ss', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para nome souza ou sousa
		if (substr_count($sss, 'sousa')==1){
			$ks =  str_replace('sousa', 'souza', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'souza')==1){
			$ks =  str_replace('souza', 'sousa', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para ch e x
		if (substr_count($sss, 'ch')==1){
			$ks =  str_replace('ch', 'x', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'x')==1){
			$ks =  str_replace('x', 'ch', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para y
		if (substr_count($sss, 'li')==1){
			$ks =  str_replace('li', 'ly', $sss);
			$query .= $campo." LIKE '%".trim($ks)."%' OR ";
		}elseif (substr_count($sss, 'ly')==1){
			$ks =  str_replace('y', 'li', $sss);
			$query .= $campo." LIKE '%".trim($ks)."%' OR ";
		}

		//Expassão de busca para keli
		if (substr_count($sss, 'keli')==1){
			$ks =  str_replace('keli', 'kely', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('keli', 'kelly', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('keli', 'kelli', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";

		}elseif (substr_count($sss, 'kely')==1){
			$ks =  str_replace('kely', 'keli', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kely', 'kelly', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kely', 'kelli', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";

		}elseif (substr_count($sss, 'kelly')==1){
			$ks =  str_replace('kelly', 'keli', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelly', 'kelli', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelly', 'kely', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";

		}elseif (substr_count($sss, 'kelli')==1){
			$ks =  str_replace('kelli', 'keli', $sss);
			$query .= $campo."  LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelli', 'kelly', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('kelli', 'kely', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para tais
		if (substr_count($sss, 'tais')==1){
			$ks =  str_replace('tais', 'thais', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('tais', 'thays', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'thais')==1){
			$ks =  str_replace('thais', 'tais', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('thais', 'tays', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'thays')==1){
			$ks =  str_replace('thays', 'thais', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('thays', 'tais', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		if (substr_count($sss, 'l')==1){
			$ks =  str_replace('l', 'll', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'n')==1){
			$ks =  str_replace('n', 'nn', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		if (substr_count($sss, 'll')==1){
			$ks =  str_replace('ll', 'l', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'nn')==1){
			$ks =  str_replace('nn', 'n', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}
		//Expassão de busca para ana
		if (substr_count($sss, 'ana')==1){
			$ks =  str_replace('ana', 'anna', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'anna')==1){
			$ks =  str_replace('anna', 'ana', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}
		//Expassão de busca para Valter
		if (substr_count($sss, 'walter')==1){
			$ks =  str_replace('walter', 'valter', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'valter')==1){
			$ks =  str_replace('valter', 'walter', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}

		//Expassão de busca para diana
		if (substr_count($sss, 'diana')==1){
			$ks =  str_replace('dianna', 'dyanna', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('diana', 'dyana', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('diana', 'dianna', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'dyanna')==1){
			$ks =  str_replace('dyanna', 'diana', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyanna', 'dyana', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyanna', 'dianna', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'dyana')==1){
			$ks =  str_replace('dyana', 'dyanna', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyana', 'diana', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dyana', 'dianna', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}elseif (substr_count($sss, 'dianna')==1){
			$ks =  str_replace('dianna', 'dyanna', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dianna', 'diana', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
			$ks =  str_replace('dianna', 'dyana', $sss);
			$query .= $campo." LIKE '%".$ks."%' OR ";
		}
		$this->querys = $query;

	}

	function expansao () {
		return $this->querys;
	}
}

?>
