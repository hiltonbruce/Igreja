<?php
class tes_ativaCargo {

	protected $igreja;
	protected $descricao;
	protected $hierarquia;

	function tes_ativaCargo ($igreja=0,$descricao=0,$hierarquia=0) {
		$this->igreja 	 = $igreja;
		$this->descricao = $descricao;
		$this->hierarquia = $hierarquia;
	}

	function cadMembroCargo($rol,$nome,$valor,$diapgto,$fonte,$codDespesa) {
		//Cadastra e atualiza o cargo se j� estive outro com a mesmo fun��o exceto Minist�rio
		$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
		global $db;
		//Se tiver alguem no mesmo cargo destiva
		// Once you have a valid DB object named $db...
		$table_name   = 'cargoigreja';
		$table_fields = array('status', 'hist');
		$table_values = array('0', $hist );
		$table_where = 'descricao = '.$this->descricao.' AND igreja = '.$this->igreja.
				' AND  hierarquia= '.$this->hierarquia.' AND descricao <> "17" ';
		$sth = $db->autoPrepare($table_name, $table_fields,
				DB_AUTOQUERY_UPDATE, $table_where);

		if (PEAR::isError($sth)) {
			die($sth->getMessage());
		}
		$res =& $db->execute($sth, $table_values);

		if (PEAR::isError($res)) {
			die($res->getMessage());
		}
		$desativadoCad = $db->affectedRows();

		//Insert o membro no cargo
		$sth = $db->prepare('INSERT INTO  cargoigreja VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$data = array( null,$this->descricao,'0','1', $this->igreja, $rol, $nome, $this->hierarquia, $valor, $diapgto, $fonte,$codDespesa, $hist, date('Y-m-d H:i:s'));
		$db->execute($sth, $data);// Always check that result is not an error
		if (PEAR::isError($res)) {
			die($res->getMessage());
		}
		$ativadoCad = $db->affectedRows();

		return array('Desativado'=>$desativadoCad,'Cadastro'=>$ativadoCad);
	}

	function desativaCargo($id) {
		//Desativa o cargo
		$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];

		global $db;

		//Se tiver alguem no mesmo cargo destiva
		// Once you have a valid DB object named $db...
		$table_name   = 'cargoigreja';
		$table_fields = array('status', 'hist');
		$table_values = array('0', $hist );
		$table_where = 'id = '.$id;

		$sth = $db->autoPrepare($table_name, $table_fields,
				DB_AUTOQUERY_UPDATE, $table_where);

		if (PEAR::isError($sth)) {
			die($sth->getMessage());
		}
		$res =& $db->execute($sth, $table_values);

		if (PEAR::isError($res)) {
			die($res->getMessage());
		}
		$desativadoCad = $db->affectedRows();

		return array('Desativado'=>$desativadoCad);
	}

}
?>
