	<?PHP
	require_once("DB.php");
	if (file_exists("func_class/constantes.php")){
		require('func_class/constantes.php');
	}elseif (file_exists('../func_class/constantes.php')){
		require('../func_class/constantes.php');
	}elseif (file_exists('../../func_class/constantes.php')){
		require('../../func_class/constantes.php');
	}
	$db =& DB::connect ($dns, array());
	if (PEAR::isError($db)){ die ($db->getMessage());exit;}

	/*
		 *@categoria  Pagina��o
		 * @Pacote    Rodap�
		 * @autor     Joseilton Costa Bruce <hiltonbruce@gmail.com>
		 * @copyright 2009
		 * @licen�a   www.gnu.org/licenses/licenses.html#GPL
		 * @version   CVS: $Id: rodape.php,v 0.10 2009/03/30 05:27:25 aharvey Exp $
	*/

	class rodape {
		protected $_pagina; //Recebe a quantidade de Links de p�ginas dispon�veis
		protected $_url; //Recebe o n�mero da p�gina para direcionar as solicita��es
		protected $_linkpagina; //nome do link com a pagina��o
		protected $_urlextra; //Recebe o link da p�gina atual para enviar a url da p�gina
		protected $_linkppag; //Define a quantidade de links num�ricos na p�gina

		function __construct($_pagina=0,$_url=0,$_linkpagina="",$_urlextra="",$_linkppag=0) {
			$this->_pagina = $_pagina;
			$this->_url=$_url;
			$this->_linkpagina=$_linkpagina;
			$this->_urlextra=$_urlextra;
			$this->_linkppag=$_linkppag;
		}

		public function getPagina(){
			//Total de link de p�ginas
			return $this->_pagina;
		}

		public function getUrl(){ //P�gina atual para o PHP, ou seja, para o usu�rio ela � este valor + 1 - Visual
			return $this->_url;
		}      //echo "<h1>$table</h1>";      //echo "<h1>$table</h1>";      //echo "<h1>$table</h1>";      //echo "<h1>$table</h1>";

		public function getLinkpagina(){ //nome do link da p�gina. Ex.
			return $this->_linkpagina;
		}

		public function getUrlextra(){
			return $this->_urlextra;
		}

		public function getLinkppag(){ //Se a quant de links por p�ginas for maior q a quant de paginas dispon�veis ele retorna quant de p�aginas
			if ($this->_linkppag<=$this->_pagina)
				return $this->_linkppag;
			else
				return $this->_pagina;
		}

		public function getQuantpg() {
			//Total de p�ginas
			if ($this->getLinkppag()>0)
				return ceil(($this->getUrl())/$this->getLinkppag());
			else
				return 0;
		}

		public function getUltimapg(){
			//limita o loop for ao valor da �ltima p�gina
			if (($this->getQuantpg()*$this->getLinkppag())<=$this->getPagina())
				return $this->getQuantpg()*$this->getLinkppag();
			elseif (($this->getQuantpg()*$this->getLinkppag())>$this->getPagina())
			return $this->getPagina();
		}

		public function getDados(){
			echo 	"Links de P&acute;gina: \$this->getPagina() : <span>".$this->getPagina()."</span><br/>".
					"linkP�gina: \$this->getLinkpagina() : <span>".$this->getLinkpagina()."</span><br/>".
					"url da p&acute;gina: \$this->getUrl() : <span> ".$this->getUrl()."</span><br/>".
					"Link por P&acute;gina: \$this->getLinkppag() : <span>".$this->getLinkppag()."</span><br/>".
					"urlExtra: \$this->getUrlextra() : <span >".$this->getUrlextra()."</span><br/>".
					"For final: \$this->getQuantpg()*\$this->getLinkppag(): <span>".$this->getQuantpg()*$this->getLinkppag()."</span><br/>".
					"Total de paginas: getQuantpg() = ceil((\$this->getUrl()+1)/\$this->getLinkppag()) <span>".$this->getQuantpg()."</span><br/>";
		}

		public function getRodapeinic() {
			if ($this->_url>1)
			{
				$url = $this->_url-1;
				echo 	"<ul class='pagination pagination-sm'><li><a href='./{$this->getUrlextra()}&{$this->_linkpagina}=1'>In&iacute;cio</a>";
				echo 	"<a href='./{$this->getUrlextra()}&{$this->_linkpagina}=$url'>&laquo;</a>"; //Vai p a p�gina anterior
			}else {
				echo '<ul class="pagination pagination-sm">';
			}
	}
	/*public function getRodapeinicPesq() {
	if ($this->_url>0)
	{
	$url = $this->_url-1;
	echo 	"<a href='./{$this->getUrlextra()}'>In&iacute;cio</a> | ".
	"<a href='./pesq_membro.php?nome={$_GET["nome"]}&campo={$_GET["campo"]}&rol_pai={$_GET["rol_pai"]}&".$this->_linkpagina."=$url'>Anterior</a>"; //Vai p a p�gina anterior
	}
	}
	*/
	public function getRodapemeio() {
		//Define a parte central da pagina��
			for ($i=($this->getUltimapg()-$this->getLinkppag() ); $i<($this->getUltimapg()); $i++)
			{
				$pg=$i+1;
				$url = $this->getLinkpagina()."=".($i+1);
				if ($pg!=($this->getUrl()))
					{
					echo "<li><a href='./{$this->getUrlextra()}&$url'>$pg</a></li>";
					}else{
						echo '<li><a class="btn btn-primary active disabled">'.$pg.'</a></li>';
					}
			}//Fim loop for
		echo '';
	}

	public function getRodapefim($mais=null){
			$mais++;
			$fim=$this->getPagina();
			$proxima = $this->getUrl()+1;
				if ($proxima<$this->getPagina()){
						echo 	"<li class='next'><a href='./".$this->getUrlextra()."&".$this->_linkpagina."=".$proxima."'>&raquo;</a></li>";
						echo	"<li><a href='./".$this->getUrlextra()."&".$this->getLinkpagina()."=$fim'>Fim</a></li></ul>";
				}else {
					echo '</ul>';
				}
	}

	public function getRodaperes() { //Total das p�ginas disponibilizadas
	if ($this->getPagina()>"1"){
	return "<br/><span>Total de ".$this->getPagina()." p&aacute;ginas";
		}elseif ($this->getPagina()=="1"){
		return "<br/><span>Total de ".$this->getPagina()." p&aacute;gina";
		}else {
		return "N�o h� nenhuma informa��o para esta pesquisa!";
	}
	}

	public function getRodape() {
	return 	"{$this->getRodapeinic()}".
	"{$this->getRodapemeio()}".
	"{$this->getRodapefim()}";
	}

	public function form_rodape ($texto,$nInput) {
    $nome = (empty($_GET["nome"])) ? '' : $_GET["nome"] ;
    $direita = (empty($_GET["direita"])) ? '' : $_GET["direita"] ;
    $rec = (empty($_GET["rec"])) ? '' : $_GET["rec"] ;
    $id = (empty($_GET["id"])) ? '' : $_GET["id"] ;
    $ord = (empty($_GET["ord"])) ? '' : $_GET["ord"] ;
    $menu = (empty($_GET["menu"])) ? '' : $_GET["menu"] ;
    $escolha = (empty($_GET["escolha"])) ? '' : $_GET["escolha"] ;
		if (!empty($nInput)) {
			$novaLinha = '<input name="'.$nInput.'" type="hidden" value="'.$_GET[$nInput].'">';
		}else {
			$novaLinha = '';
		}
	echo '<form id="form" name="form" method="get" action="">';
	echo '<input name="escolha" type="hidden" id="escolha" value="'.$escolha.'">';
	echo '<input name="menu" type="hidden" value="'.$menu.'">';
	echo '<input name="ord" type="hidden" value="'.$ord.'">';
	echo '<input name="id" type="hidden" value="'.$id.'">';
	echo '<input name="rec" type="hidden" value="'.$rec.'">';
	echo '<input name="direita" type="hidden" value="'.$direita.'">';
	echo '<input name="nome" type="hidden" value="'.$nome.'">';
	echo '<div class="row"><div class="col-xs-4">';
	echo $novaLinha;
	echo '<input name="'.$this->_linkpagina.'" class="form-control input-sm" type="text" size="4" />';
	echo '</div><div class="col-xs-3">';
	echo '<input class="btn btn-primary btn-sm" type="submit" name="Submit" value="'.$texto.'" />';
	echo '</div></div></form>';
	}

	public function form_rodape_get ($texto,$campo) {
	echo 	"<form id='form' name='form' method='get' action=''>".$texto.
	"<input name='escolha' type='hidden' id='escolha' value='{$_GET["escolha"]}'>".
	"<input name='menu' type='hidden' value='{$_GET["menu"]}'>".
	"<input name='$campo' type='hidden' value='{$_GET[$campo]}'>".
	"<input name='ord' type='hidden' value='{$_GET["ord"]}'>".
	"<input name='id' type='hidden' value='{$_GET["id"]}'>".
	"<input name='nome' type='hidden' value='{$_GET["nome"]}'>".
	"<input name='{$this->_linkpagina}' type='text' size='3' />".
	"<input type='submit' name='Submit' value='Listar...' />".
	"</form>";
	}

	function __destruct() {
		//foi removido pois ao final da p�gina aparecia informa��es do rodap�
	//echo $this->getRodaperes ();
	}
	/* Exemplo para chamada desta classe
	$_urlLi="escolha=".$_GET["escolha"]."&menu=".$_GET["menu"]."&ord_m=".$_GET["ord_m"];
	$_rod = new rodape(20,$_GET["pag_rodape"],"pag_rodape","$_urlLi",8);//(Quantidade de p�ginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por p�gina)
	$_rod->getDados();
	$_rod->getRodape();
	Exemplo de CSS para o Radap�:

	span#rodape{
	font-weight:bold;
	background:#00CCFF;
	font-weight: bold;
	}

	a#rodape{
	text-decoration:underline;
	font-size:16px;
	}
	*/}

