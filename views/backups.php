<?php
  if (is_null($linkLancamento)) {
    $linkLancamento = './?escolha=models/bkpBanco.php&menu=views/backups';
    $linkNull = true;
    echo '<p>';
    $fimMenu ='</p>';
  }else {
    $linkNull = false;
    $fimMenu ='';
  }
 ?>
<div class="btn-group">
  <a <?PHP $b=link_ativo($_GET["rec"], "25"); ?> href="<?php echo $linkLancamento;?>&rec=25">
  <button type="button" class="btn btn-warning btn-sm <?php echo $b;?>"
    ><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Dados</button></a>
</div>
<?php
  if ($linkNull) {
    $linkLancamento = './?escolha=views/backup.php&menu=views/backups';
  }
 ?>
 <div class="btn-group">
  <a <?PHP $b=link_ativo($_GET["rec"], "26"); ?> href="<?php echo $linkLancamento;?>&rec=26">
  <button type="button" class="btn btn-warning btn-sm <?php echo $b;?>"
    ><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Fotos</button></a>
</div>
<?php
  echo $fimMenu;
 ?>
