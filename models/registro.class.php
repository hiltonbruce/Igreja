<?php
class registro extends numlinhas {
	
	function registros () {
		$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;				

		while ($this->res->fetchInto($regist1, DB_FETCHMODE_ASSOC)) {
				//Concluir os tipo de registro para listar na fichamembro
			switch ($regist1["situacao"]){
				case "1":
					++$s1;
					$sit1	= ($s1<2) ? $s1.' - Conciliação':$s1.' - Conciliações';
					break;
				case "2":
					++$s2;
					$sit2	= ($s2<2) ? $s2.' - Displina':$s2.' - Displinas';
					break;
				case "3":
					++$s3;
					$sit3	= ($s3<2) ? $s3.' - Nota de Falecimento':' <blink>Membro C/ '.$s3.' notas de Falecimentos. Corrigir o Cadastro!</blink>';
					break;
				case "4":
					++$s4;
					$sit4	= ($s4<2) ? $s4.' - Mudan&ccedil;a de Igreja Sem Carta':' - Mudan&ccedil;as de Igreja Sem Carta';
					break;
				case "5":
					++$s5;
					$sit5	= ($s5<2) ? $s5.' - Afastamento':$s5.' - Afastamentos';
					break;
				case "6":
					++$s6;
					$sit6	= ($s6<2) ? $s6.' - Transfência C/ Carta':$s6.' - Transfências C/ Carta';
					break;
				default:
					$situacao = 'Situ&ccedil;&atilde;o n&atilde;o definida!';
					break;
			}
		}
		
		return $sit1.' '.$sit2.' '.$sit3.' '.$sit4.' '.$sit5.' '.$sit6.' '.$situacao;
	}
	
	
}