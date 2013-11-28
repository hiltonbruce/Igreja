<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
<?PHP
if (!empty($_GET['uf'])){
		$uf = $_GET['uf'];}
	else 
		{$uf = "PB";}
$ind=0;
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<?PHP
controle("inserir");
		
//$estado = new DBRecord ("estado",$uf,"uf");
//$test = new DBRecord($table, $id, $campo);
?>
<fieldset><legend>Alterar e Incluir Cidade</legend>

<table id="Cidade" style="text-align: left; width: 100%;" >
	<tbody>
		<tr>
			<td>
			Estado
			</td>
			<td>
						<?PHP							
							$esc_cidade = new cidadepop('cidade', 'id', 'coduf');
							$esc_cidade->List_Selec_pop("escolha=tab_auxiliar/cadastro_cidade.php&uf=$uf&idcidade=");
						?>
		</td>
	</tbody>
</table>
<table id="Tabela Cidades" summary="Lista das Cidade." style="text-align: left; width: 100%;">
    <caption>
      Cidades do Estado <?php echo $estado->nome;?>
    </caption>
    <colgroup>
		<col id="Nome da atual">
		<col id="Alterar para:">
		<col id="Excluir bairro!">
	</colgroup>
    <thead>
      <tr>
        <th scope="col">Nome da atual</th>
        <th scope="col">Alterar para:</th>
        <th scope="col">Excluir Cidade!</th>
      </tr>
    </thead>

    <tbody>
    <?php
  
    $options = new bairro();
	$lista = $options->Arraybairro("2566");

	while ($chave=key($lista)) {
		++$contar;
		if ($contar==1) {
			$zebrar = "class='odd'";}
			else
			{$zebrar = "";$contar=0;}
		?>
		<tr <?php echo $zebrar;?>>
			<td><?php echo $lista[$chave];?></td>
			<td><?php 
					$alt_bair = new formbairro();
					$alt_bair->formulario($lista[$chave], $chave, ++$ind);
				?>
			</td>
			<td>
				<a href="./?escolha=sistema/excl_bairro.php&tabela=bairro&id=<?php echo $chave;?>">Excluir...</a>
			</td>
    	</tr>
    		<?PHP
    		next($lista);
    	}
    	
    ?>
      
    </tbody>
  </table>
 </fieldset>