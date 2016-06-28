<?PHP
	$foco = (empty($_GET['cta'])) ? 'autofocus="autofocus"' : '' ;
?>
<fieldset>
<legend>Lan&ccedil;amentos por total da semana</legend>
<form id="form1" name="form1" method="post" action="">
	<div class="row">
		<div class="col-xs-5">
			<label><strong>Recebido parar:</strong></label>
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
			  <div class="col-xs-3">
			  	<label>Semana</label>
			  	<?php
					require 'help/formTes/oracao.php';
				  	echo $ent01;
			  	?>
			  </div>
			  <div class="col-xs-2">
			  	<label>Data</label>
			    <input type="text" name='data<?PHP echo $i; ?>' class="form-control dataclass"
			     placeholder="data" tabindex="<?PHP echo ++$ind; ?>" >
			  </div>
			  <div class="col-xs-2">
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