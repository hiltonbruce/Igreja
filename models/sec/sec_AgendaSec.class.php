<?php
class sec_AgendaSec
{

	protected $y;
	protected $m;
	protected $d;
	protected $igreja;

	function __construct($y = '',$m = '',$d = '',$ano = '',$igreja = '') {

    $m = (empty($_GET['month'])) ? date('n') : intval($_GET['month']) ;
    $y = (empty($_GET['year'])) ? date('Y') : intval($_GET['year']) ;
    $d = (empty($_GET['day'])) ? '' : intval($_GET['day']) ;
		$sql  = 'SELECT a.*,i.razao,s.alias,u.nome,u.cargo ';
		$sql .= 'FROM agendamssgs AS a, igreja AS i, setores AS s, usuario AS u ';
		$sql .= 'WHERE a.igreja = i.rol AND a.uid = u.cpf AND a.setor = s.id ';
		$sql .= 'AND a.y = "'.$y.'" AND a.m = "'.$m.'" ORDER BY a.d' ;
		$this->sql_lst = mysql_query($sql) or die (mysql_error());

	}

	function listaEventos(){
		return mysql_fetch_assoc($this->sql_lst);
	}

}
?>
