
<a <?PHP $b=link_ativo($_GET["age"], "1");?>
	href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=1">
	<button type="button" class="btn btn-alerta btn-sm <?php echo $b;?>">Adiant. p/ Compras</button>
</a>
<a <?PHP $b=link_ativo($_GET["age"], "2");?>
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=2">
			<button type="button" class="btn btn-alerta btn-sm <?php echo $b;?>">Prestar Contas</button>
</a>
<a <?PHP $b=link_ativo($_GET["age"], "3");?>
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=3">
			<button type="button" class="btn btn-alerta btn-sm <?php echo $b;?>">
			Agendar Despesa</button>
</a>
<a <?PHP $b=link_ativo($_GET["age"], "7");?>
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=7">
			<button type="button" class="btn btn-alerta btn-sm <?php echo $b;?>">Folha</button>
</a>
<a <?PHP $b=link_ativo($_GET["age"], "9");?>
            href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=9">
            <button type="button" class="btn btn-alerta btn-sm <?php echo $b;?>">Demonstrativo</button>
</a>
