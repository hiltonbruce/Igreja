<?php $ind=1;

if (date("n")>='10') 
	$ano = date("Y")+1;
	else
	$ano = date("Y");
?>
<fieldset>
<legend>Emitir Envelopes</legend>
<form id="form1" name="form1" method="post" action="tesouraria/envelope_dizimo.php">
	Nome
	<input type="text" name="nome" size="40" tabindex="<?PHP echo $ind++;?>" />			
	Rol:
	<input name="rol" type="text" value="" size="10"  tabindex="<?PHP echo $ind++;?>" />
	<a href="javascript:lancarSubmenu('campo=nome&rol=rol&form=0')"><img border="0" src="img/lupa_32x32.png" width="18" height="18" title="Click aqui para pesquisar membros!" /></a>
	Ano:
	<input name="ano" type="text" value="<?PHP echo $ano;?>" size="4"  tabindex="<?PHP echo $ind++;?>"  />
	<input type="submit" name="Submit" value="Emitir envelope..." tabindex="<?PHP echo ++$ind; ?>"/>
</form>
</fieldset>

<fieldset>
<legend>Personalizar impressão</legend>
	Tamanho do Papel<br />
	&nbsp;&nbsp;Largura...........210,0 mm<br />
	&nbsp;&nbsp;Altura............297,0 mm<br /><br />
	Margens do Papel<br />
	&nbsp;&nbsp;Acima..............6,30 mm<br />
	&nbsp;&nbsp;Abaixo............14,20 mm<br />
	&nbsp;&nbsp;Esquerda...........6,30 mm<br />
	&nbsp;&nbsp;Direita........... 6,30 mm<br /><br /><br />
	Modo paissagem<br /><br /><br />
	Para Envelope de Tamaho ..... 119mm x 169mm
	
</fieldset>
