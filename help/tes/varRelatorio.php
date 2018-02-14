<?PHP
    $dia = (empty($_GET['dia'])) ? '' : sprintf("%'02u",$_GET['dia']);
    $ano = (empty($_GET['ano'])) ? date('Y'):$_GET['ano'];
    $refer = (empty($_GET['refer'])) ? '' : $_GET['refer'] ;
    $cta = (empty($_GET['conta'])) ? '' : $_GET['conta'] ;
    if (empty($_GET['conta'])) {
      $ctaId = '';
    } else {
      $conta = new tes_conta();
      $ctaAcesso = $conta->ativosArray();
      $ctaId = $ctaAcesso[intval($_GET['conta'])]['id'];
    }

    $mes = (empty($_GET['mes'])) ? '':sprintf("%'02u",$_GET['mes']) ;
    $roligreja = (empty($_GET['igreja'])) ? '0':intval($_GET['igreja']);
    $tituloColuna5 = 'Valor(R$)';
    $numLanc = (empty($_GET['numLanc'])) ? '' : intval($_GET['numLanc']) ;
    if (!empty($_GET['vlrLanc']) && $_GET['vlrLanc']!='0,00') {
      $vlrLanc = strtr( str_replace(array('.'),array(''),$_GET['vlrLanc']), ',.','.,' ) ;
    } else {
      $vlrLanc = '';
    }
    if (!empty($_GET['deb'])) {
        $deb = 'checked="checked"' ;
        $debA = 'active' ;
        $debValor = $_GET['deb'] ;
    }else {
        $deb =  '';
        $debA =  '';
        $debValor =  '';
    }
    if (!empty($_GET['cred'])) {
        $cred = 'checked="checked"' ;
        $credA = 'active';
        $credValor = '1';
    }else {
        $cred = '';
        $credA = '';
        $credValor = $_GET['cred'];
    }
?>
