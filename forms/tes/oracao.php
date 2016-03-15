<fieldset>
<legend>Circulos de Ora&ccedil;&otilde;es - ADULTOS</legend>
<form id="form1" name="form1" method="post" action="">
	<?php
		for ($i=1; $i < 6; $i++) {
			$foco = ($i=='1') ? 'autofocus="autofocus"' : '' ;
			?>
			<div class="row">
			  <div class="col-xs-3">
			  	<label>Adultos</label>
			    <input type='text' name='of<?PHP echo $i; ?>' class='form-control'
			    placeholder='Ofertas' tabindex="<?PHP echo ++$ind; ?>"
			     <?PHP echo $foco; ?> >
			  </div>
			  <div class="col-xs-3">
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
	  	<input name="igreja" type="hidden" value='<?php echo $roligreja;?>' />
	  </div>
	</div>
</form>
</fieldset>

<?PHP
	$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
	$linkLancamento .= '&igreja='.$roligreja.'&rec=24';
?>