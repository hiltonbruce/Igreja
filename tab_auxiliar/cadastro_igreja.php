<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
<?PHP
if (!empty($_GET['idcidade'])){
		$idcidade = (int)$_GET['idcidade'];}
	else 
		{$idcidade = "2655";}
$ind=0;
$link_est = "./?escolha=tab_auxiliar/cadastro_igreja.php&uf_end=";

if (empty($_POST["cidade"]) && empty($_POST["igreja"])){
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

	<form action="" method="post" name="cadastro_igreja">
	<fieldset><legend>Cadastrar Sede e Congrações</legend>
		<table style="text-align: left; width: 100%;">
			<thead>
				<tr>
					<td>
						<label>Estado:</label>
							<select name="destino" class="form-control" id="destino" onchange="MM_jumpMenu('parent',this,0)">
							<?PHP
							if (empty($_GET["uf_end"]))
							{?>
								<option value="">Escolha o Estado</option>
							<?PHP
							}else{
								echo "<option value={$_GET['uf_end']}>{$_GET['uf_end']}</option>";
							} 
							?>
								<option value='<?PHP echo $link_est;?>AC'>Acre</option>
								<option value='<?PHP echo $link_est;?>AL'>Alagoas</option>
								<option value="<?PHP echo $link_est;?>AP">Amap&aacute;</option>
								<option value='<?PHP echo $link_est;?>AM'>Amazonas</option>
								<option value='<?PHP echo $link_est;?>BA'>Bahia</option>
								<option value="<?PHP echo $link_est;?>CE">Cear&aacute;</option>
								<option value='<?PHP echo $link_est;?>DF'>Distrito Federal</option>
								<option value="<?PHP echo $link_est;?>GO">Goi&aacute;s</option>
								<option value="<?PHP echo $link_est;?>MA">Maranh&atilde;o</option>
								<option value='<?PHP echo $link_est;?>MT'>Mato Grosso</option>
								<option value='<?PHP echo $link_est;?>MS'>Mato Grosso do Sul</option>
								<option value='<?PHP echo $link_est;?>MG'>Minas Gerais</option>
								<option value="<?PHP echo $link_est;?>PA">Par&aacute;</option>
								<option value="<?PHP echo $link_est;?>PB">Para&iacute;ba</option>
								<option value="<?PHP echo $link_est;?>PR">Paran&aacute;</option>
								<option value='<?PHP echo $link_est;?>PE'>Pernambuco</option>
								<option value="<?PHP echo $link_est;?>PI">Piau&iacute;</option>
								<option value='<?PHP echo $link_est;?>RJ'>Rio de Janeiro</option>
								<option value='<?PHP echo $link_est;?>RN'>Rio Grande do Norte</option>
								<option value='<?PHP echo $link_est;?>RS'>Rio Grande do Sul</option>
								<option value="<?PHP echo $link_est;?>RO">Rond&ocirc;nia</option>
								<option value='<?PHP echo $link_est;?>RR'>Roraima</option>
								<option value='<?PHP echo $link_est;?>SC'>Santa Catarina</option>
								<option value="<?PHP echo $link_est;?>SP">S&atilde;o Paulo</option>
								<option value='<?PHP echo $link_est;?>SE'>Sergipe</option>
								<option value='<?PHP echo $link_est;?>TO'>Tocantins</option>
							</select>					</td>
					<td>
							<?PHP
							if (!empty($_GET["uf_end"]))
							{
								
								//conectar();
								$vl_uf=$_GET["uf_end"];
								$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cidade");
								echo "<label>Cidade:</label>";		
								$vlr_linha=$lst_cid->ListDados (++$ind);
							
							?>
				</tr>
				<tr>
					<td colspan="2"> <label>igreja:</label>
    					<input name="razao" class="form-control" type="text" id="razao" 
    					required="required" tabindex = "<?php echo ++$ind; ?>" size="55">
    				</td>
				</tr>
				<tr>
					<td><label>Setor:</label>
						<?php
						$setor = new setor(++$ind);
						?>					</td>
					<td><label>CNPJ</label>
						<input name="cnpj" type="text" class="form-control" id="cnpj" tabindex = "<?php echo ++$ind; ?>" >
					</td>
				</tr>
				<tr>
					<td><label>Endereço Web</label>
						<input name="site" class="form-control" type="text" id="site" tabindex = "<?php echo ++$ind; ?>" value='www.adpb.com.br'>
					</td>
					<td><label>Email:</label>
                      <input name="email" class="form-control" type="text" id="email" tabindex = "<?php echo ++$ind; ?>" />
                     </td>
				</tr>
				<tr>
				  <td colspan="2"><label>Pastor ou Dirigente (Rol ou Nome)</label>
                    <input name="pastor" required="required" class="form-control" type="text" id="pastor" tabindex = "<?php echo ++$ind; ?>" size="55" />
                  </td>
			  </tr>
				<tr>
					<td><label>Endereço</label>
						<input name="rua" required="required" class="form-control" type="text" id="rua" tabindex = "<?php echo ++$ind; ?>" size="30" >
					</td>
					<td><label>Número</label>
						<input name="numero" required="required" class="form-control" type="text" id="numero" tabindex = "<?php echo ++$ind; ?>" size="5">
					</td>
				</tr>
				<tr>
					<td><label>CEP</label>
						<input name="cep" class="form-control" type="text" id="cep" tabindex = "<?php echo ++$ind; ?>">
					</td>
			<td><label>Telefone</label>
				<input name="fone" class="form-control" type="text" id="fone" tabindex = "<?php echo ++$ind; ?>">	
			</td>
				</tr>
				<tr>
					<td><label>Rol do 1º Secretario</label>
						<input name="secretario1" class="form-control" type="text" id="secretario1" tabindex = "<?php echo ++$ind; ?>">
					</td>
					<td><label>Rol do 2º Secretario</label>
						<input name="secretario2" class="form-control" type="text" id="secretario2" tabindex = "<?php echo ++$ind; ?>">
					</td>
				</tr>
			</thead>
		</table>
	<?PHP } ?>

   
  </fieldset>
	  <?php 
	  $ceia = new formceia();
		echo $ceia->formulario(++$ind);
	  ?>
  <fieldset>
  <legend>Dia do Circulo de Ora&ccedil;&atilde;o</legend>
		<table style="text-align: left; width: 100%;">
			<tbody>
			<tr>
			<td>Segunda
	  		<input type="radio" id="dia" name="oracao" value="2" tabindex = "<?php echo ++$ind; ?>" ></td>
	  		<td>Terça
	  		<input type="radio" id="dia" name="oracao" value="3" tabindex = "<?php echo ++$ind; ?>" ></td>
	  		<td>Quarta
	  		<input type="radio" id="dia" name="oracao" value="4" tabindex = "<?php echo ++$ind; ?>" ></td>
	  		<td>Quinta
	  		<input type="radio" id="dia" name="oracao" value="5" tabindex = "<?php echo ++$ind; ?>" ></td>
	  		<td>Sexta
	  		<input type="radio" id="dia" name="oracao" value="6" tabindex = "<?php echo ++$ind; ?>" ></td>
	  		<td>Sábado
	  		<input type="radio" id="dia" name="oracao" value="7" tabindex = "<?php echo ++$ind; ?>" ></td>
	  		</tr>
	  		</tbody>
	  	</table>
  </fieldset>
   <label>
    <input type="hidden" name="escolha" value="models/cad_igreja.php">
    <input type="submit"  class="btn btn-primary" name="Submit" value="Cadastrar" tabindex = "<?php echo ++$ind; ?>" >
    </label>
</form>
<?PHP
}elseif ($_SESSION['nivel']>4)//Verifica se o usuário tem autorização para o cadastro e realiza inserção 
{
	
	//Inserir dados na tadela igreja
	$log = "Inserido por: {$_SESSION["valid_user"]}";
	
	$igreja = htmlentities ($_POST["igreja"]);
	$cidade = (int)$_POST["cidade"];
	
	$rec = new bairro($cidade, $igreja);
	
	if (!$rec->exitecad()) { //verifica se o igreja já está cadastrado para esta cidade
	
	$value = "'','$igreja','$cidade',NULL,'$log'";
	$carta = new insert ("$value","igreja");
	$carta->inserir();
	}
	$mostracidade = new DBRecord("cidade",$cidade,"id");
	echo $mostracidade->nome."!</h2";

		echo "<h3><a href=./?escolha=tab_auxiliar/cadastro_igreja&uf_end=PB>Cadastrar outra igreja? Clique aqui...</a></h3>";
		echo "<script> alert('Cadastrar outra igreja!'); location.href='<?PHP echo $link_est;?>PB';</script>";

	
}else{
	echo "Desculpe! Mas voc&ecirc; não te autoriza&ccedil;&atilde;o para esta terefa.";
}
/*
require_once ("HTML/QuickForm.php");
require_once ("HTML/QuickForm/Renderer/QuickHtml.php");

$teams = array ('Brasil','Alemanha','Argentina','itália');

$form = new HTML_QuickForm();
//$element =& $form->addElement('autocomplete','teams','Times favoritos: ');
//$element->setOptions($teams);
$element =& $form->addElement('autocomplete', 'iautoComp', array('Your favourite fruit:', 'This is autocomplete element.<br />Start typing and see how it suggests possible completions.'), array('Pear', 'Orange', 'Apple'), array('size' => 30));
   
echo $form;
			*/
?>