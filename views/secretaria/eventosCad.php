<p>
	<?php
		$eventos = new sec_Eventos('2016','2');
		$listEventos = $eventos->listEventos();
		print_r($listEventos);
	?>
	<dl class="dl-horizontal">
		<?php
			foreach ($listEventos as $key => $value) {
				echo $value;
			}
		?>
	</dl>

</p>