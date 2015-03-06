<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">

<fieldset>
	<legend>Agendar Contas &agrave; Pagar</legend>
	<!-- Desenvolvido por Wellington Ribeiro -->
	<blink>
		<h2>Criar buscas para alteração e eliminação de grupos de agendamento
			ou individuais</h2>
	</blink>
	<form method="post" name="autocompletar" action="">
		<table>
			<thead>
				<tr>
					<th scope="col">Igreja</th>
					<th scope="col">1&ordm; Vencimento</th>
					<th scope="col">Valor total</th>
					<th scope="col">Parcelas</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?PHP
					$congr = new List_sele ("igreja","razao","congregacao");
					echo $congr->List_Selec (++$ind,$_GET['congregacao'],'autofocus="autofocus" required="required" class="form-control"');
					?></td>
					<td><input name="venc" type="text" id="venc" size='10'
						tabindex="<?PHP echo ++$ind;?>" id='data' required='required'
						value='<?php echo $_GET['venc'];?>' class="form-control" /></td>
					<td><input name="valor" type="text" id="valor" size='10'
						" class="form-control" tabindex="<?PHP echo ++$ind;?>"
						required='required' value='<?php echo $_GET['valor'];?>' /></td>
					<td><input name="parc" type="text" id="parc" size='3' maxlength="3"
						tabindex="<?PHP echo ++$ind;?>" required='required'
						class="form-control" value='<?php echo $_GET['parc'];?>' /></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" style="background-color: #F0E68C; font-size: 120%">Para
						contas repetidas todos os meses como enegia el&eacute;trica e
						&aacute;gua deixe a parcela em branco ou com 0(zero), que o
						agendamento será automatizado!</td>
				</tr>
				<tr>
					<td colspan="4">Referente a:<br />
		<textarea class="text_area" name="motivo" required="required"
			cols="30" id="referente" tabindex="<?PHP
   echo ++$ind;?>" class="form-control"
			onKeyDown="textCounter(this.form.referente,this.form.remLen,255);"
			onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"
			><?php echo $_GET["motivo"];?></textarea><div id="progreso"></div></td>
			</tr>
				<tr>
					<td><label>(Max. 255 Carateres) </label><input readonly type=text name=remLen size=3
			class="form-control" maxlength=3 value="255"> Caracteres restantes
					</td>
					<td><label>Rol do Credor</label>  <input
			name="rol" id="rol" tabindex="<?php echo ++$ind;?>;" class="form-control"
			value="<?php echo $_GET['rol'];?>" placeholder="Exclusivo para Membros" ></td>
					<td colspan="2"> OU... Preencha o formulário abaixo!</td>
				</tr>
			</tfoot>
		</table>
	<?php
		require_once 'forms/tes/lancarContabil.php';
	?>
		<table style="background-color: #D3D3D3;">
			<caption>Dados do Credor</caption>
			<tbody>
				<tr>
					<td colspan='3'><label>Razão Social:</label><input type="text"
						tabindex="<?PHP echo ++$ind;?>" name="nome" id="credor3"
						size='80%' value='<?php echo $_GET['nome'];?>' class="form-control"
						placeholder="Mínimo de 5 caracteres p/ novo Cadastro!" /></td>
				</tr>
				<tr>
					<td colspan='2'><input type="hidden" name="id" id="valCredor"
						class="form-control" value='<?php echo $_GET['id'];?>' />
						<label> Nome Abreviado:</label>
					<input type="text" name="alias" tabindex="<?php echo ++$ind;?>"
						class="form-control" size='50%' id="aliasCredor" /></td>
					<td><label>CNPJ:</label>
					<input type="text" id="siglaCredor" tabindex="<?php echo ++$ind;?>"
						class="form-control" name="sigla" value="" /></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><label>Responsavel:</label>
					<input type="text" id="respCredor" tabindex="<?php echo ++$ind;?>"
						class="form-control" name="resp" value="" size='50%' /></td>
					<td><label>CPF:</label>
					<input type="text" id="cpfCredor" name="cpf"
						class="form-control" tabindex="<?php echo ++$ind;?>" value="" /></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><label>Endereço:</label>
					<input type="text" id="estadorCredor" tabindex="<?php echo ++$ind;?>"
						class="form-control" name="estado" value="" size="50">
					</td>
					<td><label>Bairro:</label>
					<input type="text" id="bairro_val" tabindex="<?php echo ++$ind;?>"
						class="form-control" name="bairro" value="" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><label>Cidade:</label>
					<input type="text" id="cidade_val" tabindex="<?php echo ++$ind;?>"
						class="form-control" name="cidade" value="" size="40" />
					</td>
					<td><label>UF: </label>
					<input type="text" id="uf_val" tabindex="<?php echo ++$ind;?>"
						class="form-control" name="uf" value="" />
					</td>
				</tr>
				<tr>
					<td><label>Telefone fixo:</label><input type="text" id="fone"
						tabindex="<?php echo ++$ind;?>" name="telefone" class="form-control"
						value="<?php echo (empty($_GET['telefone'])?'':$_GET['telefone']);?>" />
					</td>
					<td><label>Celular</label>
					<input type="text" id="celular" name="celular" tabindex="<?php echo ++$ind;?>"
						class="form-control" value="<?php echo (empty($_GET['celular'])?'':$_GET['celular']);?>" />
					</td>
					<td></td>
				</tr>
				<tr>
					<td><label>Fornecedor de:</label><?php
					$desp1 = new ListDespesa('acesso');
					$desp1->List_sel(++$ind,'desp1');
					?></td>
					<td></td>
					<td><label>Fopnecedor de:</label><?php
					$desp1 = new ListDespesa('acesso');
					$desp1->List_sel(++$ind,'desp2');?></td>
				</tr>
				<tr>
					<td><label>Fornecedor de:</label><?php
					$desp1 = new ListDespesa('acesso');
					$desp1->List_sel(++$ind,'desp3');
					?></td>
					<td><label>&nbsp;</label><input type="hidden" name="escolha"
						value="controller/despesa.php"> <input type="hidden" name="menu"
						value="top_tesouraria"><input type="submit" name="listar"
						 class="btn btn-primary" tabindex="<?php echo ++$ind;?>" value="Agendar Pagamento...">
						  <input type="hidden" name="age" " value="6"></td>
				</tr>
			</tbody>
		</table>
	</form>
</fieldset>
	<script type="text/javascript">
	new Autocomplete("credor3", function() {
		this.setValue = function( id, nome, celular, resp, alias, cpf) {
			$("#valCredor").val(id);
			$("#estadorCredor").val(nome);
			$("#siglaCredor").val(celular);
			$("#respCredor").val(resp);
			$("#aliasCredor").val(alias);
			$("#cpfCredor").val(cpf);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autorazao.php?q=" + this.value;
	});

</script>
