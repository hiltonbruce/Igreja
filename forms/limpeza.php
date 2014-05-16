
<?php 
	$igreja = ($_POST['igreja']>0) ? $_POST['igreja']:$_GET['igreja'];
	echo "<style type='text/css'>";
	require_once ("aniv/style.css");
	echo "</style>";
	if ($_POST['item']!='' && $_POST['']!='quant') {
		require_once 'models/cadlimpeza.php';
	}
	$data = (checadata($_GET['data'])) ? $_GET['data']:date('d/m/Y');
	
	if (empty($_GET['mes']) && empty($_GET['ano'])) {
		$periodo = periodoLimp($mesref);
	}else {
		$periodo = periodoLimp($_GET['mesref']);
	}
	
	//Incluir tabela com resumo do pedido
?>
<fieldset>
<legend>Solicitação de Material de Limpeza, para: <?php echo $periodo['0'];?></legend>
<form method='post' name='limpeza' >
	<table style="width: 100%;"  class="table table-bordered" >
			<tr>
				<td>
					<?php 
						$item = new List_sele('limpeza', 'discrim', 'item');
						echo $item->List_Selec(++$ind,'',' class="form-control" ');
					?>
				</td>
				<td>
					<input type="text" name="quant" placeholder="Quantidade" class="form-control" tabindex="<?PHP echo ++$ind;?>" />
				</td>
				<td>
					<?php 
						$item = new List_sele('igreja', 'razao', 'igreja');
						echo $item->List_Selec(++$ind,$igreja,' class="form-control" requrided="requrided"');
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label>Data:</label>
					<input type="text" name="data" class="form-control" required='required' id='data'
						tabindex="<?PHP echo ++$ind;?>" value="<?php echo $data;?>" maxlength="10" />
				</td>
				<td>&nbsp;<br />
					<a href="./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=2&<?php echo $linkperido;?>">
					<button type="button" class="btn btn-primary" >Mostrar totalizador</button></a>
				</td>
				<td>&nbsp;<br />
					<input type="submit"  class="btn btn-primary" name="Submit" value="Enviar..." tabindex="<?PHP echo ++$ind; ?>"/>
					<input type="hidden" name="mes" value="<?PHP echo $_GET['mes'];?>"/>
					<input type="hidden" name="ano" value="<?PHP echo $_GET['ano'];?>"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<a href='./?escolha=controller/limpeza.php&menu=top_tesouraria&limpeza=5'><button type="button" class="btn btn-primary">Alterar Período...</button></a>
<a href='./controller/limpeza.php?limpeza=6'><button type="button" class="btn btn-primary">Material Disponível...</button></a>
</fieldset>

<?php
	if ( $igreja >0) {
		//Lista materiais da congregação
		require_once 'views/tabLimpeza.php';
	}
?>
