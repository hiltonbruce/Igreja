<?PHP

		$reimprimir = new DBRecord("tes_recibo", $numRec, "id");
		$cad_igreja = $reimprimir->igreja();
		$valor = $reimprimir->valor();
		$rec_tipo = $reimprimir->tipo();
		$fonte_recurso = $reimprimir->fonte();
		list($ano, $mes, $dia) = explode("-", $reimprimir->data());
		$data = $dia.'/'.$mes.'/'.$ano;
		$rolmembro = $reimprimir->recebeu();
		$numero = $rolmembro;
		list($nome, $cpf, $rg) = explode("," , $rolmembro);
		$cpf = trim( $cpf, 'CPF: ');
		$rg = trim( $rg, 'RG: ' );
		$referente = $reimprimir->motivo();
	
	
		$fonte = new DBRecord ("fontes",$fonte_recurso,"id");
	
	//Formata o valor e defini para exibição por texto por extenso
		$valor_us =strtr("$valor", ',','.' );
		$vlr = number_format("$valor_us",2,",",".");
		$dim = extenso($valor_us);
		$dim = ereg_replace(" E "," e ",ucwords($dim));
	
	
		//Verifica o tipo de recibo de dá o texto apropriado
		
		switch ($rec_tipo){
		case 1:
			$membro = new DBRecord ("membro",$rolmembro,"rol");
			$ecles = new DBRecord ("eclesiastico",$rolmembro,"rol");
			$prof = new DBRecord ("profissional",$rolmembro,"rol");
			$texto ="Eu, ".strtoupper( toUpper($membro->nome())).", ";
	      	$texto .= "CPF: ".$prof->cpf();
	      	//echo("<h1>{$prof->rg()}ttt</h1>");
	      	
				if ($prof->rg()==(int)$prof->rg()){
					$texto .= ", RG: ".$prof->rg();
					if ($prof->orgao_expedidor()!=""){
						$texto .= " - ".$prof->orgao_expedidor();
					}
				}else{
					$texto .= ", RG: ".$prof->rg();
					if ($prof->orgao_expedidor()!=""){
						$texto .= " - ".$prof->orgao_expedidor();
					}
				}
			$texto .=', rol N&ordm: '.$rolmembro;
			$texto .= ', recebi da Igreja Evang&eacute;lica Assembleia de Deus - '. $igreja->cidade().' - '.$igreja->uf();
			$responsavel = $membro->nome()."<br />CPF: ".$prof->cpf()." - RG: ".$prof->rg();
			$recebeu = $rolmembro;//Define o beneficiário do recibo
			break;
		case 2:
			if ($numero==""){
				echo "<script> alert('Fornecedor não definido!');location.href='".$link."';</script>";
				$erro=1;
			}
			
			$nome = new DBRecord ("credores",$numero,"id");
			$cidade = new DBRecord ("cidade",$nome->cidade(),"id");
			
			if (strlen($nome->cnpj_cpf())==18){
			$tipo = "CNPJ";
			}elseif (strlen($nome->cnpj_cpf())==14){
			$tipo = "CPF";}
			
			$texto =  "Pago a ".strtoupper( toUpper($nome->razao())).", ";
	      	$texto .= "$tipo: ".$nome->cnpj_cpf().", situada &agrave;: ".$nome->end().", N&ordm; ".$nome->numero();
	      	$texto .= ", ".$nome->bairro()." - ".$cidade->nome()." - ".$nome->uf();
			$responsavel = $nome->responsavel()."<br />CPF: ".$nome->cpf();
			$recebeu = $numero;//Define o beneficiário do recibo 
			break;
		case 3:
			$texto = "Eu, ".strtoupper( toUpper($nome)).", ";
	      	$texto .= "CPF: ".$cpf.", RG: ".$rg.", ";
			$texto .= "recebi da Igreja Evang&eacute;lica Assembleia de Deus - ". $igreja->cidade()." - ".$igreja->uf();
			$responsavel = $nome."<br />CPF: ".$cpf." - RG: ".$rg;
			$recebeu = strtoupper( toUpper($nome)).", CPF: ".$cpf.", RG: ".$rg;//Define o beneficiário do recibo 
			break;
		default:
			//echo "<script> alert('Recibo indefinido!');location.href='../?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec={$_POST["rec"]}';</script>";
			$erro =1;
	}
	if ($erro!='1') {
?>

<div style="width: 665px;">
  <div id="header">
	<p>
	<?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} <br /> $origem - {$igreja->uf()} - CNPJ: {$igreja->cnpj()}<br />
	CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?> 
	<br />Copyright &copy; <a rel="nofollow" href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information">Site&nbsp;</a>
    <br />Email: <a href="mailto: <?PHP echo "{$igreja->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>

<div id="mainnav">
		<div style="text-align: right;"><h4><?php printf ("N&uacute;mero: %'05u",$numRec);?></h4></div>
  </div>
	<div id="content"><div id="Tipo">
			Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 Valor: R$ <?php echo $vlr;?> <br />
  </div>
    <div id="added-div1">
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<?php
		echo $texto;
	?>, a import&acirc;ncia de <?php echo "R$ $vlr ( $dim ).";?><br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelo que firmamos o presente recibo em uma
		via para os devidos fins.<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Referente: <?PHP echo $referente;?>.</p>
		<h4><?php printf ("Fonte do recurso: %s - Cod. %03u.",$fonte->discriminar(),number_format($fonte->id(), 0, ',', '.'));
		if ($cad_igreja<2){
			echo ' Templo Sede.';
		}else {
			$imp_igreja = new DBRecord('igreja',$cad_igreja, 'rol');
			echo ' Cong. '.$imp_igreja->razao();
		}
		?></h4>
    </div>
    <div id="added-div-2">
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?PHP  print $igreja->cidade()." - ".$igreja->uf().", ".data_extenso ($data);?><br /><br /><br />
    	<div id="polegar">Polegar</div><div id="assinatura">Assinatura: <?PHP echo strtoupper(toUpper($responsavel));?></div>
	 </div>
    </div>
    <div id="footer">
     Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
    </div>
  </div>
  <?php 
	}
  ?>