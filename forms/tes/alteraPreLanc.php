<!-- Desenvolvido por Wellington Ribeiro o autocompletar-->
<!-- O calculo da data do proximo lancamento caso não seja passsado esta no script 'forms/concluirdiz.php' -->
<?PHP
	$lancAltera = new DBRecord('dizimooferta',$_GET['id'],'id');
	//$ctaDev = $lancAltera->devedora();//Conta devedora
	if ($lancAltera->lancamento()=='0' || $_SESSION['nivel']>'10') {

		$contaAtivas = new tes_conta();
		$optionTipo = '';$lanContr = '';

			//print_r($contaAtivas->ativosArray());
		foreach ($contaAtivas->ativosArray()  as $ctaAcesso => $ctaArray) {
			if ($ctaArray['nivel1']== '4') {

				list($n1,$n2,$n3,$n4,$n5)=explode('.', $ctaArray['codigo']);

				switch ($n1.$n2.$n3.$n4) {
					case '411001':
					# Caixa Geral
						$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
					case '411002':
					# Caixa de Senhoras
						$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
					case '411003':
					# Caixa Geral - Receita de Campanhas
						$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
					case '411004':
					# Caixa de Ensino
						$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
					case '411005':
						//Há varios caixas na Mocidade
						if ($n5=='002') {
							# Setor I - Rubem
							$ctaDev = 9;
						} elseif ($n5=='003') {
							# Setor II - Zebulom
							$ctaDev = 10;
						} elseif ($n5=='004')  {
							# Setor III - Azer
							$ctaDev = 11;
						} elseif ($n5=='005')  {
							# Setor IV - Juda
							$ctaDev = 12;
						}else {
							#Caixa geral da Mocidade
							$ctaDev = 8;
						}

						$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
					case '411006':
					# Caixa infantil
						$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
					case '412001':
					# Missões
						$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
					default:
					# Todas as demais receitas
						$optionTipo .= '<option value="'.$ctaAcesso.',2">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
						break;
				}
			}
			//conta atual do pré lançamento
			if ($lancAltera->credito()==$ctaAcesso) {
					$lanContr = '<option value="'.$lancAltera->credito().','.$lancAltera->tipo().'">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
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
				    <label>Data: </label> <input type="text" id="data" name="data" tabindex="<?php echo ++$ind;?>" 
                     value="<?php echo conv_valor_br ($lancAltera->data());?>" class="form-control" required="required"/>
				  </div>
				  <div class="col-xs-2">
				    <label>Semana: </label> <input type="text" id="semana" name="semana" tabindex="<?php echo ++$ind;?>" 
                     value="<?php echo $lancAltera->semana();?>" class="form-control" required="required"/>
				  </div>
				  <div class="col-xs-2">
				<label>Referente Mês:</label><input type="text" name="mes" maxlength="2" tabindex="<?php echo ++$ind;?>" 
					value="<?php echo $lancAltera->mesrefer();?>" class="form-control"  required="required" />
				</div>
				  <div class="col-xs-2">
					 <label>Ano:</label> <input type="text" id="ano" name="ano"
						value="<?php echo $lancAltera->anorefer();?>" tabindex="<?php echo ++$ind;?>" 
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
					<td colspan="2"><label>Receita:</label>
						 <select name='acesso' class='form-control' tabindex="<?php echo ++$ind;?>" >
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
					<td colspan="2"><label>Caixa</label>
						<select name='caixa' class='form-control' tabindex="<?php echo ++$ind;?>" >
							<?php
							$campanha = new tes_listDisponivel;
							echo $campanha -> List_Selec ($lancAltera->devedora());
						?>
						</select>
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
						cols="50%" tabindex="<?php echo ++$ind;?>"
						><?php echo $lancAltera->obs();?></textarea>
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
