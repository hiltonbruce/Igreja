<?php
// $discrimMat = strlen($_GET['discrim']);

// var_dump($_GET);
$idMat = 1;
$materialLimp = "SELECT * FROM limpeza WHERE id=:ID";
$stmtLimp = $conn->prepare($materialLimp);
$stmtLimp ->bindParam(":ID", $idMat);
$stmtLimp->execute();
$resultsLimp = $stmtLimp->fetchAll(PDO::FETCH_ASSOC);


// var_dump($resultsLimp[0]);

$optionLimp = '';
$optWhere = '"",';
$separ = '';
foreach ($resultsLimp[0] as $key => $value) {

  $optionLimp .= ':'.strtoupper($key);
  // $stmt ->bindParam($optionLimp, .$value);
  if ($key!='id') {
    $optionsVlr = strtoupper($key);
    $optWhere .= $separ . ':'.$optionsVlr;
    $separ = ', ';
  }

}

$materialUpdate = "INSERT INTO limpeza VALUE ($optWhere)";
// echo '<br />$materialUpdate '.$materialUpdate;
$stmtUpDate = $conn->prepare($materialUpdate);
// $stmtUpDate ->bindParam(':ID', $idMat);


foreach ($resultsLimp[0] as $key => $value) {

  $optionLimp .= ':'.strtoupper($key);
  // $stmt ->bindParam($optionLimp, .$value);
  if ($_GET[$key]!='' && $key!='id') {
    $optionsVlr = strtoupper($key);
    $stmtUpDate ->bindParam($optionsVlr, $_GET[$key]);
    // echo '<br /> $key'.$optionsVlr.' VLR -> '.$_GET[$key];
  }

}
// $stmtUpDate->execute();
if ($stmtUpDate->execute()) {
  ?>

<br />
  <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4>Cadastro!</h4>
      <p>O material <strong><?php echo $_GET['discrim'];?></strong> foi registrado com sucesso!</button>
      </p>
    </div>

  <?php
} else {
  echo mysqli_error();
  ?>

<br />
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4>Erro!</h4>
      <p>Nenhum material novo foi cadastrado no sistema! Se o problema persistir entre em contato o desenvolvedor!
      </p>
    </div>

  <?php
}

 ?>
