<fieldset><legend>Altera&ccedil;&atilde;o e Inicializa&ccedil;&atilde;o de Senhas</legend>
<table class='table table-striped table-hover'>
    <colgroup>
		<col id="Usuários">
		<col id="Inicializar/Excluir!">
		<col id="Área">
		<col id="albumCol">
	</colgroup>
    <tbody>
    <?php
      $options = new usuarios();
      $lista = $options->Arrayusuario();
      // var_dump($lista);
      for ($item=0;$item<count($lista);$item++){
    		foreach ($lista[$item] as $key => $result):
      	   $usuario->$key = $result;
    		endforeach;
  $errorIni = true;
  if ($usuario->situacao=='1' && (($usuario->setor==$_SESSION["setor"] && $_SESSION["nivel"]>'10') || $_SESSION['nivel']>='15')) {
    $botaoAtDes = '<p><button class="btn btn-danger btn-sm" ><span class="glyphicon ';
    $botaoAtDes .= 'glyphicon-remove"></span> Desativar...</button></a></p>';
  } elseif ($usuario->situacao=='0' && (($usuario->setor==$_SESSION["setor"] && $_SESSION['nivel']>'10') || $_SESSION['nivel']>='15')) {
    # Opção de ativa caso esteja desativado
    $botaoAtDes = '<p><button class="btn btn-success btn-sm" ><span class="glyphicon ';
    $botaoAtDes .= 'glyphicon-ok"></span> Ativar...</button></a></p>';
  }else {
    $errorIni = false;
    $botaoAtDes = '';
  }
  $alterar = new formusuario($usuario->cpf,$usuario->cargo);
  	?>
		<tr>
			<td width='40%'>
        <?php
					$alterar->alt_nome($usuario->nome, $usuario->id, ++$ind,$errorIni,$usuario->perfil);
				?>
				<a href="./?escolha=tab_auxiliar/inic_usuario.php&menu=top_admusuario&id=<?php
        echo $usuario->id;?>">
				<?php
          echo $botaoAtDes;
					$situacao = ($usuario->situacao=='0') ? 1 : 0 ;
					if ($_GET['id']==$usuario->id && ($usuario->setor==$_SESSION["setor"] || $_SESSION['setor']>='50')) {
						$options->Atualizar($_GET['id'],$situacao);
					}elseif ($_GET['id']==$usuario->id) {
						# code...
						echo '<script> alert("Você não tem autorização para alterar esse usuário!")</script>';
					}
					if ($errorIni) {
						#Se tem autorizaï¿½ï¿½o inicializa senha
						$alterar->ini_senha($usuario->id, ++$ind);
					}else {
					  echo '</td><td>';
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
