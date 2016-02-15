<?PHP
	session_start();
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	//conectar ();
  $rolMembro = (!empty($_GET['rol'])) ? intval($_GET['rol']) : '';
	$membro = new DBRecord ("membro",intval($rolMembro),"rol");
  if (is_numeric($membro->naturalidade())) {
      $cidadeNatal = new DBRecord ("cidade",$membro->naturalidade(),"id");
      $cidNatal =  $cidadeNatal->nome().' - '.$cidadeNatal->coduf();
  } else {
      $cidNatal = $membro->naturalidade();
  }
	$est_civil = new DBRecord ("est_civil",$rolMembro,"rol");
	$ecles = new DBRecord ("eclesiastico",$rolMembro,"rol");
	$profis = new DBRecord ("profissional",$rolMembro,"rol");
	$igreja = new DBRecord ("igreja","1","rol");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ficha de Membro</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">
<style type="text/css">
<!--

body {
  font-family:Arial, Helvetica, sans-serif;
}

#header { height: 125px; background-image: url(header2.jpg); background-repeat: no-repeat; background-position: top bottom; margin: 0; padding: 0 20px 0 100px; text-align:center; font-family:"Times New Roman", Times, serif;}

#header h5 {
	font-size: 100%;
	text-align: left;
	color: #a12621;
	font-size: 1em;
	font-weight: normal;
	padding: -200px 20px 0;
}

fieldset {
	width: 96%;
	margin: 1em 0;
	padding: 4px;
	border: 1px solid #0033FF;
}

legend {
	font-weight:bold;
	border: 1px solid #0033FF;
	padding: 1px 4px;
	background-color: #ccc;
}

#endereco {
	position:absolute;
	left:131px;
	top:85px;
	width:313px;
	height:54px;
	z-index:5;
}
	#footer {
	color: #636466;
	font-size:65%;
	height: 50px;
	background-repeat: no-repeat;
	background-position: top;
	text-align: left;
	clear: both;
	margin: 0;
	padding-top: 25px;
	padding: 10px 0 0 0;
	background-image: url(horbar.gif);
		width: 800px;
}

#footer a {
	color: #636466;
	text-decoration: underline;
}

a:link:after, a:visited:after {
	content:"("attr(href)")";
	font-size: 80%;
	color:#555555;
}

h1{
	color: #0000FF;
	font-size: 300%;
	font-family: Forte;
	font-weight: normal;
	text-align: left;
	height: 60px;
	padding-top: 20px;
	padding-left: 20px;
	font-family:"Times New Roman", Times, serif;

}


.clear {
  clear: both;
}

table {
  border-collapse: collapse;
  width: 95%;
}

#lst_cad p{
	padding:2px 1px; margin: 0;
	font: 12px Arial; height:15px;
	color:#000066;
}

caption {
  font-size: 1.2em;
  font-weight: bold;
  margin: 1em 0;
}

#foto {
	float:inherit;
}

col {
  border-right: 1px solid #ccc;
}

col#albumCol {
  border: none;
}

thead {
  background: #ccc url(images/bar.gif) repeat-x left center;
  border-top: 1px solid #a5a5a5;
  border-bottom: 1px solid #a5a5a5;
}

th {
  font-weight: normal;
  text-align: left;
}

#playlistPosHead {
  text-indent: -1000em;
}

th, td {
  padding: 0.1em 1em;
  font-size: 70%;
}

.odd {
  background-color:#E9E9E9;
}

.dados {
  background:#CCCCCC;
}

tr:hover {
  background-color:#3d80df;
  color: #fff;
}

thead tr:hover {
  background-color: transparent;
  color: inherit;
}


-->
</style>
</head>

<body>
<div id="header">
	</div>
<div id="lst_cad">
<h2><u>Ficha de Cadastro</u> &bull;
  </label>
      <label>
        <input type="checkbox" name="Op&ccedil;&otilde;es de Cadstro" value="radio" />
        Re-Cadastro</label>
      <label>
      <input type="checkbox" name="Op&ccedil;&otilde;es de Cadstro" value="radio" />
      Atualiza&ccedil;&atilde;o
	</label></h2>
