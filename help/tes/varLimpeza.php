<?PHP
$igreja = ($_GET['igreja']>0) ? $_GET['igreja']:$_POST['igreja'];
$linkperido = '';

if (!empty($_POST['ano'])) {
    $anoPed = intval($_POST['ano']) ;
} elseif (!empty($_GET['ano'])) {
    $anoPed = intval($_GET['ano']) ;
} else{
    $anoPed = date('Y');
}

if (!empty($_GET['mesref'])) {
    $mesref = $_GET['mesref'];
    list($mesPed,$anoPed) = explode('/',$_GET['mesref'] );
    $linkperido = 'mes='.$mesPed.'&ano='.$anoPed.'&mesref='.$mesref;
} elseif (!empty($_POST['mesref'])) {
    $mesref = $_POST['mesref'];
    list($mesPed,$anoPed) = explode('/',$_POST['mesref'] );
    $linkperido = 'mes='.$mesPed.'&ano='.$anoPed.'&mesref='.$mesref;
} elseif (!empty($_POST['mes'])) {
    $mesref = sprintf("%'02u/%u",intval($_POST['mes']),$anoPed);
    $linkperido = 'mes='.$mesPed.'&ano='.$anoPed.'&mesref='.$mesref;
} else {
    $ref = new ultimoid('limpezpedid');
    $mesref = $ref->ultimo('mesref');
    $linkperido = 'mes='.$mesPed.'&ano='.$anoPed.'&mesref='.$mesref;
}
?>
