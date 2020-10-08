<?php

//SELECT l.*,DATE_FORMAT(l.data,"%Y%m") AS dt FROM lanc AS l WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND (l.creditar=10 OR l.debitar=10)

if ((empty($_GET['periodo']))) {
    $ano = date('Y');
    $mes = date('m');
}else {
    list($ano,$mes) = explode('/',$_GET['periodo']);
    if ($mes>'12' || $mes<'01') {
        $mes = '01';
    }
    if ($ano<'2010' || $ano>date('Y')) {
        $ano = date('Y');
    }
}

$anoMes = $ano.$mes;


// $query = $conn->query('SELECT l.*,DATE_FORMAT(l.data,"%Y%m") AS dt FROM lanc AS l WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND (l.creditar=10 OR l.debitar=10)', PDO::FETCH_ASSOC);
// $query->execute();
// var_dump($query);

$recCred = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.creditar=10');
// var_dump($recCred->fetch(PDO::FETCH_OBJ));
$row = $recCred->fetch(PDO::FETCH_OBJ);
// var_dump($row);

$totCred = $row->somavlr;
$recDeb = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.debitar=10');
// var_dump($recDeb->fetch(PDO::FETCH_OBJ));
$rdeb = $recDeb->fetch(PDO::FETCH_OBJ);
$totDeb = $rdeb->somavlr;
$provComadep = $totCred - $totDeb;
echo '<br />( - ) Provisão p/ COMADEP - Contribuição 10% <br />';
echo $provComadep;
echo ' *** <br />'; 

$recCred = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.creditar=11');
// var_dump($recCred->fetch(PDO::FETCH_OBJ));
$row = $recCred->fetch(PDO::FETCH_OBJ);
$totCred = $row->somavlr;
$recDeb = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.debitar=11');
// var_dump($recDeb->fetch(PDO::FETCH_OBJ));
$rdeb = $recDeb->fetch(PDO::FETCH_OBJ);
$totDeb = $rdeb->somavlr;

echo ' 	( - ) Provisão p/ SEMAD - Contribuição 40% <br />';
echo $totCred - $totDeb;

echo '<br />Receitas --- <br />';
$recRecCred = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.creditar=c.id AND c.nivel3="4.1.1"');
// var_dump($recRecCred->fetch(PDO::FETCH_OBJ));
$row = $recRecCred->fetch(PDO::FETCH_OBJ);
$totRecCred = $row->somavlr;
$recDeb = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.debitar=c.id AND c.nivel3="4.1.1"');
$rdeb = $recDeb->fetch(PDO::FETCH_OBJ);
$totRecDeb = $rdeb->somavlr;
echo $totRecCred - $totRecDeb;

echo '<br />RECEITAS DE CAMPANHAS --- <br />';
$recCampCred = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.creditar=c.id AND c.nivel4="4.1.1.003"');
$row = $recCampCred->fetch(PDO::FETCH_OBJ);
$totCampCred = $row->somavlr;
$recDeb = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.debitar=c.id AND c.nivel4="4.1.1.003"');
$rdeb = $recDeb->fetch(PDO::FETCH_OBJ);
$totCampDeb = $rdeb->somavlr;
echo $totCampCred - $totCampDeb;
echo '<br />RECEITAS MENOS CAMPANHAS --- <br />';
echo $totRecCred - $totRecDeb - $totCampCred - $totCampDeb;

echo '<br />Contas de RECEITA --- <br />';
$ctaReceitas = $conn->query('SELECT * FROM contas WHERE nivel1="4" GROUP BY nivel3');

while ($ctas = $ctaReceitas->fetch(PDO::FETCH_OBJ)) {
    echo $ctas->nivel3.'<br />';
}
// exit;

echo '<br />RECEITAS DE CAMPANHAS --- <br />';
$recCampCred = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.creditar=c.id AND c.nivel4="4.1.1.003"');
$row = $recCampCred->fetch(PDO::FETCH_OBJ);
$totCampCred = $row->somavlr;
$recDeb = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.debitar=c.id AND c.nivel4="4.1.1.003"');
$rdeb = $recDeb->fetch(PDO::FETCH_OBJ);
$totCampDeb = $rdeb->somavlr;
echo $totCampCred - $totCampDeb;

echo '<br />Receitas de Missões--- <br />';
$recRecCred = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.creditar=c.id AND c.nivel3="4.1.2"');
// var_dump($recRecCred->fetch(PDO::FETCH_OBJ));

while($row = $recRecCred->fetch(PDO::FETCH_OBJ)){
    $totRecCred = $row->somavlr;
    echo $totRecCred . '<br />';
}

