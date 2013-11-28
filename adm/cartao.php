<div>
  <h2><a href="relatorio/cartao_impr.php">Visualizar impress&atilde;o ?<img src="img/Bank-Check-48x48.png" width="41" height="45" align="absmiddle"/></a>*<br />
  </h2>
    </div>
 <?PHP
if ($_SESSION['nivel']>4){
$tab="adm/atualizar_dados.php";//link q informa o script quem receberá os dados do form para atualizar
$tab_edit="adm/dados_pessoais.php&tabela=membro&campo=";//Link de chamada da mesma página para abrir o form de edição do item

$dad_cad = mysql_query ("SELECT *,m.obs AS mobs,DATE_FORMAT(m.datanasc,'%d/%m/%Y')AS br_datanasc, DATE_FORMAT(e.batismo_em_aguas,'%d/%m/%Y')AS dt_batismo FROM membro AS m, eclesiastico AS e, profissional AS p, est_civil AS ec WHERE m.rol='".$_SESSION["rol"]."' AND m.rol=e.rol AND m.rol=p.rol AND m.rol=ec.rol ");

if (mysql_num_rows($dad_cad)<1)//Lista independente de outras tabelas
{
	$dad_cad = mysql_query ("SELECT * FROM membro WHERE rol='".$_SESSION["rol"]."'");
}

if (mysql_num_rows($dad_cad)<1)//Informa que o rol não possui niguem registrado
{
	echo "<h3>N&atilde;o h&aacute; dados para este Rol.</h3>";
	exit;
}

$arr_dad = mysql_fetch_array ($dad_cad);

?>
<div id="lst_cad">
  <?PHP
	if (!empty($_SESSION["rol"]))
	{
	 if (file_exists("img_membros/".$_SESSION["rol"].".jpg"))
		{
			$img=$_SESSION["rol"].".jpg";
		}
		else
		{
			$img="ver_foto.jpg";
		}
	?>
<table width="100%">
      <tr>
        <td colspan="2">Nome:
		<?PHP
			switch ($arr_dad["situacao_espiritual"])
			{
				case "1":
					$estilo="";
					break;
				case "2":
					$estilo="<span style='color:#FF0000'>Ver comunh&atilde;o</span>";
					break;
				default:
					$estilo="<span style='color:#006633''>Corrija a comunh&atilde;o com a Igreja. Use bot&atilde;o Eclesi&aacute;stico acima!</span>";
					break;
								
			}
			$nome = new editar_form("nome",$arr_dad["nome"],$tab,$tab_edit);
			$_SESSION["membro"]=$arr_dad["nome"];
			echo $estilo;
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<td rowspan="4" align="center"><img src="img_membros/<?PHP echo "$img";?>" width="75" height="98" border="1" /></td>
      </tr>
      <tr>
        <td colspan="2">Cargo:<strong>
        <?PHP
		
		$rec = new DBRecord ("eclesiastico","{$_SESSION["rol"]}","rol");
		//echo $rec->diacono()." - ".$rec->presbiterio()." - ".$rec->evangelista()." - ".$rec->pastor();
		
		if ($rec->pastor()>"0000-00-00") {
			echo "Pastor";
		}elseif ($rec->evangelista()>"0000-00-00") {
			echo "Evangelista";
		}elseif ($rec->presbiterio()>"0000-00-00") {
			echo "Presb&iacute;tero";
		}elseif ($rec->diaconato()>"0000-00-00") {
			echo "Di&aacute;cono";
		}else {
			echo "Membro";
		}
		?></strong></td>
      </tr>
      <tr>
        <td colspan="2" >Pai:
          <?PHP
		$_GET["rol_pai"]=$arr_dad["rol_pai"];
		$nome = new editar_form("pai",$arr_dad["pai"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td colspan="2" >M&atilde;e:
            <?PHP
		$_GET["rol_mae"]=$arr_dad["rol_mae"];
		$nome = new editar_form("mae",$arr_dad["mae"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?>	</td>
	    <?php
		if ($_GET["campo"]!=="pai")
		{?>
        <?php } ?>
      </tr>
      <tr>
        <td>Data de Nascimento:
        <?PHP
			$nome = new editar_form("datanasc",$arr_dad["br_datanasc"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Nacionalidade:
        <?PHP
			$nome = new editar_form("nacionalidade",$arr_dad["nacionalidade"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Naturalidade:
        <?PHP
			$nome = new editar_form("naturalidade",$arr_dad["naturalidade"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td
      ></tr>
      <tr>
        <td>UF:
        <?PHP
			$nome = new editar_form("uf_nasc",$arr_dad["uf_nasc"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>RG:
        <?PHP
			$nome = new editar_form("rge",$arr_dad["rg"],"profissional","adm/cartao.php&tabela=profissional&campo=");
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Org&atilde;o Expedidor:
        <?PHP
			$nome = new editar_form("orgao_expedidor",$arr_dad["orgao_expedidor"],"profissional","adm/cartao.php&tabela=profissional&campo=");
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<?php
		if ($_GET["campo"]!=="mae")
		{?>
        <?php } ?>
      </tr>
	  <tr>
        <td>CPF:
        <?PHP
			$nome = new editar_form("cpf",$arr_dad["cpf"],"profissional","adm/cartao.php&tabela=profissional&campo=");
			$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>Data do Batismo:
        <?PHP
			$nome = new editar_form("batismo_em_aguas",$arr_dad["dt_batismo"],"eclesiatico","adm/cartao.php&tabela=eclesiatico&campo=");
			$nome->getMostrar();$nome->getEditar();
		?></td>
        <td colspan="2">Congrega&ccedil;&atilde;o:
        <?PHP
			$nome = new editar_form("congregacao",$arr_dad["congregacao"],"eclesiatico","adm/cartao.php&tabela=eclesiatico&campo=");
			$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Estado Civil:
        <?PHP
			$nome = new editar_form("estado_civil",$arr_dad["estado_civil"],"est_civil","adm/cartao.php&tabela=est_civil&campo=");
			$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  </table>
	<?PHP
	}}
	?> * O cargo de auxiliar &eacute; uma situa&ccedil;&atilde;o peculiar, e pode n&atilde;o ser permanente, para remover a cargo basta zerar a data de auxiliar! N&atilde;o &eacute; realizado o hist&oacute;rio. </div>
