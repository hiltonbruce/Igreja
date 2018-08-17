   <div class="btn-group">
    <a <?PHP $b=link_ativo($_GET["sec"], "0"); ?> href="./?<?php echo $linkLancamento;?>sec=0">
    <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Agenda</button></a>
  </div>
   <div class="btn-group">
    <a <?PHP $b=link_ativo($_GET["sec"], "1"); ?> href="./?<?php echo $linkLancamento;?>sec=1">
    <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Novos Convertidos</button></a>
  </div>
   <div class="btn-group">
    <a <?PHP $b=link_ativo($_GET["sec"], "2"); ?> href="./?<?php echo $linkLancamento;?>sec=2">
    <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Cad Batismo</button></a>
  </div>
   <div class="btn-group">
    <a <?PHP $b=link_ativo($_GET["sec"], "3"); ?> href="./?<?php echo $linkLancamento;?>sec=3">
    <button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Lista para Batismo</button></a>
  </div>
