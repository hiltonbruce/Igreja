<!-- Desenvolvido por Wellington Ribeiro o autocompletar-->
<!-- O calculo da data do proximo lancamento caso não seja passsado esta no script 'forms/concluirdiz.php' -->
<?PHP
	$lancAltera = new DBRecord('dizimooferta',$_GET['id'],'id');
	if ($lancAltera->lancamento()=='0' || $_SESSION['nivel']>'10') {
		switch ($lancAltera->credito()) {
			case '700':
				$lanContr = '<option value="700,1,1">Dizimo</option>';
				break;
			case '701':
				$lanContr = '<option value="701,1,1">Oferta</option>';
				break;
			case '702':
				$lanContr = '<option value="702,1,1">Oferta-Extra</option>';
				break;
			case '703':
				$lanContr = '<option value="703,1,1">Voto</option>';
				break;
			case '720':
				$lanContr = '<option value="720,3,7">Oração - Adulto</option>';
				break;
			case '721':
				$lanContr = '<option value="721,3,7">Oração - Votos Adulto</option>';
				break;
			case '900':
				$lanContr = '<option value="900,8,7">Oração - Mocidade</option>';
				break;
			case '723':
				$lanContr = '<option value="723,5,7">Oração - Infantil</option>';
				break;
			case '820':
				$lanContr = '<option value="820,2,5">Missões - Sede</option>';
				break;
			case '821':
				$lanContr = '<option value="821,2,5">Missões - Congregações</option>';
				break;
			case '822':
				$lanContr = '<option value="822,2,5">Missões - Carnês</option>';
				break;
			case '':
				$lanContr = '<option value="823,2,5">Missões - Cofre</option>';
				break;
			case '824':
				$lanContr = '<option value="824,2,5">Missões - Votos</option>';
				break;
			case '825':
				$lanContr = '<option value="825,2,5">Missões - Votos</option>';
				break;

			default:
				$lanContr = '';
				break;
		}
?>
<fieldset>
<legend>Dizimo e Ofertas</legend>
<form method="post" name="" action="">
		<?php
		$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
		$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control" required="required" autofocus="autofocus" ');
		echo $listaIgreja;
		?>

<fieldset>
<legend>D&iacute;zimos, Votos e Ofertas (Estamos na:
			<?php echo semana(date('d/m/Y'));?>
			&ordf; Semana deste mês)</legend>
	<table>
		<tbody>
			<tr>
				<td colspan="3"><label>Nome:</label> <input type="text" name="nome"
				id="campo_estado" size="50%" class="form-control"
				placeholder="Nome do dizimista para iniciarmos a busca no cadastro da Igreja!"
					tabindex="<?php echo ++$ind;?>" value='<?PHP echo $lancAltera->nome();?>'/>
				</td>
				<td><label>Rol:</label> <input type="text" id="rol" name="rol" tabindex="<?php echo ++$ind;?>"
						value="<?PHP echo $lancAltera->rol();?>" class="form-control" placeholder="N&ordm; do membro na igreja" />
				</td>
			</tr>
			<tr>
				<td><label>Data: </label> <input type="text" id="data" name="data"
					value="<?php echo conv_valor_br ($lancAltera->data());?>" class="form-control" required="required"/>
				</td>
				<td><label>Referente Mês:</label><input type="text" name="mes" maxlength="2"
					size="2" value="<?php echo $lancAltera->mesrefer();?>" class="form-control"  required="required" />
				</td>
				<td>
					 <label>Ano:</label> <input type="text" id="ano" name="ano"
						size="4" value="<?php echo $lancAltera->anorefer();?>"
					 	required="required" class="form-control" />
				</td>
				<td><label>Congreg. do membro:</label> <input type="text" id="cong"
					class="form-control" disabled="disabled" value="<?php echo $lancAltera->congcadastro();?>" />
				</td>
			</tr>
		</tbody>
	</table>
	</fieldset>
	<fieldset>
		<legend>Contribui&ccedil;&atilde;o</legend>
		<table>
			<tbody>
				<tr>
					<td colspan="2"><label>Tipo:</label>
						 <select class='form-control'>
							  <?php echo $lanContr;?>
							  <option value=""> *** Informe o tipo ***</option>
							  <option value="700,1,1">Dizimo</option>
							  <option value="701,1,1">Oferta</option>
							  <option value="702,1,1">Oferta-Extra</option>
							  <option value="703,1,1">Voto</option>
							  <option value="720,3,7">Oração - Adulto</option>
							  <option value="721,3,7">Oração - Votos Adulto</option>
							  <option value="900,8,7">Oração - Mocidade</option>
							  <option value="723,5,7">Oração - Infantil</option>
							  <option value="820,2,5">Missões - Sede</option>
							  <option value="821,2,5">Missões - Congregações</option>
							  <option value="822,2,5">Missões - Carnês</option>
							  <option value="823,2,5">Missões - Cofre</option>
							  <option value="824,2,5">Missões - Envelopes</option>
							  <option value="825,2,5">Missões - Votos</option>
						</select>
					</td>
					<td><label>Valor:</label><input type="text" id="oferta0" autocomplete="off"
						class="form-control" name="oferta0" value="<?php echo $lancAltera->valor();?>" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
				</tr>
				<tr>

					<td colspan="2"><label> Qual Campanha ?</label><?php
					$campanha = new List_campanha;
					echo $campanha -> List_Selec(++$ind,(int)$_GET['acescamp']);
					?>
					</td>
					<td><label>&nbsp;</label> <input class="btn btn-primary"
					type="submit" name="listar" value="Lançar..."></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<fieldset>
		<legend>Observação:</legend>
	<table class="table">
		<tbody>
			<tr>
				<td colspan="2"><textarea name="obs" id="obs" class="form-control"
						cols="50%" tabindex="<?php echo ++$ind;?>"></textarea>
				</td>
				<td><input type="hidden" name="tipo" id="tipo" value="1"> <input
					type="hidden" name="escolha" value="models/dizoferta.php"> <input
					type="submit" name="listar" value="Lançar..."
					 class="btn btn-primary" tabindex="<?php echo ++$ind;?>">
					 <input type="hidden" name="id" value="<?php echo $idLanc;?>">
					 <input type="hidden" name="tabela" value="<?php echo $tabela;?>">
				</td>
			</tr>
		</tbody>
	</table>
	</fieldset>
</form>
</fieldset>
<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular, congr ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#rol").val(celular);
			$("#cong").val(congr);
		}

		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autodizimo.php?q=" + this.value + "&igreja=<?php echo $_GET['igreja'];?>" ;
	});
</script>
<?PHP
} else {
	require_once ('forms/autodizimo.php');
}
?>
