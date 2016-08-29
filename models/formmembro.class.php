<?php
class formmembro extends formularioalterar {

	public function getMostrar($rol){

	if ($this->campo==$this->vlr_get)
	{

		if ($this->valor=="")
		{
			$this->valor="N&atilde;o informado";
			}
	   		?>
				<div class="row">
				  <div class="col-xs-5">
				    <input type="text" class="form-control input-sm" disabled="disabled" name="nome<?PHP echo $this->campo;?>" value="<?PHP echo $this->valor;?>" />
				  </div>
				  <div class="col-xs-2">
					<input type="text"name="recebeu" class="form-control input-sm" value="<?PHP echo $rol;?>" tabindex="<?PHP echo ++$ind;?>"/>
				  </div>
				  <div class="col-xs-2">
					<a href="javascript:lancarSubmenu('campo=nome<?PHP echo $this->campo;?>&rol=recebeu&form=form1')"
					><img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para pesquisar membros!"
					tabindex="<?PHP echo $ind++;?>"/>Busca por membros...</a>
				  </div>
				  <div class="col-xs-3">
					<input type="submit" class="btn btn-primary btn-sm" name="Submit" value="Alterar..."  tabindex="<?PHP echo ++$ind;?>" />
				  </div>
				</div>

				</form>
			<?PHP
		}

		if (empty($this->valor)){
			$this->valor = "Não Informado";
		}
			echo "<p><a title='Click aqui para alaterar este campo!' href='./?escolha={$this->link_form}'  tabindex='++$ind' >{$this->valor}</a></p>";

	}

}
?>
