<form method="post" name="form1">
	<select name='curso' id='curso' onchange="MM_jumpMenu('parent',this,0)" tabindex='1'>		
	<option value="" > Escolha o Curso </option>
	<option value="./?escolha=cetad/pgto.php&amp;menu=top_cetad&amp;curso=0">Limpar Op&ccedil;&atilde;o </option>
	<?PHP
		$lista = new List_Curso;
		$lista -> List_Curso_pop ();
	?>
	</select>
	<?PHP
		$lista = new Aluno_Curso;
		$lista -> List_Aluno ();
	?>
    <label>Valor:
    <input name="valor" type="text" id="valor">
    </label>
    <label><p>
    <input type="submit" name="Submit" value="Confirmar..."> </p>
	<input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
	<input name="curso" type="hidden" id="curso" value="<?PHP echo $_GET["curso"];?>">
	<input name="tabela" type="hidden" id="tabela" value="cetad_pgto" />
    </label>
</form>

