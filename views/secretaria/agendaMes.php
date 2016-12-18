
<ul class="nav nav-tabs">
  <li role="presentation"><a href="#">Dia</a></li>
  <li role="presentation" class="active"><a href="#">Sem</a></li>
  <li role="presentation"><a href="#">M&ecirc;s</a></li>
  <li role="presentation"><a href="#">Eventos</a></li>
</ul>
<?PHP
  /*
  Função geradora de calendário.
  Parâmetros:
  string
  gerarCalend([MÊS],[ANO],[NÚMERO_DE_MÊSES],[NÚMERO_DE_TABELAS_POR_LINHA],
                                  [CONJUTO DE DATAS1]...[CONJUTO DE DATASn],
                                  [RODAPÉS],
                                  [DESCRIÇÕES DA LEGENDA])

  Os três últimos parâmetros são arrays.
  A marcação dos dias é feita da seguinte forma:
  dd/mm, para um dia específico ou dd-dd/mm para um intervalo de dias.

  Podem ser criadas marcações de datas indefinidamente, basta adicioná-las no arquivo
  'calendario.css', usando o nome de classe td_marcadoX, onde X é o número da marcação.
  */
$sem = new DateTime ();
print_r($sem);
echo "<h2>";
echo $sem->format('N');
echo "</h2>";
 $agendaSec = new sec_Agenda;
 echo $agendaSec->gerarCalend(date('m'),date('Y'),1,3,
                      array($marc0,$marc1,$marc2,$marc3,$marc4,$marc5,$marc6),
                      array("5 dias","7 dias","10 dias Cong. Usadeby","8 dias Cong. de Missões","4 dias Cong. Umadeby","8 dias EBAJ","2 dias EBD"),
                      array("Dias Congressos","Pesquisas e Estudos","Feriados",
                            "Planejamento Acadêmico","Casamentos","Início e término do período da Campanha",
                            "Recesso"));


     ?>
