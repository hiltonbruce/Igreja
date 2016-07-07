<?php
	$eventos = new sec_Eventos('2016','2');
	#print_r($list());
?>
<dl class="dl-horizontal">
	<?php
		while ($listEventos = $eventos->listEventos()) {
	print_r($listEventos);
			echo '<dt>Evento: '.$listEventos['nevento'].'</dt>';
			echo '<dd>';
			echo 'Direção: '.$listEventos['nome'].'<br />'.'';
			echo 'Área Resp.: '.$listEventos['alias'].'<br />';
			echo 'Evento: '.$listEventos['nevento'].'<br />';
			echo '</dd>';
		}
	?>
</dl>