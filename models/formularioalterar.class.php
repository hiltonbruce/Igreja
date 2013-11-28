<?php 
class formularioalterar {

	public $campo;
	public $valor;
	public $acao;
	public $link_form;

	function __construct ($vlr_get="",$valor="",$acao="",$link_form="") {

		$this->campo 		= $_GET["campo"];       //Nome do campo para get
		$this->vlr_get		= $vlr_get;             //Valor relacionado ao get
		$this->valor 		= $valor;               //O valor do campo no banco de dados
		$this->acao 		= $acao;                //Link para onde o form ira direcionar os dadosa. Ex.:adm/atualizar_dados.php
		$this->link_form 	= $link_form.$vlr_get;  //Link de chamada do form para edição do form. Ex.: adm/dados_pessoais.php&campo=datanasc&tabela=membro
		
	}
	
	public function formcab () {
		//*Cabeçalho do formulário
		
			/* Formulário para edição por item. Neste form os campos são recebidos de qualquer
			campo para edição da tabela. Bastando para isso o envio do campo por GET-campo, esse campo que é
			passado, também é responsável pelo da tabela que será alterada e o GET-tabela traz o nome da tabela
			que sofrerá alteração. Em agumas ocasiões também é passado o campo UF.*/
		
			if ($this->campo==$this->vlr_get)
			{

			$ident = (empty($_GET["rol"])) ? (INT)$_GET['id']:(int)$_GET['rol'];
			?>
			<form id="form1" name="form1" method="post" action="">
			<input type="hidden" name="escolha" value="<?PHP echo "{$this->acao}";?>" /> <!-- indica o script que receberá os dados -->
			<input type="hidden" name="tabela" value="<?PHP echo $_GET["tabela"];?>" />
			<input type="hidden" name="id" value="<?PHP echo $ident;?>" />
			<input type="hidden" name="campo" value="<?PHP echo "{$this->campo}";?>" />
			<?php
			}
	}

	public function getditar(){
	$ind = 1;	
	if ($this->campo==$this->vlr_get)
	{
		
		if ($this->valor=="")
		{
			$this->valor="N&atilde;o informado";
			}
	   		?>
				<input type="text" name="<?PHP echo $this->campo;?>" value="<?PHP echo $this->valor;?>" size="30" tabindex="<?PHP echo $ind++;?>"/>
				<input type="submit" name="Submit" value="Alterar..."  tabindex="<?PHP echo $ind++;?>" />
				</form>
			<?PHP
		}

	}
	
	public function getMostrar(){
		
	if ($this->campo==$this->vlr_get)
	{
		
		if ($this->valor=="")
		{
			$this->valor="N&atilde;o informado";
			}
	   		?>
				<input type="text" name="<?PHP echo $this->campo;?>" value="<?PHP echo $this->valor;?>" size="30" tabindex="<?PHP echo $ind++;?>"/>
				<input type="submit" name="Submit" value="Alterar..."  tabindex="<?PHP echo $ind++;?>" />
				</form>
			<?PHP
		}
		
		if (empty($this->valor)){
			$this->valor = "Não Informado";
		}
				echo "<p><a title='Click aqui para alaterar este campo!' href='./?escolha={$this->link_form}'  tabindex='$ind++' >{$this->valor}</a></p>";
		
	}

}
?>