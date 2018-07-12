<?php
class igreja {

	protected $id;

	function __construct ($id=""){
		$this->result = mysql_query("SELECT * FROM igreja WHERE rol='$id' ") or die (mysql_error());
		$this->id = $id;
	}
	function exitecad (){
		if (mysql_num_rows( $this->result)>0){
		 	echo "<h2>A Igreja ' $this->id ' j&aacute; est&aacute; cadastrado na Cidade de ";
		 	return true;
		 } else {
		 	echo "<h1>Novo Bairro Cadastrado: $this->bairro</h1>";
		 	return false;
		 }
	}

	function Arrayigreja(){
	$this->query = "SELECT rol,razao,status,rua,numero,setor FROM igreja ";
	$this->sql_lst = mysql_query("{$this->query} ORDER BY razao") or die (mysql_error());
	//echo "<h1>Teste</h1>";
   while($this->col_lst = mysql_fetch_array($this->sql_lst))
   {
  $bairr_array [$this->col_lst['rol']]=array ($this->col_lst['razao'],$this->col_lst['status']
  	,$this->col_lst['rol'],$this->col_lst['rua'],$this->col_lst['numero'],$this->col_lst['setor']);
   }
	  return $bairr_array;
	}

	function Deletar (){
		$ver = mysql_query("DELETE FROM igreja WHERE rol='{$this->id}' LIMIT 1");
		if($ver){
				echo "<script> alert('Apagado com sucesso'); location.href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf=PB';</script></a>";
				echo "Bairro apagado com sucesso<br><a href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf=PB'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "Não foi possível apagar, apresentou o seguite erro:  '$erro'";
				}
	}

	function ArrayIgrejaDados(){
		//Devolve um array com os dados de todas as igrejas
		global $db;
		$db->setFetchMode(DB_FETCHMODE_ASSOC);

		$res =& $db->query('SELECT * FROM igreja WHERE status="1" ORDER BY razao');
		while ($res->fetchInto($row)) {
			// Assuming DB's default fetchmode is DB_FETCHMODE_ORDERED
			$linhas[] = $row;
		}
		return $linhas;
	}
	function ordenar($ordenar) {//ordena a listagem e seleciona por cargo
	$ordenar = (empty($_GET["ord"])) ? $ordenar :  $_GET["ord"];
	switch ($ordenar){//Ordena a listagem
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

	function cargo ($opCargo){
		$opCargo = (!empty($_GET["id"])) ? intval($_GET["id"]) : $opCargo ;
		if ($opCargo>0) {
			$congreg = "AND e.congregacao=".$opCargo;
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
				case "7"://Lista apenas mulheres
					$congreg = " AND m.sexo = 'F' ";
					break;
				case "8"://Lista apenas Homens
					$congreg = " AND m.sexo = 'M' ";
					break;
				case "9"://Lista apenas Homens
					$congreg = " AND m.sexo <> 'M' AND m.sexo <> 'F'";
					break;
				case "10"://Lista apenas Doadores de Sangue
					$congreg = " AND m.doador = 'SIM'";
					break;
				default:
					break;
		}
		//$congreg;
		return $congreg;
	}

	function ArrayCargosDados($cargo) {
		global $db;
		$queryCargo = cargo('2');
		$querys = "SELECT * from membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND
		 e.situacao_espiritual<2 ".$queryCargo." ORDER BY ".$queryCargo;
		$db->setFetchMode(DB_FETCHMODE_ASSOC);
		$res = & $db->query($querys);
		print_r($res);
		while ($res->fetchInto($row)) {
			// Assuming DB's default fetchmode is DB_FETCHMODE_ORDERED
			$linhas[] = $row;
		}
		return $linhas;
	}
}
?>
