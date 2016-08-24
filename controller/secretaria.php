<?php
///require("calendario/funcs.php");
$sec = (empty($_GET['sec'])) ? 0 : intval($_GET['sec']) ;
$linkLancamento = 'escolha=controller/secretaria.php&';
require_once 'views/secretaria/topNovoConvert.php';

    switch ($sec) {
        case 1:
            # Novos convertidos
            require_once 'views/secretaria/cadNovoConvert.php';
            break;

        default:
            #Agenda da secretaria executiva
            $painelDireito = 'views/secretaria/agendaMes.php';
            require_once 'views/secretaria/agenda.php';
            break;
    }
?>
