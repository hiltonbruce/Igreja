<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">

<fieldset>
	<legend>Agendar Contas &agrave; Pagar</legend>
	<script type="text/javascript">
$(document).ready(function(){

	new Autocomplete("campo_estado", function() {
		this.setValue = function( id, nome, celular, resp, alias, cpf) {
			$("#id_val").val(id);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#resp_val").val(resp);
			$("#alias_val").val(alias);
			$("#cpf_val").val(cpf);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autorazao.php?q=" + this.value;
	});

});
</script>
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
					echo $congr->List_Selec (++$ind,$_GET['congregacao'],'autofocus="autofocus" required="required"');
					?></td>
					<td><input name="venc" type="text" id="venc" size='10'
						tabindex="<?PHP echo ++$ind;?>" id='data' required='required'
						value='<?php echo $_GET['venc'];?>' /></td>
					<td><input name="valor" type="text" id="valor" size='10'
						" 
            	tabindex="<?PHP echo ++$ind;?>"
						required='required' value='<?php echo $_GET['valor'];?>' /></td>
					<td><input name="parc" type="text" id="parc" size='3' maxlength="3"
						tabindex="<?PHP echo ++$ind;?>" required='required'
						value='<?php echo $_GET['parc'];?>' /></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" style="background-color: #F0E68C; font-size: 120%">Para
						contas repetidas todos os meses como enegia el&eacute;trica e
						&aacute;gua deixe a parcela em branco ou com 0(zero), que o
						agendamento será automatizado!</td>
				</tr>
			</tfoot>
		</table>
		Referente a:<br />
		<textarea class="text_area" name="motivo" required="required"
			cols="30" id="referente" tabindex="<?PHP
   echo ++$ind;?>"
			onKeyDown="textCounter(this.form.referente,this.form.remLen,255);"
			onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"
			><?php echo $_GET["motivo"];?></textarea>
		<div id="progreso"></div>
		(Max. 255 Carateres) <input readonly type=text name=remLen size=3
			maxlength=3 value="255"> Caracteres restantes <br /> Rol do Credor <input
			name="rol" id="rol" tabindex="<?php echo ++$ind;?>;"
			value="<?php echo $_GET['rol'];?>"> OU...
		<table style="background-color: #D3D3D3;">
			<caption>Dados do Credor</caption>
			<tbody>
				<tr>
					<td colspan='3'>Razão Social:(Mínimo de 5 caracteres p/ novo Cadastro!)<br /> <input type="text"
						tabindex="<?PHP echo ++$ind;?>" name="nome" id="campo_estado"
						size='80%' value='<?php echo $_GET['nome'];?>' /></td>
				</tr>
				<tr>
					<td colspan='2'><input type="hidden" name="id" id="id_val"
						value='<?php echo $_GET['id'];?>' /> Nome Abreviado:<br />
					<input type="text" name="alias" tabindex="<?php echo ++$ind;?>"
						size='50%' id="alias_val" />*</td>
					<td>CNPJ:<br />
					<input type="text" id="sigla_val" tabindex="<?php echo ++$ind;?>"
						name="sigla" value="" />*</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">Responsavel: <br />
					<input type="text" id="resp_val" tabindex="<?php echo ++$ind;?>"
						name="resp" value="" size='50%' />*</td>
					<td>CPF: <br />
					<input type="text" id="cpf_val" name="cpf"
						tabindex="<?php echo ++$ind;?>" value="" />*</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">Endereço:<br />
					<input type="text" id="estado_val" tabindex="<?php echo ++$ind;?>"
						name="estado" value="" size="50">
					</td>
					<td>Bairro: <br />
					<input type="text" id="bairro_val" tabindex="<?php echo ++$ind;?>"
						name="bairro" value="" />
					</td>
				</tr>
				<tr>
					<td colspan="2">Cidade: <br />
					<input type="text" id="cidade_val" tabindex="<?php echo ++$ind;?>"
						name="cidade" value="" size="40" />
					</td>
					<td>UF: <br />
					<input type="text" id="uf_val" tabindex="<?php echo ++$ind;?>"
						name="uf" value="" />
					</td>
				</tr>
				<tr>
					<td>Telefone fixo: <br /> <input type="text" id="fone"
						tabindex="<?php echo ++$ind;?>" name="telefone"
						value="<?php echo (empty($_GET['telefone'])?'':$_GET['telefone']);?>" />
					</td>
					<td>Celular<br />
					<input type="text" id="celular" name="celular" tabindex="<?php echo ++$ind;?>"
						value="<?php echo (empty($_GET['celular'])?'':$_GET['celular']);?>" />
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">Fornecedor de:<br /> <?php 
					$desp1 = new ListDespesa('acesso');
					$desp1->List_sel(++$ind,'desp1');
					?></td>
				</tr>
				<tr>
					<td colspan="3">Fopnecedor de:<br /> <?php 
					$desp1 = new ListDespesa('acesso');
					$desp1->List_sel(++$ind,'desp2');
					?></td>
				</tr>
				<tr>
					<td colspan="2">Fornecedor de:<br /> <?php 
					$desp1 = new ListDespesa('acesso');
					$desp1->List_sel(++$ind,'desp3');
					?></td>
					<td><input type="hidden" name="escolha"
						value="controller/despesa.php"> <input type="hidden" name="menu"
						value="top_tesouraria"></td>
				</tr>
				<tr>
					<td colspan='3'><input type="submit" name="listar"
						tabindex="<?php echo ++$ind;?>" value="Agendar Pagamento..."> <input
						type="hidden" name="age" " value="4"></td>
				</tr>
			</tbody>
		</table>
	</form>
</fieldset>
