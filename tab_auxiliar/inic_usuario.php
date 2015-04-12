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
				<a href="./?escolha=tab_auxiliar/inic_usuario.php&menu=top_admusuario&id=<?php echo $usuario->id;?>">
				<?php
					if ($usuario->situacao=='1') {
						echo '<button class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-remove"></span> Desativar...</button></a>';
					} else {
						echo '<button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-ok"></span> Ativar...</button></a>';
					}

					$situacao = ($usuario->situacao=='0') ? 1 : 0 ;

					if ($_GET['id']==$usuario->id) {
						$options->Atualizar($_GET['id'],$situacao);
					}
				?>				
				</td><td>
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