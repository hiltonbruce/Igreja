<?PHP
class tes_listDisponivel extends List_sele {

	function __construct (){

		$this->tabela = 'contas';//
		$this->campo_retorno = 'acesso';//Campo que serï¿½ retornado
		$this->texto_field = 'acesso';//O nome que serï¿½ relaciondo ao campo de retorno para envio pelo form
		$this->query = 'SELECT * from '.$this->tabela.' WHERE tipo="D" AND saldo > "0"';

		$this->sql_lst = mysql_query($this->query.' AND nivel3="1.1.1" AND acesso>"0" ORDER BY codigo ');
	}

	function List_Selec ($caixa){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	$linha1='';
	$linhas ="<option value=''>Escolha a fonte pagadora!</option>";

		while($campoList = mysql_fetch_array($this->sql_lst))
		{
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