class DBRecord {
  /*Exemplo de funcionamento desta classe:
	$rec = new DBRecord ("tabela","op��o","campo"); Aqui ser� selecionado a informa��o do campo da tabela autor igual a op�ao
	print $rec->Name()."\n"; Imprime o valor na tela
	$rec->Name = "Novo Nome"; Aqui � atribuido a esta vari�vel um valor para UpDate
	$rec->Update(); � feita a chamada do m�todo q realiza a atualiza��o no Banco
  */
  var $h;
  var $table;
  var $id;
  var $campo;

  public function DBRecord( $table, $id, $campo )
  {
	global $db;
	if (empty($campo)){$campo="rol";}
	$res = $db->query( "SELECT * from $table WHERE $campo=?", array( $id ) );
	$res->fetchInto( $row, DB_FETCHMODE_ASSOC );
	// var_dump($res );
	$this->{'h'} = $row;
	$this->{'table'} = $table;
	$this->{'id'} = $id;
	$this->campo = $campo;
  }

  public function __call( $method, $args ){
	//echo "CALL";
	return $this->{'h'}[$method];
  }

  public function cad_organica($ind) {
     //Lista subordinado � do script igreja/cad_organica
     $lin = mysql_query("SELECT * from {$this->{'table'}} ORDER BY id_igreja,codigo ");
     $coluna = 0;
     $id_igreja = 0;
	while ($line = mysql_fetch_array($lin))
	  {
	  if  (strlen ($line[2])==4)// Altera a cor de fundo nas contas
	  $fd_tab = "bgcolor='#00CCFF'";
	  elseif (strlen ($line[2])==1)
	  $fd_tab = "bgcolor='#FFFFCC'";
	  elseif  (strlen ($line[2])==13 || strlen ($line[1])==7)// Altera a cor de fundo nas contas
	  $fd_tab = "bgcolor='#00FFFF'";
	  elseif (strlen ($line[2])==7)
	  $fd_tab = "bgcolor='#00FFFF'";
	  else
	  $fd_tab = "";
	  if ($id_igreja > 1 && $id_igreja==$line[1]){
// </tbody></table>
	  ?>
	  <table width="565" border = "1" summary="Lista Unidades Oranicas da Igreja." >
	  <caption>
	  </caption>
	  <thead>
	       <tr>
	       <th colspan="2" scope="col">Unidades da Congrega&ccedil;&atilde;o<?php echo " - $id_igreja - line[1]".$line[1];?></th>
	       </tr>Informado
	  </thead>
	       <tfoot>
	       <tr>
	       <td colspan="2"><a href="#" >Ocultar/Exibir Unidades - Congre&ccedil;&atilde;o</a></td>
	       </tr>
	  </tfoot>
	  <tbody>
	  <?PHP }
	  elseif ($line[1] == "1" && $id_igreja==0){
	  ?>
	  <table width="565" id="" border = "1" summary="Lista Unidades Oranicas da Igreja.">
	  <caption>
	  </caption>
	  <thead>
	       <tr>
	       <th colspan="2" scope="col">Unidades da Sede</th>
	       </tr>
	  </thead>
	     <tfoot>
	       <tr>
	       <td colspan="2"><a href="#">Ocultar/Exibir Unidades - SEDE <?php echo " - $id_igreja - line[1]".$line[1];?></a></td>
	       </tr>
	     </tfoot>
	  <tbody>
	  <?PHP
	  }
	  echo "<tr>";
	  ++$coluna;
	  ++$ind;
	  if ((strlen ($line[1])<=13 && strlen ($line[1])<>7) || $line[1]=="1.09.00")
	  print( "<td title= '$line[4]' $fd_tab >$line[2]</td><td $fd_tab ><input name='subordinado' type='radio' value='$line[2]' tabindex='++$ind;'/>$line[4]</td>");
	  else
	  print( "<td title= '$line[5]'> $line[4]</td><td>$line[4]</td>");
	  echo "</tr>";
	  if ($line[1]!=$id_igreja) {
	       $id_igreja = $line[1];
	  }
	  //if ($coluna > 1)  {echo "</tr>";$coluna = 0;echo "<tr>";}
	  }
     //echo "</tr>";
     echo "</tbody></table>";
     return $ind;
	}

