<table class='table table-striped table-condensed'>
    <tr>
      <td>
        <strong>Onde congrega:</strong><h6><?PHP echo $igreja->razao();?></h6>
      </td>
      <td>
        <strong>Situa&ccedil;&atilde;o espiritual:</strong>
        <h6><?PHP echo situacao ($arr_dad["situacao_espiritual"]);?></h6>
      </td>
      <td><strong>Ano  Batismo  Esp. Santo:</strong>
        <h6><?PHP echo $arr_dad["batismo_espirito_santo"];?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>Data Batismo &Aacute;guas:</strong>
        <h6><?PHP echo $arr_dad["batismo_em_aguas"];?></h6>
      </td>
      <td colspan="2"><strong>Denomina&ccedil;&atilde;o que veio:</strong>
        <h6><?PHP echo $arr_dad["veio_qual_denominacao"];?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>UF:</strong>
        <h6><?PHP echo $arr_dad['uf'];?></h6>
      </td>
      <td><strong>Local de Batismo:</strong>
        <h6><?PHP echo $cidade->nome();?></h6>
      </td>
      <td><strong>Mudou da denomina&ccedil;&atilde;o:</strong>
        <h6><?PHP echo $arr_dad["dt_mudanca_denominacao"];?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>Auxiliar de trabalho em:</strong>
        <h6><?PHP echo $arr_dad["auxiliar"];?></h6>
      </td>
      <td><strong>Di&aacute;cono em:</strong>
        <h6><?PHP echo $arr_dad["diaconato"];?></h6>
      </td>
      <td><strong>Presb&iacute;tero em:</strong>
        <h6><?PHP echo $arr_dad["presbitero"];?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>Evangelista em:</strong>
        <h6><?PHP echo $arr_dad["evangelista"];?></h6>
      </td>
      <td><strong>Pastor em:</strong>
        <h6><?PHP echo $arr_dad["pastor"];?></h6>
      </td>
      <td><strong>Data:</strong>
        <h6><?PHP echo $arr_dad["data"];?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>Cidade e UF de onde veio:</strong>
        <h6><?PHP echo $arr_dad["lugar"];?></h6>
      </td>
      <td><strong>Data da mudan&ccedil;a da outra Assembleia:</strong>
        <h6><?PHP echo $arr_dad["dt_muda_assembleia"];?></h6>
      </td>
      <td><strong>Data da aclama&ccedil;&atilde;o:</strong>
        <h6><?PHP echo $arr_dad["dat_aclam"];?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>Cart&atilde;o Impresso em:</strong>
        <h6><?PHP echo $arr_dad["c_impresso"];?></h6>
      </td>
      <td colspan='2'><strong>Cart&atilde;o Impresso por:</strong>
        <h6><?PHP echo quem_entregou ($arr_dad["quem_imprimiu"]);?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>Cart&atilde;o Entregue em:</strong>
        <h6><?PHP echo $arr_dad["c_entregue"];?></h6>
      </td>
      <td><strong>Cart&atilde;o Recebido por:</strong>
        <h6><?PHP echo fun_igreja ($arr_dad["quem_recebeu"]);?></h6>
      </td>
      <td><strong>Cart&atilde;o Entregue por:</strong>
        <h6><?PHP echo fun_igreja ($arr_dad["quem_entregou"]);?></h6>
      </td>
    </tr>
    <tr>
    <td colspan="4"><strong>Observa&ccedil;&otilde;es:</strong>
      <h6><?PHP echo $arr_dad["obs"];?></h6>
    </td>
  </tr>
  <tr>
    <td><strong>Recibo de entrega N&ordm;:</strong></td>
    <td colspan="3">
      <h6>
        <?PHP
          if ($arr_dad["rec_entrega"]>"0") {
            printf ("%'05u &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$arr_dad["rec_entrega"]) ;
          }else {
            echo "Sem recibo de entrega";
          }
          ?>
      </h6>
    </td>
  </tr>
  </table>
