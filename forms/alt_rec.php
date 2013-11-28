<?php $ind=1; 
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
$campos = array ("rol","valor","data","fonte","referente","rec","transid");

?>
<td>
	<form id = "2" action="tesouraria/recibo_print.php" method="post">
		<input type="hidden" name="reimprimir" id="reimprimir" value="<?php echo $rec_alterar->id();?>">
		<input type="submit" value = "Re - Imprimir este recibo" >
</form>
</td>
<td style="text-align: right;">
	<form id = "form1" action="" method="get">
		<input type="hidden" name="valor" id="valor" value="<?php echo  $rec_alterar->valor();?>">
		<input type="hidden" name="referente" id="referente" value="<?php echo  $rec_alterar->motivo();?>">
		<input type="hidden" name="igreja" id="igreja" value="<?php echo  $rec_alterar->igreja();?>">
		<input type="hidden" name="fonte" id="fonte" value="<?php echo  $rec_alterar->fonte();?>">
		<?php 
			switch ($rec_alterar->tipo()) {
				case 3:
				list($nome,$cpf,$rg)=explode( ",",$rec_alterar->recebeu());
				$cpf = trim( $cpf, 'CPF: ');
				$rg = ltrim( $rg, 'RG: ' );
				echo '<input type="hidden" name="nome" id="nome" value="'.$nome.'">';
				echo '<input type="hidden" name="cpf" id="cpf" value="'.$cpf.'">';
				echo '<input type="hidden" name="rg" id="" value="'.$rg.'">';
				echo '<input type="hidden" name="rec" id="rec" value="3">';
				break;
				case 2:
				echo '<input type="hidden" name="recebeu" id="recebeu" value="'.$rec_alterar->recebeu().'">';
				break;
				
				default:
				echo '<input type="hidden" name="nome" id="nome" value="'.$recebeu.'">';
				echo '<input type="hidden" name="rol" id="rol" value="'.$rec_alterar->recebeu().'">';
				break;
			}
			echo '<input type="hidden" name="escolha" id="escolha" value="tesouraria/recibo.php">';
			echo '<input type="hidden" name="menu" id="menu" value="top_tesouraria">';
		?>
		<input type="hidden" name="rec" id="rec" value="<?php echo $rec_alterar->tipo();?>">
		<input type="submit" value = "Editar como novo...">
	</form>
</td>

<?php 
} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
?>
