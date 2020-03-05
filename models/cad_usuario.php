<!-- <h1><img src="img/loading2.gif" width="30" height="30"></h1> -->
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICENï¿½A
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
  if (isset($_POST[$keyPost]) && $_POST[$keyPost]!='')
  {
    $perfil .= $sepPerfil.strtolower(strip_tags($_POST[$keyPost]));
    $sepPerfil = ',';
  }
}
// echo "perfil -> ".$perfil;
echo "<br />";
// var_dump($conn);
$dataUser = "SELECT * FROM usuario LIMIT 1";
$stmtUser = $conn->prepare($dataUser);
$stmtUser->execute();
$resultsUser = $stmtUser->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultsUser[0] as $key => $value) {
  $optionsVlr = strtoupper($key);

  if (!empty($_POST[$key]) && $key!='senha') {
    $optWhere .= $separ . ':' . $optionsVlr;
    $separ = ', ';
  } elseif ($key == 'perfil' && $key!='id') {
    $optWhere .= $separ . ':' . $optionsVlr;
    $separ = ', ';
  }elseif ($key == 'senha') {
    $optWhere .= $separ . ':' . $optionsVlr;
    $separ = ', ';
  }
}

$addUser = "INSERT INTO usuario VALUE ($optWhere)";
$stmtAddUser = $conn->prepare($addUser);

foreach ($resultsUser[0] as $key => $value) {
  $optionsVlr = ':'.strtoupper($key);

  $dataUser = $_POST[$key];

  if ($key == 'id') {
  continue;
  }

  if ($key == 'perfil') {
    $_POST[$key] = $perfil;
  }elseif ($key == 'historico') {
    $_POST[$key] = $_SESSION['valid_user'].": ".date("Y-m-d h:i:s");
  }elseif ($key == 'senha') {
    $_POST[$key] = MD5($dataUser);
  }

  $stmtAddUser -> bindParam($optionsVlr, $_POST[$key]);
  // echo $optionsVlr.' - '.$key." value -> ".$dataUser.'<br />';
}
// echo "string -> ".$addUser;

// echo mysqli_error($conn);
// $stmtAddUser->execute();

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
	echo "<script>alert('Desculpe! Mas, lembre-se você deve ter privilégios para cadastrar esse uauúrio, para conclusão do cadastro de acesso ao sistema! {$_SESSION["setor"]} - {$_POST["perfil"]}');</script>";
}
?>
<p>&nbsp;</p>
