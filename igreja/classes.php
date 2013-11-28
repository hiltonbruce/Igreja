<?PHP

class igreja {

	function ordenar() {//ordena a listagem e seleciona por cargo
	
		
		switch ($_GET["ord"]){//Ordena a listagem
		
			case "2";
				$ord = "e.congregacao";
				break;
			case "1";
				$ord = "m.rol";
				break;
			default ;
				$ord = "m.nome";
				break;
		}
		return $ord;
	}
	
	function cargo (){
		
		if ($_GET["id"]>0) {
			$congreg = "AND e.congregacao=".$_GET["id"];
		}
			switch ($_GET["cargo"]){//verifica o cargo
				
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
		
		
		return $congreg;
	}

}

?>