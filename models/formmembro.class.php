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
				<input type="text" disabled="disabled" name="nome<?PHP echo $this->campo;?>" value="<?PHP echo $this->valor;?>" size="30" tabindex="<?PHP echo ++$ind;?>"/>
				Rol:
				<input type="text"name="recebeu" value="<?PHP echo $rol;?>" size="5" tabindex="<?PHP echo ++$ind;?>"/>
				<a href="javascript:lancarSubmenu('campo=nome<?PHP echo $this->campo;?>&rol=recebeu&form=form1')"><img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para pesquisar membros!"  tabindex="<?PHP echo $ind++;?>"/>Busca por membros...</a>
				<input type="submit" name="Submit" value="Alterar..."  tabindex="<?PHP echo ++$ind;?>" />
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