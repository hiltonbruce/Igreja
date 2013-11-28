
<?php 
	$igreja = ($_POST['igreja']>0) ? $_POST['igreja']:$_GET['igreja'];
	echo "<style type='text/css'>";
	require_once ("aniv/style.css");
	echo "</style>";
	if ($_POST['item']!='' && $_POST['']!='quant') {
		require_once 'models/cadlimpeza.php';
	}
	$mesref = ($mesref!='') ? $mesref:$_GET['mesref'];

	$data = (checadata($_GET['data'])) ? $_GET['data']:date('d/m/Y');
	
	list($mref,$aref) = explode('/', $mesref);
	$linkperido = 'mes='.$mref.'&ano='.$aref;
	$periodo = 'para ';
	
	switch ($mref) {
		case 2:
		 $periodo .= 'Fev e Mar/';
		break;
		case 4:
		 $periodo .= 'Abr e Mai/';
		break;
		case 6:
		 $periodo .= 'Jun e Jul/';
		break;
		case 8:
		 $periodo .= 'Ago e Set/';
		break;
		case 10:
		 $periodo .= 'Out e Nov/';
		break;
		case 12:
		 $periodo .= 'Dez e Jan/';
		break;
		default:
			$periodo = 'Nenhum período definido!';
		break;
	}
	
	if (strstr($periodo, 'para')) {
		$periodo .= $aref;
	}
	
	//Incluir tabela com resumo do pedido
?>
<fieldset>
<legend>Solicitação de Material de Limpeza, <?php echo $periodo;?></legend>
<form method='post' name='limpeza' >
	<table id="listTable" style="width: 100%;">
			<colgroup>
				<col id="item">
				<col id="Quantidade">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">item</th>
				<th scope="col">Quantidade:</th>
				<th scope="col">Igreja:</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<?php 
						$item = new List_sele('limpeza', 'discrim', 'item');
						echo $item->List_Selec(++$ind,'','');
					?>
				</td>
				<td>
					<input type="text" name="quant" tabindex="<?PHP echo ++$ind;?>" />
				</td>
				<td>
					<?php 
						$item = new List_sele('igreja', 'razao', 'igreja');
						echo $item->List_Selec(++$ind,$igreja,'requrided="requrided"');
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label>Data:</label>
					<input type="text" name="data" required='required' OnKeyPress
					="formatar('##/##/####', this);" 
						tabindex="<?PHP echo ++$ind;?>" value="<?php echo $data;?>" maxlength="10" />
				</td>
				<td>
					<a href="./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=2&<?php echo $linkperido;?>">
					<button type="button">Mostrar totalizador</button></a>
				</td>
				<td>
					<input type="submit" name="Submit" value="Enviar..." tabindex="<?PHP echo ++$ind; ?>"/>
					<input type="hidden" name="mes" value="<?PHP echo $_GET['mes'];?>"/>
					<input type="hidden" name="ano" value="<?PHP echo $_GET['ano'];?>"/>
				</td>
			</tr>
		</tbody>
	</table>
</form><a href='./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=5'><button type="button">Alterar Período...</button></a>
</fieldset>

<?php
	if ( $igreja >0) {
		//Lista materiais caso a tenha iniciado a listagem
		require_once 'views/tabLimpeza.php';
	}
?>
