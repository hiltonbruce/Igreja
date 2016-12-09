<?php
if ($altEdit && $membro) {
	echo '<h3><a ';
	echo 'href="./?escolha=adm/dados_disciplina.php&bsc_rol=<?php echo $bsc_rol;?>';
	echo '&novo=novo"><button class="btn btn-primary">Novo Registro</button>';
	echo ', Clique aqui! ...</a></h3>';
	echo '';
}
 ?>
<fieldset>
	<legend>Hist&oacute;rico de registros</legend>
	<?PHP
	controle ("consulta");
	if ($_GET["lista"]<1 && empty ($_GET["novo"]) && empty($_POST["Submit"]) ) {
		//Mostra tabela com lista de registro
		$_urlLi="?escolha=adm/dados_disciplina.php&bsc_rol=$bsc_rol&ord={$_GET["ord"]}&cargo={$_GET["cargo"]}&id=".($_GET["id"]);//Montando o Link para ser passada a classe
		$query = "SELECT id,situacao,motivo,cad,DATE_FORMAT(data_ini,'%d/%m/%Y')
		AS data_ini, DATE_FORMAT(data_fim,'%d/%m/%Y') AS data_fim
		from disciplina WHERE rol = '".$bsc_rol."' " or die (mysql_error());
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
		if ($pagina<0) {
			$pagina=0;
		} //Especifica um valor p variável página caso ela esteja setada
		$inicio=$pagina * $nmpp; //Retorna qual será a primeira linha a ser mostrada no MySQL
		$sql3 = mysql_query ($query." LIMIT $inicio,$nmpp") or die (mysql_error());
		//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
		//inicia o cabeçalho de paginação
		?>
	<table class='table table-striped'>
		<colgroup>
			<col id="">
			<col id="Tipo">
			<col id="Motivo">
			<col id="Do dia">
			<col id="At&eacute; o dia">
			<col id="albumCol" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col"></th>
				<th scope="col">Tipo</th>
				<th scope="col">Descri&ccedil;&atilde;o</th>
				<th scope="col">&Iacute;ncio</th>
				<th scope="col">Final</th>
				<th scope="col">Cadastrado por:</th>
			</tr>
		</thead>
		<tbody>
			<?PHP

			while($coluna = mysql_fetch_array($sql3))
			{
				$motivoDisciplina = strip_tags($coluna["motivo"]);
				$Tipo = new situacao_espiritual ($coluna['situacao'],$_GET['rol']);
				?>
			<tr>
				<td><?php echo ++$indece;?></td>
				<td><?php
				if ($Tipo->situacao_confirma()=='Membro') {
					echo 'Conciliação';
				}else {
					echo $Tipo->situacao_confirma();
				}
				?>
				</td>
				<td><a data-toggle="tooltip" data-placement="top"
					href="./?escolha=adm/dados_disciplina.php&lista=<?php echo $coluna["id"];?>&bsc_rol=<?php echo $_GET['bsc_rol'];?>"
					title="<?php echo $motivoDisciplina;?>"><?php echo substr($motivoDisciplina,0,35)."...";?>
				</a></td>
				<td><?php echo $coluna["data_ini"];?></td>
				<td><?php echo $coluna["data_fim"];?></td>
				<td><?php echo substr($coluna["cad"],0,15);?></td>
			</tr>
			<?PHP

			}//loop while

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
	}elseif ($_GET['lista']<1){
		echo "N&atilde;o h&aacute; ocorr&ecirc;ncias para este Membro!";
	}

	//Fim da lista de mostrar tabela de registro

	if (!empty($_GET["lista"])) {
		$disc_completa = new DBRecord  ("disciplina","{$_GET["lista"]}","id");
		$Tipo = new situacao_espiritual ($disc_completa->situacao());
		//Mostrar texto completo da discipla escolhida
		?>
	<table border="1" width="100%">
		<tr>
			<td><p>Cadastrador por:</p> <?PHP echo $disc_completa->cad();?></td>
			<td><p>Em:</p> <?PHP echo conv_valor_br ($disc_completa->hist());?></td>
			<td><p>Tipo de Registro:</p> <?PHP
			if ($Tipo->situacao_confirma()=='Membro') {
				echo 'Conciliação';
			}else {
				echo $Tipo->situacao_confirma();
			}
			?></td>
		</tr>
		<tr>
			<td colspan="3" bgcolor="#E9E9E9"><p>Descri&ccedil;&atilde;o:</p> <?PHP echo $disc_completa->motivo();?>
			</td>
		</tr>
		<tr>
			<td><p>In&iacute;cio:</p> <?PHP echo conv_valor_br ($disc_completa->data_ini());?>
			</td>
			<td colspan="2"><p>Final:</p> <?PHP echo conv_valor_br ($disc_completa->data_fim());?>
			</td>
		</tr>
	</table>
	<?PHP
	//Final do texto completo da disciplina
	} elseif ($_GET["novo"]=="novo" && empty($_POST["Submit"])) {

		?>
	Registros:
	<form id="form1" name="form1" method="post" action="">
		<table width="100%">
			<thead>
				<tr>
					<td width="327" rowspan="5" id="form"><label>Detalhamento: <textarea
								name="motivo" cols="30" rows="6" required="required" id="motivo"
								tabindex="<?php echo ++$ind;?>" class="form-control" ></textarea>
					</label></td>
					<td>Dirigente do Culto: <input name="dirigente" type="text"
						tabindex="<?php echo ++$ind;?>" class="form-control"  />
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td><label>Situacao Espiritual</label> <select name="situacao"
						tabindex="<?PHP echo ++$ind;?>" class="form-control" >
							<option value="2">Displinado</option>
							<option value="1">Em Comunh&atilde;o</option>
							<option value="3">Falecido</option>
							<option value="4">Mudou-se</option>
							<option value="5">Afastou-se da Igreja</option>
							<option value="6">Transferido</option>
					</select>
					</td>
				</tr>
				<tr>
					<td width="229">Data do Registro: <label><input type="text"
							name="data_ini" id='data' tabindex="<?php echo ++$ind;?>" class="form-control"  /> </label>(Em
						branco para data atual)
					</td>
				</tr>

				<tr>
					<td>Tempo em dias (para disciplina): <label><input type="text"
							name="prazo" tabindex="<?php echo ++$ind;?>"  class="form-control" /> </label> (Em
						branco para INDETERMINDO)
					</td>
				</tr>
			</thead>
		</table>
		<input name="tabela" type="hidden" id="tabela" value="disciplina" /> <input
			name="escolha" type="hidden" id="escolha"
			value="adm/dados_disciplina.php" /> <input name="bsc_rol"
			type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" /> <label> <input
			type="submit" class='btn btn-primary' name="Submit" value="Cadastrar..."
			tabindex="<?php echo ++$ind;?>" />
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
		Descri&ccedil;&atilde;o:
		<?php echo $_POST["motivo"]."<h5>Culto dirigido por: ".$_POST[dirigente]."</h5>";?>
		<label> <input type="hidden" name="motivo"
			value="<?php echo $_POST["motivo"]."<h5>Culto dirigido por: {$_POST[dirigente]}</h5>";?>">
		</label> Registro:
		<?PHP echo $situacao->situacao_confirma();?>
		<label><input type="hidden" name="situacao"
			value="<?PHP echo $_POST["situacao"];?>"> </label> <label>Data: <?php
			if ($_POST["data_ini"]<>"") {
				echo $_POST["data_ini"];
			}else {
				echo date ("d/m/Y");
			}
			?> <input type="hidden" name="data_ini"
			value="<?php echo $_POST["data_ini"];?>" />
		</label>
		<table width="100%">
			<thead>
				<tr>
					<td><?php
		  	if ($_POST["situacao"]=="2") {
		  		echo "Tempo de disciplina:";
		  		if ((int)$_POST["prazo"]>0) {
		  			echo $_POST["prazo"]." dias.";
		  		}else {
		  			echo "INDETERMINADO";
		  		}
		  	}
		  	?> <label><input type="hidden" name="prazo"
					value="<?php echo (int)$_POST["prazo"];?>" /> </label></td>
				</tr>
			</thead>
		</table>
		<label>Sua senha: <input name="senha" type="password" id="senha"
			tabindex="1" class="form-control"  autofocus='autofocus' />
		</label> <input name="tabela" type="hidden" id="tabela"
			value="disciplina" /> <input name="bsc_rol" type="hidden" id="campo"
			value="<?PHP echo $bsc_rol;?>" /> <input name="escolha" type="hidden"
			id="escolha" value="adm/cad_dados_pess.php" /> <label> <input
			type="submit" class='btn btn-primary' name="Submit" value="Confimar..."
			tabindex="<?php echo ++$ind;?>" />
		</label>
	</form>
	<?PHP
	} //fim form confirmar cadastro $_POST["submit"]=="Cadastrar..."
	?>
</fieldset>
