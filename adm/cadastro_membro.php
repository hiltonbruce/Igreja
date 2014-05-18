<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");

unset($_SESSION["nacao"]);//Limpa estas variáveis
unset($_SESSION["cid_natal"]);
unset($_SESSION["cid_end"]);
unset($_SESSION["cpf"]);
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<fieldset>
<legend>Dados Pessoais - Cadastro de Membro</legend>
<form method="post" action="">
<table>
	<tbody>
		<tr>
			<td colspan="2"><label>Estado Natal: </label>
	   	<select name="uf_nasc" id="uf_nasc" class="form-control" idonchange="MM_jumpMenu('parent',this,0)"
	   	 tabindex="<?PHP echo ++$ind; ?>" >
	  <?PHP
			$estnatal = new List_UF('estado', 'nome','uf_nasc');
			echo $estnatal->List_Selec_pop('escolha=adm/cadastro_membro.php&uf=',$_GET['uf']);
		?>
	  </select></td>
			<td>
      
	  <?PHP
		if (!empty($_GET["uf"])){
		$vl_uf=$_GET["uf"];
		$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cid_nasc");
		echo "<label>Cidade Natal:</label>";		
		$vlr_linha=$lst_cid->ListDados (++$ind);//3 é o indice do formulário
		}
		?></td>
		</tr>
		<tr>
			<td colspan="2">
	<label>Nome:</label>
	<input name="nome_cad" class="form-control" type="text" required="required"
	id="nome_cad" tabindex="<?PHP echo ++$ind; ?>" size="40" /></td>
		<td>
	<label>CPF:</label>
	<input name="cpf" type="text" id="cpf" tabindex="<?PHP echo ++$ind; ?>" class="form-control" 
	placeholder="CPF em branco ser&aacute; utilizado o n&ordm; do rol" value="<?PHP echo $_SESSION["cpf"];?>"/>
		</td>
		</tr>
		<tr>
			<td>
  
	<label>Nacionalidade:</label>
	  <select name="nacionalidade" id="nacionalidade" class="form-control" tabindex="<?PHP echo ++$ind; ?>" >
		<option value="Brasileira">Brasil</option>
	 	<option value="Afeganistão">Afeganistão</option>
		<option value="África do Sul">África do Sul</option>
		<option value="Albânia">Albânia</option>
		<option value="Alemanha">Alemanha</option>
		<option value="Andorra">Andorra</option>
		<option value="Angola">Angola</option>
		<option value="Anguilla">Anguilla</option>
		<option value="Antártida">Antártida</option>
		<option value="Antígua e Barbuda">Antígua e Barbuda</option>
		<option value="Antilhas Holandesas">Antilhas Holandesas</option>
		<option value="Arábia Saudita">Arábia Saudita</option>
		<option value="Argélia">Argélia</option>
		<option value="Argentina">Argentina</option>
		<option value="Armênia">Armênia</option>
		<option value="Aruba">Aruba</option>
		<option value="Austrália">Austrália</option>
		<option value="Áustria">Áustria</option>
		<option value="Azerbaijão">Azerbaijão</option>
		<option value="Bahamas">Bahamas</option>
		<option value="Bangladesh">Bangladesh</option>
		<option value="Barbados">Barbados</option>
		<option value="Barein">Barein</option>
		<option value="Bélgica">Bélgica</option>
		<option value="Belize">Belize</option>
		<option value="Benin">Benin</option>
		<option value="Bermudas">Bermudas</option>
		<option value="Bielo-Rússia">Bielo-Rússia</option>
		<option value="Bolívia">Bolívia</option>
		<option value="Bósnia-Herzegovina">Bósnia-Herzegovina</option>
		<option value="Botsuana">Botsuana</option>
		<option value="Brunei Darussalam">Brunei Darussalam</option>
		<option value="Bulgária">Bulgária</option>
		<option value="Burkina Fasso">Burkina Fasso</option>
		<option value="Burundi">Burundi</option>
		<option value="Butão">Butão</option>
		<option value="Cabo Verde">Cabo Verde</option>
		<option value="Camarões">Camarões</option>
		<option value="Camboja">Camboja</option>
		<option value="Canadá">Canadá</option>
		<option value="Catar">Catar</option>
		<option value="Cayman, Ilhas">Cayman, Ilhas</option>
		<option value="Cazaquistão">Cazaquistão</option>
		<option value="Chade">Chade</option>
		<option value="Chile">Chile</option>
		<option value="China">China</option>
		<option value="Chipre">Chipre</option>
		<option value="Cingapura">Cingapura</option>
		<option value="Colômbia">Colômbia</option>
		<option value="Congo">Congo</option>
		<option value="Coréia do Norte">Coréia do Norte</option>
		<option value="Coréia do Sul">Coréia do Sul</option>
		<option value="Costa do Marfim">Costa do Marfim</option>
		<option value="Costa Rica">Costa Rica</option>
		<option value="Croácia">Croácia</option>
		<option value="Cuba">Cuba</option>
		<option value="Dinamarca">Dinamarca</option>
		<option value="Djibuti">Djibuti</option>
		<option value="Dominica">Dominica</option>
		<option value="Egito">Egito</option>
		<option value="El Salvador">El Salvador</option>
		<option value="Emirados Árabes Unidos">Emirados Árabes Unidos</option>
		<option value="Equador">Equador</option>
		<option value="Eritréia">Eritréia</option>
		<option value="Eslováquia">Eslováquia</option>
		<option value="Eslovênia">Eslovênia</option>
		<option value="Espanha">Espanha</option>
		<option value="Estados Unidos">Estados Unidos</option>
		<option value="Estônia">Estônia</option>
		<option value="Etiópia">Etiópia</option>
		<option value="Federação Russa">Federação Russa</option>
		<option value="Fiji">Fiji</option>
		<option value="Filipinas">Filipinas</option>
		<option value="Finlândia">Finlândia</option>
		<option value="França">França</option>
		<option value="Gabão">Gabão</option>
		<option value="Gâmbia">Gâmbia</option>
		<option value="Gana">Gana</option>
		<option value="Geórgia">Geórgia</option>
		<option value="Geórgia do Sul e Ilhas Sandwich do Sul">Geórgia do Sul e Ilhas Sandwich do Sul</option>
		<option value="Gibraltar">Gibraltar</option>
		<option value="Granada">Granada</option>
		<option value="Grécia">Grécia</option>
		<option value="Groenlândia">Groenlândia</option>
		<option value="Guadalupe">Guadalupe</option>
		<option value="Guam">Guam</option>
		<option value="Guatemala">Guatemala</option>
		<option value="Guernsey">Guernsey</option>
		<option value="Guiana">Guiana</option>
		<option value="Guiana Francesa">Guiana Francesa</option>
		<option value="Guiné">Guiné</option>
		<option value="Guiné Equatorial">Guiné Equatorial</option>
		<option value="Guiné-Bissau">Guiné-Bissau</option>
		<option value="Haiti">Haiti</option>
		<option value="Holanda">Holanda</option>
		<option value="Honduras">Honduras</option>
		<option value="Hong Kong">Hong Kong</option>
		<option value="Hungria">Hungria</option>
		<option value="Iêmen">Iêmen</option>
		<option value="Ilha Bouvet">Ilha Bouvet</option>
		<option value="Ilha Christmas">Ilha Christmas</option>
		<option value="Ilha de Man">Ilha de Man</option>
		<option value="Ilha Norfolk">Ilha Norfolk</option>
		<option value="Ilhas Cocos (Keeling)">Ilhas Cocos (Keeling)</option>
		<option value="Ilhas Comores">Ilhas Comores</option>
		<option value="Ilhas Cook">Ilhas Cook</option>
		<option value="Ilhas Feroé">Ilhas Feroé</option>
		<option value="Ilhas Heard e McDonald">Ilhas Heard e McDonald</option>
		<option value="Ilhas Malvinas (Falkland)">Ilhas Malvinas (Falkland)</option>
		<option value="Ilhas Marianas do Norte">Ilhas Marianas do Norte</option>
		<option value="Ilhas Marshall">Ilhas Marshall</option>
		<option value="Ilhas Maurício">Ilhas Maurício</option>
		<option value="Ilhas Salomão">Ilhas Salomão</option>
		<option value="Ilhas Seychelles">Ilhas Seychelles</option>
		<option value="Ilhas Virgens Americanas">Ilhas Virgens Americanas</option>
		<option value="Ilhas Virgens Britânicas">Ilhas Virgens Britânicas</option>
		<option value="Ilhas Wallis e Futuna">Ilhas Wallis e Futuna</option>
		<option value="Ilhas Åland">Ilhas Åland</option>
		<option value="Índia">Índia</option>
		<option value="Indonésia">Indonésia</option>
		<option value="Irã">Irã</option>
		<option value="Iraque">Iraque</option>
		<option value="Irlanda">Irlanda</option>
		<option value="Islândia">Islândia</option>
		<option value="Israel">Israel</option>
		<option value="Itália">Itália</option>
		<option value="Jamaica">Jamaica</option>
		<option value="Japão">Japão</option>
		<option value="Jersey">Jersey</option>
		<option value="Jordânia">Jordânia</option>
		<option value="Kiribati">Kiribati</option>
		<option value="Kuwait">Kuwait</option>
		<option value="Lesoto">Lesoto</option>
		<option value="Letônia">Letônia</option>
		<option value="Líbano">Líbano</option>
		<option value="Libéria">Libéria</option>
		<option value="Líbia">Líbia</option>
		<option value="Liechtenstein">Liechtenstein</option>
		<option value="Lituânia">Lituânia</option>
		<option value="Luxemburgo">Luxemburgo</option>
		<option value="Macau">Macau</option>
		<option value="Macedônia">Macedônia</option>
		<option value="Madagascar">Madagascar</option>
		<option value="Malásia">Malásia</option>
		<option value="Malauí">Malauí</option>
		<option value="Maldivas">Maldivas</option>
		<option value="Mali">Mali</option>
		<option value="Malta">Malta</option>
		<option value="Marrocos">Marrocos</option>
		<option value="Martinica">Martinica</option>
		<option value="Mauritânia">Mauritânia</option>
		<option value="Mayotte">Mayotte</option>
		<option value="México">México</option>
		<option value="Micronésia">Micronésia</option>
		<option value="Moçambique">Moçambique</option>
		<option value="Moldávia">Moldávia</option>
		<option value="Mônaco">Mônaco</option>
		<option value="Mongólia">Mongólia</option>
		<option value="Montenegro">Montenegro</option>
		<option value="Montserrat">Montserrat</option>
		<option value="Myanmar (antiga Birmânia)">Myanmar (antiga Birmânia)</option>
		<option value="Namíbia">Namíbia</option>
		<option value="Nauru">Nauru</option>
		<option value="Nepal">Nepal</option>
		<option value="Nicarágua">Nicarágua</option>
		<option value="Níger">Níger</option>
		<option value="Nigéria">Nigéria</option>
		<option value="Niue">Niue</option>
		<option value="Noruega">Noruega</option>
		<option value="Nova Caledônia">Nova Caledônia</option>
		<option value="Nova Zelândia">Nova Zelândia</option>
		<option value="Omã">Omã</option>
		<option value="Palau">Palau</option>
		<option value="Palestina">Palestina</option>
		<option value="Panamá">Panamá</option>
		<option value="Papua-Nova Guiné">Papua-Nova Guiné</option>
		<option value="Paquistão">Paquistão</option>
		<option value="Paraguai">Paraguai</option>
		<option value="Peru">Peru</option>
		<option value="Pitcairn">Pitcairn</option>
		<option value="Polinésia Francesa">Polinésia Francesa</option>
		<option value="Polônia">Polônia</option>
		<option value="Porto Rico">Porto Rico</option>
		<option value="Portugal">Portugal</option>
		<option value="Quênia">Quênia</option>
		<option value="Quirguistão">Quirguistão</option>
		<option value="Reino Unido">Reino Unido</option>
		<option value="República Centro-Africana">República Centro-Africana</option>
		<option value="República Democrática do Congo">República Democrática do Congo</option>
		<option value="República Democrática Popular do Laos">República Democrática Popular do Laos</option>
		<option value="República Dominicana">República Dominicana</option>
		<option value="República Tcheca">República Tcheca</option>
		<option value="Reunião">Reunião</option>
		<option value="Romênia">Romênia</option>
		<option value="Ruanda">Ruanda</option>
		<option value="Saara Ocidental">Saara Ocidental</option>
		<option value="Samoa">Samoa</option>
		<option value="Samoa Americana">Samoa Americana</option>
		<option value="San Marino">San Marino</option>
		<option value="Santa Helena">Santa Helena</option>
		<option value="Santa Lúcia">Santa Lúcia</option>
		<option value="São Bartolomeu">São Bartolomeu</option>
		<option value="São Cristóvão e Névis">São Cristóvão e Névis</option>
		<option value="São Martinho">São Martinho</option>
		<option value="São Tomé e Príncipe">São Tomé e Príncipe</option>
		<option value="São Vincente e Granadinas">São Vincente e Granadinas</option>
		<option value="Senegal">Senegal</option>
		<option value="Serra Leoa">Serra Leoa</option>
		<option value="Sérvia">Sérvia</option>
		<option value="Síria">Síria</option>
		<option value="Somália">Somália</option>
		<option value="Sri Lanka">Sri Lanka</option>
		<option value="St. Pierre e Miquelon">St. Pierre e Miquelon</option>
		<option value="Suazilândia">Suazilândia</option>
		<option value="Sudão">Sudão</option>
		<option value="Suécia">Suécia</option>
		<option value="Suíça">Suíça</option>
		<option value="Suriname">Suriname</option>
		<option value="Svalbard e Jan Mayen">Svalbard e Jan Mayen</option>
		<option value="Tailândia">Tailândia</option>
		<option value="Taiwan">Taiwan</option>
		<option value="Tajiquistão">Tajiquistão</option>
		<option value="Tanzânia">Tanzânia</option>
		<option value="Território Britânico do Oceano Índico">Território Britânico do Oceano Índico</option>
		<option value="Territórios Franceses do Sul">Territórios Franceses do Sul</option>
		<option value="Territórios Insulares dos Estados Unidos">Territórios Insulares dos Estados Unidos</option>
		<option value="Timor Leste">Timor Leste</option>
		<option value="Togo">Togo</option>
		<option value="Tonga">Tonga</option>
		<option value="Toquelau">Toquelau</option>
		<option value="Trinidad e Tobago">Trinidad e Tobago</option>
		<option value="Tunísia">Tunísia</option>
		<option value="Turcomenistão">Turcomenistão</option>
		<option value="Turks e Caicos">Turks e Caicos</option>
		<option value="Turquia">Turquia</option>
		<option value="Tuvalu">Tuvalu</option>
		<option value="Ucrânia">Ucrânia</option>
		<option value="Uganda">Uganda</option>
		<option value="Uruguai">Uruguai</option>
		<option value="Uzbequistão">Uzbequistão</option>
		<option value="Vanuatu">Vanuatu</option>
		<option value="Vaticano">Vaticano</option>
		<option value="Venezuela">Venezuela</option>
		<option value="Vietnã">Vietnã</option>
		<option value="Zâmbia">Zâmbia</option>
		<option value="Zimbábue">Zimbábue</option> 	
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
  <input name="escolha" type="hidden" value="adm/cad_membro_end.php" />
</form>
</fieldset>
