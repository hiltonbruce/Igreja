<fieldset>
<legend> Navegue</legend>

  <form id="form1" name="form1" method="get" action="<?PHP echo $_GET["escolha"];?>">
	<input name="proxima" type="hidden" value="<?PHP echo $_GET["proxima"];?>" /> 
	<input name="ord" type="hidden" value="<?PHP echo $_GET["ord"];?>" />  
	<input name="congregacao" type="hidden" value="<?PHP echo $_GET["congregacao"];?>" />   
	<input type="submit" name="Submit" value="Imprimir" /> 
	 
	<a href="./?escolha=<?PHP echo $_GET["escolha"];?>&proxima=<?PHP echo $anterior;?>&ord=<?PHP echo $_GET["ord"];?>&congregacao=<?PHP echo $_GET["congregacao"];?>" ><img src="img/1910_32x32.png" alt="MSemana Anteriorr" width="22" height="22" title="Semana Anterior" align="absmiddle" border="0" /></a> <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&proxima=<?PHP echo $proximo;?>&ord=<?PHP echo $_GET["ord"];?>&congregacao=<?PHP echo $_GET["congregacao"];?>" t><img src="img/1967_32x32.png" width="22" height="22" title="Pr&oacute;xima Semana" alt="Pr&oacute;xima Semana" align="absmiddle" border="0"/></a> 

  <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
    <option>--&gt;&gt; Escolha a Congrega&ccedil;&atilde;o&lt;&lt;-- </option>
    <option value="./?escolha=<?PHP echo $_GET["escolha"];?>&amp;proxima=<?PHP echo $_GET["proxima"];?>&amp;ord=<?PHP echo $_GET["ord"];?>&amp;congregacao=0">Todas as Congregac&otilde;es</option>
	<?PHP
		$congr = new List_sele ("igreja","razao","congregacao");
		$congr->List_Selec_pop ("escolha={$_GET["escolha"]}&proxima={$_GET["proxima"]}&ord={$_GET["ord"]}&congregacao=");
	?>
    </select>
  </form>
</fieldset>