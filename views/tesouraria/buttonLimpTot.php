<!-- <a href="controller/limpeza.php?limpeza=1&'<?=$linkperido?>'"><button type="button" class="btn btn-primary">Imprimir totalizador</button></a> -->
<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Imprimir totalizador <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="controller/limpeza.php?limpeza=1&<?=$linkperido?>&div=1" data-toggle="tooltip" data-placement="top"
      title="Acrescenta separador de p&aacute;gina nas impress&otilde;es das congrega&ccedil;&atilde;es" target="_blank">
      Com divisor de p&aacute;gina</a></li>
    <li><a href="controller/limpeza.php?limpeza=1&<?=$linkperido?>"  target="_blank"
      title="Sem separador de p&aacute;ginas nas impress&otilde;es das congrega&ccedil;&atilde;es"
       data-toggle="tooltip" data-placement="top">Sem divisor de p&aacute;gina</a></li>
  </ul>
</div>
