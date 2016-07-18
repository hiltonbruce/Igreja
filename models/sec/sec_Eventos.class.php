<?PHP

class sec_Eventos
{

	protected $ano;
	protected $igreja;

	function __construct($ano = '',$igreja = '') {

		/*$this->igrejaes = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho",
		                "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
		$this->dias = array("Dom","Seg","Ter","Qua","Qui","Sex","S&aacute;b");*/

		$this->ano = (empty($ano)) ? date('Y'):$ano;
		$this->igreja = (empty($igreja)) ? 1:$igreja;

		$sql  = 'SELECT a.id,a.inicio,a.semana,a.dia,a.fim,a.cad,i.razao,i.setor,m.rol,m.nome,';
		$sql .= 's.alias,s.descricao,e.nome AS nevento,e.frequencia,e.dataini,e.datafim,';
		$sql .= 'r.rols,r.dataini AS iniresp,r.datafim AS fimresp ';
		$sql .= 'FROM agsercretaria AS a, igreja AS i, membro AS m, setores AS s, eventos AS e, ';
		$sql .= 'eventosresp AS r ';
		$sql .= 'WHERE a.igreja = i.rol AND a.evento = e.id AND a.resp = r.id AND a.resp = r.id AND e.vinculo = s.id ';
		$sql .= 'AND r.rol = m.rol AND a.igreja="'.$igreja.'" AND DATE_FORMAT(a.inicio,"%Y") = "'.$ano.'" ' ;
		
		$this->sql_lst = mysql_query($sql) or die (mysql_error());

	}

	function listEventos($mes){
		return mysql_fetch_assoc($this->sql_lst);
	}
	 
}
?>