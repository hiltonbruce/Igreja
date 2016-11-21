<?PHP
	$foco = (empty($_GET['cta'])) ? 'autofocus="autofocus"' : '' ;
	$contaAtivas = new tes_conta();
	$ctaId = $contaAtivas->contasTodas();
	$optionTipo = '';
	$lanContr = '';
//	print_r($contaAtivas->contasTodas());
	$ctaReceita = 306;//Ofertas extras
	foreach ($contaAtivas->ativosArray() as $ctaAcesso => $ctaArray) {
		if ($ctaArray['nivel1']== '4') {
			list($n1,$n2,$n3,$n4,$n5)=explode('.', $ctaArray['codigo']);
			switch ($n1.$n2.$n3.$n4) {
				case '411001':
				# Caixa Geral
					$optionTipo .= '<option value="'.$ctaAcesso.'">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
					break;
				case '411002':
				# Caixa de Senhoras
					$optionTipo .= '<option value="'.$ctaAcesso.'">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
					break;
				case '411003':
					$optionTipo .= '<option value="'.$ctaAcesso.'">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
					break;
				case '411004':
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
					$ctaReceita = 821;
					$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
					break;
				default:
				# Todas as demais receitas
					$optionTipo .= '<option value="'.$ctaAcesso.',2">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
					break;
			}
		}
	}

	//conta atual do prï¿½ lanï¿½amento
	switch ($cta) {
		case '6':
		# Missões
			$ctaReceita = ($roligreja=='1') ? 422 : 423;
			$ctaVoto = 825;
			break;
		case '7':
		# Caixa de Senhoras
		$ctaReceita = 321;
		$ctaVoto = 721;
		break;
		case '8':
		# Caixa de Ensino
			$ctaReceita = 401;
			$ctaVoto = 802;
			break;
		case '9':
		# Caixa infantil
			$ctaReceita = 510;
			$ctaVoto = 951;
			break;
		case '482':
			//Há varios caixas na Mocidade
			$ctaReceita = 491;//Código sem retenção da COMADEP
			$ctaVoto = 906;
			break;
		case '504':
		case '505':
		case '506':
		case '507':
			$ctaReceita = 493;//Ofertas extras setores da mocidade
			$ctaVoto = 906;
			break;
		default:
			$ctaReceita = 306;//Ofertas extras
			$ctaVoto = 704;
			break;
	}
		$lanContr = '<option value="'.$ctaId[$ctaReceita]['acesso'].'">['.$ctaId[$ctaReceita]['codigo'].']-'.$ctaId[$ctaReceita]['titulo'].'</option>';
?>
<fieldset>
<legend>Lan&ccedil;amentos por total da semana</legend>
<form id="form1" name="form1" method="post" action="">
	<div class="row">
		<div class="col-xs-3">
			<label><strong>Caixa...</strong></label>
			<select name="acessoCreditar" id="caixa" class="form-control input-sm" required="required"
			onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>"
			<?PHP echo $foco;?> >
				<?php
					$recebimento = new tes_listDisponivel();
					$listaIgreja = $recebimento->List_Selec_pop($linkAcesso,$cta);
					echo $listaIgreja;
				?>
			</select>
		</div>
	  <div class="col-xs-6">
			<label>Ref. Receita:</label>
				 <select name='ctaReceita' class='form-control input-sm' tabindex="<?php echo ++$ind;?>" >
						<?php
							echo $lanContr;
							echo $optionTipo;
						 ?>
				</select>
	  </div>
	  <div class="col-xs-3">
			<label><strong>Igreja:</strong></label>
		  	<?PHP
				$bsccredor2 = new List_sele('igreja', 'razao', 'igreja');
				$LstIgreja = $bsccredor2->List_Selec(++$ind,$idIgreja, ' class="form-control input-sm" required="required"');
				echo $LstIgreja;
			?>
	  </div>
	</div>
	<?php
		for ($i=1; $i < 6; $i++) {
			$foco = ($i=='1') ? 'autofocus="autofocus"' : '' ;
			?>
			<div class="row">
			  <div class="col-xs-2">
			  	<label>Ofertas</label>
			    <input type='text' name='of<?PHP echo $i; ?>' class='form-control money'
			    placeholder='<?PHP echo $i;?>&ordf; Semana' tabindex="<?PHP echo ++$ind; ?>"
			     <?PHP echo $foco; ?> >
			  </div>
			  <div class="col-xs-4">
			  	<label>Semana</label>
			  	<?php
						require 'help/formTes/oracao.php';
				  	echo $ent01;
			  	?>
			  </div>
			  <div class="col-xs-3">
			  	<label>Data</label>
			    <input type="text" name='data<?PHP echo $i; ?>' class="form-control dataclass"
			     placeholder="data" tabindex="<?PHP echo ++$ind; ?>" >
			  </div>
			  <div class="col-xs-3">
			  	<label>Votos</label>
			    <input type="text" name='voto<?PHP echo $i; ?>' class="form-control money"
			    placeholder="Votos" tabindex="<?PHP echo ++$ind; ?>" >
			  </div>
			</div>
			<?php
		}
	?>
	<br>
	<div class="row">
	  <div class="col-xs-3">
		<input type="submit"  class="btn btn-primary"name="Submit" value="Lan&ccedil;ar..."
		tabindex='<?PHP echo ++$ind; ?>'/>
	  	<input name="escolha" type="hidden" value="tesouraria/receita.php" />
	  	<input name="rec" type="hidden" value='24' />
	  	<input name="ctaVoto" type="hidden" value='<?php echo $ctaVoto;?>' />
	  	<input name="cad" type="hidden" value='1' />
	  	<input name="conta" type="hidden" value='<?PHP echo $ctaId[$cta]['acesso'];?>' />
	  </div>
	</div>
</form>
</fieldset>
<?PHP
	$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
	$linkLancamento .= '&igreja='.$roligreja.'&rec=24';
?>
