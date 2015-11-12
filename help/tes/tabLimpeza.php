<?php
//Monta a tabela
foreach ($tbodytab->tabelaLimp($congregcao->rol()) as $key => $valor){
	$inclimp++;
	//Faz o trabalho de zebrar a tabela
	echo '<tr>';
	list($colUnid,$colDescr,$colQuant1,$colQuant2,$colQuant3) = explode(",", $valor);

	/*
	 * Extrai o 1º valor e atribui para a variável adequada a coluna
	 */
	list($mesRef1,$valor1) = explode (' ',$colQuant1);
	if ($mesRef1==$mesref) {
		$valorAtual = $valor1;
	}elseif ($mesRef1==$periodo['1']) {
		$valorAnt1 = $valor1;
	}elseif ($mesRef1==$periodo['2']){
		$valorAnt2 = $valor1;
	}

	/*
	 * Extrai o 2º valor e atribui para a variável adequada a coluna
	*/
	list($mesRef2,$valor2) = explode (' ',$colQuant2);
	if ($mesRef2==$periodo['1']) {
		$valorAnt1 = $valor2;
	}elseif ($mesRef2==$periodo['2']){
		$valorAnt2 = $valor2;
	}

	/*
	 * Extrai o 3º valor e atribui para a variável adequada a coluna
	*/
	list($mesRef3,$valor3) = explode (' ',$colQuant3);
	if ($mesRef3==$periodo['2']){
		$valorAnt2 = $valor3;
	}

	//echo $key.' - '.$valor;//Coluna Item
	printf("<td>%'03u</td>",$key);

	//Coluna Anterior1
	printf("<td class='text-center'>%s</td>",$valorAnt2);
	//Coluna Anterior2
	printf("<td class='text-center'>%s</td>",$valorAnt1);

	//Coluna Unidade
	printf("<td>%s</td>",$colUnid);

	//Coluna Discriminação
	echo '<td> '.$colDescr.' </td>';//Modificar qdo apliar para outros documentos

	//Coluna Atual
	printf("<td class='text-center'>%s</td></tr>",$valorAtual);

	$valorAtual=''; $valorAnt1 =''; $valorAnt2 ='';

}

?>
