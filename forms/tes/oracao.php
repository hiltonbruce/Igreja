<?PHP
	$foco = (empty($_GET['cta'])) ? 'autofocus="autofocus"' : '' ;
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
					//H� varios caixas na Mocidade
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
				# Miss�es
					$optionTipo .= '<option value="'.$ctaAcesso.',1">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
					break;
				default:
				# Todas as demais receitas
					$optionTipo .= '<option value="'.$ctaAcesso.',2">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
					break;
			}
		}
		//conta atual do pr� lan�amento
		if ($cta==$ctaAcesso) {
				$lanContr = '<option value="'.$cta.'">['.$ctaArray['codigo'].']-'.$ctaArray['titulo'].'</option>';
			}
	}
?>
<fieldset>
<legend>Lan&ccedil;amentos por total da semana</legend>
<form id="form1" name="form1" method="post" action="">
	<div class="row">
		<div class="col-xs-4">
			<label><strong>Entrada no Caixa...</strong></label>
			<select name="acessoCreditar" id="caixa" class="form-control" required="required"
			onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>"
			<?PHP echo $foco;?> >
				<?php
					$recebimento = new tes_listDisponivel();
					$listaIgreja = $recebimento->List_Selec_pop($linkAcesso,$cta);
					echo $listaIgreja;
				?>
			</select>
		</div>
	  <div class="col-xs-4">
			<label>Receita:</label>
				 <select name='acesso' class='form-control' tabindex="<?php echo ++$ind;?>" >
						<?php
							echo $lanContr;
							echo $optionTipo;
						 ?>
				</select>
	  </div>
	  <div class="col-xs-4">
			<label><strong>Igreja:</strong></label>
		  	<?PHP
				$bsccredor2 = new List_sele('igreja', 'razao', 'igreja');
				$LstIgreja = $bsccredor2->List_Selec(++$ind,$idIgreja, ' class="form-control" required="required"');
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
			    <input type='text' name='of<?PHP echo $i; ?>' class='form-control'
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
			    <input type="text" name='voto<?PHP echo $i; ?>' class="form-control"
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
	  	<input name="cad" type="hidden" value='1' />
	  	<input name="conta" type="hidden" value='<?PHP echo $cta;?>' />
	  </div>
	</div>
</form>
</fieldset>
<?PHP
	$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
	$linkLancamento .= '&igreja='.$roligreja.'&rec=24';
?>
