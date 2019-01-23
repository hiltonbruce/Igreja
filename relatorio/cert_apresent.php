<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<?PHP
	$ind = 1;
	if ($_SESSION['nivel']>7){
?>
<fieldset>
	<legend> Certid&atilde;o de Apresenta&ccedil;&atilde;o</legend>
    <form id="form1" name="form1" method="post" action="relatorio/carta_apres.php">
    <div class="row">
 	 <div class="col-xs-4">
	<label>Estado que nasceu:</label>
	<select name="uf" id="uf" class="form-control input-sm" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo $ind++;?>" onselect="1">
      <option value="<?PHP echo $_GET['uf'];?>"><?PHP echo $_GET['uf'];?></option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=AC&menu=top_formulario'>Acre</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=AL&menu=top_formulario'>Alagoas</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=AP&menu=top_formulario'>Amap&aacute;</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=AM&menu=top_formulario'>Amazonas</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=BA&menu=top_formulario'>Bahia</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=CE&menu=top_formulario'>Cear&aacute;</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=DF&menu=top_formulario'>Distrito Federal</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=GO&menu=top_formulario'>Goi&aacute;s</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=MA&menu=top_formulario'>Maranh&atilde;o</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=MT&menu=top_formulario'>Mato Grosso</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=MS&menu=top_formulario'>Mato Grosso do Sul</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=MG&menu=top_formulario'>Minas Gerais</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=PA&menu=top_formulario'>Par&aacute;</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=PB&menu=top_formulario'>Para&iacute;ba</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=PR&menu=top_formulario'>Paran&aacute;</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=PE&menu=top_formulario'>Pernambuco</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=PI&menu=top_formulario'>Piau&iacute;</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=RJ&menu=top_formulario'>Rio de Janeiro</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=RN&menu=top_formulario'>Rio Grande do Norte</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=RS&menu=top_formulario'>Rio Grande do Sul</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=RO&menu=top_formulario'>Rond&ocirc;nia</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=RR&menu=top_formulario'>Roraima</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=SC&menu=top_formulario'>Santa Catarina</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=SP&menu=top_formulario'>S&atilde;o Paulo</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=SE&menu=top_formulario'>Sergipe</option>
      <option value='./?escolha=relatorio/cert_apresent.php&uf=TO&menu=top_formulario'>Tocantins</option>
    </select>
    </div>
 	 <div class="col-xs-4">
	<?PHP
		if (!empty($_GET["uf"])){
			$vl_uf=$_GET["uf"];
			$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cidade");
			echo "<label>Na Cidade de:</label>";
			$vlr_linha=$lst_cid->ListDados ($ind++);//"2" � o indice de tabula��o do formul�rio
			echo "";
	?></div></div>
	<label>Nome da Crian&ccedil;a:</label>
    <input name="nome" type="text" class="form-control" id="nome" size="50" maxlength="40" tabindex="<?PHP echo $ind++;?>">
    <div class="row">
 	 <div class="col-xs-8">
	<label>Pai:</label>
	<input name="pai" type="text" class="form-control" id="pai" size="50" maxlength="40" tabindex="<?PHP echo $ind++;?>">
	</div>
 	 <div class="col-xs-2">
	<label>Rol:</label>
	<input name="rol_pai" class="form-control" type="text" id="rol_pai" size="5" tabindex="<?PHP echo $ind++;?>"/>
	</div>
 	<div class="col-xs-2"><label>&nbsp;</label>
    <a href="javascript:lancarSubmenu('campo=pai&rol=rol_pai&form=0')" tabindex="<?PHP echo $ind++;?>">
    <img border="0" src="img/lupa_32x32.png" width="18" height="18" title="Click aqui para pesquisar membros!" /></a>
    </div></div>
	<div class="row">
 	 <div class="col-xs-8">
	<label>M&atilde;e:</label>
	<input name="mae" type="text" id="mae" class="form-control" size="50" maxlength="40" tabindex="<?PHP echo $ind++;?>">
	</div>
 	 <div class="col-xs-2">
	<label>Rol:</label>
	<input name="rol_mae" type="text" class="form-control" id="rol_mae" size="5" maxlength="5" tabindex="<?PHP echo $ind++;?>" />
	</div>
 	<div class="col-xs-2"><label>&nbsp;</label>
    <a href="javascript:lancarSubmenu('campo=mae&rol=rol_mae&form=0')" tabindex="<?PHP echo $ind++;?>">
    <img border="0" src="img/lupa_32x32.png" width="18" height="18" title="Click aqui para pesquisar membros!" /></a>
	</div></div>
    <table width="419" border="0">
      <tr>
        <td><label>Congrega��o dos Pais:</label>
			<?PHP
		 	$congr = new List_sele ("igreja","razao","id_cong");
		 	echo $congr->List_Selec ($ind++,'','class="form-control"');
		 	?>
        </td>
        <td><label>Hospital de nascimento:</label>
            <input name="maternidade" class="form-control" type="text" id="maternidade" tabindex="<?PHP echo $ind++;?>">
       </td>
      </tr>
      <tr>
        <td><label>Sexo:</label>
			<select name="sexo" class="form-control" id="sexo" tabindex="<?PHP echo $ind++;?>">
				<option value=""  selected>- Selecionar um(a) -</option>
				<option value="M" >Masculino</option>
				<option value="F" >Feminino</option>
			</select>		</td>
        <td><label>Data de Nascimento:</label>
            <input name="dt_nasc" type="text" class="form-control dataclass" tabindex="<?PHP echo $ind++;?>" />
        </td>
      </tr>
      <tr>
        <td><label>Folha:</label>
            <input name="fl" type="text" class="form-control" id="fl" tabindex="<?PHP echo $ind++;?>" />
        </td>
        <td><label>Livro:</label>
            <input name="livro" type="text" class="form-control" id="livro" tabindex="<?PHP echo $ind++;?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label>Data da Apresenta&ccedil;&atilde;o:</label>
          <input name="dt_apresent" type="text" id="data" class="form-control" tabindex="<?PHP echo $ind++;?>"/>
          </td>
        <td><label>N�mero da Certid�o:</label>
            <input name="num_cert" type="text" class="form-control" id="num_cert" tabindex="<?PHP echo $ind++;?>" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <label>Observa&ccedil;&otilde;es:</label>
          <textarea name="obs" cols="60" id="obs" class="form-control" tabindex="<?PHP echo $ind++;?>"></textarea>
        </td>
      </tr>
      <tr>
        <td><label></label></td>
        <td>&nbsp;</td>
      </tr>
    </table>
	    <div class="row">
	 	 <div class="col-xs-8">
		  <label>Secret&aacute;rio que ir&aacute; assinar a carta:</label>
		  <select name="secretario" id="secretario" class="form-control" tabindex="<?PHP echo $ind++;?>">
		    <option value="<?PHP echo $igSede->secretario1();?>"><?PHP echo fun_igreja ($igSede->secretario1());?></option>
		    <option value="<?PHP echo $igSede->secretario2();?>"><?PHP echo fun_igreja ($igSede->secretario2());?></option>
		  </select>
		  </div>
	 	 <div class="col-xs-4">
  <!-- Envia o id para a impress�o da carta escolhida -->
  <input type="image" src="img/Preview-48x48.png" name="Submit2" value="Imprimir esta Carta" align="absmiddle" alt="Visualizar Impress&atilde;o" title="Visualizar Impress&atilde;o" tabindex="<?PHP echo $ind++;?>" />
 <?PHP
 } //fim do if ap�s selecionar a uf nascimento da crian�a
 ?> </div></div>
</form>
</fieldset>
<?PHP
} //Fim do if session>4
controle ("consulta");
?> <fieldset>
	<legend>Busca certid&atilde;o...</legend>
