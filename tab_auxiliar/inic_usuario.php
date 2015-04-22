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

					$colInicializar = '';

					if ($usuario->situacao=='1' && $usuario->setor==$_SESSION["setor"]) {
						echo '<button class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-remove"></span> Desativar...</button></a>';
					} elseif ($usuario->setor==$_SESSION["setor"]) {
						# Opção de ativa caso esteja desativado
						echo '<button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-ok"></span> Ativar...</button></a>';
					}else {
						//echo '<button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-ok"></span> Ativar...</button></a>';
					}

					$situacao = ($usuario->situacao=='0') ? 1 : 0 ;

					$errorIni = true;

					if ($_GET['id']==$usuario->id && ($usuario->setor==$_SESSION["setor"] || $usuario->nivel>'10')) {
						$options->Atualizar($_GET['id'],$situacao);
					}elseif ($_GET['id']==$usuario->id) {
						# code...
						echo '<script> alert("Você não tem autorização para alterar esse usuário!")</script>';
						$errorIni = false;
					}
				?>
				</td><td>
				<?php
					if ($errorIni) {
						#Se tem autorização inicializa senha
						$alterar->ini_senha($usuario->id, ++$ind);
					}

				?>
			</td>
    	</tr>
    		<?PHP
	}
    ?>
    </tbody>
  </table>
 </fieldset>
