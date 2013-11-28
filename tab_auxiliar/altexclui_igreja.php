<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />

<fieldset><legend>Alteração e Exclusão de Igrejas</legend>
<table id="Tabela de igrejas" summary="Lista de todos as igrejas da Cidade." style="text-align: left; width: 100%;">
    <caption>
      Todos as igrejas da Cidade de Bayeux-PB
    </caption>
    <colgroup>
		<col id="Nome da atual">
		<col id="Alterar para:">
		<col id="Excluir igreja!">
	</colgroup>
    <thead>
      <tr>
        <th scope="col">Nome da atual</th>
        <th scope="col">Alterar Nome:</th>
        <th scope="col">Excluir igreja!</th>
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
				<a href="./?escolha=sistema/excluir.php&campo=rol&tabela=igreja&id=<?php echo $chave;?>">Excluir...</a>
				<a href="./?escolha=forms/editar_igreja.php&tabela=igreja&rol=<?php echo $chave;?>">Editar informa&ccedil;&otilde;es</a>
			</td>
    	</tr>
    		<?PHP
    		next($lista);
    	}

    ?>

    </tbody>
  </table>
 </fieldset>