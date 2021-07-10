<?php
$nivel1 	= '';
$nivel2 	= '';
$comSaldo	= '';$menorAno = 2010;$maiorAno=2100;
	if (empty($_GET['ano'])) {
			$ano = date('Y');
		}elseif ($_GET['ano']<$menorAno){
			$ano = $menorAno;
		}elseif ($_GET['ano']>$maiorAno){
			$ano = $maiorAno;
		}else {
			$ano = $_GET['ano'];
		}
$queryLista  = 'SELECT *,DATE_FORMAT(data,"%c") AS mes,DATE_FORMAT(data,"%Y") AS ano ';
$queryLista .= 'FROM dizimooferta WHERE lancamento<>"0" AND DATE_FORMAT(data,"%c%Y")';
$queryLista .= '="'.$mes.$ano.'" ORDER BY igreja,anorefer,mesrefer ';
$lista = mysql_query($queryLista);
//Logica para montar o conjunto de vari�veis para compor a tabelar a seguir
// require_once 'help/tes/histFinanceiroIgreja.php';

if (file_exists('help/tes/histFinanceiroIgreja.php')) {
	require_once 'help/tes/histFinanceiroIgreja.php';//Tabela com saldos por igreja e semanal
} elseif (file_exists('../help/tes/histFinanceiroIgreja.php')) {
// echo '<h1> saldoMesFinPrint.php </h1>';
require_once '../help/tes/histFinanceiroIgreja.php';//Tabela com saldos por igreja e semanal
} 


	//echo "<h1> ** $ano **</h1>";
	$ano = ($ano=='') ? date('Y'):$ano;
	//$ano = 2013;
	//echo "<h1> ** $ano **</h1>";
	$cor= true;
	$igrejas = new igreja();
	$linha='';
	//print_r($igrejas->Arrayigreja());
	foreach ($igrejas->Arrayigreja() as $cont => $igrejaDados) {
		$bgcolor = $cor ? 'style="background:#d0d0d0"' : 'style="background:#d0d0d0"';
		$dz = 'dizimos'."$cont$ano";
		$of = 'ofertaCultos'."$cont$ano";
		$ofm = 'ofertaMissoes'."$cont$ano";
		$ofs = 'ofertaSenhoras'."$cont$ano";
		$ofmoc = 'ofertaMocidade'."$cont$ano";
		$ofi = 'ofertaInfantil'."$cont$ano";
		$ofe = 'ofertaEnsino'."$cont$ano";
		$ofNaoOp = 'ofertaNaoOp'."$cont$ano";
		$ofCampanha = 'ofertaCampanha'."$cont$ano";
		$ofExtra = 'ofertaExtra'."$cont$ano";
		$subTotal= $$dz+$$ofExtra+$$of;//Total do dizimo + Ofertas Extras + ofertas + votos dos cultos
		//Soma da coluna para linha Sub-total das congrega��es Sem a Sede
		if ($cont!='1') {
		$totDizAno  += $$dz;
		$totOfertaExtraAno  += $$ofExtra;
		$totOfertaAno  += $$of;
		$totMissoesAno  += $$ofm;
		$totSenhorasAno  += $$ofs;
		$totMocidadeAno  += $$ofmoc;
		$totInfantilAno  += $$ofi;
		$totEnsinoAno  += $$ofe;
		$totNaoOpAno += $$ofNaoOp;
		$totCampanhaAno += $$ofCampanha;
		$totSubTotalAno +=$subTotal;
		}
		//Soma linha
		$totMes = $subTotal+$$ofm+$$ofs+$$ofmoc+$$ofi+$$ofe+$$ofCampanha+$$ofNaoOp;//Total do mes (linha)
		$totSubTotal +=$subTotal;
		$totOperac +=$$dz+$$of+$$ofs+$$ofmoc+$$ofi+$$ofe+$$ofExtra;
		$ofOp = $subTotal+$$ofs+$$ofmoc+$$ofi+$$ofe;
		$nivel1 .= '<tbody><tr '.$bgcolor.' class="sub"><th>'.htmlentities($igrejaDados['0'],ENT_QUOTES,'iso-8859-1').'</th>';
		$nivel1 .= '<td id="moeda">'.number_format($$dz,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofExtra,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$of,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($subTotal,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofs,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofmoc,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofi,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofe,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($ofOp,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofNaoOp,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofCampanha,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofm,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($totMes,2,',','.').' </td></tr>';

		for ($i=1; $i < 6; $i++) {
			$dizSem = $dz.$i;
			$ofSem = $of.$i;
			$ofExtraSem = $ofExtra.$i;
			$ofCampanhaSem	= $ofCampanha.$i;
			$ofmSem = $ofm.$i;
			$ofsSem = $ofs.$i;
			$ofmocSem = $ofmoc.$i;
			$ofiSem = $ofi.$i;
			$ofeSem = $ofe.$i;
			$ofNaoOpSem = $ofNaoOp.$i;
			$totMesSem = $$dizSem+$$ofSem+$$ofmSem+$$ofsSem+$$ofmocSem+$$ofiSem+$$ofeSem+$$ofCampanhaSem+$$ofNaoOpSem;//Total da Semana (linha)
			$subTotalSem = $$dizSem+$$ofExtraSem+$$ofSem;
			$ofOpSem = $subTotalSem+$$ofsSem+$$ofmocSem+$$ofiSem+$$ofeSem;

			$nivel1Sem .= '<tr class=""><td>'.$i.'&ordf;&nbsp; Sem</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$dizSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofExtraSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($subTotalSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofsSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofmocSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofiSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofeSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($ofOpSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofNaoOpSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofCampanhaSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($$ofmSem,2,',','.').'</td>';
			$nivel1Sem .= '<td id="moeda">'.number_format($totMesSem,2,',','.').' </td></tr>';
			$nivel1Sem .= '</tr>';
		}
		$nivel1 .= $nivelSem.$nivel1Sem;
		$nivel1Sem = '';//Limpa a vari�vel para o pr�ximo m�s
		$nivel1 .= '</tbody>';
		$cor = !$cor;
	}
	?>
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
