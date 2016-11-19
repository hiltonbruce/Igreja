<?PHP
class tes_listDisponivel extends List_sele {

	function __construct (){
		$this->tabela = 'contas';//
		$this->campo_retorno = 'acesso';//Campo que serï¿½ retornado
		$this->texto_field = 'acesso';//O nome que serï¿½ relaciondo ao campo de retorno para envio pelo form
		$this->query = 'SELECT * from '.$this->tabela.' WHERE tipo="D"';
		$nivelCta = ' AND (nivel4="1.1.1.001" OR nivel4="1.1.1.002" OR nivel4="1.1.1.003")';
		//$nivelCta .= 'OR nivel4="1.1.1.005" OR nivel4="1.1.1.006")';
		$this->sql_lst = mysql_query($this->query.$nivelCta.' AND acesso>"0" ORDER BY codigo ');
	}

	function List_Selec ($caixa,$sld=null){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	$linha1='';
	$linhas ="<option value=''>Escolha a fonte pagadora!</option>";
		while($campoList = mysql_fetch_array($this->sql_lst))
		{
			if ($sld>$campoList['saldo']) {
				continue;
			}
			if ($campoList["acesso"]==$caixa) {
				$linha1  = '<option value='.$campoList["acesso"].'>'.$campoList['titulo'].
				' -> Saldo : '.number_format($campoList['saldo'],2,',','.')."</option>";
			}
			 $linhas .='<option value='.$campoList["acesso"].'>'.$campoList['titulo'].
			 ' -> Saldo : '.number_format($campoList['saldo'],2,',','.').'</option>';
		}
		return $linha1.$linhas;
	}

	function List_Selec_pop ($link,$id){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	$linha1='';
	$linhas .="<option value='./?$link{$campoList["id"]}'>Todas</option>";
		while($campoList = mysql_fetch_array($this->sql_lst))
		{
			if ($campoList["id"]==$id) {
				$linha1  = "<option value='./?$link{$campoList["id"]}'>".$campoList['titulo']."</option>";
			}
			 $linhas .="<option value='./?$link{$campoList["id"]}'>".$campoList['titulo']."</option>";
		}
		echo $linha1.$linhas;
	}
}
?>
