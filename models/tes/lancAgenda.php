<?php
    if ($valor_us>0) {
       #se o valor for zero não realiza o lançamento

    $disponivel = ($_POST['acessoCreditar']=='') ? false:$_POST['acessoCreditar'];
    //Verifica se a cta para pgto foi definida
    if ($disponivel) {
       $saldoDisp = new DBRecord ('contas',$disponivel,'acesso');
    }else {
        $msg  = '<div class="alert alert-danger" role="alert">';
        $msg .= '<h3><span class="glyphicon glyphicon-exclamation-sign" ';
        $msg .= 'aria-hidden="true"></span><span class="sr-only">Error:</span> ';
        $msg .= 'Falta Conta</h3>';
        $msg .= 'A conta para pagamento n&atilde;o foi definida! Lan&ccedil;amento ';
        $msg .= 'n&atilde;o confirmado...</div>';
        exit($msg);
    }

    if ($saldoDisp->saldo()<($valor_us+$multaUS)) {
        # Verifica se a conta possui saldo para efetuar o pgto
        $msg  = '<div class="alert alert-danger" role="alert">';
        $msg .= '<h3><span class="glyphicon glyphicon-exclamation-sign" ';
        $msg .= 'aria-hidden="true"></span><span class="sr-only">Error:</span> ';
        $msg .= 'Saldo insuficiente</h3>';
        $msg .= 'A conta para pagamento n&atilde;o possui saldo suficiente! ';
        $msg .= 'Lan&ccedil;amento n&atilde;o confirmado...</div>';
        exit($msg);
    }
        $despesa    = $_POST['acessoDebitar'];
        require_once 'models/tes/lancamento.php';
        if ($msgErro=='') {
            #Se houver lançamento atualiza a agenda
            $atualizar->idlanc  = $ultimolanc;//id do lancamento atual
        }

        $atualizar->Update();
    }

?>