  public function __get( $id )
  {
    //print "Getting $id\n";
    return $this->{'h'}[$id];
  }

  public function __set( $id, $value )
  {
	//echo "__set";
	$this->{'h'}[$id] = $value;
  }

  public function Update()
  {
    global $db;
    $fields = array();
    $values = array();
    foreach( array_keys( $this->{'h'} ) as $key )
    {
      if ( $key != "id" )
      {
        $fields []= $key." = ?";
        $values []= $this->{'h'}[$key];
      }
    }
    $fields = join( ",", $fields );
    $values []= $this->{'id'};
    if ($this->campo!='') {
    	$sql = "UPDATE {$this->{'table'}} SET $fields WHERE {$this->campo} = ?";
    }else {
    	 $sql = "UPDATE {$this->{'table'}} SET $fields WHERE rol = ?";
    }
	//echo "$sql";
  $sth = $db->prepare( $sql );
  //echo "$sth";
//   echo var_dump($values);
	$db->execute( $sth, $values );
  }
  public function UpdateID ()
  {
    global $db;
    $fields = array();
    $values = array();
    foreach( array_keys( $this->{'h'} ) as $key )
    {
      if ( $key != "id" )
      {
        $fields []= $key." = ?";
        $values []= $this->{'h'}[$key];
      }
    }
    $fields = join( ",", $fields );
    $values []= $this->{'id'};
    $sql = "UPDATE {$this->{'table'}} SET $fields WHERE id = ?";
	//echo "$sql";
    $sth = $db->prepare( $sql );
    //echo "$sth";
	$db->execute( $sth, $values );
  }
    public function Insert()
  {
    global $db;
    $fields = array();
    $values = array();
    foreach( array_keys( $this->{'h'} ) as $key )
    {
    $fields []= " ?";
		$chave [] = $key;
    $values []= $this->{'h'}[$key];
		echo "$key = {$this->{'h'}[$key]}<br/>";
    }
	$fields = join( ",", $fields );
	$chave = join( ",", $chave );
	$values []= $this->{'id'};
	//echo "Valores= {$this->{'id'}}";
  $sql = "INSERT INTO  {$this->{'table'}} $chave VALUES $fields";
	//echo "$sql";
  $sth = $db->prepare( $sql );
  //echo "$sth<br/>$fields";
  $db->execute( $sth, $values );
  }
  	/*
     function __destruct() {
	  echo "$sth \n";
	  //echo "$sql";
     }
     */
}

class insert {

	protected $tabela; //Nome da Tebela
	protected $campos; //Valores do insert

	function __construct ($campos="",$tabela="") {
			$this->setTabela ($tabela);
			$this->setCampos ($campos);
		}

	public function setTabela ($tabela){
			$this->_tabela=$tabela;
		}

	public function setCampos ($campos){
			$this->_campos=$campos;
		}

	public function getTabela (){
		return $this->_tabela;
	}

	public function getCampos (){
		return $this->_campos;
	}

	public function inserir() {
//		var_dump($this->getCampos());
		$inserir = mysql_query ("INSERT INTO ".$this->getTabela()." VALUES (".$this->getCampos().")") or die (mysql_error());
		if ($inserir){
				$idCad = mysql_insert_id();
				//echo "<script> alert('Inclus�o ######$idCad### realizada com sucesso! Em ".$this->getTabela()."');</script>";
				//echo "Inclus�o realizada com sucesso!";
		}else{
			echo "<script> alert('Falha no Cadastro. Se o probelama continua informe ao desenvolvedor do sistema!');window.history.go(-1);</script>";
			echo "Falha no Cadastro. Se o probelama continua informe ao desenvolvedor do sistema!";
			  $idCad = false;
		}
		return $idCad;
	}
	/*Exemplo do funcionamento desta classe
		$value = "'campo1','campo2','campo3','campo4',...,'campo_N'";
		$dados_pessoais = new insert ("$value","tabela");deve-se colocar todos valores para os campos da tabela a ser inserida
		$dados_pessoais->inserir();
	*/
}
class editar_form {

	public $campo;
	public $valor;
	public $acao;
	public $link_form;
	public $ind;

	function __construct ($vlr_get="",$valor="",$acao="",$link_form="") 
	{
		$this->campo 		= $_GET["campo"];       //Nome do campo para get
		$this->vlr_get		= $vlr_get;             //Valor relacionado ao get
		$this->valor 		= $valor;               //O valor do campo no banco de dados
		$this->acao 		= $acao;                //Link para onde o form ira direcionar os dadosa. Ex.:adm/atualizar_dados.php
		$this->link_form 	= $link_form.$vlr_get;  //Link de chamada do form para edi��o do form. Ex.: adm/dados_pessoais.php&campo=datanasc&tabela=membro
		if ($this->campo=="datanasc" || $this->campo=="dt_nasc" || $this->campo=="batismo_em_aguas" ||
			$this->campo=="dt_muda_assembleia"  || $this->campo=="auxiliar"
			|| $this->campo=="diaconato" || $this->campo=="presbitero" ||
			$this->campo=="evangelista" || $this->campo=="pastor" || $this->campo=="missionario" || $this->campo=="data"
			|| $this->campo=="dat_aclam" || $this->campo=="dt_mudanca_denominacao"
			|| $this->campo=="dt_apresent") 
				{
					$this->classCompl = 'dataclass';
				}else {
					$this->classCompl = '';
				}
	}