<fieldset>
<legend>Dados Pessoais</legend>
<table cellspacing="0" id="playlistTable">
  <colgroup>
    <col id="PlaylistCol" />
    <col id="trackCol" />
    <col id="artistCol" />
    <col id="albumCol" />
  </colgroup>
  <tbody>
    <tr class="odd">
      <td rowspan='4'>
          <div id="foto"><?PHP print mostra_foto();?></div>
       </td>
      <td colspan="3" scope="col"><p>Nome: </p><h4><?PHP echo $membro->nome();?></h4></td>
      <td scope="col"><p>Rol:</p><h4><?PHP printf (" %'03u",$rolMembro);?></h4></td>
    </tr>
    <tr>
      <td colspan="2">Pai:
        <p> <?PHP echo $membro->pai();?></p></td>
      <td><p>Data Nascimento: </p>
        <p> <?PHP echo conv_valor_br ($membro->datanasc());?></p></td>
      <td>Sexo:
        <p> <?PHP echo $membro->sexo();?></p></td>
    </tr>
    <tr>
      <td colspan="2"><p>M&atilde;e: </p>
        <p> <?PHP echo $membro->mae();?></p></td>
      <td><p>Nacionalidade: </p>
        <p> <?PHP echo $membro->nacionalidade();?></p></td>
      <td><p>Natural de : </p>
        <p>	<?PHP echo $cidNatal; ?></p>
      </td>
    </tr>
    <tr class="odd">
      <td colspan="2"><p>Endere&ccedil;o: </p>
        <p> <?PHP echo $membro->endereco().", N&ordm;: ".$membro->numero();?></p></td>
      <td><p>Complementos: </p>
        <p> <?PHP echo $membro->complemento();?></p></td>
      <td>Celular:
          <p> <?PHP echo $membro->celular();?></p></td>
    </tr>
    <tr>
    <td colspan="2">Cidade :
      <p>
        <?PHP
    			$cidade = new DBRecord ("cidade",$membro->cidade(),"id");
  			echo $membro->cidade()." - ".$cidade->nome()." - ".$membro->uf_resid();
  		?>
      </p></td>
    <td>Bairro :
      <p>
        <?PHP
  		$bairro = new DBRecord ("bairro",$membro->bairro(),"id");
  		echo $membro->bairro()." - ".$bairro->bairro();
  		?>
      </p></td>
    <td>CEP:
      <p> <?PHP echo $membro->cep();?></p></td>
    <td>Telefone:
      <p> <?PHP echo $membro->fone_resid();?></p></td>
    </tr>
      <tr class="odd">
      <td colspan="2">Email:
        <p> <?PHP echo $membro->email();?></p></td>
      <td>Gradua&ccedil;&atilde;o:
        <p> <?PHP echo $membro->graduacao();?></p></td>
      <td>Escolaridade:
        <p> <?PHP echo $membro->escolaridade();?></p></td>
      <td>&nbsp;</td>
      </tr>
  </tbody>
</table>
</fieldset>
<fieldset>
<legend>Dados Eclesi&aacute;sticos</legend>
<table cellspacing="0" id="playlistTable">
  <colgroup>
    <col id="PlaylistCol" />
    <col id="trackCol" />
    <col id="artistCol" />
    <col id="albumCol" />
</colgroup>
<tr>
<td>Onde congrega:
  <p><?PHP
		$igreja = new DBRecord ("igreja",$ecles->congregacao(),"rol");
		echo $ecles->congregacao()." - ".$igreja->razao();?></p>
</td>
<td>Data do Batismo em &Aacute;guas:
  <p> <?PHP echo conv_valor_br ($ecles->batismo_em_aguas());?></p></td>
<td>Ano Batismo Espirito Santo:
  <p><?PHP
		$igreja = new DBRecord ("igreja",$ecles->congregacao(),"rol");
		echo $ecles->batismo_espirito_santo();?></p>
</td>
<td>Local de Batismo:
  <p><?PHP
		$batismo = new DBRecord ("cidade",$ecles->local_batismo(),"id");
		echo $ecles->local_batismo()." - ".$batismo->nome()." - ".$ecles->uf();?></p>
</td>
</tr>
<tr class="odd">
<td>Denomina&ccedil;&atilde;o de onde veio:
  <p><?PHP echo $ecles->veio_qual_denominacao();?></p>
</td>
<td>Mudou da denomina&ccedil;&atilde;o em:
  <p><?PHP echo conv_valor_br ($ecles->dt_mudanca_denominacao());?></p>
<td>Auxiliar de trabalho em:
  <p><?PHP echo conv_valor_br ($ecles->auxiliar());?></p>
