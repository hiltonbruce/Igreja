
    <?php if ($_GET['rec']>'5' & $_GET['rec']<'9' || $_GET['rec']=='23') {
      $linkAtivo='active';
    }else {
      $linkAtivo='';
    }?>
 <div class="btn-group">
      <button type="button" class="btn btn-warning btn-sm dropdown-toggle <?php echo $linkAtivo;?>" data-toggle="dropdown">
        Contas <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu">
          <?php if ($_GET['rec']=='8' ) {
            $linkAtivo='class="active"';
          }else {
            $linkAtivo='';
          }?>
        <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=8&tipo=1">Plano de Contas</a></li>

          <?php if ($_GET['rec']=='7' ) {
            $linkAtivo='class="active"';
          }else {
            $linkAtivo='';
          }?>
        <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=7">Saldos</a></li>

          <?php if ($_GET['rec']=='6' ) {
            $linkAtivo='class="active"';
          }else {
            $linkAtivo='';
          }?>
        <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=6">COMADEP</a></li>
        <li class="divider"></li>
          <?php if ($_GET['rec']=='23' ) {
            $linkAtivo='class="active"';
          }else {
            $linkAtivo='';
          }?>
        <li <?php echo $linkAtivo;?>><a href="<?php echo $linkLancamento;?>&rec=23&cargo=&ano=&mes=&direita=1">Dizimistas</a></li>
      </ul>
    </div>
