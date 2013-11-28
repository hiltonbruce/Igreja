	<fieldset>
<legend>Cadastrar novo Curso </legend>
<form name="form1" method="post" action="">

  <label></label>
  <table>
    <tr>
      <td width="377"><label>Curso:
          <input name="tipo" type="text" id="tipo" />
      </label>
        <label>Turma:
        <input name="turma" type="text" id="turma" />
        </label>
        <label>Mensalidade:
        <input name="mensal" type="text" id="mensal" />
        </label>
        <label>Total de horas aula:
        <input name="horas_total" type="text" id="horas_total" />
        </label>
        <label> </label></td>
      <td width="337"><p>Marque os dias de Aula:</p>
        <p>
          <label>
          <input name="domingo" type="checkbox" id="domingo" value="1" />
            Domingo</label>
          <input name="segunda" type="checkbox" id="segunda" value="2" />
          Segunda-feira
  <label>
  <input name="terca" type="checkbox" id="terca" value="3" />
    Terça-feira</label>
  <label>
  <input name="quarta" type="checkbox" id="quarta" value="4" />
    Quarta-feira</label>
  <label>
  <input name="quinta" type="checkbox" id="quinta" value="5" />
    Quinta-feira</label>
  <label>
  <input name="sexta" type="checkbox" id="sexta" value="6" />
    Sexta-feira</label>
  <label>
  <input name="sabado" type="checkbox" id="sabado" value="7" />
    Sábado</label>
        </p></td>
      <td width="344"><p>Informe o Hor&aacute;rio das aulas:
        <label>Início:
        <input name="hora_ini" type="text" id="hora_ini" size="7" OnKeyPress="formatar('##:##', this);" maxlength="5" />
        </label>
        <label>Fim:
        <input name="hora_fim" type="text" id="hora_fim" size="7" OnKeyPress="formatar('##:##', this);" maxlength="5" />
        </label>
</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    </tr>
  </table>
  <p>
  <input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
  <input name="tabela" type="hidden" id="tabela" value="cetad_curso" />
  <input type="submit" name="Submit" value="Cadastrar..." />
  </p>
  </label>
</form></fieldset>