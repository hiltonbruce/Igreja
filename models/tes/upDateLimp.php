<?php
$idMat = intval($_GET['id']);

// var_dump($_GET);
$materialLimp = "SELECT * FROM limpeza WHERE id=:ID";
$stmtLimp = $conn->prepare($materialLimp);
$stmtLimp ->bindParam(":ID", $idMat);
$stmtLimp->execute();
$resultsLimp = $stmtLimp->fetchAll(PDO::FETCH_ASSOC);


// var_dump($resultsLimp[0]);
$optionLimp = '';
$optWhere = '';
$separ = '';
foreach ($resultsLimp[0] as $key => $value) {

  $optionLimp .= ':'.strtoupper($key);
  // $stmt ->bindParam($optionLimp, .$value);
  if ($_GET[$key]!='' && $key!='id') {
    $optionsVlr = strtoupper($key);
    $optWhere .= $separ . $key.'=:'.$optionsVlr;
    $separ = ', ';
  }

}

$materialUpdate = "UPDATE limpeza SET ".$optWhere.' WHERE id=:ID';
// echo $materialUpdate;
$stmtUpDate = $conn->prepare($materialUpdate);
$stmtUpDate ->bindParam(':ID', $idMat);


foreach ($resultsLimp[0] as $key => $value) {

  $optionLimp .= ':'.strtoupper($key);
  // $stmt ->bindParam($optionLimp, .$value);
  if ($_GET[$key]!='' && $key!='id') {
    $optionsVlr = strtoupper($key);
    $stmtUpDate ->bindParam($optionsVlr, $_GET[$key]);
  }

}
// $stmtUpDate->execute();
if ($stmtUpDate->execute()) {
  ?>

<br />
  <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4>Atualizado!</h4>
      <p>O item <?php echo $_GET['discrim'];?> foi atualizado com sucesso!</button>
      </p>
    </div>

  <?php
} else {
  ?>

<br />
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4>Erro!</h4>
      <p>O material <?php echo $_GET['discrim'];?> n&atilde;o foi atualizado no sistema! Se o problema persistir entre em contato o desenvolvedor!
      </p>
    </div>

  <?php
}

 ?>
