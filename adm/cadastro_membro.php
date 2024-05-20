<?php
if ($_SESSION["setor"]!='3' && $_SESSION["setor"]!='99'){
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	<h4>&Aacute;rea restrita &agrave; <strong>Secretaria Executiva!</strong></h4>
	<h5>Uso exclusivo deste setor!</h5>
	</div>
	<?php
	exit;
}

	if (empty($_GET['uf_nasc']) && empty($_POST['uf_nasc'])){
		$ufNasc = "PB";
	}elseif (!empty($_POST['uf_nasc'])) {
		$ufNasc = $_POST['uf_nasc'];
	}else{
		$ufNasc = $_GET['uf_nasc'];
	}
	$cpf_val = (empty($_GET['cpf_val'])) ? 'null' : $_GET['cpf_val'] ;
?>
<fieldset>
<legend>Dados Pessoais - Cadastro de Membro </legend>
<form method="get" action="" >
<table>
	<tbody>
		<tr>
			<td colspan="2"><label>Estado Natal: </label>
	   	<select name="uf_nasc" id="uf_nasc" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>"
	   	class="form-control" >
		  <?PHP
				$estnatal = new List_UF('estado', 'nome','uf_nasc');
				echo $estnatal->List_Selec_pop('escolha=adm/cadastro_membro.php&uf_nasc=',$ufNasc);
			?>
		  </select>
				<input name="ufNasc" type="hidden" required="required"
				value="<?php echo $ufNasc;?>" />
		</td>
			<td>
			  <?PHP
					$lst_cid = new sele_cidade("cidade",$ufNasc,"coduf","nome","cid_nasc");
					echo "<label>Cidade Natal:</label>";
					$vlr_linha=$lst_cid->ListDados (++$ind);//3 � o indice do formul�rio
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
	<label>Nome:</label>
	<input name="nome_cad" class="form-control" type="text" required="required"
	id="nome_cad" tabindex="<?PHP echo ++$ind; ?>" size="40" /></td>
		<td>
	<label>CPF:</label>
	<input name="cpf" type="text" id="cpf_val" tabindex="<?PHP echo ++$ind; ?>" class="form-control"
	placeholder="CPF em branco ser&aacute; utilizado o n&ordm; do rol" value="<?PHP echo $cpf_val;?>"/>
		</td>
		</tr>
		<tr>
			<td>

	<label>Nacionalidade:</label>
	  <select name="nacionalidade" id="nacionalidade" class="form-control" tabindex="<?PHP echo ++$ind; ?>" >
		<option value="Brasileira">Brasil</option>
	 	<option value="Afeganist�o">Afeganist�o</option>
		<option value="�frica do Sul">�frica do Sul</option>
		<option value="Alb�nia">Alb�nia</option>
		<option value="Alemanha">Alemanha</option>
		<option value="Andorra">Andorra</option>
		<option value="Angola">Angola</option>
		<option value="Anguilla">Anguilla</option>
		<option value="Ant�rtida">Ant�rtida</option>
		<option value="Ant�gua e Barbuda">Ant�gua e Barbuda</option>
		<option value="Antilhas Holandesas">Antilhas Holandesas</option>
		<option value="Ar�bia Saudita">Ar�bia Saudita</option>
		<option value="Arg�lia">Arg�lia</option>
		<option value="Argentina">Argentina</option>
		<option value="Arm�nia">Arm�nia</option>
		<option value="Aruba">Aruba</option>
		<option value="Austr�lia">Austr�lia</option>
		<option value="�ustria">�ustria</option>
		<option value="Azerbaij�o">Azerbaij�o</option>
		<option value="Bahamas">Bahamas</option>
		<option value="Bangladesh">Bangladesh</option>
		<option value="Barbados">Barbados</option>
		<option value="Barein">Barein</option>
		<option value="B�lgica">B�lgica</option>
		<option value="Belize">Belize</option>
		<option value="Benin">Benin</option>
		<option value="Bermudas">Bermudas</option>
		<option value="Bielo-R�ssia">Bielo-R�ssia</option>
		<option value="Bol�via">Bol�via</option>
		<option value="B�snia-Herzegovina">B�snia-Herzegovina</option>
		<option value="Botsuana">Botsuana</option>
		<option value="Brunei Darussalam">Brunei Darussalam</option>
		<option value="Bulg�ria">Bulg�ria</option>
		<option value="Burkina Fasso">Burkina Fasso</option>
		<option value="Burundi">Burundi</option>
		<option value="But�o">But�o</option>
		<option value="Cabo Verde">Cabo Verde</option>
		<option value="Camar�es">Camar�es</option>
		<option value="Camboja">Camboja</option>
		<option value="Canad�">Canad�</option>
		<option value="Catar">Catar</option>
		<option value="Cayman, Ilhas">Cayman, Ilhas</option>
		<option value="Cazaquist�o">Cazaquist�o</option>
		<option value="Chade">Chade</option>
		<option value="Chile">Chile</option>
		<option value="China">China</option>
		<option value="Chipre">Chipre</option>
		<option value="Cingapura">Cingapura</option>
		<option value="Col�mbia">Col�mbia</option>
		<option value="Congo">Congo</option>
		<option value="Cor�ia do Norte">Cor�ia do Norte</option>
		<option value="Cor�ia do Sul">Cor�ia do Sul</option>
		<option value="Costa do Marfim">Costa do Marfim</option>
		<option value="Costa Rica">Costa Rica</option>
		<option value="Cro�cia">Cro�cia</option>
		<option value="Cuba">Cuba</option>
		<option value="Dinamarca">Dinamarca</option>
		<option value="Djibuti">Djibuti</option>
		<option value="Dominica">Dominica</option>
		<option value="Egito">Egito</option>
		<option value="El Salvador">El Salvador</option>
		<option value="Emirados �rabes Unidos">Emirados �rabes Unidos</option>
		<option value="Equador">Equador</option>
		<option value="Eritr�ia">Eritr�ia</option>
		<option value="Eslov�quia">Eslov�quia</option>
		<option value="Eslov�nia">Eslov�nia</option>
		<option value="Espanha">Espanha</option>
		<option value="Estados Unidos">Estados Unidos</option>
		<option value="Est�nia">Est�nia</option>
		<option value="Eti�pia">Eti�pia</option>
		<option value="Federa��o Russa">Federa��o Russa</option>
		<option value="Fiji">Fiji</option>
		<option value="Filipinas">Filipinas</option>
		<option value="Finl�ndia">Finl�ndia</option>
		<option value="Fran�a">Fran�a</option>
		<option value="Gab�o">Gab�o</option>
		<option value="G�mbia">G�mbia</option>
		<option value="Gana">Gana</option>
		<option value="Ge�rgia">Ge�rgia</option>
		<option value="Ge�rgia do Sul e Ilhas Sandwich do Sul">Ge�rgia do Sul e Ilhas Sandwich do Sul</option>
		<option value="Gibraltar">Gibraltar</option>
		<option value="Granada">Granada</option>
		<option value="Gr�cia">Gr�cia</option>
		<option value="Groenl�ndia">Groenl�ndia</option>
		<option value="Guadalupe">Guadalupe</option>
		<option value="Guam">Guam</option>
		<option value="Guatemala">Guatemala</option>
		<option value="Guernsey">Guernsey</option>
		<option value="Guiana">Guiana</option>
		<option value="Guiana Francesa">Guiana Francesa</option>
		<option value="Guin�">Guin�</option>
		<option value="Guin� Equatorial">Guin� Equatorial</option>
		<option value="Guin�-Bissau">Guin�-Bissau</option>
		<option value="Haiti">Haiti</option>
		<option value="Holanda">Holanda</option>
		<option value="Honduras">Honduras</option>
		<option value="Hong Kong">Hong Kong</option>
		<option value="Hungria">Hungria</option>
		<option value="I�men">I�men</option>
		<option value="Ilha Bouvet">Ilha Bouvet</option>
		<option value="Ilha Christmas">Ilha Christmas</option>
		<option value="Ilha de Man">Ilha de Man</option>
		<option value="Ilha Norfolk">Ilha Norfolk</option>
		<option value="Ilhas Cocos (Keeling)">Ilhas Cocos (Keeling)</option>
		<option value="Ilhas Comores">Ilhas Comores</option>
		<option value="Ilhas Cook">Ilhas Cook</option>
		<option value="Ilhas Fero�">Ilhas Fero�</option>
		<option value="Ilhas Heard e McDonald">Ilhas Heard e McDonald</option>
		<option value="Ilhas Malvinas (Falkland)">Ilhas Malvinas (Falkland)</option>
		<option value="Ilhas Marianas do Norte">Ilhas Marianas do Norte</option>
		<option value="Ilhas Marshall">Ilhas Marshall</option>
		<option value="Ilhas Maur�cio">Ilhas Maur�cio</option>
		<option value="Ilhas Salom�o">Ilhas Salom�o</option>
		<option value="Ilhas Seychelles">Ilhas Seychelles</option>
		<option value="Ilhas Virgens Americanas">Ilhas Virgens Americanas</option>
		<option value="Ilhas Virgens Brit�nicas">Ilhas Virgens Brit�nicas</option>
		<option value="Ilhas Wallis e Futuna">Ilhas Wallis e Futuna</option>
		<option value="Ilhas �land">Ilhas �land</option>
		<option value="�ndia">�ndia</option>
		<option value="Indon�sia">Indon�sia</option>
		<option value="Ir�">Ir�</option>
		<option value="Iraque">Iraque</option>
		<option value="Irlanda">Irlanda</option>
		<option value="Isl�ndia">Isl�ndia</option>
		<option value="Israel">Israel</option>
		<option value="It�lia">It�lia</option>
		<option value="Jamaica">Jamaica</option>
		<option value="Jap�o">Jap�o</option>
		<option value="Jersey">Jersey</option>
		<option value="Jord�nia">Jord�nia</option>
		<option value="Kiribati">Kiribati</option>
		<option value="Kuwait">Kuwait</option>
		<option value="Lesoto">Lesoto</option>
		<option value="Let�nia">Let�nia</option>
		<option value="L�bano">L�bano</option>
		<option value="Lib�ria">Lib�ria</option>
		<option value="L�bia">L�bia</option>
		<option value="Liechtenstein">Liechtenstein</option>
		<option value="Litu�nia">Litu�nia</option>
		<option value="Luxemburgo">Luxemburgo</option>
		<option value="Macau">Macau</option>
		<option value="Maced�nia">Maced�nia</option>
		<option value="Madagascar">Madagascar</option>
		<option value="Mal�sia">Mal�sia</option>
		<option value="Malau�">Malau�</option>
		<option value="Maldivas">Maldivas</option>
		<option value="Mali">Mali</option>
		<option value="Malta">Malta</option>
		<option value="Marrocos">Marrocos</option>
		<option value="Martinica">Martinica</option>
		<option value="Maurit�nia">Maurit�nia</option>
		<option value="Mayotte">Mayotte</option>
		<option value="M�xico">M�xico</option>
		<option value="Micron�sia">Micron�sia</option>
		<option value="Mo�ambique">Mo�ambique</option>
		<option value="Mold�via">Mold�via</option>
		<option value="M�naco">M�naco</option>
		<option value="Mong�lia">Mong�lia</option>
		<option value="Montenegro">Montenegro</option>
		<option value="Montserrat">Montserrat</option>
		<option value="Myanmar (antiga Birm�nia)">Myanmar (antiga Birm�nia)</option>
		<option value="Nam�bia">Nam�bia</option>
		<option value="Nauru">Nauru</option>
		<option value="Nepal">Nepal</option>
		<option value="Nicar�gua">Nicar�gua</option>
		<option value="N�ger">N�ger</option>
		<option value="Nig�ria">Nig�ria</option>
		<option value="Niue">Niue</option>
		<option value="Noruega">Noruega</option>
		<option value="Nova Caled�nia">Nova Caled�nia</option>
		<option value="Nova Zel�ndia">Nova Zel�ndia</option>
		<option value="Om�">Om�</option>
		<option value="Palau">Palau</option>
		<option value="Palestina">Palestina</option>
		<option value="Panam�">Panam�</option>
		<option value="Papua-Nova Guin�">Papua-Nova Guin�</option>
		<option value="Paquist�o">Paquist�o</option>
		<option value="Paraguai">Paraguai</option>
		<option value="Peru">Peru</option>
		<option value="Pitcairn">Pitcairn</option>
		<option value="Polin�sia Francesa">Polin�sia Francesa</option>
		<option value="Pol�nia">Pol�nia</option>
		<option value="Porto Rico">Porto Rico</option>
		<option value="Portugal">Portugal</option>
		<option value="Qu�nia">Qu�nia</option>
		<option value="Quirguist�o">Quirguist�o</option>
		<option value="Reino Unido">Reino Unido</option>
		<option value="Rep�blica Centro-Africana">Rep�blica Centro-Africana</option>
		<option value="Rep�blica Democr�tica do Congo">Rep�blica Democr�tica do Congo</option>
		<option value="Rep�blica Democr�tica Popular do Laos">Rep�blica Democr�tica Popular do Laos</option>
		<option value="Rep�blica Dominicana">Rep�blica Dominicana</option>
		<option value="Rep�blica Tcheca">Rep�blica Tcheca</option>
		<option value="Reuni�o">Reuni�o</option>
		<option value="Rom�nia">Rom�nia</option>
		<option value="Ruanda">Ruanda</option>
		<option value="Saara Ocidental">Saara Ocidental</option>
		<option value="Samoa">Samoa</option>
		<option value="Samoa Americana">Samoa Americana</option>
		<option value="San Marino">San Marino</option>
		<option value="Santa Helena">Santa Helena</option>
		<option value="Santa L�cia">Santa L�cia</option>
		<option value="S�o Bartolomeu">S�o Bartolomeu</option>
		<option value="S�o Crist�v�o e N�vis">S�o Crist�v�o e N�vis</option>
		<option value="S�o Martinho">S�o Martinho</option>
		<option value="S�o Tom� e Pr�ncipe">S�o Tom� e Pr�ncipe</option>
		<option value="S�o Vincente e Granadinas">S�o Vincente e Granadinas</option>
		<option value="Senegal">Senegal</option>
		<option value="Serra Leoa">Serra Leoa</option>
		<option value="S�rvia">S�rvia</option>
		<option value="S�ria">S�ria</option>
		<option value="Som�lia">Som�lia</option>
		<option value="Sri Lanka">Sri Lanka</option>
		<option value="St. Pierre e Miquelon">St. Pierre e Miquelon</option>
		<option value="Suazil�ndia">Suazil�ndia</option>
		<option value="Sud�o">Sud�o</option>
		<option value="Su�cia">Su�cia</option>
		<option value="Su��a">Su��a</option>
		<option value="Suriname">Suriname</option>
		<option value="Svalbard e Jan Mayen">Svalbard e Jan Mayen</option>
		<option value="Tail�ndia">Tail�ndia</option>
		<option value="Taiwan">Taiwan</option>
		<option value="Tajiquist�o">Tajiquist�o</option>
		<option value="Tanz�nia">Tanz�nia</option>
		<option value="Territ�rio Brit�nico do Oceano �ndico">Territ�rio Brit�nico do Oceano �ndico</option>
		<option value="Territ�rios Franceses do Sul">Territ�rios Franceses do Sul</option>
		<option value="Territ�rios Insulares dos Estados Unidos">Territ�rios Insulares dos Estados Unidos</option>
		<option value="Timor Leste">Timor Leste</option>
		<option value="Togo">Togo</option>
		<option value="Tonga">Tonga</option>
		<option value="Toquelau">Toquelau</option>
		<option value="Trinidad e Tobago">Trinidad e Tobago</option>
		<option value="Tun�sia">Tun�sia</option>
		<option value="Turcomenist�o">Turcomenist�o</option>
		<option value="Turks e Caicos">Turks e Caicos</option>
		<option value="Turquia">Turquia</option>
		<option value="Tuvalu">Tuvalu</option>
		<option value="Ucr�nia">Ucr�nia</option>
		<option value="Uganda">Uganda</option>
		<option value="Uruguai">Uruguai</option>
		<option value="Uzbequist�o">Uzbequist�o</option>
		<option value="Vanuatu">Vanuatu</option>
		<option value="Vaticano">Vaticano</option>
		<option value="Venezuela">Venezuela</option>
		<option value="Vietn�">Vietn�</option>
		<option value="Z�mbia">Z�mbia</option>
		<option value="Zimb�bue">Zimb�bue</option>
	</select>

	</td>
			<td><label>&nbsp;</label>
			<input name="nacionalidade1" class="form-control" type="text"
			size="20" onselect="1" tabindex="<?PHP echo ++$ind; ?>"/>
	    </td>
			<td><label>&nbsp;</label>
	<input type="submit" class="btn btn-primary" name="Submit" value="Continuar..." tabindex="<?PHP echo ++$ind; ?>"/>
 </td>
		</tr>
	</tbody>
