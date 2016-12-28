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
    $i = (empty($_GET['igreja'])) ? '' : intval($_GET['igreja']) ;
		$sql  = 'SELECT a.*,i.razao,s.alias,u.nome,u.cargo ';
		$sql .= 'FROM agendamssgs AS a, igreja AS i, setores AS s, usuario AS u ';
		$sql .= 'WHERE a.igreja = i.rol AND a.uid = u.cpf AND a.setor = s.id ';
		if ($i!='') {
			$sql .= 'AND i.rol="'.$i.'" ';
		}
		if ($d!='') {
			$sql .= 'AND a.d="'.$d.'" ';
		}
		$sql .= 'AND a.y = "'.$y.'" AND a.m = "'.$m.'" ORDER BY a.d,a.start_time,i.razao' ;
		$this->sql_lst = mysql_query($sql) or die (mysql_error());
	}

	function listaEventos(){
		return mysql_fetch_assoc($this->sql_lst);
	}

}
?>
