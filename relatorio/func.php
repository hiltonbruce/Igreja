<?PHP
	function leg_recibos ($tipo) {
	
		//Define a legenda do fildset dos tipos de recibos
	
		switch ($tipo){
		
			case "1":
				return "Entrega de Cart&atilde;o de Membro";
				break;
			default:
				return "Entrega de documentos Diversos";
				break;
		}
	
	}
	
	function AcaoFormRecibo ($acao) {
		//define o direcionamento do formulário
		
		switch ($acao){
		
			case "1":
				return "relatorio/recibo_print.php";
				break;
			default:
				return "#";
				break;
		}	
	}
	
	class emit_recibos  {
	//cria tabela com dados para entrega de recibos
	
	protected $recibos;
	
	function __construct ($recibos = ""){
				
		$this->recibos	=	$recibos;
		$this->list_recibos = explode(",","$recibos");		
			$Ultimo_ind = mysql_query ("select max(rol) as id from recibos");
			$vlr_id = mysql_fetch_array ($Ultimo_ind);	
			$this->proximo = $vlr_id["id"]+1;
		}
	
	
	function List_rol () {
		

		while ($this->Rols = each ($this->list_recibos))
			{
			
			$membro = new DBRecord ("membro",$this->Rols["value"],"rol");
			$eclesiastico = new DBRecord ("eclesiastico",$this->Rols["value"],"rol");
			$congregacao = new DBRecord ("igreja",$eclesiastico->congregacao(),"rol");
			
			$eclesiastico->c_entregue = date("Y-m-d"); //Aqui é atribuido a esta variável um valor para UpDate
			$eclesiastico->quem_recebeu = $_POST["resp_recebeu"];
			$eclesiastico->quem_entregou =  $_SESSION['valid_user'];
			
			$eclesiastico->rec_entrega = $this->proximo;
			$eclesiastico->Update();
			
			$inc++;
			
			if ($inc==1) { echo "<tr class='odd'>"; } else {echo "<tr class='dados'>"; $inc=0;}
			
			echo	"<td>{$membro->nome()}</td>".
				"<td>{$this->Rols["value"]}</td>".
				"<td>{$congregacao->razao()}</td></tr>";
			
			}
			
		$value="'','{$_POST["tipo"]}','{$this->recibos}','{$_POST["resp_recebeu"]}','{$_SESSION["valid_user"]}',NOW(),'{$_POST["obs"]}'";
			
		$registra_recibo = new insert ("$value","recibos");
		$registra_recibo->inserir();
		
	}
	
	function ultimo_id () {
		return $this->proximo;
	}

	function reimprimir_rec () {
		

		while ($this->Rols = each ($this->list_recibos))
			{
			
			
			$membro = new DBRecord ("membro",$this->Rols["value"],"rol");
			$eclesiastico = new DBRecord ("eclesiastico",$this->Rols["value"],"rol");
			$congregacao = new DBRecord ("igreja",$eclesiastico->congregacao(),"rol");
			
			$inc++;
			
			if ($inc==1) { echo "<tr class='odd'>"; } else {echo "<tr class='dados'>"; $inc=0;}
			
			echo	"<td>{$membro->nome()}</td>".
				"<td>{$this->Rols["value"]}</td>".
				"<td>{$congregacao->razao()}</td></tr>";

			}

	}
	
	}

?>
