<?php
$pen = '';
$lancad = '';
$todos = '';
switch ($_GET['lanc']) {
	case '1':
		$lancad = 'checked';
		break;
	case '2':
		$pend = 'checked';
		break;
	default:
		$todos = 'checked';
		break;
}
?>
<fieldset>
	<legend>Filtrar recibos</legend>
	<div class="form-group">
		<form method="get" name="" action="">
			<div class="row">
				<div class="col-xs-7">
					<?php
					require_once "forms/EasyAutocomplete.php";
					?>
				</div>
				<div class="col-xs-3">
					<label>Por CPF</label>
					<input type="text" name="cpf" class="form-control input-xs" id="cpf" placeholder="N&uacute;mero">
				</div>
				<div class="col-xs-2">
					<label>Por RG</label>
					<input type="text" name="rg" class="form-control input-xs" id="rg" placeholder="N&uacute;mero">
				</div>
				<div class="col-xs-2">
					<label>Credores</label>
					<?php
					$for_num = new List_sele("credores", "alias", "recebeu");
					echo $for_num->List_Selec($ind++, $recebeu, 'class="form-control input-sm"');
					?>
				</div>
				<div class="col-xs-3"><br />
					<label>
						<input type='radio' name="lanc" value="0" <?php echo $todos; ?> tabindex="<?PHP echo ++$ind; ?>" /> &nbsp;Todos
						<input type='radio' name="lanc" value="1" <?php echo $lancad; ?> tabindex="<?PHP echo ++$ind; ?>" /> &nbsp;Pendente
						<input type='radio' name="lanc" value="2" <?php echo $pend; ?> tabindex="<?PHP echo ++$ind; ?>" /> &nbsp;Lan&ccedil;ados
					</label>
				</div>
				<div class="col-xs-2">
					<label>Cod Acesso:</label>
					<input type="text" size="2" name="acesso" value="<?php echo $_GET['acesso']; ?>" tabindex="<?PHP echo ++$ind; ?>" class="form-control  input-sm" placeholder="Acesso Cta" />
				</div>
				<div class="col-xs-1">
					<label>Dia:</label>
					<input type="text" size="2" maxlength="2" name="dia" value="<?php echo $_GET['dia']; ?>" tabindex="<?PHP echo ++$ind; ?>" class="form-control  input-sm" placeholder="dia" />
				</div>
				<div class="col-xs-2">
					<label>M&ecirc;s:</label>
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control  input-sm">
						<?php
						$mesSel = arrayMeses();
						$mesPerido = $mesSel[$mesPer];
						$linha1 = '<option value="0">Selecione o m&ecirc;s...</option>';
						foreach ($mesSel as $mes => $meses) {
							$linha2 .= '<option value=' . $mes . '>' . $meses . '</options>';
							if ($_GET['mes'] == $mes) {
								$linha1 = '<option value=' . $mes . '>' . $meses . '</options>' . $linha1;
								$mesPerido = $meses;
							}
						}
						echo $linha1 . $linha2;
						if ((isset($_GET['motivo']))) {
							$selecImput = 'form-group has-success';
							$exibirMotivo = $_GET['motivo'];
						} else {
							$selecImput = '';
							$exibirMotivo = '';
						}
						?>
					</select>
				</div>
				<div class="col-xs-2">
					<label>Ano</label>
					<input type="text" name="ano" tabindex="<?PHP echo ++$ind; ?>" class="form-control input-sm" placeholder="Ano" value="<?PHP echo $anoPer; ?>" />
				</div>
				<div class="col-xs-5 <?php echo $selecImput; ?>">
					<label>Motivo:</label>
					<input type="text" class="form-control input-sm" name="motivo" placeholder="Referente a/ou que pagou?" tabindex="<?PHP echo ++$ind; ?>" value='<?php echo $exibirMotivo; ?>' />
				</div>
				<div class="col-xs-3">
					<label>Congrega&ccedil;&atilde;o:</label>
					<?php
					$bsccredor = new List_sele('igreja', 'razao', 'igreja');
					$listaIgreja = $bsccredor->List_Selec(++$ind, $_GET['igreja'], 'class="form-control  input-sm"');
					echo $listaIgreja;
					$linkPrint  = './controller/modeloPrint.php/?nome=' . $nome . '&rol=' . $rol;
					$linkPrint .= '&cpf=' . $cpf . '&rg=' . $rg . '&recebeu=' . $recebeu . '&dia=' . $diaPer;
					$linkPrint .= '&mes=' . $mesPer . '&ano=' . $anoPer . '&igreja=' . $igr . '&tipo=4';
					$linkPrint .= '&rec=' . $_GET['rec'] . '&lanc=' . $_GET['lanc'];
					// $linkPrint .= ;
					?>
				</div>
				<div class="col-xs-2">
					<input name="escolha" type="hidden" value="controller/recibo.php" />
					<input type="hidden" name="rec" value="<?php echo $recMenu; ?>" />
					<label>&nbsp;</label>
					<input type="submit" class="btn btn-primary btn-sm" name="Submit" value="Listar..." tabindex="<?PHP echo ++$ind; ?>" />
					<input name="menu" type="hidden" value="top_tesouraria" />
				</div>
				<div class="col-xs-2">
					<label>&nbsp;</label>
					<a href='<?php echo $linkPrint; ?>' target="_blank">
						<button type="button" class="btn btn-info btn-sm">
							<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Lista Abaixo
						</button>
					</a>
				</div>
			</div>
		</form>
	</div>
</fieldset>
<?php
$titTable = '<h6>';
$tagFimTable = '</h6>';
require_once 'help/tes/listRec.php';
// require_once 'testes/autoCompleteTst.php';
?>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function(rol, nome, celular, congr) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#rol").val(celular);
			$("#cong").val(congr);
		}
		if (this.value.length < 3 && this.isNotClick)
			return;
		return "models/autodizimo.php?q=" + this.value;
	});
</script>