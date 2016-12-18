<?php
///require("calendario/funcs.php");
$sec = (empty($_GET['sec'])) ? 0 : intval($_GET['sec']) ;
$linkLancamento = 'escolha=controller/secretaria.php&';
    switch ($sec) {
        case 1:
            # Novos convertidos
            require_once 'views/secretaria/topNovoConvert.php';
            require_once 'views/secretaria/cadNovoConvert.php';
            $linkLancamento .='sec=1&';
            break;
        default:
            #Agenda da secretaria executiva
            #$painelDireito = 'views/secretaria/agendaMes.php';
            #$linkLancamento .='sec=2&';
            #require_once 'views/secretaria/agenda.php';
            require_once 'agendaSec/index.php';
            break;
    }
?>
