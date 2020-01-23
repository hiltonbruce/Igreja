<?php
	if ($_POST['item']!='' && $_POST['']!='quant') {
		require_once 'models/cadlimpeza.php';
	}
	$data = (checadata($_GET['data'])) ? $_GET['data']:date('d/m/Y');
	//Incluir tabela com resumo do pedido
?>
<fieldset>
<legend>Solicita&ccedil;&atilde;o de Material de Limpeza, para:
	<?php echo $periodo['0'];?></legend>
<form method='post' name='limpeza' >
	<table class='table'>
			<tr>
				<td><label>Item</label>
					<?php
						$item = new List_sele('limpeza', 'discrim', 'item');
						echo $item->List_Selec(++$ind,'',' class="form-control" ');
					?>
				</td>
				<td><label>Quantidade</label>
					<input type="text" name="quant" placeholder="Quantidade" class="form-control" tabindex="<?PHP echo ++$ind;?>" />
				</td>
				<td><label>Igreja</label>
					<?php
						$item = new List_sele('igreja', 'razao', 'igreja');
						echo $item->List_Selec(++$ind,$igreja,' class="form-control" requrided="requrided"');
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label>Data:</label>
					<input type="text" name="data" class="form-control dataclass" required='required'
						tabindex="<?PHP echo ++$ind;?>" value="<?php echo $data;?>" />
				</td>
				<td>&nbsp;<br />
				</td>
				<td>&nbsp;<br />
					<input type="submit"  class="btn btn-primary" name="Submit"
					 value="Lan&ccedil;ar..." tabindex="<?PHP echo ++$ind; ?>"/>
					<input type="hidden" name="mes" value="<?PHP echo $mesPed;?>"/>
					<input type="hidden" name="ano" value="<?PHP echo $anoPed;?>"/>
					<input type="hidden" name="mesref" value="<?PHP echo $mesref;?>"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
</fieldset>
<?php
require_once ('views/menus/subLimp.php');
	if ( $igreja >0) {
		//Lista materiais da congrega�ao
		require_once 'views/tabLimpeza.php';
	}
?>
