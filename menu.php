
<?php
	/*	Define se este bot�o ou limk � o corrente e o define para tal com mudan�a
	*	da cor de fundo. Isto deve ser definido no script de CSS
	*/
	if (!empty($_SESSION["valid_user"])) {
			$hom = "<a href='./?escolha=adm/cadastro_membro.php&uf=PB'>Cadastro</a>";
		}
	$hom = (empty($hom)) ? '' : $hom ;
	$admin = array ('forms/manutencao.php','forms/editar_igreja.php','tab_auxiliar/cadastro_bairro.php',
				'tab_auxiliar/cadastro_igreja.php','tab_auxiliar/altexclui_igreja.php',
				'tab_auxiliar/cad_usuario.php','patrimonio');

	$link_admin ="<li><span class='hlavny_'><a href='./?escolha=forms/manutencao.php'>Administra&ccedil;&atilde;o</a></span></li>";
	$link_tesour="<li><span class='hlavny_'><a href='./?escolha=tesouraria/agenda.php&menu=top_tesouraria'>Financeiro
	</a></span></li>";

	$link_missoes = "<li><span class='hlavny_'><a href='./?escolha=controller/missoes.php";
	$link_missoes .="&menu=top_missoes'>Miss&otilde;es</a></span></li>";

	$linkPat  = "<li><span class='hlavny_'><a href='./?escolha=controller/patrimonio.php";
	$linkPat .="&menu=top_Pat'>Patrim&ocirc;nio</a></span></li>";


	$link_home = "<li><span class='left'></span><span class='hlavny'><br /><strong class='text-primary'>Cadastro</strong></span><span class='right'></span></li>";
	$link_suporte ="<li><span class='hlavny_'><a href='./?escolha=noticias/suporte.php'>Suporte</a></span></li>";

	if ($escGET=="noticias/suporte.php"){
	$link_suporte ="<li><span class='left'></span><span class='hlavny'><br />";
	$link_suporte .="<strong class='text-primary'>Suporte</strong></span><span class='right'></span></li>";
	$link_home = "<li><span class='hlavny_'>$hom</span></li>";}

	if ((strstr($menuGET,"tesouraria")) || (strstr($escPOST,"tesouraria"))){
		$link_tesour ="<li><span class='left'></span><span class='hlavny'><br />";
		$link_tesour .="<strong class='text-primary'>Financeiro</strong></span><span class='right'></span></li>";
		$link_home = "<li><span class='hlavny_'>$hom</span></li>";}

	if ((strstr($menuGET,"missoes")) || (strstr($escPOST,"missoes"))){
		$link_missoes  ="<li><span class='left'></span><span class='hlavny' ";
		$link_missoes .="><br /><strong class='text-primary'>Miss&otilde;es</strong></span><span class='right'></span></li>";
		$link_home = "<li><span class='hlavny_'>$hom</span></li>";}

	if ($escGET=="controller/patrimonio.php"){
		$linkPat  = "<li><span class='left'></span><span class='hlavny'>";
		$linkPat .="<br /><strong class='text-primary'>Patrim&ocirc;nio</strong></span><span class='right'></span></li>";
		$link_home = "<li><span class='hlavny_'>$hom</span></li>";
	}

	if ($escGET=="forms/manutencao.php"){
			$link_admin  = "<li><span class='left'></span><span class='hlavny'>";
			$link_admin .= "<br /><strong class='text-primary'>Administra&ccedil;&atilde;o";
			$link_admin .= "</strong></span><span class='right'></span></li>";
			$link_home = "<li><span class='hlavny_'>$hom</span></li>";
	}
/*
	if ((strstr($escGET, $val_link) || strstr($escPOST,$val_link))) {
		echo "class='selected' style='border-top:0;'";
		//return "teste";
	}
	*/
?>
	<?php
	if (isset($_SESSION['valid_user']))	{
	?>
	<div class="logo"></div>
	<div id="menu">
	<div class="menu">
	<ul>
	<?php
		echo $link_home;
	?>
	<li><img src="img/divider2.png" alt="" /></li>
	<?php
		if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50) {
			echo $link_tesour.'<li><img src="img/divider2.png" alt="" /></li>';
			}
		if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50) {
			echo $link_missoes.'<li><img src="img/divider2.png" alt="" /></li>';
			}
		echo $link_admin;?>
		<li><img src="img/divider2.png" alt="" /></li>
		<?php
		echo $linkPat.'<li><img src="img/divider2.png" alt="" /></li>';
		echo $link_suporte;
		?>
</ul>
</div>
</div>
	<?php } ?>
