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
      <p>Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>tton type="button" class="btn btn-default">Or do this</button>
      </p>
    </div>

  <?php
}

 ?>
