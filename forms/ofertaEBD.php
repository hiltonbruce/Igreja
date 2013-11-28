<script type="text/javascript">
$(document).ready(function(){

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
		return "models/autodizimo.php?q=" + this.value;
	});

});
</script>
<!-- Desenvolvido por Wellington Ribeiro -->
<?php
$dtlanc = ($_GET['dtlanc']=='') ? date('d/m/Y'):$_GET['dtlanc'];
$meslanc = ($_GET['mes']=='' || $_GET['mes']>12 || $_GET['mes']<1) ? date('m'):$_GET['mes'];
$anolanc = ($_GET['ano']=='') ? date('Y'):$_GET['ano'];
?>
<fieldset>
	<legend>Escola Bíblica</legend>
	<form method="post" name="" action="">
		<table style="background-color: #D3D3D3; border: 0;">
			<tbody>
				<tr>
					<td colspan="2">
						<span style="text-align: left; font-weight: bold">
							Ofertas da Escola Bíblica e do Dep de Ensino (Estamos na:
							<?php echo semana(date('d/m/Y'));?>
							&ordf; Semana deste mês)
						</span>
					<td>
						Entrada ref. Igreja:
						<?php
						$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'required="required" autofocus="autofocus" ');
						echo $listaIgreja;
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">Nome:<br /> <input type="text" name="nome"
						id="campo_estado" size="50%" tabindex="<?php echo ++$ind;?>" />
					
					<td><label>Rol:<br /> <input type="text" id="rol" name="rol"
							value="" />
					</label>
					</td>
				</tr>
				<tr>
					<td>Data: <br /> <input type="text" id="data" name="data"
						value="<?php echo $dtlanc;?>" />
					</td>
					<td>Referente <br />Mês:<input type="text" id="mes" name="mes"
						size="2" value="<?php echo $meslanc;?>"
						OnKeyPress="formatar('##', this);" /> Ano: <input type="text"
						id="ano" name="ano" size="4" value="<?php echo $anolanc;?>"
						OnKeyPress="formatar('##', this);" />
					</td>
					<td>Congreg. do membro: <br /> <input type="text" id="cong"
						disabled="disabled" value="" />
					</td>
				</tr>
				<tr>
					<td>Ofertas:<br /> <input type="text" id="oferta0" name="oferta0"
						value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Corpo de Professores da EBD:</label><input type="text"
						id="oferta1" name="oferta1" value=""
						tabindex="<?php echo ++$ind;?>" />
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><label>Revistas:</label><input type="text"
						id="oferta2" name="oferta2" value=""
						tabindex="<?php echo ++$ind;?>" /> Nas revistas não há provisão</td>
					<td><input type="submit" name="listar" value="Lançar..."></td>
				</tr>
			</tbody>
		</table>

</fieldset>

<fieldset>
		<legend>Observação:</legend>
	<table style="background-color: #D3D3D3; border: 0; width: 100%;">
		<tbody>
			<tr>
				<td colspan="2"><textarea name="obs" id="obs"
						cols="50%" tabindex="<?php echo ++$ind;?>"></textarea>
				</td>
				<td><input type="hidden" name="tipo" id="tipo" value="4"> <input
					type="hidden" name="escolha" value="models/dizoferta.php"> <input
					type="submit" name="listar" value="Lançar..."
					tabindex="<?php echo ++$ind;?>">
				</td>
			</tr>
		</tbody>
	</table>
	</fieldset>
</form>


