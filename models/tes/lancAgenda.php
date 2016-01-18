<?php
    if ($valor_us>0) {
       #se o valor for zero não realiza o lançamento

    $disponivel = ($_POST['acessoCreditar']=='') ? false:$_POST['acessoCreditar'];
    //Verifica se a cta para pgto foi definida
    if ($disponivel) {
       $saldoDisp = new DBRecord ('contas',$disponivel,'acesso');
    }else {
        exit('A conta para pagamento não foi definida! Lançamento não confirmado...');
    }

    if ($saldoDisp->saldo()<($valor_us+$multaUS)) {
        # Verifica se a conta possui saldo para efetuar o pgto
        exit('A conta para pagamento não possui saldo suficiente! Lançamento não confirmado...');
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
