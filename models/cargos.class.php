<?php
class cargos {


	protected $limitSQL01;
	protected $limitSQL02;

	function __construct ($limitSQL01="",$limitSQL02=""){

		//$this->result = mysql_query("SELECT * FROM igreja WHERE rol='$cargoIgreja' ") or die (mysql_error());
		$this->limitSQL01 = ($limitSQL01=='') ?  0:$limitSQL01;
		$this->limitSQL02 = ($limitSQL02=='') ?  300:$limitSQL01;

	}

	function ArrayCargosDados($cargo,$opCargo) {

		$opCargo = (!empty($_GET["id"])) ? $_GET["id"] : $cargo;

		/*if ($opCargo>0) {
			$congreg = "AND e.congregacao=".$opCargo;
		}*/
			switch ($opCargo){//verifica o cargo

				case "1"://Verifica se é auxiliar de trabalho
					$congreg .= " AND DATE_FORMAT(e.auxiliar,'%d') <> '00'  AND DATE_FORMAT(e.diaconato,'%d') = '00' AND DATE_FORMAT(e.presbitero,'%d') = '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "2"://verifica se é diácono
					$congreg .= " AND DATE_FORMAT(e.diaconato,'%d') <> '00' AND DATE_FORMAT(e.presbitero,'%d') = '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "3"://verifica se é Presbítero
					$congreg .= " AND DATE_FORMAT(e.presbitero,'%d') <> '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "4"://verifica se é Evangelista
					$congreg .= " AND DATE_FORMAT(e.evangelista,'%d') <> '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "5"://verifica se é Pastor
					$congreg .= " AND DATE_FORMAT(e.pastor,'%d') <> '00' ";
					break;

				default:
					break;
		}


		global $db;

		$querys  = "SELECT m.*,i.razao from membro AS m, eclesiastico AS e, igreja AS i WHERE m.rol=e.rol AND";
		$querys .= ' e.situacao_espiritual<2 '.$congreg.' AND e.congregacao=i.rol';
		$querys .= ' ORDER BY nome LIMIT '.$this->limitSQL01.','.$this->limitSQL02;

		$db->setFetchMode(DB_FETCHMODE_ASSOC);

		$res = & $db->query($querys) ;
		//print_r($res);
		while ($res->fetchInto($row)) {
			// Assuming DB's default fetchmode is DB_FETCHMODE_ORDERED
			$linhas[] = $row;
		}
		return $linhas;

	}

	function linhas($cargo,$opCargo) {

		switch ($opCargo){//verifica o cargo

				case "1"://Verifica se é auxiliar de trabalho
					$congreg .= " AND DATE_FORMAT(e.auxiliar,'%d') <> '00'  AND DATE_FORMAT(e.diaconato,'%d') = '00' AND DATE_FORMAT(e.presbitero,'%d') = '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "2"://verifica se é diácono
					$congreg .= " AND DATE_FORMAT(e.diaconato,'%d') <> '00' AND DATE_FORMAT(e.presbitero,'%d') = '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "3"://verifica se é Presbítero
					$congreg .= " AND DATE_FORMAT(e.presbitero,'%d') <> '00' AND DATE_FORMAT(e.evangelista,'%d') = '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "4"://verifica se é Evangelista
					$congreg .= " AND DATE_FORMAT(e.evangelista,'%d') <> '00' AND DATE_FORMAT(e.pastor,'%d') = '00' ";
					break;

				case "5"://verifica se é Pastor
					$congreg .= " AND DATE_FORMAT(e.pastor,'%d') <> '00' ";
					break;

				default:
					break;
		}


		global $db;

		$querys  = "SELECT m.rol from membro AS m, eclesiastico AS e, igreja AS i WHERE m.rol=e.rol AND";
		$querys .= ' e.situacao_espiritual<2 '.$congreg.' AND e.congregacao=i.rol';

		$db->setFetchMode(DB_FETCHMODE_ASSOC);

		$res = & $db->query($querys) ;

		return $res->numRows();

	}

}
?>