<form id="form1" name="form1" method="get" action="">
<div class="row">
<div class="col-xs-4">
 <label>Busca por:</label>
  <select name="campo" id="campo" class="form-control" tabindex="<?PHP echo $ind++;?>">
    <option value="nome">Crian&ccedil;a</option>
    <option value="pai">Pai</option>
    <option value="rol_pai">Rol do Pai</option>
    <option value="rol_mae">M&atilde;e</option>
    <option value="dt_nasc">Data de Nascimento</option>
    <option value="sexo">Sexo</option>
    <option value="dt_apresent">Data da apresenta&ccedil;&atilde;o</option>
  </select>
  </div>
<div class="col-xs-6"><label>&nbsp;</label>
  <input name="menu" type="hidden" id="menu" value="top_formulario" />
  <input name="escolha" type="hidden" id="escolha" value="relatorio/busca_apresent.php" />
  <input name="valor" type="text" class="form-control" id="valor" tabindex="<?PHP echo $ind++;?>" />
  </div>
<div class="col-xs-2">
  <label>&nbsp;</label>
  <input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Procurar..." tabindex="<?PHP echo $ind++;?>" />
  </div></div>
  </form>
		<form id="form1" name="form1" method="get" action="">
	    <div class="row">
	 	 <div class="col-xs-4">
		<label>Listar por Congrega&ccedil;&atilde;o:</label>
		<select name="menu1" class="form-control" onchange="MM_jumpMenu('parent',this,0)">
		  <option>--&gt;&gt; Escolha a Congrega&ccedil;&atilde;o&lt;&lt;-- </option>
		  <option value="./?escolha=<?PHP echo $_GET["escolha"];?>&proxima=<?PHP
		  	echo $_GET["proxima"];?>&ord=<?PHP echo $_GET["ord"];?>&amp;congregacao=0">Todas as Congregac&otilde;es</option>
		  <?PHP
			$congr = new List_sele ("igreja","razao","congregacao");
			$congr->List_Selec_pop ("campo=id_cong&menu=top_formulario&escolha=relatorio/busca_apresent.php&valor=");
		?>
		</select>
		</div></div>
		</form>
</fieldset>
