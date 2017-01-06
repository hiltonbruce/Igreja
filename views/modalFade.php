<!-- Button trigger modal -->
<label>&nbsp;</label>
<button type="button" class="btn btn-danger  btn-sm" data-toggle="modal" data-target="#myModal">
  <?php echo $btnMes;?>
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $titMens;?></h4>
      </div>
      <div class="modal-body">
        <h5><?php echo $corpoMens;?></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <a href='./?escolha=tesouraria/rec_alterar.php&menu=top_tesouraria&id=<?php echo $recibo;?>&pag_mostra=1'>
        <button type="button" class="btn btn-primary">Voltar</button>
        </a>
      </div>
    </div>
  </div>
</div>
