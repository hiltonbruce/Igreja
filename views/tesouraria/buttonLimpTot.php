<fieldset>
  <legend>
    Respons&aacute;vel pela Entrega do Material:
  </legend>
  <form action="controller/limpeza.php" method="get" target="_blank">
    <div class="row">
      <div class="col-xs-6">
        <label>Nome</label>
        <input type="text" name="name" class="form-control"
        placeholder="Pessoa respons&aacute;vel pela entrega" autofocus>
      </div>
      <div class="col-xs-3">
        <label><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Fone de Contato:</label>
        <input type="text" name="phone" class="form-control celular" placeholder="Telefone">
      </div>
      <div class="col-xs-3 checkbox">
          <label><br />
            <input type="checkbox" name="div" value="1"> Com divisor de p&aacute;ginas na impress&atilde;o
          </label>
      </div>
      <div class="col-xs-10">
        <label>Observa&ccedil;&atilde;o:</label>
        <input type="text" name="obs" class="form-control" placeholder="">
      </div>
      <div class="col-xs-2">
        <label>&nbsp;</label>
        <input type="submit" class="form-control btn-primary" value="Imprimir Totalizador">
        <input type="hidden" name="limpeza" value="1">
        <input type="hidden" name="mes" value="<?=$mesPed?>">
        <input type="hidden" name="ano" value="<?=$anoPed?>">
        <input type="hidden" name="mesref" value="<?=$mesref?>">
      </div>
    </div>
  </form>
</fieldset>