$recDeb = $conn->query('SELECT l.*,SUM(l.valor) AS somavlr FROM lanc AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.debitar=c.id AND c.nivel3="4.1.2"');
// var_dump($recDeb->fetch(PDO::FETCH_OBJ));
while($rdeb = $recDeb->fetch(PDO::FETCH_OBJ)){
    $totRecDeb = $rdeb->somavlr;
    echo  $totRecDeb . '<br />';
}

echo $totRecCred - $totRecDeb;

echo '<br />Dizimos e Ofertas--- <br />';
$recDizCred = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.credito=c.acesso AND c.nivel4="4.1.1.001"');
// var_dump($recDizCred->fetch(PDO::FETCH_OBJ));

while($row = $recDizCred->fetch(PDO::FETCH_OBJ)){
    $totRecCred = $row->valor;
    echo $totRecCred . '<br />';
}

$recDizDeb = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.devedora=c.acesso AND c.nivel4="4.1.1.001"');
// var_dump($recDizDeb->fetch(PDO::FETCH_OBJ));
while($rdeb = $recDizDeb->fetch(PDO::FETCH_OBJ)){
    $totRecDeb = $rdeb->valor;
    echo  $totRecDeb . '<br />';
}

echo $totRecCred - $totRecDeb;

echo '<br />Campanhas--- <br />';
$recDizCred = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.credito=c.acesso AND c.nivel4="4.1.1.003"');
while($row = $recDizCred->fetch(PDO::FETCH_OBJ)){
    $totRecCred = $row->valor;
    echo $totRecCred . '<br />';
}

$recDizDeb = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.devedora=c.acesso AND c.nivel4="4.1.1.003"');
while($rdeb = $recDizDeb->fetch(PDO::FETCH_OBJ)){
    $totRecDeb = $rdeb->valor;
    echo  $totRecDeb . '<br />';
}

echo $totRecCred - $totRecDeb;

echo '<br />Escola--- <br />';
$recDizCred = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.credito=c.acesso AND c.nivel4="4.1.1.004"');
while($row = $recDizCred->fetch(PDO::FETCH_OBJ)){
    $totRecCred = $row->valor;
    echo $totRecCred . '<br />';
}

$recDizDeb = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.devedora=c.acesso AND c.nivel4="4.1.1.004"');
while($rdeb = $recDizDeb->fetch(PDO::FETCH_OBJ)){
    $totRecDeb = $rdeb->valor;
    echo  $totRecDeb . '<br />';
}

echo $totRecCred - $totRecDeb;

echo '<br />USADEBY--- <br />';
$recDizCred = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.credito=c.acesso AND c.nivel4="4.1.1.002"');
while($row = $recDizCred->fetch(PDO::FETCH_OBJ)){
    $totRecCred = $row->valor;
    // echo $totRecCred . '<br />';
}

$recDizDeb = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.devedora=c.acesso AND c.nivel4="4.1.1.002"');
while($rdeb = $recDizDeb->fetch(PDO::FETCH_OBJ)){
    $totRecDeb = $rdeb->valor;
    // echo  $totRecDeb . '<br />';
}

echo $totRecCred - $totRecDeb;

echo '<br /><br />UMADEBY--- <br />';
$recDizCred = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.credito=c.acesso AND c.nivel4="4.1.1.005"');
while($row = $recDizCred->fetch(PDO::FETCH_OBJ)){
    $totRecCred = $row->valor;
    // echo $totRecCred . '<br />';
}

$recDizDeb = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.devedora=c.acesso AND c.nivel4="4.1.1.005"');
while($rdeb = $recDizDeb->fetch(PDO::FETCH_OBJ)){
    $totRecDeb = $rdeb->valor;
    // echo  $totRecDeb . '<br />';
}

echo $totRecCred - $totRecDeb;

echo '<br /><br />UCADEBY--- <br />';
$recDizCred = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.credito=c.acesso AND c.nivel4="4.1.1.006"');
while($row = $recDizCred->fetch(PDO::FETCH_OBJ)){
    $totRecCred = $row->valor;
    echo $totRecCred . '<br />';
}

$recDizDeb = $conn->query('SELECT SUM(l.valor) AS valor FROM dizimooferta AS l, contas AS c WHERE DATE_FORMAT(data,"%Y%m")="'.$anoMes.'" AND l.devedora=c.acesso AND c.nivel4="4.1.1.006"');
while($rdeb = $recDizDeb->fetch(PDO::FETCH_OBJ)){
    $totRecDeb = $rdeb->valor;
    echo  $totRecDeb . '<br />';
}
