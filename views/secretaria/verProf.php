<table class='table table-striped table-condensed'>
    <tr>
      <td>
        <strong>Profiss&atilde;o:</strong><h6><?PHP echo $arr_dad->profissao();?></h6>
      </td>
      <td>
        <strong>CPF:</strong>
        <h6><?PHP echo $arr_dad->cpf();?></h6>
      </td>
      <td><strong>Identidade:</strong>
        <h6><?PHP echo $arr_dad->rg();?></h6>
      </td>
    </tr>
    <tr>
      <td><strong>Org&atilde;o expedidor:</strong>
        <h6><?PHP echo $arr_dad->orgao_expedidor();?></h6>
      </td>
      <td colspan="2"><strong>Empresa onde Trabalha:</strong>
        <h6><?PHP echo $arr_dad->onde_trabalha();?></h6>
      </td>
    </tr>
    <tr>
    <td colspan="4"><strong>Observa&ccedil;&otilde;es:</strong>
      <h6><?PHP echo $arr_dad->obs();?></h6>
    </td>
  </tr>
  </table>
