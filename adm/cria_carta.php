<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");

controle("inserir");
$bsc_rol = (int)$_GET['bsc_rol'];
if ((empty($_POST["tipo"]) || empty($_POST["cidade"])) && empty($_POST["exterior"])) {
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<form action="" id = "exterior" method="post" >
	<input type="hidden" name="exterior" value="1">
	<input type="submit" class='btn btn-primary' name="Submit" value="Clique aqui se carta para Exterior" tabindex="<?PHP echo $ind++;?>">
</form>

<fieldset>
<legend>Carta - Cadastro</legend>
<form action="" id = "exterior" method="post" >
	<input type="hidden" name="exterior" value="1">
	<input type="submit" class='btn btn-primary' name="Submit" value="Carta - Exterior" tabindex="<?PHP echo $ind++;?>">
</form>

<form method="post" action="">
<div class="row">
	<div class="col-xs-4">
	 <label>Estado de Destino:</label> 
	   	<select name="uf_nasc" id="uf_nasc" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
	  <?PHP
			$estnatal = new List_UF('estado', 'nome','uf_nasc');
			echo $estnatal->List_Selec_pop('escolha=adm/cria_carta.php&bsc_rol='.$bsc_rol.'&uf=',$_GET['uf']);
		?>
	  </select>
	</div>
	<div class="col-xs-4">
		<?PHP
		if (!empty($_GET["uf"])){
		//conectar();
		$vl_uf=$_GET["uf"];
		$lst_cid = new sele_cidade("cidade","$vl_uf","codUf","nome","cidade");
		echo "<label>Cidade de Destino:</label>";		
		$vlr_linha=$lst_cid->ListDados ($ind++);
		?>
		</div>
	<div class="col-xs-4">
		<label>Tipo:</label>
			<select name="tipo" id="tipo" tabindex="<?PHP echo $ind++;?>" class="form-control">
			  <option value="">&lt;&lt;--Tipo de Carta--&gt;&gt;</option>
			  <option value="1">Recomenda&ccedil;&atilde;o</option>
			  <option value="2">Mudan&ccedil;a</option>
			  <option value="3">Tr&acirc;nsito</option>
			</select>
	</div>
	
	<div class="col-xs-4">	
        <label>Qual Igreja/Instui��o: </label>
        <input name="igreja" type="text" id="igreja" tabindex="<?PHP echo $ind++;?>" value="Assembleia de Deus" class="form-control" />
    </div> 
  <div class="col-xs-6">
  <label>Observa&ccedil;&atilde;o:</label>
	<textarea name="obs" cols="70" rows="2" id="obs" class="form-control" tabindex="<?PHP echo $ind++;?>" ><?PHP echo $_POST["obs"];?></textarea>
	</div>
	</div>	
		
	<?PHP	
		}
	?>

	    <input type="submit" class='btn btn-primary' name="Submit" value="Salvar" tabindex="<?PHP echo $ind++;?>">
	<h5>Obs: A data deve estar no formato: dd/mm/aaaa (00/00/0000)</h5>
</form>
</fieldset>
<?PHP
} elseif ($_POST["exterior"]==1) {
?>	
	<fieldset>
		<legend>Cadastro de carta para o exterior</legend>
		<form method="post" action="">
		
<div class="row">
	<div class="col-xs-4">	  
			<label>Pa�s de destino: </label>
				<input name="pais" type="text" id="pais" tabindex="<?PHP echo $ind++;?>" class="form-control" />
	</div>
	<div class="col-xs-4">
				<label>Cidade: </label>
				<input name="cidade" type="text" id="cidade" tabindex="<?PHP echo $ind++;?>" class="form-control"/>
	</div>
	<div class="col-xs-4">
			<label>Tipo:</label>
					<select name="tipo" id="tipo" tabindex="<?PHP echo $ind++;?>" class="form-control">
					  <option value="">&lt;&lt;--Tipo de Carta--&gt;&gt;</option>
					  <option value="1">Recomenda&ccedil;&atilde;o</option>
					  <option value="2">Mudan&ccedil;a</option>
					  <option value="3">Tr&acirc;nsito</option>
					</select>
	</div>
	<div class="col-xs-4">
				
		        <label>Qual Igreja/Instui��o:</label> 
		        <input name="igreja" type="text" id="igreja" tabindex="<?PHP echo $ind++;?>" value="Assembleia de Deus" class="form-control" />
	</div>
	<div class="col-xs-6">
		  <label>Observa&ccedil;&atilde;o:</label>
					<textarea name="obs" cols="70" rows="2" id="obs" tabindex="<?PHP echo $ind++;?>" class="form-control" ><?PHP echo $_POST["obs"];?></textarea>
	</div></div>			
			    <input type="submit" class='btn btn-primary' name="Submit" value="Salvar" tabindex="<?PHP echo $ind++;?>">
			<h5>Obs: A data deve estar no formato: dd/mm/aaaa (00/00/0000)
		  </h5>
		</form>
	</fieldset>
<?php	
} elseif ($_SESSION['nivel']>4){
	
	//Inserir dados na tadela carta
	$pais = $_POST["pais"]." - ".$_POST["cidade"];
	$cidade = ($_POST["pais"]<>"") ?  $pais : $_POST["cidade"];
	if ($_POST["obs"]=="nada"){$_POST["obs"]="";}
	$log = time()."@Inserido por:{$_SESSION["valid_user"]}";
	$value = "null,'{$_POST["tipo"]}','{$bsc_rol}','$cidade','{$_POST["igreja"]}','{$_POST["obs"]}',NOW(),'$log'";
	$carta = new insert ("$value","carta");
		if ($_POST["tipo"]=="2") {
			$transf = "null,'{$bsc_rol}','6','Carta de Mudan�a',NOW(),null,'$log',NOW()";
			$registro = new insert ("$transf","disciplina");
		}
	
	$carta->inserir();
	if ($_POST["tipo"]=="2") {
		$rec = new DBRecord ("eclesiastico",$bsc_rol,"rol");
		$rec->situacao_espiritual = 6; //Aqui � atribuido a esta vari�vel o valor para UpDate
		$rec->UpDate();
		//Insere o hist�rico para registro da transfer�ncia
		$motivo = 'Transferido para igreja: '.$_POST["igreja"].' conf. carta de mudan�a.';
		$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
		$value = "null,'{$bsc_rol}','6','$motivo',NOW(),null,'$hist',NOW()";
		$disciplina = new insert ("$value","disciplina");
		$disciplina -> inserir();
	}

	echo "<script>location.href='./?escolha=adm/dados_cartas.php&bsc_rol=$bsc_rol'</script>";
}else{
	echo "Desculpe! Mas voc&ecirc; n&atilde;o tem autoriza&ccedil;&atilde;o para este procedimento.";
}
?>