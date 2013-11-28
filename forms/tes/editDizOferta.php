<script type="text/javascript" src="js/autocomplete.js"></script>
<script
	type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link
	rel="stylesheet" type="text/css" href="css/autocomplete.css"><script type="text/javascript">
$(document).ready(function(){

	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular, congr ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#cargo").val(celular);
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
<?php
$ofertante = new DBRecord('dizimooferta', $idDizOf, 'id');

if ($ofertante->congcadastro()>'0') {
	$igrejaContibui = new DBRecord ('igreja',$ofertante->congcadastro(),'rol');
}

if ($ofertante->lancamento()=='0' || $_SESSION["setor"]>"50") {
?>
<form method="post" name="" action="">
	<table style="background-color: #D3D3D3; border: 0;">
		<caption style="text-align: left; font-weight: bold">
			D&iacute;zimos, Votos e Ofertas (Estamos na:
			<?php echo semana(date('d/m/Y'));?>
			&ordf; Semana deste mês)
		</caption>
		<tbody>
			<tr>
				<td>Nome:<br /> <input type="text" name="nome"
				id="campo_estado" size="38%" value="<?php echo $ofertante->nome();?>"
					tabindex="<?php echo ++$ind;?>" />
				</td>		
				<td><label>Rol:<br /> <input type="text" id="rol" name="rol"
						value="<?php echo $ofertante->rol();?>" /> </label>
				</td>
				<td>Congreg. do membro: <br /> <input type="text" id="cong"
					disabled="disabled" value="<?php echo $igrejaContibui->razao();?>" />
				</td>
			</tr>
			<tr>	
				<td colspan="2">
					Receita: <br /> 
					<?php
					$editEntrada = new tes_listConta('contas', 'titulo', 'credito');
					$complemento = ++$ind.' required="required" ';
					$listaContas = $editEntrada->List_Selec($ofertante->credito(),'4',$complemento);
					echo $listaContas;
					?>
				</td>
				<td><label>Valor:</label><input type="text" id="valor"
					name="valor" value="<?php echo  number_format($ofertante->valor(),2,',','.');?>" tabindex="<?php echo ++$ind;?>" />
				</td>
			</tr>
			<tr>	
				<td colspan="2">
					Caixa: <br /> 
					<?php
					$editCaixa = new tes_listConta('contas', 'titulo', 'devedora');
					$complemento = ++$ind.' required="required" ';
					$listCaixa = $editCaixa->List_Selec($ofertante->devedora(),'1.1.1.001',$complemento);
					//$bsccredor->List_Selec(++$ind,$_GET['igreja'],'required="required" autofocus="autofocus" ');
					echo $listCaixa;
					?>
				</td>
				<td>
					<input type="hidden" name="idDizOf" id="idDizOf" value="<?php echo $_GET['idDizOf'];?>">
					<input type="hidden" name="rolIgreja" id="rolIgreja" value="<?php echo $_GET['igreja'];?>"> <input
					type="hidden" name="escolha" value="views/tesouraria/atualizaDizOferta.php"> <input
					type="submit" name="listar" value="Lançar..."
					tabindex="<?php echo ++$ind;?>">
				</td>
				<td>
					Ou <a href="<?php echo $apagarEntrada;?>" ><button>Apagar</button></a> esta entrada!
				</td>
			</tr>
			<tr>
				<td>Data: <br /> <input type="text" id="data" name="data"
					value="<?php echo conv_valor_br($ofertante->data()) ;?>" />
				</td>
				<td>
					<?php 
						$mes = $ofertante->mesrefer();
						$nomeCampo = 'mesrefer';
						require_once 'forms/listSelect/mes.php';
					?>
				</td>	
				<td>
					Ano:<br />  
					<input type="text" id="ano" name="anorefer" size="4" value="<?php echo $ofertante->anorefer();?>"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php 
}else {
?>
	<h2>Laçamento concluído, não pode ser Alterado. Faça o estorno Contábil e lance outra vez!</h2>
<?php
}
?>