	public function getEditar($placeholder,$fJScript,$ident){
	$ind = 1;
	if ($this->valor=="" || $this->valor=='N&atilde;o Informado!'){
		$this->valor='';
		if ($placeholder=='') {
			$placeholder='Informe aqui para alterar!';
		}
	}elseif ($this->campo=='valor') {
		$trans = array("." => ",", "," => ".");
		$this->valor = strtr($this->valor,$trans);
		$this->classCompl = 'money';
	}
	if ($this->campo==$this->vlr_get)
		{
			/* Formul�rio para edi��o por item. Neste form os campos s�o recebidos de qualquer
			campo para edi��o da tabela. Bastando para isso o envio do campo por GET-campo, esse campo que �
			passado, tamb�m � respons�vel pelo da tabela que ser� alterada e o GET-tabela traz o nome da tabela
			que sofrer� altera��o. Em agumas ocasi�es tamb�m � passado o campo UF.*/

			//echo $this->campo." = ".$this->vlr_get;
      if ($ident=='') {
          $ident = (empty($_GET["bsc_rol"])) ? intval($_GET['id']):intval($_GET['bsc_rol']);
      }
			?>
			<form id="form1" name="form1" method="post" action="">
			<table><tbody><tr><td>
			<input type="hidden" name="escolha" value="<?PHP echo "{$this->acao}";?>" /> <!-- indica o script que receber� os dados -->
			<input type="hidden" name="campo" value="<?PHP echo "{$this->campo}";?>" />
			<input type="hidden" name="tabela" value="<?PHP echo $_GET["tabela"];?>" />
			<input type="hidden" name="id" value="<?PHP echo $ident;?>" />
			<?PHP
			switch ($this->campo){
				case "sexo":
					?></td><td><label>&nbsp;</label>
					  <select name="<?PHP echo $this->campo;?>" autofocus="autofocus" class="form-control" >
						<option value="<?PHP echo $this->valor;?>"><?PHP echo $this->valor;?></option>
						<option value="M">Masculino</option>
						<option value="F">Femino</option>
					  </select></td>
					<?PHP
					break;
				case "situacao_espiritual":
					?></td><td><label>&nbsp;</label>
					  <select class="form-control" name="<?PHP echo $this->campo;?>" placeholder='<?php echo $placeholder;?>'
					  autofocus="autofocus" tabindex="<?PHP echo $ind++;?>">
						<option value="<?PHP echo $this->valor;?>"><?PHP echo $this->valor;?></option>
						<option value="1">Em Comunh&atilde;o</option>
						<option value="3">Faleceu</option>
						<option value="4">Modou de Denomina&ccedil;&atilde;o</option>
						<option value="5">Afastou-se da Igreja</option>
						<option value="6">Transferido</option>
					  </select></td>
					<?PHP
					break;
				case 'obs';
					echo '</td><td><label>&nbsp;</label><textarea class="form-control" autofocus="autofocus" placeholder="'.$placeholder.'"';
					echo "name='{$this->campo}' cols='50' onselect='1' ";
					echo 'tabindex="'.$ind++.'" >'.$this->valor.'</textarea></td>';
					break;
				case "uf_nasc":
					$ind++;
					echo '</td><td><label>&nbsp;</label>';
					echo sele_uf ($this->valor,"uf_nasc");
					echo '</td>';
					break;
				case "uf_resid":
					echo '</td><td><label>&nbsp;</label>';
					echo sele_uf ($this->valor,"uf_resid");
					echo '</td>';
					break;
				case "tipo":
					echo 	"</td><td><label>&nbsp;</label><select class='form-control' name='$this->campo' autofocus='autofocus' size='1'".
							  " class='AzulMedio' id='$this->campo' placeholder=' $placeholder' tabindex='$ind++'>".
							  "<option value='$this->valor' selected>".carta ($this->valor)."</option>".
							  "<option value='1'>".carta (1)."</option>".
							  "<option value='2'>".carta (2)."</option>".
							  "<option value='3'>".carta (3)."</option>".
							"</select></td>";
					break;
				default:
					?>
					</td><td>
					<label>&nbsp;</label>
			      		<input type="text" class="form-control <?php echo $this->classCompl;?>"
								autofocus="autofocus" placeholder="<?php echo $placeholder;?>"
								name="<?PHP echo $this->campo;?>" value="<?PHP echo $this->valor;?>"
								size="30" tabindex="<?PHP echo $ind++;?>" />
					</td></td>
					<?PHP
					break;
			}
			if ($this->campo=="pai" || $this->campo=="mae" || $this->campo=="conjugue")//Abre para edi��o 2 campos para Pai e M�e
			{
			//Nos campos Pai e M�e � aberto um segundo campo do form para o rol e a op��o, por JavaScript, de um script para pesquisa de membros e preenchimeto destes campos
			?>
			<td>
		    <div class="row">
		 	 <div class="col-xs-4">
			<label>Rol:</label>
			<input name="<?PHP echo "rol_{$this->campo}";?>" class='form-control input-sm' autofocus="autofocus" type="text"
			value="<?PHP echo $_GET["rol_{$this->campo}"];?>" size="10"  tabindex="<?PHP echo $ind++;?>" /></div>
			<?php
			if ($fJScript!='') {
				$form=$fJScript;
			}elseif ($this->campo=="conjugue") {$form=0;}else{$form=2;}
			?>
		 	 <div class="col-xs-2">
			<label>&nbsp;</label>
			<a href="javascript:lancarSubmenu('campo=<?PHP echo $this->campo;?>
				&rol=rol_<?PHP echo $this->campo;?>&form=<?PHP echo $form;?>')"
				 title="Click aqui para pesquisar membros!"  >
				<span class="btn btn-link glyphicon glyphicon-search" > Pesquisar...</span></a></div></div>
			<?PHP
			}
			?>
			<td>
			<label>&nbsp;</label>
			<input type="submit" class='btn btn-primary btn-sm' name="Submit" value="Alterar..."  tabindex="<?PHP echo $ind++;?>" />
			</tr></tbody></table></form>
			<?PHP
		}else{
			//echo "<h3>{$this->vlr_get} - {$this->valor}</h3>";
			switch ($this->vlr_get)
			{
				case ("tipo")://tipo na lista carta
					if ($this->valor=="1")
						$exibi_opcao="Recomenda&ccedil;&atilde;o";
					elseif ($this->valor=="2")
						$exibi_opcao="Mudan&ccedil;a";
					else
						$exibi_opcao="N&atilde;o Informado";
					break;
				case ("sexo")://tipo na 4a Pessoal
					if ($this->valor=="M")
						$exibi_opcao="Masculino";
					elseif ($this->valor=="F")
						$exibi_opcao="Feminino";
					else
						$exibi_opcao="N&atilde;o Informado";
					break;
				default:
					$exibi_opcao=$this->valor;
			}
			//echo "<p><a title='Click aqui para alaterar este campo!' href='./?escolha={$this->link_form}'>{$exibi_opcao}</a></p>";
		}
	}
	public function getMostrar(){
		if (empty($this->valor)){
			$this->valor = "N&atilde;o Informado!";
		}
        $msgExibir = '<p><a title="Click aqui para alterar este campo!" href="./?escolha='.$this->link_form.'" tabindex="$ind++" >'.$this->valor;
        switch ($this->vlr_get) {
            case 'situacao_espiritual':
                echo '<p><a title="Click aqui para alterar este registro!"'
                    .'href="./?escolha=adm/dados_disciplina.php&bsc_rol='.$_GET["bsc_rol"].'&novo=novo"'
                    .'tabindex="'.$ind++.'" >'.$this->valor.'</a></p>';
                break;
            case 'secretario1':
                if ($this->valor>0) {
                    $nomeSecr1 = new DBRecord ('membro',$this->valor,'rol');
                    echo $msgExibir.' - '.$nomeSecr1->nome().'</a></p>';
                }else {
                    echo $msgExibir.'</a></p>';
                }
                break;
            case 'secretario2':
                if ($this->valor>0) {
                    $nomeSecr2 = new DBRecord ('membro',$this->valor,'rol');
                    echo $msgExibir.' - '.$nomeSecr2->nome().'</a></p>';
                }else {
                    echo $msgExibir.'</a></p>';
                }
                break;
            default:
                echo $msgExibir.'</a></p>';
                break;
        }
	}
}

