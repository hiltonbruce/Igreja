<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />

<fieldset><legend>Alteração e Inicializa&ccedil;&atilde;o de Senhas</legend>
<table id="Tabela de usuarios" summary="Lista de todos os usuarios com acesso ao sistema." style="text-align: left; width: 100%;">
    <colgroup>
		<col id="Usuários">
		<col id="Inicializar/Excluir!">
		<col id="">
		<col id="!">
	</colgroup>
    <tbody>
    <?php
  
    $options = new usuarios();
	$lista = $options->Arrayusuario();
		
	for ($item=0;$item<count($lista);$item++){
		foreach ($lista[$item] as $key => $result):
	         $usuario->$key = $result;
		endforeach;
		
		++$contar;
			
		$zebrar = ($contar % 2) == 0 ? "class='odd'" : "";
		?>
		<tr <?php echo $zebrar;?>>
			<td width='50%'><?php
				echo "CPF: ".$usuario->cpf." - Cargo:".$usuario->cargo;
					$alterar = new formusuario();
					$alterar->alt_nome($usuario->nome, $usuario->id, ++$ind);
				?>
			</td>
			<td>
				<a href="./?escolha=sistema/excluir.php&campo=id&tabela=usuario&id=<?php echo $usuario->id;?>">
				<button class='btn btn-primary btn-sm' ><span class='glyphicon glyphicon-remove'></span> Excluir...</button></a>
				</td><td><label>&nbsp;</label>
				<?php 
				
					$alterar->ini_senha($usuario->id, ++$ind)
				?>
			</td>
    	</tr>
    		<?PHP
	}
	
    ?>

    </tbody>
  </table>
 </fieldset>