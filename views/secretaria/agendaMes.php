
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
 $marc0=array("12/01","02/04","08-09/04","15-16/04","22-23/04","29-30/04",
              "06-07/05","13-14/05","20/05","28/05",
              "03-04/06","10-11/06","17-18/06","24-25/06",
              "01-02/07","08-09/07","22/07","30/07","05/08");
 $marc1=array("01-04/02","09-11/02","14-18/02","21-25/02","28/02");
 $marc2=array("08/02","25/03","21/04","26/05");
 $marc3=array("01-04/03","07-11/03","14-18/03","21-24/03","28-31/03");
 $marc4=array("21/05","27/05","23/07","29/07");
 $marc5=array("01/04","05/05","06/08");
 $marc6=array("10-19/01");

   echo gerarCalend(date('m'),date('Y'),1,3,
                      array($marc0,$marc1,$marc2,$marc3,$marc4,$marc5,$marc6),
                      array("...","...","10 dias Cong. Usadeby","8 dias Cong. de Missões","8 dias Cong. Umadeby","8 dias EBAJ","2 dias EBD"),
                      array("Dias Congressos","Pesquisas e Estudos","Feriados",
                            "Planejamento Acadêmico","Casamentos","Início e término do período da Campanha",
                            "Recesso"));

     ?>
