<?php
class List_setores {
	//Lista para formulário

	function __construct (){
		$this->sql_lst = mysql_query('SELECT * FROM setores WHERE hier="1" ORDER BY alias');
	}

	function List_Setor($ind,$req=null,$setor=null) {
	//Mostra as linhas de select
	$superUs = '';
	$linhas  = '<select name="setor" '.$req.' tabindex='.$ind.'>';
	$linhas .= "<option value=''>-->> Setor <<--</option>";
		while($colList = mysql_fetch_array($this->sql_lst)){
			if ($colList["id"]==$setor) {
				$linhas .= '<option value="'.$colList["id"].'">';
				$linhas .= htmlspecialchars(stripcslashes($colList['alias']),ENT_QUOTES,'iso-8859-1');
				$linhas .= '</option>';
			} elseif ($setor >= '50') {
					$linhas .= '<option value="'.$colList["id"].'">';
					$linhas .= htmlspecialchars(stripcslashes($colList['alias']),ENT_QUOTES,'iso-8859-1');
					$linhas .= '</option>';
					$superUs  = '<option value="99">';
					$superUs .= 'Acesso Total';
					$superUs .= '</option>';
			}
		}
	$linhas .= $superUs.'</select>';
	return $linhas;
	}

	function List_SetorPop() {
		$linha = '';
	//Mostra as linhas de select escolha=tab_auxiliar%2Fcad_usuario.php&menu=top_admusuario
		while($this->col_lst = mysql_fetch_array($this->sql_lst)){
			$linha .= "<option value='./?escolha=tab_auxiliar/cad_usuario.php&menu=top_admusuario&setor";
			$linha .= $this->col_lst['id']."'>".htmlspecialchars(stripcslashes($this->col_lst['alias']),ENT_QUOTES,'iso-8859-1').
			$linha .= '</option>';
		}
		return $linha;
	}
}
