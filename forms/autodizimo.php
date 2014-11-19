<!-- Desenvolvido por Wellington Ribeiro o autocompletar-->
<!-- O calculo da data do proximo lancamento caso não seja passsado esta no script 'forms/concluirdiz.php' -->
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
					tabindex="<?php echo ++$ind;?>" />
				</td>
				<td><label>Rol:</label> <input type="text" id="rol" name="rol" tabindex="<?php echo ++$ind;?>"
						value="" class="form-control" placeholder="N&ordm; do membro na igreja" />
				</td>
			</tr>
			<tr>
				<td><label>Data: </label> <input type="text" id="data" name="data"
					value="<?php echo $dtlanc;?>" class="form-control" required="required"/>
				</td>
				<td><label>Referente Mês:</label><input type="text" id="mesnum" name="mes"
					size="2" value="<?php echo $meslanc;?>" class="form-control"  required="required" />
				</td>
				<td>
					 <label>Ano:</label> <input type="text"
					id="ano" name="ano" size="4" value="<?php echo $anolanc;?>"
					 required="required" class="form-control" />
				</td>
				<td><label>Congreg. do membro:</label> <input type="text" id="cong"
					class="form-control" disabled="disabled" value="" />
				</td>
			</tr>
		</tbody>
	</table>
	</fieldset>
	<fieldset>
		<legend>Cultos</legend>
		<table>
			<tbody>
				<tr>
					<td><label>D&iacute;zimo:</label><input type="text" id="oferta0" autocomplete="off"
						class="form-control" name="oferta0" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td><label>Oferta:</label><input type="text" id="oferta1" autocomplete="off"
						 class="form-control" name="oferta1" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td><label>Oferta Extra:</label><input type="text" id="oferta2" autocomplete="off"
						class="form-control" name="oferta2" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
				</tr>
				<tr>
					<td><label>Voto:</label><input type="text" id="oferta3" autocomplete="off"
						class="form-control" name="oferta3" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$" />
					</td>
					<td></td>
					<td><label>&nbsp;</label> <input class="btn btn-primary"
					type="submit" name="listar" value="Lançar..."></td>
				</tr>
				<tr>
					<td colspan="2"><label> Qual Campanha ?</label><?php
					$campanha = new List_campanha;
					echo $campanha -> List_Selec(++$ind,(int)$_GET['acescamp']);
					?>
					</td>
					<td><label>Oferta da Campanha:</label><input type="text" id="oferta4" autocomplete="off"
						 class="form-control" name="oferta4" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>

			</tbody>
		</table>
	</fieldset>
	<fieldset>
		<legend>Missões</legend>
		<table  class="table">
			<tbody>
				<tr>
					<td><label>Oferta:</label><input type="text" id="oferta5" autocomplete="off"
						class="form-control" name="oferta5" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td><label>Envelopes:</label><input type="text" id="oferta6" autocomplete="off"
						class="form-control" name="oferta6" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td><label>Cofres:</label><input type="text" id="oferta7" autocomplete="off"
						class="form-control" name="oferta7" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
				</tr>
				<tr>
					<td><label>Carnês:</label><input type="text" id="oferta8" autocomplete="off"
						class="form-control" name="oferta8" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td></td>
					<td> <label>&nbsp;</label> <input class="btn btn-primary"
					type="submit" name="listar" value="Lançar..."></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<fieldset>
		<legend>Circulos de Oração</legend>
		<table class="table">
			<tbody>
				<tr>
					<td><label>Adulto:</label><input type="text" id="oferta9" autocomplete="off"
						class="form-control" name="oferta9" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td><label>Mocidade:</label><input type="text" id="oferta10" autocomplete="off"
						class="form-control" name="oferta10" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td><label>Infantil:</label><input type="text" id="oferta11" autocomplete="off"
						class="form-control" name="oferta11" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
				</tr>
				<tr>
					<td><label>Voto:</label><input type="text" id="oferta12" autocomplete="off"
						class="form-control" name="oferta12" value="" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
					<td></td>
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
