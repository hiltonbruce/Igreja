<?PHP

		$reimprimir = new DBRecord("tes_recibo", $numRec, "id");
		$cad_igreja = $reimprimir->igreja();
		$valor = $reimprimir->valor();
		$conta = $reimprimir->conta();
		$rec_tipo = $reimprimir->tipo();
		list($ano, $mes, $dia) = explode("-", $reimprimir->data());
		$data = $dia.'/'.$mes.'/'.$ano;
		$rolmembro = $reimprimir->recebeu();
		$numero = $rolmembro;
		list($nome, $cpf, $rg) = explode("," , $rolmembro);
		$cpf = trim( $cpf, 'CPF: ');
		$rg = trim( $rg, 'RG: ' );
		$referente = '<br>'.$reimprimir->motivo();
	
	
	//Formata o valor e defini para exibição por texto por extenso
		$valor_us =strtr("$valor", ',','.' );
		
		$format = '<div id="Tipo">Valor: R$ %s </div>';
		if ($conta=='485') {
			$vlr = '';
		}else {
			$vlr = sprintf($format,number_format("$valor_us",2,",","."));
		}
		
		if ($conta==$_POST['grupo']) {
			$obs = '<fieldset> <legend>Obs.:</legend>'.strip_tags($_POST['obs'].'</fieldset>');
		}else {
			$obs='';
		}
		
	
	
		//Verifica o tipo de recibo de dá o texto apropriado
		
		switch ($rec_tipo){
		case 1:
			$membro = new DBRecord ("membro",$rolmembro,"rol");
			$ecles = new DBRecord ("eclesiastico",$rolmembro,"rol");
			$prof = new DBRecord ("profissional",$rolmembro,"rol");
			$texto =strtoupper( toUpper($membro->nome()))." - ";
	      	//echo("<h1>{$prof->rg()}ttt</h1>");
			$texto .='rol N&ordm: '.$rolmembro;
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
			
			$texto =  strtoupper( toUpper($nome->razao())).", ";
	      	$texto .= "$tipo: ".$nome->cnpj_cpf();
			break;
		case 3:
			$texto = strtoupper( toUpper($nome));//Define o beneficiário do recibo 
			break;
		default:
			//echo "<script> alert('Recibo indefinido!');location.href='../?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec={$_POST["rec"]}';</script>";
			$erro =1;
	}
	if ($erro!='1') {
?>
<div id="mainnav">
		<div style="text-align: right;"><h4><?php printf ("N&uacute;mero do recibo: %'05u",$numRec);?></h4></div>
  </div>
	<div id="content">
	<?php echo $vlr;?><br />
  </div>
    <div id="added-div1">

	<?php
		echo $texto.$referente;
	?>
		<?php 
		if ($cad_igreja<2){
			echo '<h4> Templo Sede.</h4>';
		}else {
			$imp_igreja = new DBRecord('igreja',$cad_igreja, 'rol');
			echo '<h4> Cong. '.$imp_igreja->razao().'</h4>';
		}
		
		echo $obs;
		?>
    </div>
    </div>
    <div id="footer">
     Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
    </div>
  <?php 
	}
  ?>