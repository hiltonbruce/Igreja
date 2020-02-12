<fieldset>
<legend>Cadastro de Usu&aacute;rios de Acesso ao Sistema</legend>
<form method="post" action="">
<div class="row">
  <div class="col-xs-9">
		<label>Nome:</label>
		<input name="nome" type="text" id="nome" required="required" class="form-control"
		value="<?PHP echo $_POST["nome"];?>" tabindex="<?PHP echo ++$ind; ?>" />
  </div>
  <div class="col-xs-3">
		<label>CPF:</label>
		<input name="cpf" type="text" id="cpf" tabindex="<?PHP echo ++$ind; ?>"
		required="required" class="form-control" value="<?PHP echo $_POST["cpf"];?>" />
  </div>
  <div class="col-xs-3">
		<label>Cargo:</label>
		<input name="cargo" type="text" required="required" class="form-control"
		id="cargo" value="<?PHP echo $_POST["cargo"];?>" tabindex="<?PHP echo ++$ind; ?>"/>
  </div>
  <div class="col-xs-3">
		<label>Senha:</label>
		<input name="senha" type="password"  required="required" class="form-control"
		tabindex="<?PHP echo ++$ind; ?>" />
  </div>
  <div class="col-xs-3">
		<label>Confirme a Senha:</label>
		<input name="senha1" type="password"  required="required" class="form-control"
		 tabindex="<?PHP echo ++$ind; ?>" />
  </div>
  <div class="col-xs-3">
		<label>Setor de atua&ccedil;&atilde;o</label>
		<?php
			$setor = new List_setores();
			echo $setor->List_Setor(++$ind,'class="form-control"',$_SESSION['setor']);
		 ?>
  </div>
  <div class="col-xs-12">
		<label>Perfis de Acesso:</label>
     <div class="checkbox">
      <label class="checkbox-inline">
        <input type="checkbox" value="secCad" name="perfil0" tabindex="<?PHP echo ++$ind; ?>" >
        Secretaria <strong>Cadastrar</strong>
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" value="secUP" name="perfil1" tabindex="<?PHP echo ++$ind; ?>" >
        Secretaria <strong>Editar</strong>
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" value="secDis" name="perfil2" tabindex="<?PHP echo ++$ind; ?>" >
        Secretaria <strong>Disciplinar</strong>
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" value="tesCad" name="perfil3" tabindex="<?PHP echo ++$ind; ?>" >
        Tesouraria
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" value="misCad" name="perfil4" tabindex="<?PHP echo ++$ind; ?>" >
        Miss&otilde;es
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" value="pastor" name="perfil5" tabindex="<?PHP echo ++$ind; ?>" >
        Pastor da Igreja
      </label>
      </div>
  </div>
  <div class="col-xs-4">
		<label>N&iacute;vel de acesso</label>
		<select name='nivel' class='form-control' tabindex='<?PHP echo ++$ind; ?>'>
			<?php
				require_once 'forms/sec/niveisAcesso.php';
			 ?>
		</select>
  </div>
  <div class="col-xs-3">
		<label>&nbsp;</label><input type="submit" required="required"
		 class="btn btn-primary" name="Submit" value="Cadastrar..."
		 tabindex="<?PHP echo ++$ind; ?>"/>
    <input type="hidden" name="data" value="<?php echo date('Y-m-d H:i:s');?>">
    <input type="hidden" name="situacao" value="1">
    <input type="hidden" name="historico" value="<?php echo $_SESSION['nome'].'-'.$_SESSION['valid_user'];?>">
		<input name="escolha" type="hidden" value="tab_auxiliar/cad_usuario.php" />
  </div>
</div>
</form>
</fieldset>
