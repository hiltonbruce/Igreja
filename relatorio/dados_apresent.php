<?PHP
controle ("consulta");

$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
$tab_edit="relatorio/dados_apresent.php&menu=top_formulario&tabela=cart_apresentacao&rol={$_GET["rol"]}&campo=";//Link de chamada da mesma página para abrir o form de edição do item

$apresenta = new DBRecord ("cart_apresentacao",$_GET["rol"],"rol");

$igreja = new DBRecord ("igreja",$apresenta->id_cong(),"rol");
$igreja_sede = new DBRecord ("igreja","1","rol");

$cidade = new DBRecord ("cidade",$apresenta->cidade(),"id");
$id = $apresenta -> rol();

//echo "<h1>{$apresenta -> nome()}</h1>";

//$dad_cad = mysql_query ("SELECT *,DATE_FORMAT(data,'%d/%m/%Y') AS data  FROM est_civil WHERE rol='".$_SESSION["rol"]."'");
//$arr_dad = mysql_fetch_array ($dad_cad);

$ind = 1; //Define o indice dos campos do formulário

?>
<fieldset>
<div id="lst_cad">
	<?PHP
	if (!empty($id)) {
	?>
	<table width="550">
      <tr>
        <td colspan="2">Nome da Crian&ccedil;a :
        <?PHP
		$nome = new editar_form("nome",$apresenta->nome(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Congrega&ccedil;&atilde;o:
        <?PHP
		$nome = new editar_form("id_cong",$igreja->razao(),$tab,$tab_edit);
		$nome->getMostrar();


		if ($_GET["campo"]=="id_cong"){
			?>
				  <form id="form1" name="form1" method="post" action="">
				    <div class="row">
				 	 <div class="col-xs-6">
				         <?PHP
						 	$congr = new List_sele ("igreja","razao","id_cong");
						 	echo $congr->List_Selec (++$ind,$igreja->rol(),'class="form-control input-sm"');
						 ?>
					</div>
				 	 <div class="col-xs-2">
						 <input name="escolha" type="hidden" id="escolha" value="adm/atualizar_dados.php" />
						  <input name="tabela" type="hidden" id="tabela" value="cart_apresentacao" />
						  <input name="id" type="hidden" id="id" value="<?php echo $apresenta->rol();?>" />
						  <input name="campo" type="hidden" id="campo" value="id_cong" />
						  <input name="Alterar..." type="submit" class="btn btn-primary btn-sm" id="Alterar..." value="Alterar..." tabindex="2" />
					</div></div>
				  </form>
				<?PHP
				}
				?>
		</td>
      </tr>
      <tr>
        <td colspan="2">Pai:
        <?PHP
		$nome = new editar_form("pai",$apresenta->pai(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','0');
		?></td>
        <td>Rol do Pai:
			<?PHP
				$_GET["rol_pai"]=$apresenta->rol_pai();
				$nome = new editar_form("rol_pai",$apresenta->rol_pai(),$tab,$tab_edit);
				$nome->getMostrar();$nome->getEditar();
			?></td>
      </tr>
      <tr>
        <td colspan="2">M&atilde;e:
		<?PHP
		$nome = new editar_form("mae",$apresenta->mae(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','0');
		?></td>
		<?php
		if ($_GET["campo"]!=="mae")
		{?>
			<td>Rol da M&atilde;e:
			<?PHP
				$nome = new editar_form("rol_mae",$apresenta->rol_mae(),$tab,$tab_edit);
				$nome->getMostrar();$nome->getEditar();
			?>			</td>
		<?php
		} ?>
      </tr>
      <tr>
        <td>Data Nascimento:
        <?PHP
		$nome = new editar_form("dt_nasc",conv_valor_br($apresenta->dt_nasc()),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>Hospital:
          <?PHP
		$nome = new editar_form("maternidade",$apresenta->maternidade(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Sexo:
	    <?PHP
		$nome = new editar_form("sexo",$apresenta->sexo(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>UF Nascimento:
        <?PHP
		$nome = new editar_form("uf",$apresenta->uf(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>Naturalidade:
        <?PHP
		$nome = new editar_form("cidade",$cidade->nome(),$tab,$tab_edit);
		$nome->getMostrar();

		//$nome = new editar_form("cidade",$apresenta->cidade(),$tab,$tab_edit);
		//$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>N&ordm; Certid&atilde;o :
        <?PHP
		$nome = new editar_form("num_cert",$apresenta->num_cert(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Livro:
        <?PHP
		$nome = new editar_form("livro",$apresenta->livro(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Folhas:
	    <?PHP
		$nome = new editar_form("fl",$apresenta->fl(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Data:
        <?PHP
		$nome = new editar_form("data", conv_valor_br($apresenta->data()),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td colspan="3">Observa&ccedil;&otilde;es:
        <?PHP
		$nome = new editar_form("obs",$apresenta->obs(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
    </table>
    <form id="form1" name="form1" method="post" action="relatorio/carta_apres.php">
    <div class="row">
 	 <div class="col-xs-6">
      <input name="rol" type="hidden" id="rol" value="<?PHP echo $apresenta->rol();?>" />
      <label>Secret&aacute;rio:</label>
		<select name="secretario" id="secretario" class="form-control" tabindex="<?PHP echo $ind++;?>">
			<option value="<?PHP echo $igreja_sede->secretario1();?>"><?PHP echo fun_igreja ($igreja_sede->secretario1());?></option>
			<option value="<?PHP echo $igreja_sede->secretario2();?>"><?PHP echo fun_igreja ($igreja_sede->secretario2());?></option>
		</select>
		</div>
 	 	<div class="col-xs-2">
        <label>&nbsp;</label>
        <input type="submit" class="btn btn-primary btn-sm" name="Submit" value="Imprimir..." />
        </div>
        </div>
  </form>
    <?PHP
    }else {
    	echo "Sem Cadastro para este id: {$_GET["id"]}";
    }

    ?>
</div>
</fieldset>
