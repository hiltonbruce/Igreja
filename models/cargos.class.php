<?php
class cargos {


	protected $pagina;
	protected $linhasPorPag;
	protected $igreja;

	function __construct ($pagina="",$linhasPorPag="",$igreja=""){
		$pagina = ($pagina<'1') ? 1 : $pagina ;
		if ($igreja<1) {
			$this->opIgreja = '';
		} else {
			$this->opIgreja = ' AND i.rol ="'.$igreja.'" ' ;
		}
			//$this->opIgreja = ' AND i.rol ="2"' ;
		//$linhasPorPag =  $pagina-1 ;
		$this->linhasPorPagina = ($linhasPorPag==0) ?  300:$linhasPorPag;
		$this->linhaInicial = ($pagina=='1') ?  0:($pagina-1)*$linhasPorPag;

		$this->query  = 'SELECT m.*,i.razao from membro AS m, eclesiastico AS e, igreja AS i WHERE m.rol=e.rol AND';
		$this->query .= ' i.rol=e.congregacao AND e.situacao_espiritual<="2" '.$this->opIgreja;
		$this->query2 = '';

		$this->congreg  = "";
		$this->congreg0 = "";
		$this->congreg1 = " AND DATE_FORMAT(e.auxiliar,'%d') <> '00'  AND DATE_FORMAT(e.diaconato,'%d') = '00' AND DATE_FORMAT(e.presbitero,'%d') = '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
		$this->congreg2 = " AND DATE_FORMAT(e.diaconato,'%d') <> '00' AND DATE_FORMAT(e.presbitero,'%d') = '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
		$this->congreg3 = " AND DATE_FORMAT(e.presbitero,'%d') <> '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
		$this->congreg4 = " AND DATE_FORMAT(e.evangelista,'%d') <> '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
		$this->congreg5 = " AND DATE_FORMAT(e.pastor,'%d') <> '00' ";
	}

	function ArrayCargosDados($cargo) {

		//$opCargo = (!empty($_GET["id"])) ? $_GET["id"] : $cargo;

		$opcCargo = 'congreg'.$cargo;
		$congreg = $this->$opcCargo;

		global $db;

		//$querys  = "SELECT m.*,i.razao from membro AS m, eclesiastico AS e, igreja AS i WHERE m.rol=e.rol AND";
		$querys  = $this->query.$congreg.' AND e.congregacao=i.rol';
		$querys .= ' ORDER BY i.razao,m.nome LIMIT '.$this->linhaInicial.','.$this->linhasPorPagina;

		$db->setFetchMode(DB_FETCHMODE_ASSOC);
		$res = & $db->query($querys) ;
		//print_r($res);
		while ($res->fetchInto($row)) {
			// Assuming DB's default fetchmode is DB_FETCHMODE_ORDERED
			$linhas[] = $row;
		}
		return $linhas;

	}

	function linhas($cargo) {

		$opcCargo = 'congreg'.$cargo;
		$congreg = $this->$opcCargo;

		global $db;

		$querys  = $this->query.$congreg.' AND e.congregacao=i.rol';
		$querys .= ' ORDER BY i.razao,m.nome ';

		$db->setFetchMode(DB_FETCHMODE_ASSOC);
		$res = & $db->query($querys) ;
		return $res->numRows();

	}

	function totDizimMembro($mes,$opCargo,$ano) {

		$opcCargo = 'congreg'.$opCargo;
		$congreg = $this->$opcCargo;

		global $db;

		$query  = "SELECT m.rol from membro AS m, eclesiastico AS e, igreja AS i, dizimooferta AS d WHERE m.rol=e.rol AND";
		$query .= ' e.situacao_espiritual<2 '.$this->opIgreja.$congreg.' AND e.congregacao=i.rol AND m.rol=d.rol';
		$query .= ' AND d.valor>"0" AND d.anorefer ="'.trim($ano).'" AND d.mesrefer = "'.$mes.'" AND d.credito = "700" GROUP BY d.rol ';

		$db->setFetchMode(DB_FETCHMODE_ASSOC);
		$res = & $db->query($query) ;
		return $res->numRows();

	}
}
?>