</td>
<td>Di&aacute;cono em:
  <p><?PHP echo conv_valor_br ($ecles->diaconato());?></p>
</td>
</tr>
<tr>
  <td>Presbit&eacute;ro em:
    <p><?PHP echo conv_valor_br ($ecles->presbitero());?></p>
    </td>
  <td>Evangelista em:
    <p><?PHP echo conv_valor_br ($ecles->evangelista());?></p>
  </td>
  <td>Pastor em:
    <p><?PHP echo conv_valor_br ($ecles->pastor());?></p>
  </td>
  <td>Veio de outra Assembleia de Deus:
    <p><?PHP echo $ecles->veio_outra_assemb_deus();?></p>
</td>
</tr>
<tr class="odd">
<td>Data da mudan&ccedil;a da outra Assembleia:
  <p><?PHP echo conv_valor_br ($ecles->dt_muda_assembleia());?></p>
</td>
<td>Cidade e UF de onde veio::
  <p><?PHP echo $ecles->lugar();?></p>
</td>
<td>Data:
  <p><?PHP echo conv_valor_br ($ecles->data());?></p>
  </td>
<td>Data da aclama&ccedil;&atilde;o:
  <p><?PHP echo conv_valor_br ($ecles->dat_aclam());?></p>
  </td>
</tr>
<tr>
  <td>Cart&atilde;o Impresso em:
    <p><?PHP echo sim_nao ($ecles->c_impresso());?></p>
  </td>
  <td>Cart&atilde;o Impresso em:<p>
      <?PHP echo sim_nao ($ecles->c_entregue()); ?></p>
  </td>
  <td>&Eacute; membro por aclama&ccedil;&atilde;o:<p>
      <?PHP echo sim_nao ($ecles->eh_membro_aclamacao());?></p>
    </td>
  <td>Situa&ccedil;&atilde;o espiritual:
    <p><?PHP echo sit_espiritual ($ecles->situacao_espiritual());?></p>
</td>
</tr>
</tbody></table>
</fieldset>
<fieldset>
<legend>Dados Profissionais e Faml&iacute;ares</legend>
<table cellspacing="0" id="playlistTable">

<colgroup>
<col id="PlaylistCol" />
<col id="trackCol" />
<col id="artistCol" />
<col id="albumCol" />
</colgroup>
<tr>
<td>Profiss&atilde;o:
  <p> <?PHP echo $profis->profissao();?></p></td>
<td>CPF:
  <p> <?PHP echo $profis->cpf();?></p></td>
<td>Identidade:
  <p> <?PHP echo $profis->rg()." - ".$profis->orgao_expedidor();?></p></td>
<td>Empresa onde Trabalha:
  <p> <?PHP echo $profis->onde_trabalha();?></p></td>
</tr>

<tr class="odd">
<td>Conjugue:
  <p> <?PHP echo $est_civil->estado_civil();?></p></td>
<td>Rol do Conjugue:
  <p> <?PHP echo $est_civil->rol_conjugue();?></p></td>
<td>Certid&atilde;o de Casamento N&ordm;:
  <p> <?PHP echo $est_civil->certidao_casamento_n();?></p></td>
<td>Livro:
  <p> <?PHP echo $est_civil->livro();?></p></td>
</tr>

<tr>
<td><p>Folhas: </p>
  <p> <?PHP echo $est_civil->folhas();?></p></td>
<td>Data:
  <p> <?PHP echo conv_valor_br ($est_civil->data());?></p></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr class="dados">
<td colspan="4">Oserva&ccedil;&otilde;es:</td>
</tr>

<tr class="odd">
  <td colspan="4"><?PHP echo $membro->obs().'<br/><br/>';?>
  </td>
</tr>

</tbody>
</table>
</fieldset>
DATA:___/___/______&nbsp;&nbsp;Visto Dirigente:________________________&nbsp;&nbsp;Visto Secret.:___________________
</div><!-- fim div lst_cad -->
<br />
<div id="footer">
	<?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} - {$igreja->cidade()} - {$igreja->uf()}";?><br />

	  Copyright &copy; <a href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information"></a>
      Email: <a rel="nofollow" target="_blank" href="mailton: <?PHP echo "{$igreja->email()}";?>"><?PHP echo "{$igreja->email()}";?></a>
	   <?PHP echo "CNPJ: {$igreja->cnpj()}";?><br />
   		<?PHP echo "CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?><br />
     <p> Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
    </div>

</body>
</html>
