<?PHP	
	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	
	session_start();
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");	    
	function __autoload ($classe) { 
	require_once ("../models/$classe.class.php");
	}
	controle("consulta");
	$rol 		= (int)$_GET["rol"];
	$membro		= new DBRecord ("membro",$rol ,"rol");
	$est_civil 	= new DBRecord ("est_civil",$rol,"rol");
	$ecles 		= new DBRecord ("eclesiastico",$rol,"rol");
	$prof 		= new DBRecord ("profissional",$rol,"rol");
	$igreja 	= new DBRecord ("igreja",$ecles->congregacao(),"rol");
	$cidade 	= new DBRecord ("cidade",$membro->naturalidade(),"id");
	$cidend 	= new DBRecord ("cidade",$membro->cidade(),"id");
	$bairro 	= new DBRecord ("bairro",$membro->bairro(),"id");
	$numreg		= new registro ('disciplina', 'rol', $rol);	
	$sede 		= new DBRecord ("igreja",'1',"rol");
	if ($ecles->congregacao()=='1') {
		//Sede
		$dircon		= 'Pastor: '.$sede->pastor();
		$templo		= '<b>Templo Sede </b> ';
	}else {
		//Congregações
		$dadocong 	= new DBRecord ("igreja",$ecles->congregacao(),"rol");
		$dirigente 	= new DBRecord ("membro",$dadocong->pastor(),"rol");
		$dircon		= '<b>Dirig. </b>'.cargo($dadocong->pastor()).': '.$dirigente->nome();
		$templo		= '<b>Congreg.: </b>'.$igreja->razao();
	}
	if ($numreg->totlinhas()>1) {
		$reg = $numreg->totlinhas().' registros, sendo: '.$numreg->registros();
		
	}elseif ($numreg->totlinhas()==1){
		
		$reg = '1 (um) registro, sendo: '.$numreg->registros();
	}else {
		$reg = 'Sem registro neste cadastro!';
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ficha de Membro</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/fichamembro.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">
</head>
<body>
  <div id="header">
	<p>
	<?PHP echo "Templo SEDE: {$sede->rua()}, N&ordm; {$sede->numero()} <br /> {$sede->cidade()} - {$sede->uf()} - CNPJ: {$sede->cnpj()}<br />
	CEP: {$sede->cep()} - Fone: {$sede->fone()} - Fax: {$sede->fax()}";?>
	<br />Copyright &copy; <a rel="nofollow" href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information">Site&nbsp;</a>
    <br />Email: <a href="mailto: <?PHP echo "{$sede->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>
   <div id="added-div1">
   <table id="playlistTable" summary="">
	<thead>
		<tr>
			<th colspan="3">Ficha de Membro<br /><span style='font-size: 70%;'><?php echo $templo;?>,
			 <?php echo $dircon;?></span></th>
		</tr>
	</thead>
    <tbody>
		<tr>
			<td colspan="2"><b>Cargo: </b><?php echo cargo($rol).' - '.situacao($ecles->situacao_espiritual(), $rol);?></td>
        <td rowspan="3" width='75' ><?PHP printf ("Rol: %'04u <br />",$rol); echo mostra_foto($rol);?></td>
		</tr>
      <tr>
        <td colspan="2"><b>Nome: </b><?php echo $membro->nome();?></td>
      </tr>
      <tr>
        <td colspan="2" ><b>Pai: </b><?php echo $membro->pai();?></td>
      </tr>
      <tr>
        <td colspan="3"><b>Mãe: </b><?php echo $membro->mae();?></td>
      </tr>
      <tr>
        <td colspan="3"><b>Cidade Natal: </b><u><?php echo $cidade->nome().' - '.$cidade->coduf();?></u></td>
      </tr>
      <tr>
        <td colspan="3"><b>Telefones: </b><u><?php echo $membro->fone_resid().' - '.$membro->celular();?></u></td>
      </tr>
      <tr>
        <td colspan="3"><b>Email: </b><u><?php echo $membro->email();?></u></td>
      </tr>
      <tr>
        <td><b>RG: </b><?php echo $prof->rg().' - '.$prof->orgao_expedidor();?></td>
        <td><b>CPF: </b><?php echo $prof-> 	cpf();?></td>
        <td><b>Nasc.: </b><?php echo conv_valor_br($membro->datanasc()) ;?></td>
      </tr>
      <tr>
        <td colspan="3"><b>Cônjugue: </b><?php echo $est_civil->conjugue();?></td>
      </tr>
      <tr>
        <td colspan="3"><b>Endereço: </b><?php echo $membro->endereco().', Nº: '.$membro->numero();?></td>
      </tr>
      <tr>
        <td colspan="3"><b>Bairro: </b><?php echo $bairro->bairro();?></td>
      </tr>
      <tr>
        <td colspan="3"><b>Cidade: </b><?php echo $cidend->nome().' - '.$cidend->coduf();?></td>
      </tr>
      <?php 
      	if ($membro->sexo()=='F') {
      		echo '<tr><td colspan="3"><b>Batismo:</b> '.conv_valor_br($ecles->batismo_em_aguas()).'</td></tr>';
      	}else {
      ?>
      <tr>
        <td><b>Batismo:</b><?php echo conv_valor_br($ecles->batismo_em_aguas());?></td>
        <td><b>Auxiliar:</b><?php echo conv_valor_br($ecles->auxiliar());?></td>
        <td><b>Diacono:</b><?php echo conv_valor_br($ecles->diaconato());?></td>
      </tr>
      <tr>
        <td><b>Presb.:</b> <?php echo conv_valor_br($ecles->presbitero());?></td>
        <td><b>Evangel.:</b> <?php echo conv_valor_br($ecles->evangelista());?></td>
        <td><b>Pastor:</b> <?php echo conv_valor_br($ecles->pastor());?></td>
      </tr>
      <?php } ?>
      </tbody>
	  <tfoot>
	      <tr>
	        <td colspan="3" style="background-color:#CCCCCC;font-size:90%"><?php echo $reg;?> </td>
	      </tr>
	  </tfoot>
    </table>
    </div>
    <div id="footer">
	<?PHP 
	echo "Templo: {$sede->razao()}: {$sede->rua()}, N&ordm; {$sede->numero()} - {$sede->cidade()} - {$sede->uf()}";
	
	?><br />
	  Copyright &copy; <a onclick='target="_blank"' href="http://<?PHP echo "{$sede->site()}";?>/" title="Copyright information"></a>
      Email: <a rel="nofollow" href="mailto: <?PHP echo "{$sede->email()}";?>" onclick='target="_blank"'><?PHP echo "{$sede->email()}";?></a> <br />
	   <?PHP echo "CNPJ: {$sede->cnpj()}";?><br />
   		<?PHP echo "CEP: {$sede->cep()} - Fone: {$sede->fone()} - Fax: {$sede->fax()}";?><br />
	  <p>Designed by <a rel="nofollow"  onclick='target="_blank"' href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
    </div>
 
<!-- FOOTER CENTER "Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a>"-->
<!-- NEW PAGE -->
<!-- HEADER CENTER <?php echo "Anexo - Ficha Rol: $rol";?>" -->
<?php 
if (strlen($membro->obs()>'4') ) {
?>
<div style="page-break-before: always;"></div>
   <p>
   <div id="added-div1">
	<table id="playlistTable" summary="">
		<thead>
			<tr>
				<th colspan="3">Obsevações:</th>
			</tr>
		</thead>
	    <tbody>
			<tr>
				<td colspan="3"><span style="text-align: justify;">
					<?php echo $membro->obs();?></span>
				</td>
			</tr>
      </tbody>
    </table>
	</div>
    </p>
	
<?PHP
}
if ($_GET["lista"]<1 && empty ($_GET["novo"]) && empty($_POST["Submit"]) ) {
	
	$query = "SELECT id,situacao,motivo,cad,DATE_FORMAT(data_ini,'%d/%m/%Y')
				 AS data_ini, DATE_FORMAT(data_fim,'%d/%m/%Y') AS data_fim 
				 from disciplina WHERE rol = '{$_GET["rol"]}' " or die (mysql_error());
				
	$sql3 = mysql_query ($query) or die (mysql_error()); 
			//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
	
	if (mysql_num_rows ($sql3)>0) {
			
?>
<div style="page-break-before: always;">
   <div id="added-div1">
  <table >
			<caption>Hist&oacute;rico</caption>
				<colgroup>
					<col id="item" />
					<col id="Tipo" />
					<col id="Do dia" />
					<col id="At&eacute; o dia" />
					<col id="albumCol" />
				</colgroup>
				
				<thead>
					<tr>
					<th scope="col">Item</th>
					<th scope="col">Tipo</th>
					<th scope="col">&Iacute;ncio</th>
					<th scope="col">Final</th>
					<th scope="col">Cadastrado por:</th>
					</tr>
				</thead>
				<tbody>
			<?PHP
				
				while($coluna = mysql_fetch_array($sql3))
				{
				$Tipo = new situacao_espiritual ($coluna['situacao'],$_GET['rol']);
				$ls+=1;
				if ($ls>1)	
						{
						$cor="class='odd'";
						$ls=0;
						}
						else 
						{$cor="class='od2'";
						}
				?>
				<tr "<?php echo "$cor";?>">
					<td rowspan="2"><?php echo ++$indece;?></td>
					<td><?php echo $Tipo->situacao_confirma();?></td>
					<td><?php echo $coluna["data_ini"];?></td>
					<td><?php echo $coluna["data_fim"];?></td>
					<td><?php echo $coluna["cad"];?></td>
				</tr>
				<tr style="border: solid 1px;">
					<td colspan="4"><p>Descri&ccedil;&atilde;o</p><?php echo $coluna["motivo"];?></td>
				</tr>
				<?PHP
				
				}//loop while
				
		?>	
			</tbody>
			</table></div>
	
		<?PHP
		}}
    ?>
</body>
</html>
