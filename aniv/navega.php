  <form id="form1" name="form1" method="get" action="<?PHP echo $_GET["escolha"];?>" target="_blank">
	<input name="proxima" type="hidden" value="<?PHP echo $_GET["proxima"];?>" />
	<input name="ord" type="hidden" value="<?PHP echo $_GET["ord"];?>" />
	<input name="congregacao" type="hidden" value="<?PHP echo $_GET["congregacao"];?>" />
  <div class="row">
    <div class="col-xs-1"><label>&nbsp;</label>
      	<input type="submit" name="Submit" class="btn btn-primary" value="Imprimir" />
    </div>
    <div class="col-xs-3"><label>&nbsp;</label>
    <div class="btn-group" role="group" aria-label="...">
      <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&proxima=<?PHP
      echo $anterior;?>&ord=<?PHP echo $_GET["ord"];?>&congregacao=<?PHP
      echo $_GET["congregacao"];?>" type="button" class="btn btn-primary">
        <span class="glyphicon glyphicon-backward" aria-hidden="true"> </span> Voltar um dia
     </a>
    <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&proxima=<?PHP echo
     $proximo;?>&ord=<?PHP echo $_GET["ord"];?>&congregacao=<?PHP echo $_GET["congregacao"];
     ?>" type="button" class="btn btn-primary">Avan&ccedil;ar um dia
     <span class="glyphicon glyphicon-forward" aria-hidden="true"> </span>
    </a>
    </div>
    </div>
      <div class="col-xs-2"><label>Per&iacute;odo:</label>
      <select name="periodo" class="form-control" >
  		<option>Hoje</option>
  		<option value="1">da Semana</option>
  		<option value="2">do M&ecirc;s</option>
  		</select>
    </div>
    <div class="col-xs-4"><label>Igreja</label>
      <select name="igreja" id="igreja" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
  		<?php
      $congr = new List_sele ("igreja","razao","congregacao");
      $linkAcesso="escolha={$_GET["escolha"]}&proxima={$_GET["proxima"]}&ord={$_GET["ord"]}&congregacao=";
  		$listaIgreja = $congr->List_Selec_pop($linkAcesso,$_GET['congregacao']);
  		//echo $listaIgreja;
  		?>
  		</select>
    </div>
    </div>
      <div class="col-xs-1"><label>&nbsp;</label>
      <input type="submit" class="btn btn-primary" value='Listar!' >
    </div>
</div>
  </form>
