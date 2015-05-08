<?PHP
if ($_SESSION['nivel']>4){

$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
$tab_edit="adm/dados_famil.php&bsc_rol=$bsc_rol&tabela=est_civil&campo=";//Link de chamada da mesma página para abrir o form de edição do item
$dad_cad = mysql_query ("SELECT *,DATE_FORMAT(data,'%d/%m/%Y') AS data  FROM est_civil WHERE rol='".$bsc_rol."'");
$arr_dad = mysql_fetch_array ($dad_cad);

$ind = 1; //Define o indice dos campos do formulário

ver_cad();
?>
	<?PHP
	if (!empty($_SESSION["rol"]))
	{
		if (!empty($arr_dad["rol"])) {
	?>
<div id="lst_cad">
	<table class='table'>
      <tr>
        <td colspan="2">Conjugue:
		<?PHP
		$_GET["rol_conjugue"]=$arr_dad["rol_conjugue"];
		$nome = new editar_form("conjugue",$arr_dad["conjugue"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
		<?php
		if ($_GET["campo"]!=="conjugue")
		{?>
			<td>Rol do Conjugue:
			<?PHP
				$nome = new editar_form("rol_conjugue",$arr_dad["rol_conjugue"],$tab,$tab_edit);
				$nome->getMostrar();$nome->getEditar();
			?></td>
		<?php
		} ?>
      </tr>
      <tr>
        <td>Estado Civil:
		<?PHP
		$nome = new editar_form("estado_civil",$arr_dad["estado_civil"],$tab,$tab_edit);
		$nome->getMostrar();
		if ($_GET["campo"]=="estado_civil") {
		?>
		<form id="form1" name="form1" method="post" action="">
        <div class="row">
            <div class="col-xs-4">
			<select name="estado_civil" id="estado_civil" class="form-control" tabindex="<?PHP echo $ind++;?>">
              <option value="<?PHP echo $arr_dad["estado_civil"];?>"><?PHP echo $arr_dad["estado_civil"];?></option>
		  	<?PHP
			$membro = new DBRecord ("membro",$_SESSION["rol"],"rol");
			if ((strtoupper($membro->sexo()))=="M") {
			?>
              <option value="Solteiro">Solteiro</option>
              <option value="Casado">Casado</option>
              <option value="Viúvo">Vi&uacute;vo</option>
              <option value="Divorciado">Divorciado</option>
			<?PHP
			}else {
			?>
              <option value="Solteira">Solteira</option>
              <option value="Casada">Casada</option>
              <option value="Viúva">Vi&uacute;va</option>
              <option value="Divorciada">Divorciada</option>
			<?PHP
			}
			?>
              <option value="Outros">Outros</option>
		  </select>
            </div>
            <div class="col-xs-2">
    			<input type="submit" class="btn btn-primary" name="Submit" value="Alterar..." />
    			<input name="escolha" type="hidden" value="adm/atualizar_dados.php" />
    			<input name="tabela" type="hidden" value="est_civil" />
    			<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
                <input name="campo" type="hidden" id="campo" value="estado_civil" />
            </div>
            </div>
		</form>
		<?PHP
		} //Fim do if ($_GET["campo"]="estado_civil"
		?>		</td>
        <td colspan="2">Certid&atilde;o de Casamento N&ordm;
          <?PHP
		$nome = new editar_form("certidao_casamento_n",$arr_dad["certidao_casamento_n"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Data:
        <?PHP
		$nome = new editar_form("data",$arr_dad["data"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td><td>Livro:
          <?PHP
		$nome = new editar_form("livro",$arr_dad["livro"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?>
</td>
		<td>Folhas:
        <?PHP
		$nome = new editar_form("folhas",$arr_dad["folhas"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td colspan="3">Observa&ccedil;&otilde;es:
		<?PHP
		$nome = new editar_form("obs",$arr_dad["obs"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?>		</td>
      </tr>
    </table>
</div>
	<?PHP
	}//Fim do if !empty($arr_dad["rol"]) quando não existe cadastro para este rol é aberto um form para preenchimento
	else {
		require_once ("adm/form_famil.php");
	}
	}}
	?>
