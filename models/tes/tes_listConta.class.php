<?php
class tes_listConta extends List_sele {
	
	function List_Selec ($item,$grupo,$complemento){
	
		$linha1  =  "<select name='{$this->texto_field}' id='{$this->texto_field}' $complemento >";
		if ($item<1) {
			$linha1 .=  "<option value=''>-->> Escolha <<--</option>";
		}
		$defineGrupo = strlen($grupo);
		
		switch (strlen($grupo)) {
			case '9':
				$nivelGrupo = 'nivel4';
			break;
			case '5':
				$nivelGrupo = 'nivel3';
			break;
			case '3':
				$nivelGrupo = 'nivel2';
			break;
			default:
				$nivelGrupo = 'nivel1';
			break;
		}
		
		$linhas .= '';	
		while($col_lst = mysql_fetch_array($this->sql_lst))
		{
			$linhOption = "<option value='".$col_lst["acesso"]."'>".$col_lst['codigo'].'-'.$col_lst[$this->campo_retorno]."</option>";
			
			if ($col_lst[$nivelGrupo]==$grupo && $col_lst["acesso"]>'0') {
				if ($col_lst["acesso"]=='') {
					if ($item==$col_lst["acesso"]) {
						$linha1 .=  $linhOption;
					}
					$linhas .= $linhOption;
				}else {
					if ($item==$col_lst["acesso"]) {
						$linha1 .=  $linhOption;
					}
					$linhas .= $linhOption;
				}
			}	
		}
		$linha3 = "</select>";
		 
		return $linha1.$linhas.$linha3 ;
	}
}
