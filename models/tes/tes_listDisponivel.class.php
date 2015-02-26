<?PHP
class tes_listDisponivel extends List_sele {

	function __construct (){

		$this->tabela = 'contas';//
		$this->campo_retorno = 'acesso';//Campo que serï¿½ retornado
		$this->texto_field = 'acesso';//O nome que serï¿½ relaciondo ao campo de retorno para envio pelo form
		$this->query = "SELECT * from {$this->tabela} ";

		$this->sql_lst = mysql_query($this->query.' WHERE tipo="D" AND nivel3="1.1.1" AND acesso>"0" ORDER BY codigo ');
	}

	function List_Selec_pop ($link,$caixa){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	$linha1='';
	$linhas .="<option value='./?$link{$this->col_lst["acesso"]}'>Escolha a fonte pagadora!</option>";

		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			if ($this->col_lst["acesso"]==$caixa) {
				$linha1  = "<option value='./?$link{$this->col_lst["acesso"]}'>".$this->col_lst['titulo'].
				' -> Saldo : '.number_format($this->col_lst['saldo'],2,',','.')."</option>";
			}
			 $linhas .="<option value='./?$link{$this->col_lst["acesso"]}'>".$this->col_lst['titulo'].
			 ' -> Saldo : '.number_format($this->col_lst['saldo'],2,',','.')."</option>";
		}

		return $linha1.$linhas;
	}

}

?>