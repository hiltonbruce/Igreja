
<div>
<?php
$altEdit = ($_SESSION["setor"]=='3' || $_SESSION["setor"]=='99') ? true:false;
if ($membro) {
?>
<a <?PHP $b=id_corrente ("_pessoais"); ?> href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Pessoais</button>
</a>
<a <?PHP $b=id_corrente ("_ecles");?> href="./?escolha=adm/dados_ecles.php&uf_end=PB&campo=cidade&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Eclesi&aacute;stico</button>
</a>
<a <?PHP $b=id_corrente ("_profis"); ?> href="./?escolha=adm/dados_profis.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Profissional</button>
</a>
<a <?PHP $b=id_corrente ("_famil");?> href="./?escolha=adm/dados_famil.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Familiar</button>
</a></li>
<a <?PHP $b=id_corrente ("_cartas");?> href="./?escolha=adm/dados_cartas.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Cartas</button>
</a>
<a <?PHP $b=id_corrente ("cartao");?> href="./?escolha=adm/cartao.php&bsc_rol=<?php echo $bsc_rol;?>">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Cart&atilde;o</button>
</a>
		<?php
				if ($_SESSION["setor"]=='3' || $_SESSION["setor"]=='2' || $_SESSION["nivel"]>'10') {
			?><!-- Verifica se é tesouraria -->
		<a <?PHP $b=id_corrente ("disciplina");?> href="./?escolha=adm/dados_disciplina.php&bsc_rol=<?php echo $bsc_rol;?>">
			<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Registros</button>
		</a>
		<?php
		}
		if ($_SESSION["setor"]=='2' || $_SESSION["nivel"]>'10') {
	?><!-- Verifica se é tesouraria -->
		<a <?PHP $b=id_corrente ("saldoMembros");?>
		href="./?escolha=views/tesouraria/saldoMembros.php&bsc_rol=<?php
		echo $bsc_rol;?>&ano=<?php echo $_GET['ano'];?>">
		<button type="button" class="btn btn-info btn-sm <?php
		echo $b;?>">Financeiro</button></a>
  <?php
	 }
		echo '<p><strong>'.$membro->nome().'</strong> - ';
		$ecles = new DBRecord ('eclesiastico',$bsc_rol,"rol");
		$igreja = new DBRecord ('igreja',$ecles->congregacao,'rol');
		echo 'Cargo: '.cargo($bsc_rol)['0'].' - Congrega: '.$igreja->razao();
		echo ', '.situacao($ecles->situacao_espiritual(),$bsc_rol).'</p>';
	}
?>
</div>
