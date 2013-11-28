<?php
class cidadeSelec {

	protected $tabela;
	protected $valor;
	protected $campo;
	protected $campo_retorno;
	protected $texto_field;

	function cidadeSelec ($tabela="", $valor="", $campo="", $campo_retorno= "", $texto_field=""){

		$this->tabela = $tabela;//
		$this->valor = $valor;//O valor do campo no banco de dados
		$this->campo = $campo;//Campo para pesquisa no Banco

		//Monta a parte o retorno html do formulário
		$this->campo_retorno = $campo_retorno;//Campo que será retornado
		$this->texto_field = $texto_field;//O nome que será relaciondo ao campo de retorno para envio pelo form

		if (DB::isError($res))
		{
			echo $db->getMessage;
			exit;
		}
	}

	function listDados ($indice,$req,$codCidade,$uf){//indice da sequência do formulário

		global $db;
		$sql_lst = "SELECT * from ! ORDER BY coduf,nome";
		$this->res = $db->query($sql_lst, array( $this->tabela));

		//Obtém o número de linhas
		$num_linhas = (int)$this->res->numRows();
		$linhaCidade = '';

		//Mostra as linhas de select
		$linha0 = 	"<select name='{$this->texto_field}' id='{$this->texto_field}' $req tabindex='$indice'>";
		$linhas = $this->res->fetchRow(DB_FETCHMODE_ASSOC);
		for ($i=0; $i<$num_linhas; $i++)
		{
			if ($linhas["coduf"]==$uf) {
				if ($linhas["id"]==$codCidade) {
					$linhaCidade = "<option value='".$linhas["id"]."'>".$linhas['nome']."-".$linhas['coduf']."</option>";
				}
				$linhas1 = "<option value='".$linhas["id"]."'>".$linhas['nome']."-".$linhas['coduf']."</option>";
			}else {
				$linhas2 = "<option value='".$linhas["id"]."'>".$linhas['nome']."-".$linhas['coduf']."</option>";
			}
				
		}
		$linhas2 .= "</select>";
		//Disconecta do Banco
		//$db->disconnect();

		return $linha0.$linhaCidade.$linha1.$linhas2;

	}
}