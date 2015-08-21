<form>
	<div class="row">
	  <div class="col-xs-6">
	  	<label>Filtra grupo de Contas</label>
		<select class='form-control' name="conta" id="igreja" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		<?PHP
			$id = (empty($_GET['id'])) ? '' : (int)$_GET['id'] ;
			$linkAcesso  = 'escolha=tesouraria/receita.php&menu=top_tesouraria';
			$linkAcesso .= '&rec=8&tipo=1&id=';
			$campo = new tes_listCta ('titulo','id');
			$options = $campo->List_Selec_pop($linkAcesso,$id);
			echo $options ['0'];
		?>
		</select>
	  </div>
	  <div class="col-xs-2">
<?PHP
	$grupoCta = $options['1'];
	//print_r($options);
?>
	  </div>
	  </div>
</form>

