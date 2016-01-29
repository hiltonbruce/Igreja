<?php
	/* script de cadastro do recibo a ser atribuida a
	 * a variável adquada para chamada no momento
	 * correto quando estiver gerando a tabela no script
	 * help/tes/reciboPgto.php
	 */
	//echo '<h1>gerarRecGrupo</h1>';
	$igreja = new DBRecord ("igreja","1","rol");
	//$referente = $_POST['referente'];
	$valor_us = $valor['pgto'];
	$cad_igreja = $valor['igreja'];
	$fonte_recurso = $valor['tipo'];
	$data = date ('d/m/Y');
	$hist = $_SESSION['valid_user'].": ".date("d/m/Y h:i:s");

	switch ($_POST['grupo']) {
		case '2':
			//tesoureiros
			$rec_tipo=1;
			$rolmembro = $valor['rolMembro'];
		break;
		case '3':
			//Auxilio
			if ($valor['rolMembro']>'0') {
				$rec_tipo=1;
				$rolmembro = $valor['rolMembro'];
			}else {
				$rec_tipo=3;
				list($nome,$cpf,$rg)=explode( ",",$valor['naoMembro']);
				$cpf = trim( $cpf, 'CPF: ');
				$rg = ltrim( $rg, 'RG: ' );
			}
		break;
		case '4':
			//Zeladores
			if ($valor['rolMembro']>'0') {
				$rec_tipo=1;
				$rolmembro = $valor['rolMembro'];
			}else {
				$rec_tipo=3;
				list($nome,$cpf,$rg)=explode( ",",$valor['naoMembro']);
				$cpf = trim( $cpf, 'CPF: ');
				$rg = ltrim( $rg, 'RG: ' );
			}
		break;
		case '5':
			if ($valor['rolMembro']>'0') {
				$rec_tipo=1;
				$rolmembro = $valor['rolMembro'];
			}else {
				$rec_tipo=3;
				list($nome,$cpf,$rg)=explode( ",",$valor['naoMembro']);
				$cpf = trim( $cpf, 'CPF: ');
				$rg = ltrim( $rg, 'RG: ' );
			}
			//Demais Pagamentos
		break;
		case '6':
			//Sexta-Feira
			if ($valor['rolMembro']>'0') {
				$rec_tipo=1;
				$rolmembro = $valor['rolMembro'];
			}else {
				$rec_tipo=3;
				list($nome,$cpf,$rg)=explode( ",",$valor['naoMembro']);
				$cpf = trim( $cpf, 'CPF: ');
				$rg = ltrim( $rg, 'RG: ' );
			}
		break;
		case '7':
			//Pgto's quinzenal
			if ($valor['rolMembro']>'0') {
				$rec_tipo=1;
				$rolmembro = $valor['rolMembro'];
			}else {
				$rec_tipo=3;
				list($nome,$cpf,$rg)=explode( ",",$valor['naoMembro']);
				$cpf = trim( $cpf, 'CPF: ');
				$rg = ltrim( $rg, 'RG: ' );
			}
		break;
		case '8':
			//Sede
			if ($valor['rolMembro']>'0') {
			$rec_tipo=1;
			$rolmembro = $valor['rolMembro'];
			}else {
				$rec_tipo=3;
				list($nome,$cpf,$rg)=explode( ",",$valor['naoMembro']);
				$cpf = trim( $cpf, 'CPF: ');
				$rg = ltrim( $rg, 'RG: ' );
			}
		break;
		default:
			//grupo = 1 -> Ministerio
			$rolmembro = $valor['rolMembro'];
			$rec_tipo=1;
		break;
	}
?>
