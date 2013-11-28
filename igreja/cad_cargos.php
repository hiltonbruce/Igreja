<?php
controle ("inserir");
if ($_SESSION["rol"]=="") {
	echo "<script> alert('Faça antes a pesquisa no cadastro de Membro verifique os dados e retorne!');location.href='./?escolha=adm/dados_pessoais.php'</script>";
}
$ver_comunh = new DBRecord ("eclesiastico",$_POST["rol"],"rol");
$cargo_igreja = new DBRecord ("cargo_igreja",$_SESSION["rol"],"rol");

if ($_POST["Submit"]!="Cadastrar..."){
	//chama o formulário para o cadastro do responsável
?>

	<div id="lst_cad">
<fieldset>
<legend> Cadastro de Respons&aacute;vel por Trabalho na Igreja</legend>
<form method="post" action="">
  <div id="lst_cad">
	Sede/Congrega:
          <label>
          <?PHP
			$congr = new List_sele ("igreja","razao","congregacao");
			$congr->List_Selec (++$ind);
		?>
          </label>
		  <label>Tipo:
		  	<?PHP
				$tipo = new List_sele ("cargos","descricao","id");
				$tipo -> List_Selec (++$ind);
			?>
		  </label>
		  Rol  do Respons&aacute;vel:
          <label> </label>
          <input readonly name="rol" type="text" id="rol" tabindex="<?PHP echo ++$ind;?>" size="10" value="<?PHP echo $_SESSION["rol"];?>" />
          - <?PHP echo $_SESSION["membro"];?>
         
          <label>Hierarquia
          <select name="hierarquia" id="hierarquia">
            <option value="1">1&ordm;</option>
            <option value="2">2&ordm;</option>
            <option value="3">3&ordm;</option>
            <option value="4">4&ordm;</option>
            <option value="5">5&ordm;</option>
            <option value="6">6&ordm;</option>
            <option value="7">7&ordm;</option>
            <option value="8">8&ordm;</option>
            <option value="9">9&ordm;</option>
            <option value="10">10&ordm;</option>
          </select>
          Observa&ccedil;&atilde;o:</label>
		<textarea class="text_area" name="obs" cols="25" wrap=physical id="obs" tabindex="<?PHP echo ++$ind;?>" onKeyDown="textCounter(this.form.obs,this.form.remLen,255);" onKeyUp="textCounter(this.form.obs,this.form.remLen,255);progreso_tecla(this,255);" value="<?PHP echo $_POST["obs"];?>" ></textarea>
   
	   <div id="progreso"></div>
   		(Max. 255 Carateres)
  <input readonly type=text name=remLen size=3 maxlength=3 value="255"> 
	Caracteres restantes
	<label>
        <input type="submit" name="Submit" value="Cadastrar..." tabindex="<?PHP echo $ind++;?>" />
</label>
	</div>
	<input name="escolha" type="hidden" value="igreja/cad_cargos.php" />
	<input name="menu" type="hidden" id="menu" value="top_igreja" />
</form>
</fieldset>
</div>

<?PHP
}elseif ($ver_comunh->situacao_espiritual()=="1") {
//pede confimação para o cadastro do cargo
	$responsavel = new DBRecord ("membro",$_POST["rol"],"rol");
	$congreg = new DBRecord ("igreja",$_POST["congregacao"],"rol");
	$cargo = new DBRecord ("cargos",$_POST["id"],"rol");
	
	if ($cargo_igreja->descricao()!=$_POST["id"] && $cargo_igreja->igreja()!=$_POST["congregacao"]){
		?>
		<fieldset>
		<legend>Confirmar cadastro de Respons&aacute;vel</legend>
		Membro: 
		<h3><?PHP echo mostra_foto ()."<br>{$responsavel->nome()} - Rol:{$_POST["rol"]}";?></h3>
		Ir&aacute; assumir na congregação:
		<h3><?PHP echo $congreg->razao();?></h3>
		A fun&ccedil;&atilde;o de:
		<h3><?PHP echo $cargo->descricao().$_POST["descricao"];?></h3>
		E ser&aacute; o N&uacute;mero 
		<h3><?PHP echo $_POST["hierarquia"];?> </h3>na sucess&atilde;o da fun&ccedil;&atilde;o. 
		<p>Observa&ccedil;&otilde;es:</p>
		<h3><?PHP echo $_POST["obs"];?></h3>
		<form id="form1" name="form1" method="post" action="">
		  <input type="hidden" name="igreja"  value="<?PHP echo $_POST["congregacao"];?>" />
		  <input type="hidden" name="descricao"  value="<?PHP echo $_POST["id"];?>" />
		  <input type="hidden" name="obs"  value="<?PHP echo $_POST["obs"];?>" />
		  <input type="hidden" name="hierarquia"  value="<?PHP echo $_POST["hierarquia"];?>" />
		  <input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
		  <input name="tabela" type="hidden" id="menu" value="cargo_igreja" />
		  <label>
		  <input type="submit" name="Submit2" value="Confirmar ?" />
		  </label>
		</form>
		</fieldset>
		
		<?PHP
	}else {
		echo "Este Membro já está cadastro!";
	}	
} else {
	echo "N&atilde;o ser&aacute; poss&iacute;vel a atribui&ccedil;&atilde;o de fun&ccedil;&atilde;o a este Membro at&eacute; que seja regularizado a situa&ccedil;&atilde;o espiritual na tabela Eclesi&aacute;stico do cadastro de Membros!";
	echo "<script> alert('Não será possível a atribuição de função a este Membro até que seja regularizado a situação espiritual na tabela Eclesiástico do cadastro de Membros'); location.href='./?bsc_rol={$_POST["rol"]}&escolha=adm/dados_ecles.php';</script>";
}
?>