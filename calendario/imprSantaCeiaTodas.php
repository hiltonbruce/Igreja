<?PHP
/***************************************************************************
 * Gerador de calendário em PHP                                            *
 * Última alteração: 28/02/2005 às 17:37                                   *
 * Autor: Raphael Araújo e Silva - khaotix_@hotmail.com                    *
 * Adaptação: Joseilton Costa Bruce (30/01/2010) - hiltonbruce@gmail.com   *
 * ATENÇÃO: VOCÊ TEM A COMPLETA PERMISSÃO PARA ALTERAÇÃO E REDISTRIBUIÇÃO  *
 *          DO CÓDIGO NESTE E EM QUALQUER ARQUIVO ACOMPANHANTE DESDE QUE O *
 *          AUTOR ORIGINAL SEJA CITADO.                                    *
 ***************************************************************************/

function calcularDiaSemana($dia,$mes,$ano)
 {
  $s=(int)($ano / 100);
  $a=$ano % 100;

  if($mes<=2)
  {
   $mes+=10;
   $a--;
  }
  else $mes-=2;

  $ival=(int)(2.6*$mes-0.1);
  $q1=(int)($s / 4);
  $q2=(int)($a / 4);

  $dia_semana=($ival + $dia + $a + $q1 + $q2 - 2 * $s) % 7;

  if($dia_semana<0) $dia_semana+=7;

  return($dia_semana);
 }

 function gerarCalendario($mes,$ano,$nmeses,$ncols,$datas,$rodapes,$leg,$dia_ceia,$semana_ceia,$classDias)//$feriados,$marcados,$rodapes)
 {
  if(!($mes>0 && $mes<=12 && ($nmeses>0 && $nmeses<=12) &&
      ($ncols>0 && $ncols<=12) && ($mes+$nmeses<=13)))
  {
   $tabela="Erro ao gerar calendário: [mês=".$mes."] [ano=".$ano.
           "] [número de meses=".$nmeses."] [tabelas por linha=".$ncols."]<br>";
  }
  else
  {

   //Carrega o css do calendário e armazena em $dados
   $arq=fopen("../css/calendarioCeia.css","r");
   $tam=filesize("../css/calendarioCeia.css");
   $dados=fread($arq,$tam);
   fclose($arq);
   //Coloca o css carregado no código do calendário
   echo "<style type='text/css'>".$dados."</style>";

   //Calcula em que dia da semana é o dia 1/$mes/$ano
   $dia_semana=calcularDiaSemana(1,$mes,$ano);
   $bisexto=(($ano % 4 ==0) || ($ano % 100==0)); //Verifica se o ano é bisexto
   $ndias=array(31,($bisexto ? 29 : 28),31,30,31,30,31,31,30,31,30,31); //Vetor com o número de dias de cada mês
   $meses=array("Janeiro","Fevereiro","Março","Abril","Maio","Junho",
                "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
   $dias=array("Dom","Seg","Ter","Qua","Qui","Sex","Sáb");

   $idx=$mes-1;
   $total=$idx+$nmeses; //Total de meses a serem considerados
   $dia=$daux=$dia_semana;

    for($i=0;$i<count($datas);$i++)
     $qtd[$i]=count($datas[$i]);

   $nq=count($qtd);
   $tabDias = '';

   while($idx<$total)
   {
    $tabela="<tr>";
    for($ms=0; $ms<$ncols && $idx<$total; $ms++)
    {
     $cnt_dias=1; //Inicializa o contador de dias
     $temp_ln="";
     $nl=0;

     while($cnt_dias<=$ndias[$idx])
     {
      $temp_ln=$temp_ln."<tr>"; //Cria uma linha da tabela do mês atual
	  //$cultos =="";

      for($d=0;$d<7 && $cnt_dias<=$ndias[$idx];$d++)
      {
       if($d>=$dia || $dia==0)
       {
	  $classe="";
	  $maux=$idx+1;

	//A rotina abaixo verifica se o dia atual é um feriado ou um dia marcado
	//onde $datas contém os dois vetores $feriados e $marcados
	for($i=0;$i<$nq && $classe=="";$i++)
	{
	  //for para marcação dos dias ou intervalos de dias
	 for($i1=0;$i1<$qtd[$i] && $classe=="";$i1++)
	 {
	  //Caso seja um intervalo de dias
	  if(strpos($datas[$i][$i1],"-")==2)
	  {
	   $d1=substr($datas[$i][$i1],0,2); //Obtém o primeiro dia
	   $d2=substr($datas[$i][$i1],3,2); //Obtém o segundo dia
	   $m=substr($datas[$i][$i1],6,2); //Obtém o mês do intervalo
	  }
	  else //Caso seja um dia
	  {
	   $d1=substr($datas[$i][$i1],0,2); //Obtém o dia
  	   $d2=0;
	   $m=substr($datas[$i][$i1],3,2); //Obtém o mês
	  }

	  //Atribui uma classe CSS à célula (dia) atual da tabela caso
	  //o mês atual $maux seja igual ao mês obtido de um dos vetores $m ($feriado ou $marcado)
	  //Verifica se o dia atual $cnt_dias está no intervalo de dias ou se é igual
	  //ao dia obtido
   	  if($m==$maux && (($cnt_dias>=$d1 && $cnt_dias<=$d2) ||
	    ($cnt_dias==$d1))) $classe="td_marcado".($i+1);//$valor[$i];
	 }
	}

	$cultos = $classe;

	if($classe=="") //Caso a classe ainda não esteja definida após o for acima
	 $classe=($d==0 ? "td_marcado0" : "td_dia");

     /*
     if($d==0 || $cultos =="") //Caso a classe ainda não esteja definida após o for acima
	 $classe=($d==1 || $d==3 || $d==5 ? "td_marcado3" : $classe);//Define os dias de culto
     */

    if ($d==$dia_ceia)  ++$semana;

     if ($ceia=="" &&  $d==$dia_ceia && $semana==$semana_ceia) //Se 1ª Sexta marca santa ceia
	 {
	 	if ($d==$dia_ceia) {
	 		$igreja[substr($meses[$idx], 0,3)] =  $cnt_dias;
	 		$cnt_dias = sprintf (" %'02u",$cnt_dias);

	 		$tabDias .= '<td class="'.$classDias.'">'.$cnt_dias.'</td>';//Cria a celula do dia da ceia
	 	}
	 }

	//Cria a célula referente ao dia atual
	$temp_ln=$temp_ln."<td class='".$classe."'> ".$cnt_dias++."</td>";
        $daux++;
        if($daux>6) $daux=0;
       }
       else $temp_ln=$temp_ln."<td>&nbsp</td>";
      }
      $nl++;
      $temp_ln=$temp_ln."</tr>";
      $dia=0;
     }
     if($nl==5) $temp_ln=$temp_ln."<tr><td colspan=7>&nbsp;</td></tr>";
     $temp_tb=$temp_tb.$temp_ln;

     $k=$idx-($mes-1);

     $tabela=$tabela.$temp_tb;
     $dia=$daux;
     $ceia = "";$culto="";
     $idx++; //Passa para o próximo mês
     $sem=0;
     $semana=0;
    }
    $tabela=$tabela."</tr>";
   }
  }

  for($idx2=0;$idx2<12;$idx2++) { //Gera o cabeçalho da tabela do mês atual
  	$ceiaTodos .="<td class='cabecalho'>".substr($meses[$idx2],0,3)."</td>";
  }
  	$tabTodasCeias=$ceiaTodos."</tr><tr>"; //Fecha o cabeçalho

  $tabTodasCeias=$ceiaTodos."</tr>"; //Fecha o cabeçalho
  $tabDias = $tabDias.'</tr>';
  return($tabDias);
 }



?>