</table>
<dl>
	<dt id="css">Se o membro cadastrado n&atilde;o for brasileiro use o "Bot&atilde;o" abaixo?</dt>
	<dd>
		<div class="row">
		  <div class="col-xs-4">
		    <label>Cidade do Pa�s:</label>
		    <input name="cidExtrang" type="text" class="form-control"
		    tabindex='<?PHP echo ++$ind; ?>' placeholder="Cidade do pa�s deste Membro">
		  </div>
		  <div class="col-xs-2">
		    <label>UF do Pa�s:</label>
		    <input name="ufExtrang" type="text" class="form-control"
		    tabindex='<?PHP echo ++$ind; ?>' placeholder="UF do pa�s">
		  </div>
		</div>
	</dd>
</dl>
  <input name="escolha" type="hidden" value="adm/cad_membro_end.php" />
</form>
</fieldset>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {
		var textoVer = '<a href="#" class="btn btn-primary" style="color:#fff;text-decoration:none;">&Eacute; estrangeiro?</a>';
		$('dd').css('display', 'none');
		$('dt').after(textoVer);

		$('a').click(function(){
			if ($(this).text() == '� estrangeiro?') {
				$(this).next().next().toggle();
				$(this).text('Fechar se Brasileiro!');
				$(this).next()
				.css({
				border: '1px solid #c30',
				padding: '5px 10px',
				background: '#ccc'
				})
				.slideToggle('slow');
			} else {
				$(this).text('� estrangeiro?');
				$(this).next().slideToggle('slow');
				$(this).next().next().toggle();
			}
		});
	});
   // ]]>
</script>
