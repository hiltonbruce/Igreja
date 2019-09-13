<fieldset>
  <legend>Autoriza&ccedil;&atilde;o de Menores ao Batismo</legend>
  <div class="row">
    <div class="col-xs-12">
      <label>Nome da crian&ccedil;a:</label>
      <input type="text" name="name" class="form-control" placeholder="Nome" tabindex="<?PHP echo ++$ind; ?>" >
    </div>
    <div class="col-xs-2">
      <label>Congrega&ccedil;&atilde;o:</label>
      <?PHP
      $congr = new List_sele ("igreja","razao","rolIgreja");
      echo $congr->List_Selec (++$ind,'',' class="form-control" ');
      ?>
    </div>
    <div class="col-xs-8">
      <label>Nome do Respons&aacute;vel, do Pai ou da M&atilde;e:</label>
      <input type="text" name="pais" class="form-control" placeholder="Nome" tabindex="<?PHP echo ++$ind; ?>" >
    </div>
    <div class="col-xs-2">
      <label>Data:</label>
      <input type="date" name="date" class="form-control" placeholder=".col-xs-3" value="<?php echo date('Y-m-d');?>">
    </div>
    <div class="col-xs-10">
      <label>Secretário da Congregão:</label>
      <input type="text" name="secCong" class="form-control" placeholder="Secretário da congregação">
    </div>
  </div>
</fieldset>
