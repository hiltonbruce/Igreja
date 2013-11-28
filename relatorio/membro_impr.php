<?PHP
	session_start();
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	//conectar ();
  	$carta = new DBRecord ("carta",$_POST["id_carta"],"id");
	$cidade = new DBRecord ("cidade",$carta->destino(),"id");
	$membro = new DBRecord ("membro",$_SESSION["rol"],"rol");
	$est_civil = new DBRecord ("est_civil",$_SESSION["rol"],"rol");
	$ecles = new DBRecord ("eclesiastico",$_SESSION["rol"],"rol");
	$igreja = new DBRecord ("igreja","1","rol");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="print.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">
<title>Ficha completa do membro</title>
</head>

<body>
<div id="container">
<div id="lst_cad">
  <table>
    <tr>
      <td width="250">Nome:
          <p> <?PHP echo $membro->nome();?></p></td>
      <td>Rol:
          <p><?PHP echo $membro->rol();?></p></td>
		<td>Sexo:<p><?PHP echo $membro->sexo();?></p></td>
		  <td>Data Nascimento:
		    <p><?PHP echo conv_valor_br ($membro->datanasc());?></p>
		</td>
    </tr>
    <tr>
      <td>Pai:
          <p> <?PHP echo $membro->pai();?></p></td>
      <td><p>&nbsp;</p></td>
		<td>Rol do Pai:
          <p><?PHP echo $membro->rol_pai();?></p></td>
		  <td> </td>
    </tr>
    <tr>
      <td>M&atilde;e:
          <p>
            <?PHP
		echo $membro->mae();	
		?>
          </p></td>
      <td><p>&nbsp;</p></td>
		<td>Rol da M&atilde;e :
          <p><?PHP echo $arr_dad["rol_mae"];?></p></td>
		  <td> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nacionalidade:
        <?PHP
			$nome = new editar_form("nacionalidade",$arr_dad["nacionalidade"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">Naturalidade:
        <?PHP		
		//inicio
		$cidade = new DBRecord ("cidade",$arr_dad["naturalidade"],"id");
		
		echo $arr_dad["naturalidade"];
		$nome = new editar_form("naturalidade",$cidade->nome(),$tab,$tab_edit);
		$nome->getMostrar();
		
		if ($_GET["campo"]=="naturalidade"){
		?>
          <form id="form3" method="post" action="">
            <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
            <?PHP
			$lst_cid = new sele_cidade("cidade",$arr_dad["uf_nasc"],"coduf","nome","naturalidade");	
			$vlr_linha=$lst_cid->ListDados ();
		?>
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "membro";?>" />
            <input name="Submit" type="submit" id="Submit" value="Alterar..." />
          </form>
        <?PHP
		}
		
		//fim
		?>      </td>
      <td colspan="2">UF:
        <?PHP
			$nome = new editar_form("uf_nasc",$arr_dad["uf_nasc"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
    </tr>
    <tr>
      <td colspan="2">Endere&ccedil;o:
        <?PHP
		$nome = new editar_form("endereco",$arr_dad["endereco"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      <td colspan="2">N&uacute;mero:
        <?PHP
		$nome = new editar_form("numero",$arr_dad["numero"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
    </tr>
    <tr>
      <td>Complementos:
        <?PHP
		$nome = new editar_form("complemento",$arr_dad["complemento"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      <td>Cidade:
        <?PHP		
		//inicio
		$cidade = new DBRecord ("cidade",$arr_dad["cidade"],"id");
		
		echo $arr_dad["cidade"];
		$nome = new editar_form("cidade",$cidade->nome(),$tab,$tab_edit);
		$nome->getMostrar();
		
		if ($_GET["campo"]=="cidade"){
		?>
          <form id="form3" method="post" action="">
            <input name="escolha2" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
            <?PHP
			$lst_cid = new sele_cidade("cidade",$arr_dad["uf_resid"],"coduf","nome","cidade");	
			$vlr_linha=$lst_cid->ListDados ();
		?>
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "membro";?>" />
            <input name="Submit" type="submit" id="Submit" value="Alterar..." />
          </form>
        <?PHP
		}
		
		//fim
		?></td>
      <td colspan="2">Bairro:
        <?PHP		
		//inicio
		$bairro = new DBRecord ("bairro",$arr_dad["bairro"],"id");
		
		echo $arr_dad["bairro"]." - ".$bairro->bairro();
		$nome = new editar_form("bairro",$bairro->bairro(),$tab,$tab_edit);
		$nome->getMostrar();
		
		if ($_GET["campo"]=="bairro"){
		?>
          <form id="form3" method="post" action="">
            <input name="escolha2" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
            <?PHP
			$lst_bairro = new sele_cidade("bairro",$arr_dad["cidade"],"idcidade","bairro","bairro");	
			$vlr_bairro=$lst_bairro->ListDados ();
		?>
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "membro";?>" />
            <input name="Submit" type="submit" id="Submit" value="Alterar..." />
          </form>
        <?PHP
		}
		
		//fim
		?></td>
    </tr>
    <tr>
      <td>UF Resid&ecirc;ncia:
        <?PHP
			$nome = new editar_form("uf_resid",$arr_dad["uf_resid"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
      <td>CEP:
        <?PHP
		$nome = new editar_form("cep",$arr_dad["cep"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?>      </td>
      <td colspan="2">Telefone:
        <?PHP
		$nome = new editar_form("fone_resid",$arr_dad["fone_resid"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
    </tr>
    <tr>
      <td>Email:
        <?PHP
		$nome = new editar_form("email",$arr_dad["email"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      <td>Gradua&ccedil;&atilde;o:
        <?PHP
		$nome = new editar_form("graduacao",$arr_dad["graduacao"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?>      </td>
      <td colspan="2">Escolaridade:
        <?PHP
		$nome = new editar_form("escolaridade",$arr_dad["escolaridade"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
    </tr>
    <tr>
      <td colspan="4">Observa&ccedil;&otilde;es:
        <p>
            <?PHP
		$nome = new editar_form("obs",$arr_dad["mobs"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?>
        </p></td>
    </tr>
  </table>
</div><!-- fim div lst_cad -->
</div><!-- fim div container -->

</body>
</html>
