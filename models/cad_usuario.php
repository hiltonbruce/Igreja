<!-- <h1><img src="img/loading2.gif" width="30" height="30"></h1> -->
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICENÇA
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
$perfil = 'user';
$sepPerfil = '';
$campos = '';

// $conn = new PDO('mysql:dbname='.DBNAME.';host='.DBPATH,DBUSER,DBPASS);

for ($i=0; $i < 10; $i++) {
  $keyPost = 'perfil'.$i;
  if (isset($_POST[$keyPost]) && $_POST[$keyPost]!='')
  {
    $perfil .= ','.strtolower(strip_tags($_POST[$keyPost]));
    // $sepPerfil = ',';
  }
}
// echo "<br /> perfil -> ".$perfil;
// echo "<br />";

// var_dump($conn);

// echo "<br />";
$dataUser = "SELECT * FROM usuario LIMIT 1";
$stmtUser = $conn->prepare($dataUser);
$stmtUser->execute();
$resultsUser = $stmtUser->fetchAll(PDO::FETCH_ASSOC);
// echo "<br />";
// print("PDO::FETCH_ASSOC: ");
// print_r($resultsUser);
// echo "<br />";

foreach ($resultsUser[0] as $key => $value) {

  $optionsVlr = strtoupper($key);

  if (!empty($_POST[$key]) && $key!='senha' && $key!='data') {
    $optWhere .= $separ . ':' . $optionsVlr;
  } elseif ($key == 'perfil' && $key!='id') {
    $optWhere .= $separ . ':' . $optionsVlr;
  }elseif ($key == 'senha') {
    $optWhere .= $separ . ':' . $optionsVlr;
  }elseif ($key == 'id') {
    $optWhere = ':ID' ;
  }elseif ($key == 'data') {
    $optWhere .= ',:DATAHIST' ;
  }
  $campos .= $separ.$key ;

  $valores .= $separ.$key ;

  $separ = ', ';
}


// echo "<br />";
// print("optWhere ");
// print_r($optWhere);
// echo "<br />";
// print("campos ");
// print_r($campos);
// echo "<br />";

$addUser = "INSERT INTO usuario ($campos) VALUE ($optWhere)";
$stmtAddUser = $conn->prepare($addUser);

// $resultsUser[0]['id'] = 'NULL';

foreach ($resultsUser[0] as $key => $value) {
  $optionsVlr = ':'.strtoupper($key);

  $dado = $_POST[$key];

  if ($key == 'id') {
    $dado = NULL;
  // continue;
  }elseif ($key == 'data') {
    $optionsVlr = ":DATAHIST";
    $dado = $_POST[$key];
  }elseif ($key == 'perfil') {
    $dado = "$perfil";
  }elseif ($key == 'historico') {
    $dado = $_SESSION['valid_user']." @ ".date("Y-m-d h:i:s");
  }elseif ($key == 'senha') {
    $dado = MD5($value);
  }else{
    $dado = $_POST[$key];
  }

  $stmtAddUser->bindValue($optionsVlr, $dado);
  // echo $optionsVlr.' - '.$key." value -> ".$dado.'<br />';
}
// echo "string -> ".$addUser;

// $dados = new insert ($value,'usuario');

// echo mysqli_error($conn);
$result = $stmtAddUser->execute();


// echo "***************2222**********";echo "<br />";
// print("PDO::FETCH_ASSOC: ");
// print_r($result);
// echo "<br />";

if ($result) {
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
	echo "<script>alert('Desculpe! Mas, houve um erro no Banco de Dados! {$_SESSION["setor"]} - Perfil: {$perfil}');</script>";
}
// echo mysqli_error($conn);
?>
<p>&nbsp;</p>
