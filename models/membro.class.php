<?php
class membro {

	function __construct () {

		$this->query  = 'SELECT m.*,e.auxiliar,e.diaconato,e.presbitero,e.evangelista,e.pastor ';
		$this->query .= 'FROM membro AS m, eclesiastico AS e ';
		$this->query .= 'WHERE m.rol=e.rol ';
		$this->query .= ' ORDER BY m.nome ';
		$this->membros = mysql_query($this->query) or die (mysql_error());
	}

	function nomes () {
		while($dados = mysql_fetch_array($this->membros))
		{
			if ($dados['pastor']!="0000-00-00") {
				$cargo = 'Pr. ';
			}elseif ($dados['evangelista']!="0000-00-00") {
				$cargo = 'Ev. ';
			}elseif ($dados['presbitero']!="0000-00-00") {
				$cargo = 'Pb. ';
			}elseif ($dados['diaconato']!="0000-00-00") {
				$cargo = 'Dc. ';
			}elseif ($dados['auxiliar']!="0000-00-00") {
				$cargo = 'Ax. ';
			}else {
				$cargo ='';
			}
			$mud_acent = strtoupper(strtr($dados["nome"], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC'));
			$todos[$dados['rol']] = array($mud_acent,$dados['nacionalidade'],$dados['naturalidade'],
				$dados['pai'],$dados['mae'],$dados["nome"],$cargo) ;

		}

		return $todos ;
	}

}
?>
