<?php
$nivel1 	= '';
$nivel2 	= '';
$comSaldo	= '';$menorAno = 2010;$maiorAno=2050;

if ($_GET['ano']=='') {
		$ano = date('Y');
	}elseif ($_GET['ano']<$menorAno){
		$ano = $menorAno;
	}elseif ($_GET['ano']>$maiorAno){
		$ano = $maiorAno;
	}else {
		$ano = $_GET['ano'];
	}
//$ano = 2014;

switch ($hisFinanceiro) {
	case 1:
		//Listagem para historico finaceiro das contribuições dos membros
		$query  = 'SELECT *,mesrefer AS mes,anorefer ';
		$query .= 'AS ano FROM dizimooferta WHERE lancamento<>"0" AND rol="'.$bsc_rol.'" ';
		$query .= 'AND credito!="803" ORDER BY anorefer,mesrefer';
	break;
	case 2:
		$query  = 'SELECT *,DATE_FORMAT(data,"%c") AS mes,DATE_FORMAT(data,"%Y") AS ano ';
		$query .= 'FROM dizimooferta WHERE lancamento<>"0" ';
		$query .= 'AND igreja="'.$igreja.'" ORDER BY data,anorefer,mesrefer';
	break;
	default:
		$query  = 'SELECT *,DATE_FORMAT(data,"%c") AS mes,DATE_FORMAT(data,"%Y") AS ano';
		$query .= ' FROM dizimooferta WHERE lancamento<>"0"  ORDER BY anorefer,mesrefer';
	break;
}

$lista = mysql_query($query);
//Logica para montar o conjunto de variáveis para compor a tabelar a seguir
require_once 'help/tes/histFinanceiroMembro.php';

	//echo "<h1> ** $ano **</h1>";

	$ano = ($ano=='') ? date('Y'):$ano;

	//$ano = 2013;
	//echo "<h1> ** $ano **</h1>";
	$cor= true;
	for ($cont=1; $cont<13 ; $cont++){
		$bgcolor = $cor ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
		$dz = 'dizimos'."$cont$ano"; $of = 'ofertaCultos'."$cont$ano";
		$ofm = 'ofertaMissoes'."$cont$ano";	$ofs = 'ofertaSenhoras'."$cont$ano";
		$ofmoc = 'ofertaMocidade'."$cont$ano";$ofi = 'ofertaInfantil'."$cont$ano";
		$ofe = 'ofertaEnsino'."$cont$ano";$ofCampanha = 'ofertaCampanha'."$cont$ano";
		$ofExtra = 'ofertaExtra'."$cont$ano";

		//Soma da coluna para linha do sub-total
		$totDizAno  += $$dz;$totOfertaExtraAno  += $$ofExtra;$totOfertaAno  += $$of;
		$totMissoesAno  += $$ofm;$totSenhorasAno  += $$ofs;$totMocidadeAno  += $$ofmoc;
		$totInfantilAno  += $$ofi;$totEnsinoAno  += $$ofe;$totCampanhaAno += $$ofCampanha;

		//Soma linha
		$totMes = $$dz+$$ofExtra+$$of+$$ofm+$$ofs+$$ofmoc+$$ofi+$$ofe+$$ofCampanha;//Total do mes (linha)
		$subTotal= $$dz+$$ofExtra+$$of;//Total do dizimo + Ofertas Extras + ofertas + votos dos cultos
		$totSubTotal +=$subTotal;
		$totTotal += $totMes;
		$totOp = $subTotal+$$ofs+$$ofmoc+$$ofi+$$ofe;//Total das entradas operacionais
		//Formata mês para exibição
		$mesExibir = arrayMeses();
		$verMes = $mesExibir [sprintf("%02u",$cont )];

		$nivel1 .= '<tbody><tr '.$bgcolor.' class="sub"><th><strong>'.$verMes.'/'.$ano.'</strong></th>';
		$nivel1 .= '<td id="moeda">'.number_format($$dz,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofExtra,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$of,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($subTotal,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofs,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofmoc,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofi,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofe,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($totOp,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofCampanha,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofm,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($totMes,2,',','.').'</td></tr>';

		for ($i=1; $i < 6; $i++) {
			$dizSem = $dz.$i;
			$ofSem = $of.$i;
			$ofExtraSem = $ofExtra.$i;
			$ofCampanhaSem	= $ofCampanha.$i;
			$ofmSem = $ofm.$i;$ofsSem = $ofs.$i;
			$ofmocSem = $ofmoc.$i;
			$ofiSem = $ofi.$i;
			$ofeSem = $ofe.$i;

			$subTotalSem = $$dizSem+$$ofExtraSem+$$ofSem;
			$totOpSem = $subTotalSem+$$ofsSem+$$ofmocSem+$$ofiSem+$$ofeSem;//Total das entradas operacionais semanal
			$totMesSem = $totOpSem+$$ofmSem+$$ofCampanhaSem;//Total da Semana (linha)

			$nivel1Sem .= '<tr><td><strong>'.$i.'&ordf;&nbsp; Sem</strong></td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$dizSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofExtraSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($subTotalSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofsSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofmocSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofiSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofeSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($totOpSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofCampanhaSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofmSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($totMesSem,2,',','.').'</td></tr>';
			$nivel1Sem .= '</tr>';
		}
		$nivel1 .= $nivelSem.$nivel1Sem;
		$nivel1Sem = '';//Limpa a variável para o próximo mês

		$nivel1 .= '</tbody>';

		$cor = !$cor;
	}

	?>

<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
//<![CDATA[

	$(document).ready(function() {
		var mais = '<a href="#"><img src="img/mais.gif" alt="Revelar/ocultar cidades" class="maismenos" /></a>'
			$('table#horario tbody tr:not(.sub):even').addClass('impar');
			$('table#horario tbody tr:not(.sub)').hide();
			$('.sub th').css({border: '1px solid #333'}).prepend(mais);
				$('img',$('.sub th'))
					.click(function(event){
						event.preventDefault();
						if (($(this).attr('src')) == 'img/menos.gif'){
						$(this).attr('src', 'img/mais.gif')
						.parents()
						.siblings('tr').hide();
						} else {
						$(this).attr('src', 'img/menos.gif')
						.parents().siblings('tr').show();
						};
				});
		});
// ]]>
</script>
