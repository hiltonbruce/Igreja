<?PHP
if ($_SESSION['nivel']>4){

$igreja = new DBRecord ("igreja","1","rol");

$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
$tab_edit="adm/dados_cartas.php&tabela=carta&campo=";//Link de chamada da mesma página para abrir o form de edição do item
$query = "SELECT *,DATE_FORMAT(data,'%d/%m/%Y')AS data FROM carta WHERE rol='".$_SESSION["rol"]."' ORDER BY id DESC";
$nmpp="5"; //Número de mensagens por párginas
$paginacao = Array();
$paginacao['link'] = "?"; //Paginação na mesma página
	
//Faz os calculos na paginação
$sql2 = mysql_query ("$query") or die (mysql_error());
$total = mysql_num_rows($sql2) ; //Retorna o total de linha na tabela
$paginas = ceil ($total/$nmpp); //Retorna o total de páginas
$pagina = $HTTP_GET_VARS["pagina1"];
	
if (!isset($pagina)) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
$inicio=$pagina * $nmpp; //Retorna qual será a primeira linha a ser mostrada no MySQL
$sql3 = mysql_query ("$query"." LIMIT $inicio,$nmpp") or die (mysql_error()); 
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
$arr_dad = mysql_fetch_array ($sql3);

list($diav,$mesv,$anov) = explode("/", $arr_dad["data"]);
//echo '<br />  - Data atual - ultimo Vencimento: '.$rec_alterar->data().' ---- '. ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24));
$diasemissao = ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24)); //quantidade de dias após a emissão do recibo
		
?>
<div id="lst_cad">
	<?PHP
	if (!empty($_SESSION["rol"]))
	{
	?>
	<table width="100%">
      <tr>
        <td>Tipo:
          <?PHP				
			$nome = new editar_form("tipo",$arr_dad["tipo"],$tab,$tab_edit);
			echo "Carta de ".carta($arr_dad["tipo"]);
			//$nome->getMostrar();$nome->getEditar();
			?></td>
        <td>Data:
          <?PHP 
          if ($diasemissao==1) {
          	echo ' (Criada hoje)';
          }elseif ($diasemissao<3){
          echo ' (Criada ontem!)';
          }else {
          	echo ' (Criada à: '.$diasemissao. ' dias)';
          }
          
       $nome = new editar_form("data",$arr_dad["data"],$tab,$tab_edit);
		$nome->getMostrar();
		
		if ($diasemissao<='3') {
			$nome->getEditar();
		}elseif ($_GET['campo']=='data') {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			Prazo <strong>EXPIRADO</strong>! Você tem até <strong>3 dias</strong> para alterar esta data!
				    </div>
			<?php
		}
		
			
		?></td>
      </tr>
      <tr>
        <td colspan="2">Igreja/Institui&ccedil;&atilde;o: 
          <?PHP
		$nome = new editar_form("igreja",$arr_dad["igreja"],$tab,$tab_edit);
		$nome->getMostrar();
		
		
		if ($diasemissao<='20') {
			$nome->getEditar();
		}elseif ($_GET['campo']=='igreja')  {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			Prazo <strong>EXPIRADO</strong>! Você tem até <strong>20 dias</strong> para alterar a Igreja de destino!
			</div>
			<?php
		}
		
		
		?></td>
      </tr>
      <tr>
        <td>Destino:
        <?PHP
        
        $det_inteiro = (int)$arr_dad["destino"];
        	
        if ($det_inteiro!=0) 
        {
        	$rec = new DBRecord ("cidade",$arr_dad["destino"],"id");// Aqui será selecionado a informação do campo autor com id=2
			$cidade=$rec->nome()." - ".$rec->coduf();
			
		}else {
		 	$cidade = $arr_dad["destino"];
		}
		
		if (isset($cidade)){
				//print $cidade;
				$cid = new editar_form("destino",$cidade,$tab,$tab_edit);
				$cid->getMostrar();
				if ($diasemissao<='20') {
					$cid->getEditar();
				}elseif ($_GET['campo']=='destino')  {
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					Prazo <strong>EXPIRADO</strong>! Você tem até <strong>20 dias</strong> para alterar o destino!
					</div>
					<?php
				}
		
			}else{
				echo "<h3>N&acirc;o h&aacute; registro de nenhuma carta para este membro</h3>";
			}
		
		?></td>
        <td>&nbsp;</td>
      </tr>
      
      
      <tr>
        <td colspan="3">Observa&ccedil;&otilde;es
		<?PHP
		$nome = new editar_form("obs",$arr_dad["obs"],$tab,$tab_edit);
		$nome->getMostrar();
				if ($diasemissao<='20') {
					$nome->getEditar();
				}elseif ($_GET['campo']=='obs')  {
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					Prazo <strong>EXPIRADO</strong>! Você tem até <strong>20 dias</strong> para alterar a observação!
					</div>
					<?php
				}
		
		?></td>
      </tr>
    </table>
	<?PHP
	}}
	if ($ecles->situacao_espiritual()=='1') {
	?>&Uacute;ltima ocorr&ecirc;ncia para este Membro
	<form id="form1" name="form1" method="get" action="">
	  <label>
	    <input type="submit" class='btn btn-primary' name="Submit" value="Nova Carta" />
      </label>
      <input name="escolha" type="hidden" id="escolha" value="adm/cria_carta.php" />
      <input name="bsc_rol" type="hidden" id="bsc_rol" value="<?php echo $_GET['bsc_rol'];?>" />
      <input name="uf" type="hidden" id="uf" value="PB" />
	</form>
	<?php 
	}else {
		echo '<div class="bs-callout bs-callout-warning">';
		echo '<h4>Esta pessoa não está com situação regular em nosso rol de membro! </h4>';
		echo 'Para emissão de outra carta é necessário que esteja em comunhão com a igreja! ';
		echo 'Se deseja emitir nova transferência, caso a anterior tenha perdido a validade, ';
		echo 'ou qualquer outro tipo de carta, reintegre-o a comunhão da igreja e emita nova carta! ';
		echo 'Tendo, ainda, 3 dias para alterar a data e 20 para os demais dados! <br>';
		echo '<strong>Você ainda poderá re-imprimir a última!</strong>';
		echo '</div>';
	}
	?>
</div>
<form id="form2" name="form2" method="post" action="relatorio/carta_print.php">
  
  <input type="hidden" name="id_carta" value="<?PHP echo $arr_dad["id"];?>" />
      <input name="bsc_rol" type="hidden" id="bsc_rol" value="<?php echo $_GET['bsc_rol'];?>" />
  <div class="row">
  <div class="col-xs-5"> 
  <label>Secretário que ir&aacute; assinar a carta:</label>
  <select name="secretario" id="secretario" class='form-control'>
    <option value="<?PHP echo fun_igreja ($igreja->secretario1());?>"><?PHP echo fun_igreja ($igreja->secretario1());?></option>
    <option value="<?PHP echo fun_igreja ($igreja->secretario2());?>"><?PHP echo fun_igreja ($igreja->secretario2());?></option>
  </select></div>
  <!-- Envia o id para a impressão da carta escolhida -->
  <input type="image" src="img/Preview-48x48.png" name="Submit2" value="Imprimir esta Carta" align="absmiddle" alt="Visualizar Impress&atilde;o" title="Visualizar Impress&atilde;o"/>
  
  </div>
</form>