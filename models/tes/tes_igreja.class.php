<?php
class tes_igreja {


	function __construct ($igreja='',$ano=''){
		$this->igreja = $igreja;
		$this->ano = $ano;
	}

	function ArraySaldos(){

		$this->query  = 'SELECT igreja,SUM(valor) AS valor,mesrefer AS mes FROM dizimooferta ';
		$this->query .= 'WHERE anorefer ='.$this->ano.' AND igreja = '.$this->igreja.'';
		$this->sql_lst = mysql_query("{$this->query} GROUP BY mesrefer ORDER BY igreja") or die (mysql_error());

	       while($resultado = mysql_fetch_array($this->sql_lst))
	       {
		    $valores_array [$resultado['mes']]=$resultado['valor'];
	       }
	  return $valores_array;

	}

	function dataEntrada () {

		$ultimaEntrada  = 'SELECT d.lancamento,d.data,d.mesrefer,d.anorefer,i.cultos FROM dizimooferta AS d,igreja AS i';
		$ultimaEntrada .= ' WHERE igreja="'.$this->igreja.'" AND i.rol = d.igreja ORDER BY data DESC LIMIT 1';
		$dados = mysql_query($ultimaEntrada);
		$resUltimoDia = mysql_fetch_array($dados);
		//print_r($resUltimoDia);
		$dtUltLanc = new DateTime($resUltimoDia['data']);

		if ($resUltimoDia['lancamento']=='0' || $resUltimoDia['cultos']=='') {
//print_r($dtUltLanc);
			//Culto na data lançamento em aberto
			if ( $resUltimoDia['cultos']=='') {
				#Se dias de cultos estiver vazio acrescenta dois para o próximo lancamento
				$a = $dtUltLanc->modify('+2 day');
				//print_r( $a);
			}
			$proxCulto = $dtUltLanc->format('d/m/Y');
			$mesLanc = $dtUltLanc->format('m');
			$anoLanc = $dtUltLanc->format('Y');

			return array('mesrefer' => $mesLanc,
				'anorefer' => $anoLanc,'proxCulto'=>$proxCulto
				,'igreja'=>$this->igreja );
		} else {
//print_r($dtUltLanc);
			//Calcando a próximo data para lançamento (próximo culto)
			//$dtUltLanc->modify('+1 day');
			$mesLanc = $dtUltLanc->format('m');
			$anoLanc = $dtUltLanc->format('Y');
			$diaUltimoCulto = $dtUltLanc->format('N');
			list($culto[1],$culto[2],$culto[3],$culto[4]) = explode('-', $resUltimoDia['cultos']);

			//acrescentar na pesquisa os dias de cultos
			//$frase  = $resUltimoDia['cultos'];
			$numDias = array(1, 2, 3, 4, 5, 6, 7);
			$nomeDias   = array('1'=>'next Monday','2'=>'next Tuesday','3'=>'next Wednesday',
				'4'=>'next Thursday','5'=>'next Friday','6'=>'next Saturday','7'=>'next Sunday');

//print_r($culto);
			# Considerando domingo como dia 7
			if ($diaUltimoCulto<$culto[2] || $diaUltimoCulto=='7') {
				# 1º culto da Semana
				$diaProxCulto=$nomeDias[$culto[2]];
			}elseif ($diaUltimoCulto<$culto[3]) {
				# 2º culto da Semana
				$diaProxCulto=$nomeDias[$culto[3]];
			}elseif ($diaUltimoCulto<$culto[4] && $diaUltimoCulto!='') {
				# 3º culto da Semana
				$diaProxCulto=$nomeDias[$culto[4]];
			}else {
				# 4º culto da Semana
				$diaProxCulto=$nomeDias[$culto[1]];
			}

#Modifica a data para o proximo culto
$proxCulto = $dtUltLanc->modify($diaProxCulto);
$proxCulto = $proxCulto->format('d/m/Y');
$mesLanc = $dtUltLanc->format('m');
$anoLanc = $dtUltLanc->format('Y');

			//echo "<h1>".$diaUltimoCulto.' ## '.$diaProxCulto.' ++ '.$resUltimoDia['cultos'].' -- '.$diaProxCulto.' ** '.$nomeDias[$cultos[$diaProxCulto]].' == '.$cultos[$diaProxCulto]."</h1>";

			$date = new DateTime();
			$date->modify('next tuesday');
			//echo $date->format('Y-m-d');

			return array('mesrefer' => $mesLanc,
				'anorefer' => $anoLanc,$resUltimoDia['data'],'proxCulto'=>$proxCulto
				,'igreja'=>$this->igreja);
		}


	}
}
?>
