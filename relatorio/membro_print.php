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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Carta de <?PHP echo carta($carta->tipo());?></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="print.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">
</head>
<body>
<div id="container">
  <div id="header">
    <h1>Igreja Assembleia de Deus</h1>
	<h5>Av. Eng. de Carvalho, 410 - Bayeux - PB<br />
     CEP 58.307-150 - Fone: (0**83) 3232-1420</h5>
  </div>
<div id="mainnav">
    <div id="foto">
  	<?PHP print mostra_foto();?></div>
	<div id="Tipo">
	  <h3>
	Ficha de Membro </h3>
  </div>
  </div>
	<div id="content">
    <div id="lst_cad">
      <table>
        <tr>
          <td colspan="2">Nome:<p>
		  <?PHP echo $membro->nome();?></p>
		  </td>
          <td>Rol:<p><?PHP echo $membro->rol();?></p></td>
        </tr>
        <tr>
          <td>Pai:<p>
            <?PHP echo $membro->pai();?></td>
           <td>Rol do Pai:
          <p><?PHP echo $membro->rol_pai();?></p></td>
        </tr>
        <tr>
          <td>M&atilde;e:<p>
         <?PHP
		echo $membro->mae();	
		?></p></td>
          <?php
		if ($_GET["campo"]!=="mae")
		{?>
          <td>Rol da M&atilde;e :
            <p><?PHP echo $arr_dad["rol_mae"];?></p></td>
          <?php } ?>
        </tr>
        <tr>
          <td>Sexo:
            <?PHP
			$nome = new editar_form("sexo",$arr_dad["sexo"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		 ?></td>
          <td>Data Nascimento:
            <?PHP
			$nome = new editar_form("datanasc",$arr_dad["br_datanasc"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
          <td colspan="2">Nacionalidade:
            <?PHP
			$nome = new editar_form("nacionalidade",$arr_dad["nacionalidade"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
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
		?>
          </td>
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
		?>
          </td>
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
		?>
          </td>
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
      <p>&nbsp;</p>
    </div>
    <div id="footer">
	  Templo SEDE: Rua Eng&ordm; de Carvalho, 410 - Centro - Bayeux - PB<br />
	  Cep.: 58.307-150 - Fone: (0**83) 3232-1420
      <p>Copyright &copy; <a href="http://www.abdy.com.br/" title="Copyright information">Igreja Assembleia de Deus</a> - Bayeux - PB Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
    </div>
  </div>
</div>
</body>
</html>
