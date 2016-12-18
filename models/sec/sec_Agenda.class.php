<?PHP
/***************************************************************************
 * Gerador de calendário em PHP																					 *
 * Última alteração: 28/02/2005 às 17:37                                *
 * Autor: Raphael Araújo e Silva - khaotix_@hotmail.com                   *
 *                                                                         *
 * ATENÇÃO: VOCÊ TEM A COMPLETA PERMISSÃO PARA ALTERAÇÃO E REDISTRIBUIÇÃO  *
 *          DO CÓDIGO NESTE E EM QUALQUER ARQUIVO ACOMPANHANTE DESDE QUE O *
 *          AUTOR ORIGINAL SEJA CITADO.                                    *
 ***************************************************************************/
/**
*
*/
class sec_Agenda
{
	protected $ano;
	function __construct($ano='') {
		$this->meses=array("Janeiro","Fevereiro","Mar&ccedil;o","Abril","Maio","Junho",
		                "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
		$this->dias=array("Dom","Seg","Ter","Qua","Qui","Sex","S&aacute;b");
		$this->ano = (empty($ano)) ? date('Y'):$ano;
	}

	function calcDiaSemana($dia,$mes,$ano){
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

	 function gerarCalend($mes,$ano,$nmeses,$ncols,$datas,$rodapes,$leg)
	 //$feriados,$marcados,$rodapes
	 {
	  if(!($mes>0 && $mes<=12 && ($nmeses>0 && $nmeses<=12) &&
	      ($ncols>0 && $ncols<=12) && ($mes+$nmeses<=13))) {
	   $tabela="Erro ao gerar calend&aacute;rio: [m&ecirc;s=".$mes."] [ano=".$ano.
	           "] [n&uacet;mero de meses=".$nmeses."] [tabelas por linha=".$ncols."]<br>";
	  } else {
	   //Carrega o css do calendário e armazena em $dados
	   $arq=fopen("calendario.css","r");
	   $tam=filesize("calendario.css");
	   $dados=fread($arq,$tam);
	   fclose($arq);
	   //Coloca o css carregado no código do calendário
	   echo "<style type='text/css'>".$dados."</style>";
	   //Calcula em que dia da semana é o dia 1/$mes/$ano
	   $dia_semana=calcDiaSemana(1,$mes,$ano);
	   $bisexto=(($ano % 4 ==0) || ($ano % 100==0)); //Verifica se o ano é bisexto
	   $ndias=array(31,($bisexto ? 29 : 28),31,30,31,30,31,31,30,31,30,31); //Vetor com o número de dias de cada mês
	   $meses=array("Janeiro","Fevereiro","Mar&ccedil;o","Abril","Maio","Junho",
	                "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	   $dias=array("Dom","Seg","Ter","Qua","Qui","Sex","S&aacute;b");
	   $idx=$mes-1;
	   $total=$idx+$nmeses; //Total de meses a serem considerados
	   $dia=$daux=$dia_semana;
	    for($i=0;$i<count($datas);$i++)
	    	$qtd[$i]=count($datas[$i]);
		   	$nq=count($qtd);
		   	$tabela="<table class='table table-bordered'>"; //Inicia a tabela geral (que suportará as demais tabelas de meses)
		  while($idx<$total) {
		    $tabela=$tabela."<tr>";
		    for($ms=0; $ms<$ncols && $idx<$total; $ms++) {
	     		$temp_tb="<td valign='top'><table class='table'>
	              <tr><td colspan=7  class='cabecalho'>".$meses[$idx].'/'.$ano.
	              "</td></tr><tr>"; //Cria uma tabela para o m�s atual
		     for($idx2=0;$idx2<7;$idx2++) //Gera o cabe�alho da tabela do m�s atual
		     $temp_tb=$temp_tb."<td class='td_semana'>".$dias[$idx2]."</td>";
		     $temp_tb=$temp_tb."</tr>"; //Fecha o cabe�alho
		     $cnt_dias=1; //Inicializa o contador de dias
		     $temp_ln="";
		     $nl=0;
		     while($cnt_dias<=$ndias[$idx]) {
		      $temp_ln=$temp_ln."<tr>"; //Cria uma linha da tabela do mês atual
		      for($d=0;$d<7 && $cnt_dias<=$ndias[$idx];$d++) {
						if($d>=$dia || $dia==0) {
			        $classe="";
							$maux=$idx+1;
					//A rotina abaixo verifica se o dia atual é um feriado ou um dia marcado
					//onde $datas contém os dois vetores $feriados e $marcados
					for($i=0;$i<$nq && $classe=="";$i++)
					{
					 for($i1=0;$i1<$qtd[$i] && $classe=="";$i1++)
					 {
						  //Caso seja um intervalo de dias
						  if(strpos($datas[$i][$i1],"-")==2) {
						   $d1=substr($datas[$i][$i1],0,2); //Obt�m o primeiro dia
						   $d2=substr($datas[$i][$i1],3,2); //Obt�m o segundo dia
						   $m=substr($datas[$i][$i1],6,2); //Obt�m o m�s do intervalo
						  } else /*Caso seja um dia */ {
						   $d1=substr($datas[$i][$i1],0,2); //Obt�m o dia
					  	   $d2=0;
						   $m=substr($datas[$i][$i1],3,2); //Obt�m o m�s
						  }
						  //Atribui uma classe CSS � c�lula (dia) atual da tabela caso
						  //o m�s atual $maux seja igual ao mês obtido de um dos vetores $m ($feriado
						  // ou $marcado)
						  //Verifica se o dia atual $cnt_dias está no intervalo de dias ou se é igual
						  //ao dia obtido
					   	  if($m==$maux && (($cnt_dias>=$d1 && $cnt_dias<=$d2) ||
						    ($cnt_dias==$d1))) {
						    $classe="td_marcado".($i+1);//$valor[$i];
								$marcaDia .= '<span class="'.$classe.'" >'.$title[$diaMc].'</span>';
							}

					 }
				}
				if($classe=="") //Caso a classe ainda não esteja definida após o for acima
				 $classe=($d==0) ? "td_marcado0": "td_dia";
				//Cria a célula referente ao dia atual
				$diaMc = $cnt_dias-1;
				$title[$diaMc] .= '<p class="evento" >'.$rodapes[$i-1].'</p>';
				if (date('dmY')==$diaMc.$mes.$ano & $marcaDia!='') {
					$diaAtual = '<a title = "'.$rodapes[$i-1].'"" href="data='.$cnt_dias.'"><strong>'.'<span class="text-success">'.$cnt_dias++.'</span></strong></a>';
				} elseif ($marcaDia!='') {
					$diaAtual = '<a title = "'.$rodapes[$i-1].'" href="data='.$cnt_dias.'"><strong>'.$cnt_dias++.'</strong></a>';
				} else {
					$diaAtual = $cnt_dias++;
				}
				if ($daux==0) {
						$domingo = 'danger';
				} elseif ($diaAtual.$mes==date('dm')) {
					$domingo =  'info';
				} else {
					$domingo = '' ;
				}

				$temp_ln=$temp_ln."<td class='td_dia $domingo'>".$diaAtual.'<br />---'.$marcaDia.'</td>';
				$marcaDia = '';
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
	     if($rodapes[$k]!="") //Gera um rodapé para a tabela de mês
	     {
	      $temp_tb=$temp_tb."<tr><td colspan=7 class='rodape'>".$rodapes[$k].
	               "</td></tr></table><br></td>";
	     }
	     else $temp_tb=$temp_tb."</table></td>";

	     $tabela=$tabela.$temp_tb;
	     $dia=$daux;
	     $idx++; //Passa para o próximo mês
	    }
	    $tabela=$tabela."</tr>";
	   }

	   #Legenda
	  /* $legenda="<table class='table'><tr><td class='cabecalho' colspan=2>Legenda</td></tr>";

	   for($i=1;$i<=$nq;$i++)
	    $legenda  =$legenda."<tr><td class='td_marcado".$i."'>&nbsp;</td><td class='td_leg'>";
		$legenda .=$leg[$i-1]."</td></tr>";

	   $tabela=$tabela.$legenda."</table>";*/
	   $tabela=$tabela."</table>";


	  }
	//  print_r($datas);
//	  echo '<br />';
	//  print_r($rodapes);
	  return($tabela);
	 }

	 function cabecalho ($mes){

	     $temp_tb="<td valign='top'><table class='table'>
	              <tr><td colspan=7  class='cabecalho'>".$meses[$mes].'/'.$ano.
	              "</td></tr><tr>"; //Cria uma tabela para o mês atual

	     for($idx2=0;$idx2<7;$idx2++) //Gera o cabeçalho da tabela do mês atual
	     $temp_tb=$temp_tb."<td class='td_semana'>".$dias[$idx2]."</td>";

	     $temp_tb=$temp_tb."</tr>"; //Fecha o cabeçalho

	     return $temp_tb;

	 }

	 function semana ($num) {


	 }

	 function dia ($num) {

	 }
}
?>
