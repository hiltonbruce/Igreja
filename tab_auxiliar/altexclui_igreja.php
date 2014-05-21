<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />

<fieldset><legend>Alterar cadastro e/ou Destivar Igrejas</legend>
<table id="Tabela de igrejas" summary="Lista de todos as igrejas da Cidade." style="text-align: left; width: 100%;">
    <caption>
      Todos as igrejas da Assembleia de Deus em Bayeux-PB
    </caption>
    <colgroup>
		<col id="Nome da atual">
		<col id="Alterar Nome:">
		<col id="Excluir">
		<col id="Excluir igreja!">
	</colgroup>
    <thead>
      <tr>
        <th scope="col">Nome da atual</th>
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
			<td><?php echo $lista[$chave]['0'];?></td>
			<td><?php
					$alt_bair = new formigreja();
					$alt_bair->formulario($lista[$chave]['0'], $chave, ++$ind);
					
					if ($lista[$chave]['1']=='1')/*Status ativo da igreja*/{
						$status = '0';$scrStatus ='img/not.png';$nomButton = 'Desativar...';
						$titleButton = 'Encerra o funcionamento desta Igreja!';
					}else {
						$status = '1';$scrStatus ='img/yes.png';$nomButton = 'Ativar...';
						$titleButton = 'Reativar o funcionamento desta Igreja!';
					}
						
				?>
			</td>
			<td>
				<?php 
					if ($chave!='1') {
						?>
							<form method="post" action="">
								<input type="hidden" name="escolha" value="sistema/atualizar_rol.php">
								<input type="hidden" name="campo" value="status">
								<input type="hidden" name="tabela" value="igreja">
								<input type="hidden" name="id" value="<?php echo $chave.'&igreja='.$lista[$chave];?>">
								<input type="hidden" name="status" value="<?php echo $status;?>">
								<button	title='<?php echo $titleButton;?>' class="btn btn-primary btn-xs" >
							<img src="<?php echo $scrStatus;?>" alt="Desativar" width="22" height="22" align="absmiddle" border="0" />
							<?php echo $nomButton;?></button>
							</form>
						<?php
					}else {
						echo '<span class="divider" title="A sede n&atilde;o pode ser exclu&iacute;da!">Sede</span>';
					}
				?>
				</td>
				<td>
				<a href="./?escolha=forms/editar_igreja.php&tabela=igreja&rol=<?php echo $chave;?>"
				 title="Editar as informa&ccedil;&otilde;es gerais desta Igreja: Dirigente, secretário, tesoureiro, etc." >
				 <button class="btn btn-primary btn-xs">
				<img src="img/blackeditar.png" alt="Voltar 1 dia" width="22" height="22" align="absmiddle" border="0" />
				Dados</button></a>
			</td>
    	</tr>
    		<?PHP
    		next($lista);
    	}
    ?>
    </tbody>
  </table>
 </fieldset>
