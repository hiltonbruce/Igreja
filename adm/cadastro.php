<?php
if ($_SESSION["setor"] != '3' && $_SESSION["setor"] != '99') {
?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<h4>&Aacute;rea restrita &agrave; <strong>Secretaria Executiva!</strong></h4>
		<h5>Uso exclusivo deste setor!</h5>
	</div>
<?php
	exit;
}
//$rec = new DBRecord ("cidade",$_SESSION["cid_natal"],"id");
//$nome_cidade = $rec->nome()." - ".$rec->coduf();
if (intval($_POST["cid_natal"]) != 0) {
	$recCidNatal = new DBRecord("cidade", $_POST["cid_natal"], "id");
	$nome_cidade = $recCidNatal->nome();
	$id_Cidade = $recCidNatal->id();
	$uf_nasc = $recCidNatal->coduf();
}else {
	list($nome_cidade,$uf_nasc) = explode('-',$_POST["cid_natal"]);
	$id_Cidade = $nome_cidade;
}

if (isset($_POST["cid_end"])) {
	$id_cid = intval($_POST["cid_end"]);
} else {
	$id_cid = intval($_GET["cid_end"]);
}
$rec_end = new DBRecord("cidade", $id_cid, "id"); //Faz a busca do cidade pelo id e traz o nome
$cid_end = $rec_end->nome() . " - " . $rec_end->coduf();
$cpf = $_POST['cpf'];
$ind = 1; //Define o ï¿½ndece dos campos do formulï¿½rio
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
	<legend>Dados Pessoais - Cadastro</legend>
	<form method="post" action="">
		<table class="table">
			<tbody>
				<tr>
					<td colspan="3"><label>Nome:</label>
						<span class="form-control" disabled="disabled" title="Para alterar nome use o botão voltar do navegador!"><?PHP echo $_POST["nome_cad"] . ' - CPF:' . $cpf; ?>
						</span>
						<input name="nome" type="hidden" value="<?PHP echo $_POST["nome_cad"]; ?>" />
						<input name="cpf" type="hidden" value="<?PHP echo $cpf; ?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<?php
						require_once "forms/easyPaiMae.php";
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2"><label>Endere&ccedil;o:</label> <input name="endereco" type="text" id="endereco" size="32" class="form-control" maxlength="40" required="required" tabindex="<?PHP echo $ind++; ?>"></td>
					<td>
						<label>N&ordm;</label> <input name="numero" type="text" id="numero" size="11" class="form-control" maxlength="5" tabindex="<?PHP echo $ind++; ?>" required="required">
					</td>
				</tr>
				<tr>
					<td>
						<label>Bairro:</label>
						<?php
						if (isset($id_cid)) {
							$_POST["cid_end"] = $id_cid;
						}
						$lst_cid = new sele_cidade("bairro", $id_cid, "idcidade", "bairro", "bairro");
						$vlr_linha = $lst_cid->ListDados($ind++, $_GET['bairro']);
						?>
					<td>
						<label>Complementos:</label>
						<input name="uf_resid" type="hidden" value="<?PHP echo $rec_end->coduf(); ?>" />
						<input name="cidade" type="hidden" value="<?PHP echo $rec_end->id(); ?>" />
						<input name="complemento" class="form-control" type="text" id="complemento" tabindex="<?PHP echo $ind++; ?>" placeholder="Casa, apto ..." />
					</td>
					<td><label>Bairro n&atilde;o cadastrado... </label><a href="./?escolha=tab_auxiliar/cadastro_bairro.php&uf=
						<?PHP echo $rec_end->coduf(); ?>&cidade=<?PHP echo $rec_end->id(); ?>
						&nomeCid=<?PHP echo $rec_end->nome(); ?>" class="btn btn-primary">Clique aqui!</a></td>
				</tr>
				<tr>
					<td colspan='2'>
						<?PHP
						echo "<label>Cidade:</label> <input class='form-control' value='$cid_end' ";
						echo 'disabled="disabled"/><td><label>CEP:</label><input name="cep" type="text" id="cep" class="form-control" ';
						echo 'tabindex="' . $ind++ . '">';
						?>
					</td>
				</tr>
				<tr>
					<td>
						<label>Telefone:</label> <input name="fone_resid" class="form-control" type="text" id="fone" tabindex="<?PHP echo $ind++; ?>">
					</td>
					<td>
						<label>Celular:</label> <input name="celular" class="form-control" type="text" id="celular" tabindex="<?PHP echo $ind++; ?>">
					</td>
					<td>
						<label>Nacionalidade: </label>
						<input class="form-control" value='<?PHP echo $_POST["nacao"]; ?>' disabled='disabled' />
						<input name='nacao' type='hidden' value='<?PHP echo $_POST["nacao"]; ?>' />
					</td>
				</tr>
				<tr>
					<td><label>Natural de:</label>
						<input class='form-control' value='<?PHP echo $nome_cidade . '-' . $uf_nasc; ?>' disabled='disabled' />
						<input name="uf_nasc" class="form-control" type="hidden" value="<?PHP echo $uf_nasc; ?>" />
						<input name="cid_natal" class="form-control" type="hidden" value="<?PHP echo $id_Cidade; ?>" />
					</td>
					<td>
						<label>Data&nbsp;de&nbsp;Nascimento:</label>
						<input name="datanasc" type="text" class="form-control" id="data" placeholder="(Ex.: 21/04/1968)" tabindex="<?PHP echo $ind++; ?>">
					</td>
					<td>
						<label>Sexo:</label> <select name="sexo" id="sexo" class="form-control" tabindex="<?PHP echo $ind++; ?>">
							<option value="" selected>- Escolha -</option>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<h6>Doador de Sangue?
							<label class="radio-inline">
								<input type='radio' name='doador' required="required" value='Sim' tabindex='<?PHP echo $ind++; ?>' />
								 Sim
								</label>
							<label class="radio-inline">
								<input type='radio' name='doador' required="required" value='Não' tabindex='<?PHP echo $ind++; ?>' /> 
								N&atilde;o
							</label>
						</h6>
					</td>
					<td>
						<label>Tipo</label> <select name='sangue' placeholder="Tipo Sanguínio" class="form-control" tabindex='<?PHP echo $ind++; ?>'>
							<option value=''>Tipo de Sangue</option>
							<option value='A+'>A+</option>
							<option value='A-'>A-</option>
							<option value='B+'>B+</option>
							<option value='B-'>B-</option>
							<option value='AB+'>AB+</option>
							<option value='AB-'>AB-</option>
							<option value='O+'>O+</option>
							<option value='O-'>O-</option>
						</select>
					</td>
					<td><label>Escolaridade:</label>
						<select name="escolaridade" size="1" class="form-control" id="escolaridade" tabindex="<?PHP echo $ind++; ?>">
							<option value=""></option>
							<option value="N&atilde;o Estuda">N&atilde;o Estuda</option>
							<option value="N&atilde;o Sabe Informar!">N&atilde;o Sabe
								Informar!</option>
							<option value="Alfabetizado">alfabetizado</option>
							<option value="1&ordm; Ano">1&ordm; Ano</option>
							<option value="2&ordm; Ano">2&ordm; Ano</option>
							<option value="3&ordm; Ano">3&ordm; Ano</option>
							<option value="4&ordm; Ano">4&ordm; Ano</option>
							<option value="5&ordm; Ano">5&ordm; Ano</option>
							<option value="6&ordm; Ano">6&ordm; Ano</option>
							<option value="7&ordm; Ano">7&ordm; Ano</option>
							<option value="8&ordm; Ano">8&ordm; Ano</option>
							<option value="9&ordm; Ano">9&ordm; Ano</option>
							<option value="1&ordm; Ano - M&eacute;dio">1&ordm; Ano -
								M&eacute;dio</option>
							<option value="2&ordm; Ano - M&eacute;dio">2&ordm; &ordm; Ano -
								M&eacute;dio</option>
							<option value="3&ordm; Ano - M&eacute;dio">3&ordm; Ano -
								M&eacute;dio</option>
							<option value="Superior Incompleto">Superior Incompleto</option>
							<option value="Superior Completo">Superior Completo</option>
							<option value="Mestrado">Mestrado</option>
							<option value="Doutorado">Doutorado</option>
							<option value="P&oacute;s-Doutorado">P&oacute;s-Doutorado</option>
							<option value="PHD">PHD</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>Gradua&ccedil;&atilde;o:</label> <input name="graduacao" type="text" class="form-control" tabindex="<?PHP echo $ind++; ?>">
					</td>
					<td colspan="2">
						<label>Email:</label>
						<input name="email" type="email" class="form-control" tabindex="<?PHP echo $ind++; ?>" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><label>Observa&ccedil;&atilde;o:</label> <textarea name="obs" cols="37" class="form-control" rows="2" id="obs" tabindex="<?PHP echo $ind++; ?>"></textarea>
					</td>
					<td><label>&nbsp;</label><br> <input type="submit" class="btn btn-primary" name="Submit" value="Salvar" tabindex="<?PHP echo $ind++; ?>">
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3">Obs: A data deve estar no formato: dd/mm/aaaa
						(00/00/0000). 
						<input name="tabela" type="hidden" id="tabela" value="membro" /> 
						<input type="hidden" name="escolha" value="adm/cad_dados_pess.php">
					</th>
				</tr>
			</tfoot>
		</table>
	</form>
</fieldset>