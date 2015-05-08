<?php
if (!empty($_GET["bsc_rol"])) {
?>
<div>
<a <?PHP $b=id_corrente ("_pessoais"); ?> href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Pessoais</button>
</a>
<a <?PHP $b=id_corrente ("_ecles");?> href="./?escolha=adm/dados_ecles.php&uf_end=PB&campo=cidade&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Eclesi&aacute;stico</button>
</a>
<a <?PHP $b=id_corrente ("_profis"); ?> href="./?escolha=adm/dados_profis.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Profissional</button>
</a>
<a <?PHP $b=id_corrente ("_famil");?> href="./?escolha=adm/dados_famil.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Familiar</button>
</a></li>
<a <?PHP $b=id_corrente ("_cartas");?> href="./?escolha=adm/dados_cartas.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Cartas</button>
</a>
<a <?PHP $b=id_corrente ("cartao");?> href="./?escolha=adm/cartao.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Cart&atilde;o</button>
</a>
<a <?PHP $b=id_corrente ("disciplina");?> href="./?escolha=adm/dados_disciplina.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Registros</button>
</a>
	<?php
		if ($_SESSION["setor"]=='2' || $_SESSION["nivel"]>'10') {
	?><!-- Verifica se é tesouraria -->
		<a <?PHP $b=id_corrente ("saldoMembros");?>
				href="./?escolha=views/tesouraria/saldoMembros.php&bsc_rol=<?php echo $bsc_rol;?>&ano=<?php echo $_GET['ano'];?>">
				<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Financeiro</button>
</a>
</div>
    <?php }

	if (!(strstr($_GET["escolha"], 'dados_pessoais.php') || strstr($_GET['escolha'], 'cartao.php')) && isset($_SESSION['membro']))
		{
			echo 'Dados atuais de: <b>'.$_SESSION['membro'].'</b> - ';
		}

		$ecles = new DBRecord ('eclesiastico',$bsc_rol,"rol");
		$igreja = new DBRecord ('igreja',$ecles->congregacao,'rol');
		echo 'Cargo: '.cargo($_GET["bsc_rol"]).' - Congrega: '.$igreja->razao().', '.situacao ($ecles->situacao_espiritual());
	}

?>


