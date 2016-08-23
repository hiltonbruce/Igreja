<label>Nome do Membro:</label>
<input type="text" name="nome" id="campo_nome" size="30%" class="form-control"
	placeholder="Digite o nome do Membro da Igreja!"
	tabindex="<?php echo ++$ind;?>" value="<?php echo $nomeMembro;?>" />
<input type="hidden" id="sigla_val" name="rol" value="<?php echo $rolMembro;?>"
tabindex="<?php echo ++$ind;?>" class="form-control" required='required'/>
