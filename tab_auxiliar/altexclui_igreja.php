<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />

<fieldset><legend>Altera��o e Exclus�o de Igrejas</legend>
<table id="Tabela de igrejas" summary="Lista de todos as igrejas da Cidade." style="text-align: left; width: 100%;">
    <caption>
      Todos as igrejas da Cidade de Bayeux-PB
    </caption>
    <colgroup>
		<col id="Nome da atual">
		<col id="Alterar Nome:">
		<col id="Excluir">
		<col id="Excluir igreja!">
	</colgroup>
    <thead>
      <tr>
        <th id="playlistPosHead" scope="col">Nome da atual</th>
        <th scope="col">Alterar Nome:</th>
        <th scope="col">Excluir</th>
        <th scope="col">Editar igreja!</th>
      </tr>
    </thead>

    <tbody>
    <?php

    $options = new igreja();
	$lista = $options->Arrayigreja();

	while ($chave=key($lista)) {
		++$contar;
		if ($contar==1) {
			$zebrar = "class='odd'";}
			else
			{$zebrar = "";$contar=0;}
		?>
		<tr <?php echo $zebrar;?>>
			<td><?php echo $lista[$chave];?></td>
			<td><?php
					$alt_bair = new formigreja();
					$alt_bair->formulario($lista[$chave], $chave, ++$ind);
				?>
			</td>
			<td>
				<?php 
					if ($chave!='1') {
						?>
							<a href="./?escolha=sistema/excluir.php&campo=rol&tabela=igreja&id=
							<?php echo $chave.'&igreja='.$lista[$chave];?>">
							<img src="img/not.png" alt="Voltar 1 dia" width="22" height="22" title="Voltar 1 dia" align="absmiddle" border="0" />
							Excluir...</a>
						<?php
					}else {
						echo '<span class="divider" title="A sede n�o pode ser exclu�da!">Sede</span>';
					}
				?>
				</td>
				<td>
				<a href="./?escolha=forms/editar_igreja.php&tabela=igreja&rol=<?php echo $chave;?>">
				<img src="img/blackeditar.png" alt="Voltar 1 dia" width="22" height="22" title="Voltar 1 dia" align="absmiddle" border="0" />
				Dados</a>
			</td>
    	</tr>
    		<?PHP
    		next($lista);
    	}

    ?>

    </tbody>
  </table>
 </fieldset>
