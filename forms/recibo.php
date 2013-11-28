<?php $ind=1; 
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
?>

<fieldset>
<legend>Emiss&atilde;o de Recibos</legend>
<form id="form1" name="form1" method="post" action="tesouraria/recibo_print.php">

	<table>
		<colgroup></colgroup>
		<thead></thead>
		<tbody>
<?php

switch ($_GET["rec"]){
	case 2:
			echo '<tr><td><label>Credores Cadastrados</label>';
			$for_num = new List_sele("credores", "cnpj_cpf", "numero");
			echo $for_num->List_Selec($ind++,$_GET['recebeu']);
			echo '</td><td>';
			echo '<label>ou Credores - por Nome</label>';
			$for_num = new List_sele("credores", "alias", "razao");
			echo $for_num->List_Selec($ind++,$_GET['recebeu']);
			echo '</td></tr>';
		$rec = 2;  		
		break;
	case 3:
		
		echo '<label>Nome</label>';
		echo '<input type="text" name="nome" autofocus="autofocus" value="'.$_GET["nome"].'" size="40" tabindex="'.++$ind.'" />';
		?>
		<label>CPF:</label>
			<input name="cpf" type="text" value="<?php echo $_GET["cpf"];?>" maxlength="14" OnKeyPress="formatar('###.###.###-##', this);" tabindex="<?PHP echo ++$ind;?>" />
		<?php
		echo '<label>Identidade:</label>';
		echo '<input name="rg" type="text" value="'.$_GET["rg"].'" tabindex="'.$ind++.'" />Número e Expedidor';
		$rec = 3; 
		break;
	default:
		?>
			<a href="javascript:lancarSubmenu('campo=nome&rol=rol&form=0')" >
			<img border="0" src="img/lupa_32x32.png" width="18" height="18" title="Click aqui para pesquisar membros!" />
			Pesquisar Membro</a>
			<label>Nome</label>
			<input type="text" name="nome" autofocus="autofocus" size="40" tabindex="<?PHP echo $ind++;?>" value="<?php echo $_GET["nome"];?>"/>			
			<label>Rol:</label>
			<input name="rol" type="text" value="<?php echo $_GET["rol"];?>" size="10" tabindex="<?PHP echo $ind++;?>" />
		<?php
		$rec = 1;
		break;
}
		
?>
			<tr>
				<td>
					<label>Valor (R$):</label>
					<input name="valor" type="text" id="valor" size="14" tabindex="<?PHP echo ++$ind; ?>" value="<?php echo $_GET["valor"];?>" />
				</td><td>
					<label>Data</label>
					<input name="data" type="text" id="data" OnKeyPress="formatar('##/##/####', this);" 
					tabindex="<?PHP echo ++$ind; ?> "maxlength="10" value="<?php echo $_GET["data"];?>" /> Em branco para hoje
				</td>
			</tr>
			<tr>
				<td>	
					<label>Fonte para pgto:</label>
					<?php 						
						$congr = new List_sele ("fontes", "discriminar", "fonte");
		 				echo $congr->List_Selec (++$ind,$_GET['fonte']);
					?>
				</td>
				<td>
					<label>Igreja:</label>
					<?php 
						$congr = new List_sele ("igreja","razao","igreja");
		 				echo $congr->List_Selec (++$ind,$_GET['igreja']);
					?>
				</td>
			</tr>
		</tbody>
	</table>		
	<label>Referente a/motivo do recibo</label>
   <textarea class="text_area" name="referente" cols="25" id="referente" tabindex="<?PHP
   echo $ind++;?>" onKeyDown="textCounter(this.form.referente,this.form.remLen,255);" 
		onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);"
		><?php echo $_GET["referente"];?></textarea>
   
   <div id="progreso"></div>
   (Max. 255 Carateres)
  <input readonly type=text name=remLen size=3 maxlength=3 value="255"> 
Caracteres restantes
	<label></label>
	<input type="hidden" name="rec" value="<?php echo $rec;?>">
	<input type="hidden" name="transid" value="<?php echo (get_transid());?>">
	<input type="submit" name="Submit" value="Emitir..." tabindex="<?PHP echo ++$ind; ?>"/>
</form>
</fieldset>
<?php 
} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
?>