class sele_cidade {

	protected $tabela;
	protected $valor;
	protected $campo;
	protected $campo_retorno;
	protected $texto_field;

	function __construct ($tabela="", $valor="", $campo="", $campo_retorno= "", $texto_field=""){
		$this->tabela = $tabela;//
		$this->valor = $valor;//O valor do campo no banco de dados
		$this->campo = $campo;//Campo para pesquisa no Banco
		//Monta a parte o retorno html do formul�rio
		$this->campo_retorno = $campo_retorno;//Campo que ser� retornado
		$this->texto_field = $texto_field;//O nome que ser� relaciondo ao campo de retorno para envio pelo form
		if (DB::isError($res))
		{
			echo $db->getMessage;
			exit;
		}
	}

	function ListDados ($indice,$id=null,$pers=null){//indice da sequ�ncia do formul�rio
	global $db;
	$sql_lst = "SELECT * from {$this->tabela} WHERE {$this->campo}=? ORDER BY {$this->campo_retorno}";
	$this->res = $db->query($sql_lst, array( $this->valor ));
	//Obt�m o n�mero de linhas
	$num_linhas = (int)$this->res->numRows();
	//Mostra as linhas de select
	if ($num_linhas>0){
	$linhoOptions1 = '';
	echo 	"<select name='{$this->texto_field}' class='form-control' tabindex='$indice' $pers >";
				if (($_SESSION["cid_end"])>0 && $this->campo=="cidade"){
					echo "<option value='{$_SESSION["cid_end"]}'>C�d. - {$_SESSION["cid_end"]}</option>";
				}elseif ($this->campo=="coduf" && $_GET["uf_end"]=="PB"){
					echo "<option value='2585'>Bayeux</option>";
				}else{
// 					echo "<option value=''>-->> Escolha  <<--</option>";
				}
		for ($i=0; $i<$num_linhas; $i++)
		{
			$linhas = $this->res->fetchRow(DB_FETCHMODE_ASSOC);
			if ($id == $linhas["id"]) {
				$linhoOptions1 = "<option value='".$linhas["id"]."'>".$linhas[$this->campo_retorno]."</option>";
			}
			$linhoOptions .= "<option value='".$linhas["id"]."'>".$linhas[$this->campo_retorno]."</option>";
		}
	echo $linhoOptions1.$linhoOptions.'</select>';
	//Disconecta do Banco
	//$db->disconnect();
	}elseif (empty($this->valor) && $this->campo==strtolower("uf")){
		echo "Voc&ecirc; n&atilde;o informou o estado de batismo! Fa&ccedil;a-o antes de continuar.</h2>";
		echo "<script> alert('Voc� n�o informou o estado de batismo! Fa�a-o antes de continuar.'); window.history.go(-1);</script>";
		exit;
	}elseif ($this->campo==strtolower("idcidade") && $this->valor == ""){
		echo "Voc� n�o informou a cidade ou falta atualizar! Fa�a-o antes de continuar.</h2>";
		echo "<script> alert('Voc� n�o informou a cidade ou falta atualizar! Fa�a-o antes de continuar.'); window.history.go(-1);</script>";
	}else{
		echo "<script> alert('N�o h� nenhum bairro cadastrado nesta cidade! Recomendamos que voc� fa�a-o antes de continuar.');</script>";
		echo 	"<select name='{$this->texto_field}' id='{$this->texto_field}' class='form-control' tabindex='$indice'>";
		echo "<option value=''>-->> Escolha <<--</option>";
		echo "<option value='Centro'>Centro</option>";
		echo "</select>";
	}
	}

	function cidadePopup ($indice,$id=null,$link=null){//indice da sequ�ncia do formul�rio
	global $db;
	$sql_lst = "SELECT * from {$this->tabela} WHERE {$this->campo}=? ORDER BY {$this->campo_retorno}";
	$this->res = $db->query($sql_lst, array( $this->valor ));
	//Obt�m o n�mero de linhas
	$num_linhas = (int)$this->res->numRows();
	//Mostra as linhas de select
	if ($num_linhas>0){
	$linhoOptions1 = '';
				if (($_SESSION["cid_end"])>0 && $this->campo=="cidade"){
					echo "<option value='{$_SESSION["cid_end"]}'>C�d. - {$_SESSION["cid_end"]}</option>";
				}elseif ($this->campo=="coduf" && $_GET["uf_end"]=="PB"){
					echo "<option value='$link'>Bayeux</option>";
				}else{
// 					echo "<option value=''>-->> Escolha  <<--</option>";
				}
		for ($i=0; $i<$num_linhas; $i++)
		{
			$linhas = $this->res->fetchRow(DB_FETCHMODE_ASSOC);
			if ($id == $linhas["id"]) {
				$linhoOptions1 = "<option value='$link".$linhas["id"]."'>".$linhas[$this->campo_retorno]."</option>";
			}
			$linhoOptions .= "<option value='$link".$linhas["id"]."'>".$linhas[$this->campo_retorno]."</option>";
		}
	echo $linhoOptions1.$linhoOptions;
	//Disconecta do Banco
	//$db->disconnect();
	}elseif (empty($this->valor) && $this->campo==strtolower("uf")){
		echo "Voc&ecirc; n&atilde;o informou o estado de batismo! Fa&ccedil;a-o antes de continuar.</h2>";
		echo "<script> alert('Voc� n�o informou o estado de batismo! Fa�a-o antes de continuar.'); window.history.go(-1);</script>";
		exit;
	}elseif ($this->campo==strtolower("idcidade") && $this->valor == ""){
		echo "Voc� n�o informou a cidade ou falta atualizar! Fa�a-o antes de continuar.</h2>";
		echo "<script> alert('Voc� n�o informou a cidade ou falta atualizar! Fa�a-o antes de continuar.'); window.history.go(-1);</script>";
	}else{
		echo "<script> alert('N�o h� nenhum bairro cadastrado para esta cidade! Recomendamos que voc� fa�a-o antes de continuar.');</script>";
		echo 	"<select name='{$this->texto_field}' id='{$this->texto_field}' class='form-control' tabindex='$indice'>";
		echo "<option value=''>-->> Escolha <<--</option>";
		echo "<option value='Centro'>Centro</option>";
		echo "</select>";
	}
	}

}

class List_sele {

	protected $tabela;
	protected $campo_retorno;
	protected $texto_field;//nome do campo

	function __construct ($tabela="", $campo_retorno= "", $texto_field=""){
		$this->tabela = $tabela;//
		$this->campo_retorno = $campo_retorno;//Campo que ser� retornado
		$this->texto_field = $texto_field;//O nome que ser� relaciondo ao campo de retorno para envio pelo form
		$this->query = "SELECT * from {$this->tabela} ";
		$this->sql_lst = mysql_query($this->query.' ORDER BY '.$this->campo_retorno);
	}

