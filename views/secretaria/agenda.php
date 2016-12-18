<div class="btn-group" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="glyphicon glyphicon-menu-hamburger"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="#">Agendar culto</a></li>
      <li><a href="#">Agendar Casamento</a></li>
    </ul>
  </div>
</div>
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
 $marc0=array("01/02","12/04","06/04","08-09/04","15-16/04","22-23/04","29-30/04",
              "06-07/05","13-14/05","20/05","28/05",
              "03-04/06","10-11/06","17-18/06","24-25/06",
              "01-02/07","08-09/07","22/07","30/07","05/08");
 $marc1=array("01-04/02","11-13/02","14-18/02","21-25/02","28/04");
 $marc2=array("08-10/02","08-17/03","03-05/04");
 $marc3=array("01-04/03","14-18/03","21-24/03","28-31/03");
 $marc4=array("21/05","27/05","23/07","29/07");
 $marc5=array("01/05","04/05","06/08");
 $marc6=array("10-19/01");
 $marc7=array("23-25/05");
 #Descreve o evento das datas
 $descDatas = array("Agenda 01","Agenda 002","10 dias Cong. Usadeby","8 dias Cong. de Miss�es",
                        "4 dias Cong. Umadeby","7 dias EBAJ","2 dias EBD","teste dias");
 $mesAgenda = (empty($_GET['mes']) || $_GET['mes']>'12') ?  date('m'): $_GET['mes'] ;
 $anoAgenda = (empty($_GET['ano']) || $_GET['ano']<'2010') ?  date('Y'): $_GET['ano'] ;
 $agendaSec = new sec_Agenda;
 echo $agendaSec->gerarCalend($mesAgenda,$anoAgenda,1,3,
                    array($marc0,$marc1,$marc2,$marc3,$marc4,$marc5,$marc6,$marc7),
                    $descDatas,
                    array("Dias Congressos","Pesquisas e Estudos","Feriados",
                          "Planejamento Acad�mico","Casamentos","In��cio e t�rmino do per�odo da Campanha",
                          "Recesso"));
echo $agendaSec->gerarCalend(1,2016,12,3,
                      array($marc0,$marc1,$marc2,$marc3,$marc4,$marc5,$marc6),
                      array("teste 1","teste 2","10 dias Cong. Usadeby","8 dias Cong. de Missões","8 dias Cong. Umadeby","8 dias EBAJ","2 dias EBD","teste dias"),
                      array("Dias Congressos","Pesquisas e Estudos","Feriados",
                            "Planejamento Acad�mico","Casamentos","In��cio e t�rmino do per��odo da Campanha",
                            "Recesso"));
     ?>
