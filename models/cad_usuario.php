<!-- <h1><img src="img/loading2.gif" width="30" height="30"></h1> -->
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICEN�A
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa Bruce (http://)
 * @license    http://
 * Insere dados no banco do form cad_usuario.php na tabela:usuario
 */
controle ("admin_user");

if ($_POST['senha'] != $_POST['senha1']) {
  echo "<script>alert('Desculpe! Mas, as senhas não coincidem! Tente outra vez.');; window.history.go(-1);</script>";
  exit;
}

$separ = '';
$optWhere = '"",';
$perfil = '';
$sepPerfil = '';

for ($i=0; $i < 10; $i++) {
  $keyPost = 'perfil'.$i;
  if (isset($_POST[$keyPost]))
  {
    $perfil .= $sepPerfil.strtolower(strip_tags($_POST[$keyPost]));
    $sepPerfil = ',';
  }
}

// echo "string -> ".$perfil.'<br />';

$dataUser = "SELECT * FROM usuario LIMIT 1";
$stmtUser = $conn->prepare($dataUser);
$stmtUser->execute();
$resultsUser = $stmtUser->fetchAll(PDO::FETCH_ASSOC);

// var_dump($resultsUser[0]);

foreach ($resultsUser[0] as $key => $value) {
  // $stmt ->bindParam($optionLimp, .$value);
  $optionsVlr = strtoupper($key);

  if (!empty($_POST[$key]) && $key!='id') {
    $optWhere .= $separ . ':' . $optionsVlr;
    $separ = ', ';
  } elseif ($key == 'perfil' && $key!='id') {
    $optWhere .= $separ . ':' . $optionsVlr;
    $separ = ', ';
  }
}

// echo "string perfilUser-> ".$optWhere.'<br />';

// $optWhere .= $perfilUser;;
$addUser = "INSERT INTO usuario VALUE ($optWhere)";
$stmtAddUser = $conn->prepare($addUser);

foreach ($resultsUser[0] as $key => $value) {
  $optionsVlr = ':'.strtoupper($key);
  if (!empty($_POST[$key]) && $key!='id' && $key!='perfil') {
    $stmtAddUser -> bindParam($optionsVlr, $_POST[$key]);
    // echo "$optionsVlr -> ".$_POST[$key].'<br />';
  }elseif ($key=='perfil') {
    $stmtAddUser -> bindParam($optionsVlr,$perfil );
    // echo "$optionsVlr -> ".$perfil.'<br />';
  }
}

if ($stmtAddUser->execute()) {
  ?>
  <div class="bs-callout bs-callout-warning bg-success" id="callout-input-needs-type">
      <h4>Cadastrado realizado com sucesso!!!</h4>
      <p><strong>Nome: </strong><?=$_POST['nome']?></p>
      <p><strong>CPF: </strong><?=$_POST['cpf']?></p>
      <p><strong>Cargo: </strong><?=$_POST['cargo']?></p>
      <p><strong>Perfil de acesso: </strong><?=$perfil?></p>
    </div>
    <?php

}
else
{
	echo "<script>alert('Desculpe! Mas, lembre-se você deve ter privilégios para cadastrar esse uauário, para conclusão do cadastro de acesso ao sistema!{$_SESSION["setor"]} - {$_POST["perfil"]}');</script>";
}
?>
<p>&nbsp;</p>
