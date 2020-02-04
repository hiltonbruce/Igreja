<?PHP
/***************************************************************************
 * Gerador de calend�rio em PHP                                            *
 * �ltima altera��o: 28/02/2005 �s 17:37                                   *
 * Autor: Raphael Ara�jo e Silva - khaotix_@hotmail.com                    *
 * Adapta��o: Joseilton Costa Bruce (30/01/2010) - hiltonbruce@gmail.com   *
 * ATEN��O: VOC� TEM A COMPLETA PERMISS�O PARA ALTERA��O E REDISTRIBUI��O  *
 *          DO C�DIGO NESTE E EM QUALQUER ARQUIVO ACOMPANHANTE DESDE QUE O *
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
  $ceiaTodos = '';
  $temp_tb = '';
  if(!($mes>0 && $mes<=12 && ($nmeses>0 && $nmeses<=12) &&
      ($ncols>0 && $ncols<=12) && ($mes+$nmeses<=13)))
  {
   $tabela="Erro ao gerar calend�rio: [m�s=".$mes."] [ano=".$ano.
           "] [n&uacute;mero de meses=".$nmeses."] [tabelas por linha=".$ncols."]<br>";
  }else {
   //Carrega o css do calend�rio e armazena em $dados
   $arq=fopen("../css/calendarioCeia.css","r");
   $tam=filesize("../css/calendarioCeia.css");
   $dados=fread($arq,$tam);
   fclose($arq);
   //Coloca o css carregado no c�digo do calend�rio
   echo "<style type='text/css'>".$dados."</style>";

   //Calcula em que dia da semana � o dia 1/$mes/$ano
   $dia_semana=calcularDiaSemana(1,$mes,$ano);
   $bisexto=(($ano % 4 ==0) || ($ano % 100==0)); //Verifica se o ano � bisexto
   $ndias=array(31,($bisexto ? 29 : 28),31,30,31,30,31,31,30,31,30,31); //Vetor com o n�mero de dias de cada m�s
   $meses=array("Janeiro","Fevereiro","Mar&ccedil;o","Abril","Maio","Junho",
                "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
   $dias=array("Dom","Seg","Ter","Qua","Qui","Sex","S&acute;b");

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
      $temp_ln=$temp_ln."<tr>"; //Cria uma linha da tabela do m�s atual
	  //$cultos =="";

      for($d=0;$d<7 && $cnt_dias<=$ndias[$idx];$d++)
      {
       if($d>=$dia || $dia==0)
       {
	  $classe="";
	  $maux=$idx+1;

	//A rotina abaixo verifica se o dia atual � um feriado ou um dia marcado
	//onde $datas cont�m os dois vetores $feriados e $marcados
	for($i=0;$i<$nq && $classe=="";$i++)
	{
	  //for para marca��o dos dias ou intervalos de dias
	 for($i1=0;$i1<$qtd[$i] && $classe=="";$i1++)
	 {
	  //Caso seja um intervalo de dias
	  if(strpos($datas[$i][$i1],"-")==2)
	  {
	   $d1=substr($datas[$i][$i1],0,2); //Obt�m o primeiro dia
	   $d2=substr($datas[$i][$i1],3,2); //Obt�m o segundo dia
	   $m=substr($datas[$i][$i1],6,2); //Obt�m o m�s do intervalo
	  }
	  else //Caso seja um dia
	  {
	   $d1=substr($datas[$i][$i1],0,2); //Obt�m o dia
  	   $d2=0;
	   $m=substr($datas[$i][$i1],3,2); //Obt�m o m�s
	  }

	  //Atribui uma classe CSS � c�lula (dia) atual da tabela caso
	  //o m�s atual $maux seja igual ao m�s obtido de um dos vetores $m ($feriado ou $marcado)
	  //Verifica se o dia atual $cnt_dias est� no intervalo de dias ou se � igual
	  //ao dia obtido
   	  if($m==$maux && (($cnt_dias>=$d1 && $cnt_dias<=$d2) ||
	    ($cnt_dias==$d1))) $classe="td_marcado".($i+1);//$valor[$i];
	 }
	}

	$cultos = $classe;

	if($classe=="") //Caso a classe ainda n�o esteja definida ap�s o for acima
	 $classe=($d==0 ? "td_marcado0" : "td_dia");

     /*
     if($d==0 || $cultos =="") //Caso a classe ainda n�o esteja definida ap�s o for acima
	 $classe=($d==1 || $d==3 || $d==5 ? "td_marcado3" : $classe);//Define os dias de culto
     */

    if ($d==$dia_ceia)  ++$semana;

     if ($ceia=="" &&  $d==$dia_ceia && $semana==$semana_ceia) //Se 1� Sexta marca santa ceia
	 {
	 	if ($d==$dia_ceia) {
	 		$igreja[substr($meses[$idx], 0,3)] =  $cnt_dias;
	 		$cnt_dias = sprintf (" %'02u",$cnt_dias);

	 		$tabDias .= '<td class="'.$classDias.'">'.$cnt_dias.'</td>';//Cria a celula do dia da ceia
	 	}
	 }

	//Cria a c�lula referente ao dia atual
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
     $idx++; //Passa para o pr�ximo m�s
     $sem=0;
     $semana=0;
    }
    $tabela=$tabela."</tr>";
   }
  }

  for($idx2=0;$idx2<12;$idx2++) { //Gera o cabe�alho da tabela do m�s atual
  	$ceiaTodos .="<td class='cabecalho'>".substr($meses[$idx2],0,3)."</td>";
  }
  	$tabTodasCeias=$ceiaTodos."</tr><tr>"; //Fecha o cabe�alho

  $tabTodasCeias=$ceiaTodos."</tr>"; //Fecha o cabe�alho
  $tabDias = $tabDias.'</tr>';
  return($tabDias);
 }
?>
