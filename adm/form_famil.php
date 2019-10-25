<?php
controle ("inserir");
    $linkEstCivil = './?escolha=adm/dados_famil.php&bsc_rol='.$_GET['bsc_rol'].'&civil=';
    if (!empty($_GET["civil"])) {
       $estCivil  = '<option value="'.$linkEstCivil.$_GET["civil"].'">'.$_GET["civil"].'</option>';
       $estCivil .= '<option></option>';
    } else {
        $estCivil = '';
    }
	$familia = new DBRecord ("est_civil",$bsc_rol,"rol");
	$link = "atualizar_array";//define para q p�gina direcionar� o form para atualizar

	if ($familia->rol()=="") {
		$link = "cad_dados_pess";//define para q p�gina direcionar� o form para atualizar
	}elseif ($_GET["editar"]=="editar") {
		$link = "atualizar_array";//define para q p�gina direcionar� o form para atualizar
	}
$ind=1;
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<div id="lst_cad">
<fieldset>
<legend>Dados Familiares - Cadastro de Membro</legend>
<form method="post" action="">
	<div id="lst_cad">
            <div class="row">
              <div class="col-xs-4">
                <label>Estado Civil:</label>
        		  <select name="civil" id="civil" onchange="MM_jumpMenu('parent',this,0)"
                  class='form-control' tabindex="<?PHP echo $ind++;?>">
    		  	<?PHP
                echo $estCivil;
    			$membro = new DBRecord ("membro",$bsc_rol,"rol");
    			if ((strtoupper($membro->sexo()))=="M") {
    			?>
                    <option value="<?PHP echo $linkEstCivil;?>Solteiro">Solteiro</option>
                    <option value="<?PHP echo $linkEstCivil;?>Casado">Casado</option>
                    <option value="<?PHP echo $linkEstCivil;?>Vi�vo">Vi&uacute;vo</option>
                    <option value="<?PHP echo $linkEstCivil;?>Divorciado">Divorciado</option>
    			<?PHP
    			}else {
    			?>
                    <option value="<?PHP echo $linkEstCivil;?>Solteira">Solteira</option>
                    <option value="<?PHP echo $linkEstCivil;?>Casada">Casada</option>
                    <option value="<?PHP echo $linkEstCivil;?>Vi�va">Vi&uacute;va</option>
                    <option value="<?PHP echo $linkEstCivil;?>Divorciada">Divorciada</option>
    			<?PHP
    			}
    			?>
                  <option value="./?escolha=adm/dados_famil.php&civil=Outros">Outros</option>
    			</select>
    			<?PHP
					if ($_GET["civil"]==""){
						if ((strtoupper($membro->sexo()))=="M") {
							echo "<input type='hidden' name='estado_civil' value='Solteiro' />";
						}else {
							echo "<input type='hidden' name='estado_civil' value='Solteira' />";
						}
					}else{
					echo "<input type='hidden' name='estado_civil' value='{$_GET["civil"]}' />";}
    			?></div>
      	<?PHP
 			if ($_GET["civil"]=="Casado" || $_GET["civil"]=="Casada" ) {
			?>
              <div class="col-xs-4">
                <label>Certid&atilde;o de Casamento N&ordm; :</label>
              <input name="certidao_casamento_n" type="text" id="certidao_casamento_n"
              class='form-control' tabindex="<?PHP echo $ind++;?>" />
              </div>
              <div class="col-xs-4">
               <label>Data:</label>
                  <input name="data" type="text" id="data" tabindex="<?PHP echo $ind++;?>"
                  class='form-control dataclass' />
              </div>
              <div class="col-xs-4">
                <label>Livro:</label>
            <input name="livro" type="text" id="livro"
            class='form-control' tabindex="<?PHP echo $ind++;?>"  />
              </div>
              <div class="col-xs-4">
               <label>Folha:</label>
            <input name="folhas" type="text" id="folhas"
            class='form-control' tabindex="<?PHP echo $ind++;?>" />
        </div>
              <div class="col-xs-10"><label>C&ocirc;njuge:</label>
                  <input name="conjugue" type="text" id="conjugue"
                  tabindex="<?PHP echo $ind++;?>" class='form-control' />
              </div>
              <div class="col-xs-2">
                <label>Rol do C&ocirc;njuge:</label>
                <input name="rol_conjugue" type="text" id="rol_conjugue"
                class='form-control' tabindex="<?PHP echo $ind++;?>" />
              </div>
			<?PHP
		   } // fim do else$_GET["est_civil"]=="Casado"
		   else {
		   		echo "<input name='rol_conjugue' type='hidden' />";
		   		echo "<input name='conjugue' type='hidden' />";
		   		echo "<input name='certidao_casamento_n' type='hidden' />";
		   		echo "<input name='livro' type='hidden' />";
		   		echo "<input name='data' type='hidden' />";
		   		echo "<input name='folhas' type='hidden' />";
		   }
		  ?>
              <div class="col-xs-12">
                <label>Obs:</label>
                  <textarea name="obs" id="obs" class='form-control'
                  tabindex="<?PHP echo $ind++;?>"></textarea>

	</div></div><br />
	<input name="escolha" type="hidden" value="adm/<?PHP echo $link;?>.php" />
	<input name="tabela" type="hidden" id="tabela" value="est_civil" />
  <input name="bsc_rol" type="hidden" id="tabela" value="<?PHP echo $bsc_rol;?>" />
	<input name="hist" type="hidden" id="hist" value="<?PHP echo $_SESSION['valid_user'].": ".$_SESSION['nome'].", em: ".date("d/m/Y H:i:s")."@".$familia->hist();?>" />
	<input type="submit" class='btn btn-primary' name="Submit" value="Cadastrar..." tabindex="<?PHP echo $ind++;?>" />
</form>
</fieldset>
</div>
