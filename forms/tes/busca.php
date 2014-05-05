<script type="text/javascript" src="js/autocomplete.js"></script>
<script	type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">
<script type="text/javascript">
$(document).ready(function(){

	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular, congr ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#rol").val(celular);
			$("#cong").val(congr);
		}
		
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autodizimo.php?q=" + this.value;
	});

});
</script>
<!-- Desenvolvido por Wellington Ribeiro -->
<fieldset>
	<legend>Lançamentos - Membros, congregados e an&ocirc;nimos</legend>
	<form method="get" name="" action="">
		<table style="background-color: #D3D3D3; border: 0;">
		<tbody>
			<tr>
				<td colspan="2">Nome:<br /> <input type="text" name="nome"
				id="campo_estado" size="30%" autofocus="autofocus"
					tabindex="<?php echo ++$ind;?>" value="<?php if ($_GET['rol']<'1') echo $_GET['nome'];?>" />
				</td>
			     <td><label>Rol: (Zero p/ An&ocirc;nimo)<br /> <input type="text" id="rol" name="rol"
						value="<?php echo $_GET['rol'];?>" tabindex="<?php echo ++$ind;?>" size="5" /> </label>
				</td>
				<td>
					Congrega&ccedil;&atilde;o:<br />
					<?php
						$bsccredor = new List_sele('igreja', 'razao', 'igreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'');
						echo $listaIgreja;
					?> 
				</td>
               </tr>
			<tr>
				<td>
					Dia: <br /><input type="text" size="2" maxlength="2" name="dia" value="<?php echo $_GET['dia'];?>"tabindex="<?PHP echo ++$ind; ?>" />
				</td>
				<td>
					Mês:<br /> 
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" >
					      <?php
					      	$linha1 = '<option value="">Selecione o mês...</option>';
						      foreach(arrayMeses() as $mes => $meses) {            
								 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
								 if ($_GET['mes']==$mes) {
								 	$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
								 }
						      }
						      echo $linha1.$linha2;
					      ?>
				      </select>
				</td>
				<td>
					Ano:(Zero p/ todos os anos) <br />
					<input type="text" name="ano" value="<?php echo $_GET['ano'];?>"tabindex="<?PHP echo ++$ind; ?>" size="5" />  
					<input type="hidden" name="membro"	value="<?php echo true;?>" /> 
					<input type="hidden" name="fin"	value="<?php echo $fin;?>" /> 
				</td><td>
					<input name="escolha" type="hidden" value="tesouraria/receita.php" /><br />
					<input type="hidden" name="rec"	value="<?php echo $rec;?>" /> <input type="submit" name="Submit" value="Listar..."
					tabindex="<?PHP echo ++$ind; ?>" /> 
					<input name="menu" type="hidden" value="top_tesouraria" />
				</td>
			</tr>
		</tbody>
	</table>
	</form>
</fieldset>
