<?php

controle ("inserir");

	$familia = new DBRecord ("est_civil",$_SESSION["rol"],"rol");
	
	$link = "atualizar_array";//define para q página direcionará o form para atualizar
	
	if ($familia->rol()=="") {
		$link = "cad_dados_pess";//define para q página direcionará o form para atualizar
	}elseif ($_GET["editar"]=="editar") {
		$link = "atualizar_array";//define para q página direcionará o form para atualizar	
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
	<table width="552" border="0">
      
      
      <tr>
        <td>Estado Civil:<label>
		<?PHP if ($_GET["civil"]=="") {?>
          <select name="civil" id="civil" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo $ind++;?>">
		  	<?PHP 
			$membro = new DBRecord ("membro",$_SESSION["rol"],"rol");
			if ((strtoupper($membro->sexo()))=="M") {
			?>
              <option value="./?escolha=adm/dados_famil.php&civil=Solteiro">Solteiro</option>
              <option value="./?escolha=adm/dados_famil.php&civil=Casado">Casado</option>
              <option value="./?escolha=adm/dados_famil.php&civil=Viúvo">Vi&uacute;vo</option>
              <option value="./?escolha=adm/dados_famil.php&civil=Divorciado">Divorciado</option>
			<?PHP 
			}else {
			?>
              <option value="./?escolha=adm/dados_famil.php&civil=Solteira">Solteira</option>
              <option value="./?escolha=adm/dados_famil.php&civil=Casada">Casada</option>
              <option value="./?escolha=adm/dados_famil.php&civil=Viúva">Vi&uacute;va</option>
              <option value="./?escolha=adm/dados_famil.php&civil=Divorciada">Divorciada</option>
			<?PHP 
			}
			?>
              <option value="./?escolha=adm/dados_famil.php&civil=Outros">Outros</option>
			</select>
			
			<?PHP 
				}
				
					if ($_GET["civil"]==""){
						if ((strtoupper($membro->sexo()))=="M") {
							echo "<input type='hidden' name='estado_civil' value='Solteiro' />";
						}else {
							echo "<input type='hidden' name='estado_civil' value='Solteira' />";
						}
					}else{
					echo "<input type='hidden' name='estado_civil' value='{$_GET["civil"]}' />";}
					
					echo "<strong>{$_GET["civil"]}</strong>";
			?>
			</label></td>

       <td width="218"><label></label></td>
      </tr>
			<?PHP
 			if ($_GET["civil"]=="Casado" || $_GET["civil"]=="Casada" ) {
			?>      <tr>
        <td>Certid&atilde;o de Casamento N&ordm; :
          <label>
          <input name="certidao_casamento_n" type="text" id="certidao_casamento_n" tabindex="<?PHP echo $ind++;?>" />
          </label></td>
        <td>Data:<label>
          <input name="data" type="text" id="data" tabindex="<?PHP echo $ind++;?>" onkeypress="formatar('##/##/####', this);" maxlength="10" /></label></td>
      </tr>
      <tr>
        <td>Livro:<label>
            <input name="livro" type="text" id="livro" tabindex="<?PHP echo $ind++;?>"  />
        </label></td>
        <td>Folha:<label>
            <input name="folhas" type="text" id="folhas" tabindex="<?PHP echo $ind++;?>" />
        </label></td>
      </tr>
      <tr>
        <td>Conjugue:<label>
            <input name="conjugue" type="text" id="conjugue" tabindex="<?PHP echo $ind++;?>" size="30" />
</label></td>
        <td>Rol do Conjugue:
          <label>
          <input name="rol_conjugue" type="text" id="rol_conjugue" tabindex="<?PHP echo $ind++;?>" />
          </label></td>
      </tr>
      
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
      <tr>
        <td colspan="2">Obs:
          <label>
          <textarea name="obs" cols="58" id="obs" tabindex="<?PHP echo $ind++;?>"></textarea>
          </label></td>
        </tr>
    </table>
	</div>
	<input name="escolha" type="hidden" value="adm/<?PHP echo $link;?>.php" />
	<input name="tabela" type="hidden" id="tabela" value="est_civil" />
	<input name="hist" type="hidden" id="hist" value="<?PHP echo $_SESSION['valid_user'].": ".$_SESSION['nome'].", em: ".date("d/m/Y H:i:s")."@".$familia->hist();?>" />
	<input type="submit" name="Submit" value="Cadastrar..." tabindex="<?PHP echo $ind++;?>" />
</form>
</fieldset>
</div>