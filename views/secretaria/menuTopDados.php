<div id="tabs">
  <ul>
	<li><a <?PHP id_corrente ("_pessoais"); ?> href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $bsc_rol;?>"><span>Pessoais</span></a></li>
	<li><a <?PHP id_corrente ("_ecles");?> href="./?escolha=adm/dados_ecles.php&uf_end=PB&campo=cidade&bsc_rol=<?php echo $bsc_rol;?>"><span>Eclesi&aacute;stico</span></a></li>
	<li><a <?PHP id_corrente ("_profis"); ?> href="./?escolha=adm/dados_profis.php&bsc_rol=<?php echo $bsc_rol;?>"><span>Profissional</span></a></li>
	<li><a <?PHP id_corrente ("_famil");?> href="./?escolha=adm/dados_famil.php&bsc_rol=<?php echo $bsc_rol;?>"><span>Familiar</span></a></li>
	<li><a <?PHP id_corrente ("_cartas");?> href="./?escolha=adm/dados_cartas.php&bsc_rol=<?php echo $bsc_rol;?>"><span>Cartas</span></a></li>
	<li><a <?PHP id_corrente ("cartao");?> href="./?escolha=adm/cartao.php&bsc_rol=<?php echo $bsc_rol;?>"><span>Cart&atilde;o</span></a></li>
	<li><a <?PHP id_corrente ("disciplina");?> href="./?escolha=adm/dados_disciplina.php&bsc_rol=<?php echo $bsc_rol;?>"><span>Registros</span></a></li>
	<?php if ($_SESSION["setor"]=='2' || $_SESSION["nivel"]>'10') { ?><!-- Verifica se é tesouraria -->
		<li><a <?PHP id_corrente ("saldoMembros");?> href="./?escolha=views/tesouraria/saldoMembros.php&bsc_rol=<?php echo $bsc_rol;?>"><span>Financeiro</span></a></li>
    <?php } ?>
  </ul>
</div>
<?php 
	if (!(strstr($_GET["escolha"], "dados_pessoais.php") || strstr($_GET["escolha"], "cartao.php")) && isset($_SESSION["membro"]))
		{
			echo 'Dados atuais de: <b>'.$_SESSION["membro"].'</b> - ';		
		}
			$ecles = new DBRecord ("eclesiastico",$bsc_rol,"rol");
			$igreja = new DBRecord ("igreja",$ecles->congregacao,"rol");
			echo "Cargo: ".cargo($_GET["bsc_rol"])." - Congrega: {$igreja->razao}";			
?>
		
		