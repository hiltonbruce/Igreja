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

		if ($resUltimoDia['lancamento']=='0') {
			//Culto na data lançamento em aberto
			$proxCulto = $dtUltLanc->format('d/m/Y');
			$mesLanc = $dtUltLanc->format('m');
			$anoLanc = $dtUltLanc->format('Y');
			return array('mesrefer' => $mesLanc,
				'anorefer' => $anoLanc,'proxCulto'=>$proxCulto
				,'igreja'=>$this->igreja );
		} else {

			//Calcando a próximo data para lançamento (próximo culto)
			//$dtUltLanc->modify('+1 day');
			$mesLanc = $dtUltLanc->format('m');
			$anoLanc = $dtUltLanc->format('Y');
print_r($dtUltLanc);
			$diaUltimoCulto = $dtUltLanc->format('N');
			list($culto[1],$culto[2],$culto[3],$culto[4]) = explode('-', $resUltimoDia['cultos']);

			$cultos = array($culto[1] => $culto[1],$culto[2] => $culto[2],$culto[3] => $culto[3],$culto[4] => $culto[4]);
			//acrescentar na pesquisa os dias de cultos
			//$frase  = $resUltimoDia['cultos'];
			$numDias = array(1, 2, 3, 4, 5, 6, 7);
			$nomeDias   = array('1'=>'next Monday','2'=>'next Tuesday','3'=>'next Wednesday',
				'4'=>'next Thursday','5'=>'next Friday','6'=>'next Saturday','7'=>'next Sunday');
			/*$culto1 = str_replace($numDias, $nomeDias, $culto1);
			$culto2 = str_replace($numDias, $nomeDias, $culto2);
			$culto3 = str_replace($numDias, $nomeDias, $culto3);
			$culto4 = str_replace($numDias, $nomeDias, $culto4);*/
print_r($nomeDias);
			$diaProxCulto = ($culto[$diaUltimoCulto]>7 || $culto[$diaUltimoCulto]<1) ? $diaUltimoCulto:$culto[2];
			echo "<h1>".$resUltimoDia['cultos'].' -- '.$diaProxCulto.' ** '.$nomeDias[$cultos[$diaProxCulto]].' == '.$cultos[$diaProxCulto]."</h1>";

			switch ($dtUltLanc->format('N')) {
				case '7':
				//Segunda-feira
					if ($this->igreja=='1') {
						$proxCulto = $dtUltLanc->format('d/m/Y');
					} else {
						$proxCulto = $dtUltLanc->modify('next tuesday');
						$proxCulto = $proxCulto->format('d/m/Y');
						$mesLanc = $dtUltLanc->format('m');
						$anoLanc = $dtUltLanc->format('Y');
					}
					echo "string";
					break;
				case '1':
				//Terça-feira
					if ($this->igreja=='1') {
						$proxCulto = $dtUltLanc->modify('next wednesday');
						$proxCulto = $dtUltLanc->format('d/m/Y');
						$mesLanc = $dtUltLanc->format('m');
						$anoLanc = $dtUltLanc->format('Y');
					} else {
						$proxCulto = $dtUltLanc->format('d/m/Y');
					}
					break;

				case '2':
				//Quarta-feira
					if ($this->igreja=='1') {
						$proxCulto = $dtUltLanc->format('d/m/Y');
					} else {
						$proxCulto = $dtUltLanc->modify('next thursday');
						$proxCulto = $proxCulto->format('d/m/Y');
						$mesLanc = $dtUltLanc->format('m');
						$anoLanc = $dtUltLanc->format('Y');
					}
						break;

				case '3':
				//Quinta-feira
					if ($this->igreja=='1') {
						$proxCulto = $dtUltLanc->modify('next friday');
						$proxCulto = $dtUltLanc->format('d/m/Y');
						$mesLanc = $dtUltLanc->format('m');
						$anoLanc = $dtUltLanc->format('Y');
					} else {
						$proxCulto = $dtUltLanc->format('d/m/Y');
					}
						break;

					break;

				case '4':
					//Sexta-feira
					if ($this->igreja=='1') {
						$proxCulto = $dtUltLanc->format('d/m/Y');
					} else {
						$proxCulto = $dtUltLanc->modify('next sunday');
						$proxCulto = $proxCulto->format('d/m/Y');
						$mesLanc = $dtUltLanc->format('m');
						$anoLanc = $dtUltLanc->format('Y');
					}
					break;

				case '5':
					//Sábado
					$proxCulto = $dtUltLanc->modify('next sunday');
					$proxCulto = $proxCulto->format('d/m/Y');
					$mesLanc = $dtUltLanc->format('m');
					$anoLanc = $dtUltLanc->format('Y');
					break;

				default:
				//Domingo
					$proxCulto = $dtUltLanc->format('d/m/Y');
					break;
		}

		//	$proxCulto = $dtUltLanc->modify('+1 day');

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