	function List_Selec ($seq,$item,$required){
			$linhas = '';
	  	$linha1  =  "<select name='{$this->texto_field}' id='{$this->texto_field}' $required tabindex='$seq'>";
	  	if ($item<1) {
	  		$linha1 .=  "<option value=''>-->> Escolha <<--</option>";
	  	}else {
	  		$linhas =  "<option value='0'>-->> Todas <<--</option>";
	  	}
	       while($this->col_lst = mysql_fetch_array($this->sql_lst))
	       {
          $retorLinha = strtr( $this->col_lst[$this->campo_retorno], '��������������������������','aaaaeeiooouucAAAAEEIOOOUUC' );
	       	if ($this->col_lst["rol"]=='') {
	       		if ($item==$this->col_lst["id"]) {
		       		$linha1 .=  "<option value='".$this->col_lst["id"]."'>".$retorLinha."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["id"]."'>".$retorLinha."</option>";
	       	}else {
		       	if ($item==$this->col_lst["rol"]) {
		       		$linha1 .=  "<option value='".$this->col_lst["rol"]."'>".$retorLinha."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["rol"]."'>".$retorLinha."</option>";
	       	}
	       }
	    $linha3 = "</select>";
	  return $linha1.$linhas.$linha3 ;
	}

	function listSedeCong ($seq,$item,$required){
			$linhas = '';
	  	$linha1  =  "<select name='{$this->texto_field}' id='{$this->texto_field}' $required tabindex='$seq'>";
	  	if ($item<1) {
	  		$linha1 .=  "<option value=''>-->> Escolha <<--</option>";
	  	}
	  	$linhas .=  "<option value='0'>-->> Sede e Congrega&ccedil;&otilde;es <<--</option>";
	  	$linhas .=  "<option value='-1'>-->> Todas as Congrega&ccedil;&otilde;es <<--</option>";
	       while($this->col_lst = mysql_fetch_array($this->sql_lst))
	       {
          $retorLinha = strtr( $this->col_lst[$this->campo_retorno], '��������������������������','aaaaeeiooouucAAAAEEIOOOUUC' );
	       	if ($this->col_lst["rol"]=='') {
	       		if ($item==$this->col_lst["id"]) {
		       		$linha1 .=  "<option value='".$this->col_lst["id"]."'>".$retorLinha."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["id"]."'>".$retorLinha."</option>";
	       	}else {
		       	if ($item==$this->col_lst["rol"]) {
		       		$linha1 .=  "<option value='".$this->col_lst["rol"]."'>".$retorLinha."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["rol"]."'>".$retorLinha."</option>";
	       	}
	       }
	    $linha3 = "</select>";
	  return $linha1.$linhas.$linha3 ;
	}

	function List_Selec_pop ($link,$rol){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	$linha1 ='';
	$linhas ="<option value='./?$link{$this->col_lst["rol"]}'>Todas as Igrejas</option>";
	if ($_GET['ig']=='0' && $rol=='') {
		$linhas ="<option value='./?$link{$this->col_lst["rol"]}&ig=0'>Membros S/ Congrega&ccedil;&atilde;o</option>".$linhas ;
	} else {
		$linhas = $linhas."<option value='./?$link{$this->col_lst["rol"]}&ig=0'>Membros S/ Congrega&ccedil;&atilde;o</option>" ;
	}
		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			if ($this->col_lst["rol"]==$rol) {
				$linha1  = "<option value='./?$link{$this->col_lst["rol"]}'>".$this->col_lst[$this->campo_retorno]."</option>";
			}
			 $linhas .="<option value='./?$link{$this->col_lst["rol"]}'>".$this->col_lst[$this->campo_retorno]."</option>";
		}
		echo $linha0.$linha1.$linhas;
	}

	function List_sel ($ind,$req){
	//Mostra as linhas de select
	echo "<select name='{$this->texto_field}' id='{$this->texto_field}' $req tabindex='++$ind'>";
	echo "<option value=''>-->> Escolha <<--</option>";
	  while($this->col_lst = mysql_fetch_array($this->sql_lst))
	  {
	       echo "<option value='".$this->col_lst["id"]."'>".$this->col_lst[$this->campo_retorno]."</option>";
	  }
	echo "</select>";
     }

  function List_area_atua ($ind){
	//Mostra as linhas de select
	$this->sql_area = mysql_query("{$this->query}"." WHERE codigo LIKE '_.__' AND codigo<>'1.09'");
	echo "<select name='{$this->texto_field}' id='{$this->texto_field}' class='' tabindex='++$ind'>";
	echo "<option value=''>-->> Escolha <<--</option>";
	  while($this->col_lst = mysql_fetch_array($this->sql_area))
	  {
	       echo "<option value='".Substr($this->col_lst["codigo"],0,4)."'>".$this->col_lst[$this->campo_retorno]."</option>";
	  }
	echo "</select>";
     }
}

class ultimo_registro {

   function __construct (){
	  $this->tabela = $_POST["tabela"];//Define tabela a ser usada
	  $this->query = "SELECT * from {$this->tabela} ";
     }

  function ultimo_registro ($codigo,$campo){
	//seleciona o ultimo registro subordinado ao c�digo escolhido
	if (empty($codigo))
	$codigo .=".00";
	//echo "<h1>".$codigo."</h1>";
	$codigo = $codigo.".__";
	//echo "<h1>".$codigo."</h1>";
	$this->sql = mysql_query("{$this->query} WHERE $campo LIKE '{$codigo}' ORDER BY $campo DESC LIMIT 1") OR DIE (mysql_error());
	$this->col_lst = mysql_fetch_array($this->sql);
	$this->codigo = strlen ($this->col_lst[$campo]) - 2;
	//echo "<h1> this->codigo - ".$this->codigo." -  </h1>";
	//echo "<h1> - ".$this->col_lst[$campo]." - tes </h1>";
	return Substr($this->col_lst["codigo"],$this->codigo,2);
     }
}

class List_congr {
	//Classe para lista todos os dados de uma tabela
	//para se melhorada deverei adcionar LIMIT
	protected $tabela;
	protected $campo_retorno;

	function __construct ($tabela="", $campo_retorno= ""){
		$this->tabela = $tabela;//Define tabela a ser usada
		$this->campo_retorno = $campo_retorno;//Define tabela a ser usada
	}

	function get(){
	//Mostra a lista
	$sql_lst = mysql_query("SELECT * from {$this->tabela} ORDER BY {$this->campo_retorno}");
	while($col_lst = mysql_fetch_array($sql_lst))
		{
			if ($col_lst["status"]=='1') {
				echo "</strong><a href='./?escolha=igreja/mostrar.php&id={$col_lst["rol"]}&
						menu=top_igreja'>{$col_lst[$this->campo_retorno]}</a><br/></strong>";
			}
		}
	}
}

class central {
	//Define o script da p�gina central

	function get(){
		if (!empty($_POST["escolha"]) && !(strstr($_POST["escolha"], "http")) ){
			$perfil_usu = $_POST["escolha"];
		}elseif (!empty($_GET["escolha"]) && !(strstr($_GET["escolha"], "http")) ){
			$perfil_usu = $_GET["escolha"];
		}elseif ($_GET["escolha"] == "igreja/mostrar.php"){
			 $perfil_usu = ("igreja/mostrar.php");
		}else{
			$perfil_usu = "noticias/painel.php";
		}
		if (file_exists($perfil_usu)) {
			return ($perfil_usu);
		}
	}
}

class aniversario {

	function __construct (){
		//$sql_lst = "SELECT * from membro WHERE DATE_FORMAT(datanasc,'%d/%m/%Y')=? ORDER BY {$this->campo_retorno}";
		//$this->res = $db->query($sql_lst, array( $this->valor ));
		$this->dia = date('d/m');//Recupera o dia e m�s
		$this->semana = date('w');//Recupera a semana
		$this->mes = date('m');//Recupera o m�s
		$this->ano = date('Y');//Recupera o ano
		$this->query  = "SELECT m.rol, m.nome, DATE_FORMAT(m.datanasc,'%Y') AS idade, ";
		$this->query .= "DATE_FORMAT(m.datanasc,'%m') AS mes,DATE_FORMAT(m.datanasc,'%d') AS dia, ";
		$this->query .= "DATE_FORMAT(c.data,'%Y') AS casamento, DATE_FORMAT(e.batismo_em_aguas,'%Y') ";
		$this->query .= "AS batismo, e.congregacao from membro AS m, eclesiastico AS e, est_civil AS c ";
		$this->query .= "WHERE e.situacao_espiritual<2 AND m.rol=e.rol AND m.rol=c.rol AND ";

		switch ($_GET["ord"]){
		//Ordena a lista pelas seguintes tabelas conforme as op��es que define a tabela a ser escolhida
			case "2";
				$this->ord = "e.congregacao ASC";
				break;
			case "1";
				$this->ord = "m.rol";
				break;
			case "3";
				$this->ord = " MONTH(m.datanasc), DAYOFMONTH(m.datanasc) ASC";
				break;
			case "4";
				$this->ord = " MONTH(m.datanasc), DAYOFMONTH(m.datanasc) DESC";
				break;
			case "5";
				$this->ord = " m.nome DESC";
				break;
			default ;
				$this->ord = "m.nome ASC";
				break;
		}

		if ($_GET["congregacao"]>"0") {
			$this->congreg = "AND e.congregacao=".$_GET["congregacao"];
		}else {
			$this->congreg = "";
		}

		$this->query_fim = "{$this->congreg} ORDER BY {$this->ord}";
		$prox_dia = $_GET["proxima"]+date('d');
		$this->dia_consulta = date("d/m",mktime(12,0,0,$this->mes,$prox_dia,$this->ano));//recupera o dia para consulta
		$this->consulta = date("d/m/Y",mktime(12,0,0,$this->mes,$prox_dia,$this->ano));//recupera o dia para consulta
		$this->semana_consulta = date("m",mktime(12,0,0,$this->mes,($_GET["proxima"]*7)+date('d'),$this->ano));//recupera a semana para consulta
		$this->mes_consulta = date("m",mktime(12,0,0,$this->mes+$_GET["proxima"],$this->dia,$this->ano));//recupera a semana para consulta
	}

	function qt_dia() {
		//quantidade de aniversariantes do dia
		$this->sql_dia = mysql_query ($this->query." DATE_FORMAT(m.datanasc,'%d/%m')='{$this->dia}' ".$this->query_fim) or die (mysql_error());
		$this->qt_dia = mysql_num_rows($this->sql_dia);
		return $this->qt_dia;
	}

	function nome_dia() {
		$dadosIg = new igreja();
		$nomeIg = $dadosIg->Arrayigreja();
		$this->sql_d_dia = mysql_query ($this->query." DATE_FORMAT(m.datanasc,'%d/%m')='{$this->dia_consulta}' ".$this->query_fim) or die (mysql_error());
		while($this->dados = mysql_fetch_array($this->sql_d_dia))
		{
			echo '<tr>';
			if ($_GET["proxima"]<>"") {}
			$this->idade = date('Y')-$this->dados['idade'];
		//	$this->igreja = new DBRecord ("igreja",$this->dados["congregacao"],"rol");
			echo "<td> $this->idade </td><td>";
			echo "<a href='./?escolha=adm/dados_pessoais.php&bsc_rol={$this->dados["rol"]}'>{$this->dados["rol"]}</a>";
			echo "</td><td><a href='./?escolha=adm/dados_pessoais.php&bsc_rol={$this->dados["rol"]}'>{$this->dados["nome"]}</a>";
			echo '</td><td>'.$nomeIg[$this->dados["congregacao"]]['0'].'</td>';
			echo '<td class="text-center">'.$nomeIg[$this->dados["congregacao"]]['5']."</td>";
			echo '<td>'.cargo($this->dados["rol"])['0']."</td></tr>";
		}
	}

	function casamento() {
		$this->sql_d_dia = mysql_query ($this->query." DATE_FORMAT(c.data,'%d/%m')='{$this->dia_consulta}' ".$this->query_fim) or die (mysql_error());
		while($this->dados = mysql_fetch_array($this->sql_d_dia))
		{
			$inc++;
			if ($inc==1) { echo "<tr class='odd'>"; } else {echo "<tr class='dados'>"; $inc=0;}
			$this->idade = date('Y')-$this->dados['casamento'];
			$this->igreja = new DBRecord ("igreja",$this->dados["congregacao"],"rol");
			echo "<td> $this->idade </td><td><a href='./?escolha=adm/dados_famil.php&bsc_rol={$this->dados["rol"]}'>{$this->dados["rol"]}</a></td><td>{$this->dados["nome"]}</td><td>{$this->igreja->razao()}</td><td>".cargo($this->dados["rol"])['0']."</td></tr>";
		}
	}

	function batismo() {
		// echo "Data da consulta atual {$prox_dia}/{$this->mes}/{$this->ano}";
		$this->sql_d_dia = mysql_query ($this->query." DATE_FORMAT(e.batismo_em_aguas,'%d/%m')='{$this->dia_consulta}' ".$this->query_fim) or die (mysql_error());
		while($this->dados = mysql_fetch_array($this->sql_d_dia))
		{
			$inc++;
			if ($inc==1) { echo "<tr class='odd'>"; } else {echo "<tr class='dados'>"; $inc=0;}
			$this->idade = date('Y')-$this->dados['batismo'];
			$this->igreja = new DBRecord ("igreja",$this->dados["congregacao"],"rol");
			echo "<td> $this->idade </td><td><a href='./?escolha=adm/dados_famil.php&bsc_rol={$this->dados["rol"]}'>{$this->dados["rol"]}</a></td><td>{$this->dados["nome"]}</td><td>{$this->igreja->razao()}</td><td>".cargo($this->dados["rol"])['0']."</td></tr>";
		}
	}

	function semana() {
	$semana = date('W') + $_GET["proxima"];
	if ($semana<10 && $semana>0) {$semana="0".$semana;}
	if ($semana < "1"){
		echo "<script> alert('Voc� j� atingiu o Ano anterior!');</script>";
		echo "Voc� j� atingiu o Ano anterior!";
	} elseif ($semana > "53") {
		echo "<script> alert('Voc� j� atingiu o Ano seguinte!');</script>";
		echo "Voc� j� atingiu o Ano seguinte!";
	}
		$sql_semana = mysql_query ($this->query." DATE_FORMAT(m.datanasc,'%m')='{$this->semana_consulta}'".$this->query_fim) or die (mysql_error());
		while($this->dados=mysql_fetch_array($sql_semana))
		{
			$igreja = new DBRecord ("igreja",$this->dados["congregacao"],"rol");
			$var_aniv = date('W',mktime (0,0,0,$this->dados["mes"],$this->dados["dia"],date ('Y')));

			if ($semana == $var_aniv) {
			//Como o MySQL retornava o valor da semana do ano em que o membro nasceu e em muitos casos diferente da semana atual optei selecionar do banco o m�s inteiro e impor esta condi��o e assim aparentemente n�o houve erro na listagem.
			$inc++;
			$this->tot_aniv ++;
			if ($inc==1) { echo "<tr class='odd'>"; } else {echo "<tr class='dados'>"; $inc=0;}
			echo "<td>{$this->dados["dia"]}/{$this->dados["mes"]}</td><td><a href='./?escolha=adm/dados_pessoais.php&bsc_rol={$this->dados["rol"]}'>{$this->dados["rol"]}</a></td><td>{$this->dados["nome"]}</td><td>{$igreja->razao()}</td><td>".cargo ($this->dados["rol"])['0']."</td></tr>";
			} //else {echo $var_aniv; $ok = "Falha! Date W -> ".date('W')." <--Fim";}
		}
	}

	function tot_semana () {
		return $this->tot_aniv;
	}

	function mes() {
		$this->sql_d_dia = mysql_query ($this->query." DATE_FORMAT(m.datanasc,'%m')='{$this->mes_consulta}' ".$this->query_fim) or die (mysql_error());
		//$nome_dia = mysql_num_rows($sql_d_dia);
		while($this->dados = mysql_fetch_array($this->sql_d_dia))
		{
			$inc++;
			$inc_c++;
			if ($inc%2!=0) {
				echo '<tr>';
			}
			echo "<td>{$this->dados["dia"]}/{$this->dados["mes"]}</td>
				<td><a href='./?escolha=adm/dados_pessoais.php&bsc_rol={$this->dados["rol"]}'>{$this->dados["nome"]}</a></td>";
			if ($inc%2==0 && $inc>0) {
				echo '</tr>';
			}
			// if ($inc=="2") { echo "</tr>"; }
			// if ($inc_c>"3") { $inc_c=0; }
			// if ($inc>1) {$inc=0;}
		}
	}

	function data_consulta () {
		return $this->consulta;
	}
}

class disciplina {

	function __construct (){
		$this->query = "SELECT motivo, cad, DATE_FORMAT(data_ini,'%d/%m/%Y') AS dt_ini, DATE_FORMAT(data_fim,'%d/%m/%Y') AS data_fim FROM disciplina WHERE rol={$_SESSION["rol"]} ";

		/*
		switch ($_GET["ord"]){

			case "2";
				$this->ord = "e.congregacao";
				break;
			case "1";
				$this->ord = "m.rol";
				break;
			case "3";
				$this->ord = " MONTH(m.datanasc), DAYOFMONTH(m.datanasc) ";
				break;
			default ;
				$this->ord = "m.nome";
				break;
		}*/

	}

	function tabela_disc () {
	}
}

class situacao_espiritual {
	protected $situacao;
	protected $rol;
	function __construct ($situacao="",$rol=""){
		$this->valor = $situacao;
		$this->rol 	 = ($rol>'0') ? $rol:$_SESSION["rol"];
		$this->result = mysql_query("SELECT DATE_FORMAT(data_fim,'%d/%m/%Y') AS dt_fim FROM disciplina WHERE rol = '$rol' ORDER BY id DESC LIMIT 1");
		$this->data = mysql_fetch_array($this->result);
		$this->data_fim = $this->data ["dt_fim"];
		switch ($this->valor){
			case "1":
				$this->situacao = "Membro";
				break;
			case "2":
				$this->situacao = "Displinado";
				break;
			case "3":
				$this->situacao = "Falecido";
				break;
			case "4":
				$this->situacao = "Mudou de Igreja";
				break;
			case "5":
				$this->situacao = "Afastou-se";
				break;
			case "6":
				$this->situacao = "Transferido";
				break;
			default:
				$this->situacao = "Corrija a comunh&atilde;o com a Igreja. Use bot&atilde;o Eclesi&aacute;stico acima!";
				break;
		}
	}

	function situacao (){
		switch ($this->situacao)
		{
			case "0":
				return "<span style='color:#006633'><blink>Corrija a comunh&atilde;o com a Igreja. Use bot&atilde;o Eclesi&aacute;stico acima!</blink></span>";
				break;
			case "2":
				return 	"<span style='color:#FF0000'><blink>Displinado at�: </blink></span>".$this->data_fim;
				break;
			default:
				return "<span style='color:#FF0000'><blink>{$this->situacao}</blink></span>";
				break;
		}
	}

	function situacao_confirma (){
		return $this->situacao;
	}
}

class pendencias {

	function __construct () {
		$this->var_string = "SELECT rol,nome,obs FROM membro WHERE OBS<>''";
		$this->sql_pendencia = mysql_query($this->var_string);
		$this->qt_pend = mysql_num_rows($this->sql_pendencia);
	}

	function quant_pendecias () {
		return $this->qt_pend;
	}

	function lista_pendecia() {
		$this->var_string .= "";
		while($this->dados = mysql_fetch_array($this->sql_d_dia))
		{
			$inc++;
			$inc_c++;
			if ($inc_c=="1") { echo "<tr class='odd'>"; } elseif ($inc_c=="0")  {echo "<tr class='dados'>";}
			echo "<td>{$this->dados["dia"]}/{$this->dados["mes"]}</td>
				<td><a href='./?escolha=adm/dados_pessoais.php&bsc_rol={$this->dados["rol"]}'>{$this->dados["nome"]}</a></td>";
			if ($inc=="2") { echo "</tr>"; }
			if ($inc_c>"3") { $inc_c=0; }
			if ($inc>1) {$inc=0;}
		}
	}
}
?>
