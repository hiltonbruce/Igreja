<?PHP
class editar_form {

	public $campo;
	public $valor;
	public $acao;
	public $link_form;
	
	function __construct ($vlr_get="",$valor="",$acao="",$link_form="") {
	
		$this->campo 		= $_GET["campo"];//Nome do campo para get
		$this->vlr_get		= $vlr_get;//Valor relacionaod ao get
		$this->valor 		= $valor;//O valor do campo no banco de dados
		$this->acao 		= $acao;//Link para onde o form ira direcionar os dadosa. Ex.:adm/atualizar_dados.php
		$this->link_form 	= $link_form.$vlr_get;//Link de chamada do form para edição do form. Ex.: adm/dados_pessoais.php&campo=datanasc&tabela=membro
	}
	
	public function getVazio () {
	// se valor devolvido pelo banco for vázio
		if ($this->valor=="")
		{
			$this->valor="N&atilde;o informado";
		}
	}
	
	public function getFormSexo () {
	// Se o campo for sexo retorna um campo select
	return ?>
			<select name="select" autofocus="autofocus" >
				<option value="<?PHP echo $this->valor;?>"><?PHP echo $this->valor;?></option>
				<option value="M">Masculino</option>
				<option value="F">Femino</option>
			  </select>
			<?PHP;	
	}
	
	public function getFormPais () {
	// Se o campo for sexo retorna um campo select
	return ?>
			<select name="select" autofocus="autofocus" >
				<option value="<?PHP echo $this->valor;?>"><?PHP echo $this->valor;?></option>
				<option value="M">Masculino</option>
				<option value="F">Femino</option>
			  </select>
			<?PHP;	
	}
	
	/* Formulário para edição por item. Neste form os campos são recebidos de qualquer 
	campo para edição da tabela. Bastando para isso o envio do campo por GET-campo, esse campo que é 
	passado, também é responsável pelo da tabela que será alterado e o GET-tabela traz o nome da tabela
	que sofrerá alteração. Em agumas ocasiões também é passado o campo UF.*/
	public function getEditar(){

	if ($this->campo==$this->vlr_get){

			//echo $this->campo." = ".$this->vlr_get;
			?>
				<form id="form1" name="form1" method="post" action="">
				<input type="hidden" name="escolha" value="<?PHP echo "{$this->acao}";?>" />
				<input type="hidden" name="campo" value="<?PHP echo "{$this->campo}";?>" />
				<input type="hidden" name="tabela" value="<?PHP echo $_GET["tabela"];?>" />
			<?PHP
				if ($this->campo!="sexo" && $this->campo!="obs")
				{
			?>  
			  <input type="text" name="<?PHP echo $this->campo;?>" value="
			  <?PHP
			  //No caso para o campo naturalidade o campo UF é adiconado 
			  echo $this->valor;if ($this->campo=="naturalidade" || $this->campo=="cidade"){/*DEVE-SE SE ADICIONAR OUTRO FORM PARA UF*/}
			  ?>" size="30" autofocus="autofocus" />
			<?PHP
			}else { //Campo para form tipo textarea
				echo "<textarea autofocus='autofocus' name='{$this->campo}' cols='50' >{$this->valor}</textarea>";
			}

			if ($this->campo=="pai" || $this->campo=="mae" || $this->campo=="conjugue") {
			//Nos campos Pai e Mãe é aberto um segundo campo do form para o rol e a opção, por JavaScript, de um script para pesquisa de membros e preenchimeto destes campos
			?>
			Rol:
			<input name="<?PHP echo "rol_{$this->campo}";?>" autofocus="autofocus" type="text" value="<?PHP echo $arr_dad["rol_{$this->campo}"];?>" size="10" />
			<?php
			if ($this->campo=="conjugue") {$form=2;}else{$form=3;}
			?>
			<a href="javascript:lancarSubmenu('campo=<?PHP echo $this->campo;?>&rol=rol_<?PHP echo $this->campo;?>&form=<?PHP echo $form;?>')"><img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para pesquisar membros!" /></a>
			<?PHP
			}
			?>
			<input type="submit" name="Submit" value="Alterar..." /> 
			</form>
			<?PHP

		} else {
			//echo "<h3>{$this->campo} - {$this->valor}</h3>";
			echo "<p><a title='Click aqui para alaterar este campo!' href='./?escolha={$this->link_form}'>{$this->valor}</a></p>";
		}
	}

}

class form_sexo extends editar_form {

	public function getEditar () {
	if ($this->campo=="sexo")
			{
			?>
			  <select name="select" autofocus="autofocus" >
				<option value="<?PHP echo $this->valor;?>"><?PHP echo $this->valor;?></option>
				<option value="M">Masculino</option>
				<option value="F">Femino</option>
			  </select>
			<?PHP 
			}
	}

}
?>