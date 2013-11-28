<h3><a href="./?escolha=adm/dados_disciplina.php&novo=novo">Novo Registro, Clique aqui! ...</a></h3>

<fieldset><legend>Disciplina - Cadastro</legend>

<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />

<?PHP
controle ("consulta");

if ($_GET["lista"]<1 && empty ($_GET["novo"]) && empty($_POST["Submit"]) ) {
	//Mostra tabela com lista de registro
	$_urlLi="?escolha=adm/dados_disciplina.php&ord={$_GET["ord"]}&cargo={$_GET["cargo"]}&id=".($_GET["id"]);//Montando o Link para ser passada a classe
	
	$query = "SELECT id,motivo,cad,DATE_FORMAT(data_ini,'%d/%m/%Y') AS data_ini, DATE_FORMAT(data_fim,'%d/%m/%Y') AS data_fim from disciplina WHERE rol = '{$_SESSION["rol"]}' " or die (mysql_error());
			
	$nmpp="2000"; //Número de mensagens por párginas
	$paginacao = Array();
	$paginacao['link'] = "?"; //Paginação na mesma página
				
	//Faz os calculos na paginação
	$sql2 = mysql_query ($query) or die (mysql_error());
	$total = mysql_num_rows($sql2) ; //Retorna o total de linha na tabela
	$paginas = ceil ($total/$nmpp); //Retorna o total de páginas
			
			if ($_GET["pagina1"]<1) { 
				$_GET["pagina1"] = 1;
			} elseif ($_GET["pagina1"]>$paginas) {
				$_GET["pagina1"] = $paginas;
			}
			
			$pagina = $_GET["pagina1"]-1;
				
			if ($pagina<0) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
			$inicio=$pagina * $nmpp; //Retorna qual será a primeira linha a ser mostrada no MySQL
			$sql3 = mysql_query ($query." LIMIT $inicio,$nmpp") or die (mysql_error()); 
			//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
							
			 //inicia o cabeçalho de paginação
			
			{
			?>
			<table cellspacing="0" >
			<caption>
			Registro de Disciplina 
			</caption>
			
				<colgroup>
					<col id="">
					<col id="Motivo">
					<col id="Do dia">
					<col id="At&eacute; o dia<">
					<col id="albumCol"/>
				</colgroup>
				
				<thead>
					<tr>
					<th scope="col"></th>
					<th scope="col">Motivo</th>
					<th scope="col">Do dia</th>
					<th scope="col">At&eacute; o dia</th>
					<th scope="col">Cadastrado por:</th>
					</tr>
				</thead>
				<tbody>
			<?PHP
				
				while($coluna = mysql_fetch_array($sql3))
				{
				
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
					<td><?php echo ++$indece;?></td>
					<td><a href="./?escolha=adm/dados_disciplina.php&lista=<?php echo $coluna["id"];?>" title="Click aqui para o texto completo!"><?php echo substr($coluna["motivo"],0,35)."...";?></a></td>
					<td><?php echo $coluna["data_ini"];?></td>
					<td><?php echo $coluna["data_fim"];?></td>
					<td><?php echo substr($coluna["cad"],0,15);?></td>
				</tr>
				<?PHP
				
				}//loop while produtos
				
		?>	
			</tbody>
			</table>
	
		<?PHP
		}
	
		//Classe que monta o rodape
		/*$_rod = new rodape($paginas,$_GET["pagina1"],"pagina1",$_urlLi,8);//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
		$_rod->getRodape(); $_rod->form_rodape ("Ir para P&aacute;gina: ");
		$_rod->getDados();
		if ($paginas>1)
			echo "<br><span class='style4'>Total de $paginas p&aacute;ginas";
			else
			echo "<br><span class='style4'>Total de $paginas p&aacute;gina";
			
		echo "<br />";*/
		if ($total>"1")
		{
			printf("Com %s ocorr&ecirc;ncias!",number_format($total, 0, ',', '.'));					
		}elseif ($total=="1"){
			echo "Com apenas uma ocorr&ecirc;ncia!";
		}else{
			echo "N&atilde;o ocorr&ecirc;ncias para este Membro!";
		}
	
	//Fim da lista de mostrar tabela de registro
	
}elseif (!empty($_GET["lista"])) {
	$disc_completa = new DBRecord  ("disciplina","{$_GET["lista"]}","id");
	//Mostrar texto completo da discipla escolhida
	?>
	<table border="1">
      <tr>
            <td><p>Cadastrador por:</p><?PHP echo $disc_completa->cad();?></td>
            <td><p>Em: </p>
        <?PHP echo conv_valor_br ($disc_completa->hist());?></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#E9E9E9"><p>Motivo:</p><?PHP echo $disc_completa->motivo();?></td>
      </tr>
          <tr>
            <td><p>In&iacute;cio da Disciplina:</p><?PHP echo conv_valor_br ($disc_completa->data_ini());?></td>
            <td><p>Finaliza em:</p>
            <?PHP echo conv_valor_br ($disc_completa->data_fim());?></td>
          </tr>
</table>
	<?PHP
	//Final do texto completo da disciplina
} elseif ($_GET["novo"]=="novo" && empty($_POST["Submit"])) {

?>
	Registrar Disciplina:
	<form id="form1" name="form1" method="post" action="">
	  <table width="auto">
	  <thead>
        <tr>
          <td width="327" rowspan="4" id="form"><label>Motivo:
              <textarea name="motivo" cols="40" id="motivo" tabindex="<?php echo ++$ind;?>"></textarea>
          </label>
	    </td></tr>
	    <tr><td><label>Situacao Espiritual</label>
		<select name="situacao"  tabindex="<?PHP echo ++$ind;?>">
			<option value="">Informe a Situacao</option>
			<option value="2">Displinado</option>
			<option value="3">Falecido</option>
			<option value="4">Modou-se</option>
			<option value="5">Afastou-se da Igreja</option>
		</select>
            </td></tr>
          <tr><td width="229">Data Inicial:
            <label><input type="text" name="data_ini" OnKeyPress="formatar('##/##/####', this);" tabindex="<?php echo ++$ind;?>"/></label>(Em branco para data atual)
	  </td></tr>
 
        <tr>
          <td>Tempo de disciplina:
            <label><input type="text" name="prazo" tabindex="<?php echo ++$ind;?>" /></label>
(em dias ou em branco para 30 dias)</td>
        </tr>
		</thead>
      </table>
	  <input name="tabela" type="hidden" id="tabela" value="disciplina" />
	  <input name="escolha" type="hidden" id="escolha" value="adm/dados_disciplina.php" />
	  <label>
	  <input type="submit" name="Submit" value="Cadastrar..." />
	  </label>
	</form>
	
<?PHP

} elseif ($_POST["Submit"]=="Cadastrar..."){

	$situacao = new situacao_espiritual ($_POST["situacao"]);
?>
	<script language="javascript">
		alert('Você deve confirmar este cadastro usando sua senha de acesso. Faça-o para cadastrar a disciplina!');
	</script> 
	<form id="form1" name="form1" method="post" action="">
	  <table width="auto">
	  <thead>
        <tr>
          <td width="327" rowspan="4" id="form"><label>Motivo: <?php echo $_POST["motivo"];?>
              <input type="hidden" name="motivo" value="<?php echo $_POST["motivo"];?>">
          </label>
	    </td></tr>
	    <tr><td><label>Situacao Espiritual: <?PHP echo $situacao->situacao_confirma();?></label>
		<input type="hidden" name="situacao" value="<?PHP echo $_POST["situacao"];?>">
            </td></tr>
          <tr><td width="229">Data Inicial: <?php echo $_POST["data_ini"];?>
            <label><input type="hidden" name="data_ini" value="<?php echo $_POST["data_ini"];?>"/></label>
	  </td></tr>
 
        <tr>
          <td>Tempo de disciplina: 
		  <?php 
		  	if ((int)$_POST["prazo"]>0) {
		  		echo $_POST["prazo"];
			}else {
				echo "30";
			}
		  ?> dias.
            <label><input type="hidden" name="prazo" value="<?php echo (int)$_POST["prazo"];?>" /></label></td>
        </tr>
		</thead>
      </table>
	  <label>Sua senha:
	  <input name="senha" type="password" id="senha" tabindex="1"/>
	  </label>
	  <input name="tabela" type="hidden" id="tabela" value="disciplina" />
	  <input name="escolha" type="hidden" id="escolha" value="adm/cad_dados_pess.php" />
	  <label>
	  <input type="submit" name="Submit" value="Confimar..." />
	  </label>
	</form>
<?PHP
} //fim form confirmar cadastro $_POST["submit"]=="Cadastrar..."
?>
</fieldset>
