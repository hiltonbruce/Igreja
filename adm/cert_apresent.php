<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<?PHP
	if ($_SESSION['nivel']>4){
?>
<fieldset>
	<legend> Certid&atilde;o de Apresenta&ccedil;&atilde;o</legend>
    <form id="form2" name="form2" method="post" action="relatorio/carta_apres.php">
	 Estado que nasceu:
	   <label>
	<select name="uf" id="uf" onchange="MM_jumpMenu('parent',this,0)" tabindex="1" onselect="1">
            <option value="<?PHP echo $_GET['uf'];?>"><?PHP echo $_GET['uf'];?></option>
            <option value='./?escolha=adm/cert_apresent.php&uf=AC&menu=top_formulario'>Acre</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=AL&menu=top_formulario'>Alagoas</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=AP&menu=top_formulario'>Amapá</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=AM&menu=top_formulario'>Amazonas</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=BA&menu=top_formulario'>Bahia</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=CE&menu=top_formulario'>Ceará</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=DF&menu=top_formulario'>Distrito Federal</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=GO&menu=top_formulario'>Goiás</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=MA&menu=top_formulario'>Maranhão</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=MT&menu=top_formulario'>Mato Grosso</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=MS&menu=top_formulario'>Mato Grosso do Sul</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=MG&menu=top_formulario'>Minas Gerais</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=PA&menu=top_formulario'>Pará</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=PB&menu=top_formulario'>Paraíba</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=PR&menu=top_formulario'>Paraná</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=PE&menu=top_formulario'>Pernambuco</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=PI&menu=top_formulario'>Piauí</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=RJ&menu=top_formulario'>Rio de Janeiro</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=RN&menu=top_formulario'>Rio Grande do Norte</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=RS&menu=top_formulario'>Rio Grande do Sul</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=RO&menu=top_formulario'>Rondônia</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=RR&menu=top_formulario'>Roraima</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=SC&menu=top_formulario'>Santa Catarina</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=SP&menu=top_formulario'>São Paulo</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=SE&menu=top_formulario'>Sergipe</option>
            <option value='./?escolha=adm/cert_apresent.php&uf=TO&menu=top_formulario'>Tocantins</option>
    </select></label>
	<?PHP
		if (!empty($_GET["uf"])){
			$vl_uf=$_GET["uf"];
			$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cidade");
			echo "Na Cidade de:<label>";
			$vlr_linha=$lst_cid->ListDados ("2");//"2" é o indice de tabulação do formulário
			echo "</label>";
	?>
	<br>
	Nome da Crian&ccedil;a:<label>
    <input name="nome" type="text" id="nome" size="50" maxlength="40" tabindex="3">
	</label>
	<label>Pai:</label>
	<input name="pai" type="text" id="pai" size="50" maxlength="40" tabindex="4">
	Rol:
	<input name="rol_pai" type="text" id="rol_pai" size="5" maxlength="5" tabindex="5"/>
    <a href="javascript:lancarSubmenu('campo=pai&rol=rol_pai&form=2')" tabindex="6"><img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para pesquisar membros!" /></a></p>
	<p><label>M&atilde;e:</label>
	<input name="mae" type="text" id="mae" size="50" maxlength="40" tabindex="7">
	Rol:
	<input name="rol_mae" type="text" id="rol_mae" size="5" maxlength="5" tabindex="8" />
    <a href="javascript:lancarSubmenu('campo=mae&rol=rol_mae&form=2')" tabindex="9"><img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para pesquisar membros!" /></a>
	</p>
    <table width="419" border="0">
      <tr>
        <td>Congregação dos Pais:<label>
			<?PHP
		 	$congr = new List_sele ("igreja","razao","id_cong");
		 	$congr->List_Selec ("10");
		 	?>
        </label></td>
        <td>Hospital de nascimento:<label>
            <input name="maternidade" type="text" id="maternidade" tabindex="11">
        </label></td>
      </tr>
      <tr>
        <td>Sexo:<label>
			<select name="sexo" id="sexo" tabindex="12">
				<option value=""  selected>- Selecionar um(a) -</option>
				<option value="M" >Masculino</option>
				<option value="F" >Feminino</option>
			</select></label>		</td>
        <td>Data de Nascimento:<label>
            <input name="dt_nasc" type="text" id="dt_nasc" tabindex="13" />
</label></td>
      </tr>
      <tr>
        <td>Folha:<label>
            <input name="fl" type="text" id="fl" tabindex="14" />
        </label></td>
        <td>Livro:<label>
            <input name="livro" type="text" id="livro" tabindex="15" />
        </label></td>
      </tr>
      <tr>
        <td>Data da Apresenta&ccedil;&atilde;o:
          <label>
          <input name="dt_apresent" type="text" id="dt_apresent" tabindex="16" />
          </label></td>
        <td>Número da Certidão:<label>
            <input name="num_cert" type="text" id="num_cert" tabindex="17" />
        </label></td>
      </tr>
      <tr>
        <td colspan="2">Observa&ccedil;&otilde;es:
          <label>
          <textarea name="obs" cols="60" id="obs" tabindex="18"></textarea>
        </label></td>
      </tr>
      <tr>
        <td><label></label></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  Secretário que ir&aacute; assinar a carta:
  <?PHP $igreja = new DBRecord ("igreja","1","id");?>
  <select name="secretario" id="secretario" tabindex="19">
    <option value="<?PHP echo fun_igreja ($igreja->secretario1());?>"><?PHP echo fun_igreja ($igreja->secretario1());?></option>
    <option value="<?PHP echo fun_igreja ($igreja->secretario2());?>"><?PHP echo fun_igreja ($igreja->secretario2());?></option>
  </select>
  <!-- Envia o id para a impressão da carta escolhida -->
  <input type="image" src="img/Preview-48x48.png" name="Submit2" value="Imprimir esta Carta" align="absmiddle" alt="Visualizar Impress&atilde;o" title="Visualizar Impress&atilde;o" tabindex="20" />
 <?PHP
 } //fim do if após selecionar a uf nascimento da criança
 ?>
</form>
</fieldset>
<?PHP
} //Fim do if session>4
?>
