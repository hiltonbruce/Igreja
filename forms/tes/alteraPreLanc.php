<!-- Desenvolvido por Wellington Ribeiro o autocompletar-->
<!-- O calculo da data do proximo lancamento caso não seja passsado esta no script 'forms/concluirdiz.php' -->
<?PHP
	$lancAltera = new DBRecord('dizimooferta',$_GET['id'],'id');

	if ($lancAltera->lancamento()=='0' || $_SESSION['nivel']>'10') {

		$contaAtivas = new tes_conta();
		$optionTipo = '';$lanContr = '';

			//print_r($contaAtivas->ativosArray());
		foreach ($contaAtivas->ativosArray()  as $ctaAcesso => $ctaArray) {
			if ($ctaArray['nivel1']== '4') {

				list($n1,$n2,$n3,$n4,$n5)=explode('.', $ctaArray['codigo']);

				switch ($n1.$n2.$n3.$n4) {
					case '411001':
						$optionTipo .= '<option value="'.$ctaAcesso.',1,1">'.$ctaArray['titulo'].'</option>';
						break;
					case '411002':
						$optionTipo .= '<option value="'.$ctaAcesso.',3,1">'.$ctaArray['titulo'].'</option>';
						break;
					case '411003':
						$optionTipo .= '<option value="'.$ctaAcesso.',1,1">'.$ctaArray['titulo'].'</option>';
						break;
					case '411004':
						$optionTipo .= '<option value="'.$ctaAcesso.',4,1">'.$ctaArray['titulo'].'</option>';
						break;
					case '411005':
						$optionTipo .= '<option value="'.$ctaAcesso.',8,1">'.$ctaArray['titulo'].'</option>';
						break;
					case '411006':
						$optionTipo .= '<option value="'.$ctaAcesso.',5,1">'.$ctaArray['titulo'].'</option>';
						break;
					case '412001':
						$optionTipo .= '<option value="'.$ctaAcesso.',2,1">'.$ctaArray['titulo'].'</option>';
						break;
					default:
						$optionTipo .= '<option value="'.$ctaAcesso.',1,2">'.$ctaArray['titulo'].'</option>';
						break;
				}
			}
			//conta atual do pré lançamento
			if ($lancAltera->credito()==$ctaAcesso) {
					$lanContr = '<option value="'.$lancAltera->credito().','.$lancAltera->devedora().','.$lancAltera->tipo().'">'.$ctaArray['titulo'].'</option>';
				}

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
				<td colspan = '4'>
				<div class="row">
				  <div class="col-xs-2">
				    <label>Data: </label> <input type="text" id="data" name="data"
                     value="<?php echo conv_valor_br ($lancAltera->data());?>" class="form-control" required="required"/>
				  </div>
				  <div class="col-xs-2">
				    <label>Semana: </label> <input type="text" id="semana" name="semana"
                     value="<?php echo $lancAltera->semana();?>" class="form-control" required="required"/>
				  </div>
				  <div class="col-xs-2">
				<label>Referente Mês:</label><input type="text" name="mes" maxlength="2"
					value="<?php echo $lancAltera->mesrefer();?>" class="form-control"  required="required" />
				</div>
				  <div class="col-xs-2">
					 <label>Ano:</label> <input type="text" id="ano" name="ano"
						value="<?php echo $lancAltera->anorefer();?>"
					 	required="required" class="form-control" />
				</div>
				  <div class="col-xs-4">
				<label>Congreg. do membro:</label> <input type="text" id="cong"
					class="form-control" disabled="disabled" value="<?php echo $lancAltera->congcadastro();?>" />
				</div></div>
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
						 <select name='acesso' class='form-control'>
							  <?php
							  	echo $lanContr;
							   	echo $optionTipo;
							   ?>
						</select>
					</td>
					<td><label>Valor:</label><input type="text" id="oferta0" autocomplete="off"
						class="form-control" name="oferta0" value="<?php echo number_format($lancAltera->valor(), 2, ",", "");?>" tabindex="<?php echo ++$ind;?>"
						placeholder="Valor em R$"  />
					</td>
				</tr>
				<tr>
					<td colspan="2"><label><!-- Qual Campanha ?--></label><?php
					//$campanha = new List_campanha;
					//echo $campanha -> List_Selec(++$ind,(int)$_GET['acescamp']);
					?>
					</td>
					<td><label>&nbsp;</label> <input class="btn btn-primary"
					type="submit" name="listar" value="Alterar..."></td>
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
					type="hidden" name="escolha" value="models/tes/corrigiPreLanc.php"> <input
					type="submit" name="listar" value="Alterar..."
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
