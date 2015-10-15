<?php
//verifica se foi passada a igreja caso contrário fixa na Sede
    if (!empty($_GET['igreja'])) {
        $igreja = $_GET['igreja'];
    } elseif (!empty($_POST['igreja'])) {
        $igreja = $_POST['igreja'];
    }else {
        $igreja = 1;
    }
?>
<fieldset>
<legend>Circulos de Ora&ccedil;&otilde;es</legend>
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
	  	<input name="escolha" type="hidden" value="views/oracao.php" />
	  </div>
	</div>
</form>
</fieldset>
