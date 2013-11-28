<?php 
	switch ($mes) {
		case 2:
			$mesExtenso = 'Fevereiro';
		break;
		case 3:
			$mesExtenso = 'Março';
		break;
		case 4:
			$mesExtenso = 'Abril';
		break;
		case 5:
			$mesExtenso = 'Maio';
		break;
		case 6:
			$mesExtenso = 'Junho';
		break;
		case 7:
			$mesExtenso = 'Julho';
		break;
		case 8:
			$mesExtenso = 'Agosto';
		break;
		case 9:
			$mesExtenso = 'Setembro';
		break;
		case 10:
			$mesExtenso = 'Outubro';
		break;
		case 11:
			$mesExtenso = 'Novembro';
		break;
		case 12:
			$mesExtenso = 'Dezembro';
		break;		
		default:
			$mesExtenso = 'Janeiro';
			$mes = 1;
		break;
	}
?>
<label>Referente mês: </label>
<select name="<?php echo $nomeCampo;?>" id="mes" tabindex="<?PHP echo ++$ind;?>">
	<option value="<?PHP echo $mes;?>"><?PHP echo $mesExtenso;?></option>
	<option value='1'>Janeiro</option>
	<option value='2'>Fevereiro</option>
	<option value='3'>Março</option>
	<option value='4'>Abril</option>
	<option value='5'>Maio</option>
	<option value='6'>Junho</option>
	<option value='7'>Julho</option>
	<option value='8'>Agosto</option>
	<option value='9'>Setembro</option>
	<option value='10'>Outubro</option>
	<option value='11'>Novembro</option>
	<option value='12'>Dezembro</option>
</select>
