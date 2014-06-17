<?php
	/*	Define se este botão ou limk é o corrente e o define para tal com mudança
	*	da cor de fundo. Isto deve ser definido no script de CSS
	*/
	if (empty($_SESSION["valid_user"]))
			$hom = "<a href='./'>Home</a>";
		else
			$hom = "<a href='./?escolha=adm/cadastro_membro.php&uf=PB'>Cadastro</a>";
	
	$admin = array ("forms/manutencao.php","forms/editar_igreja.php","tab_auxiliar/cadastro_bairro.php","tab_auxiliar/cadastro_igreja.php","tab_auxiliar/altexclui_igreja.php","tab_auxiliar/cad_usuario.php");
	
	$link_admin ="<li><span class='hlavny_'><a href='./?escolha=forms/manutencao.php'>Administra&ccedil;&atilde;o</a></span></li>";
	$link_tesour="<li><span class='hlavny_'><a href='./?escolha=tesouraria/agenda.php&menu=top_tesouraria'>Financeiro
	</a></span></li>";
	$link_home = "<li><span class='left'></span><span class='hlavny'>$hom</span><span class='right'></span></li>";
	$link_suporte ="<li><span class='hlavny_'><a href='./?escolha=noticias/suporte.php'>Suporte</a></span></li>";
	
	if ($_GET["escolha"]=="noticias/suporte.php"){
	$link_suporte ="<li><span class='left'></span><span class='hlavny'><a href='./?escolha=noticias/suporte.php'>Suporte</a></span><span class='right'></span></li>";
				$link_home = "<li><span class='hlavny_'>$hom</span></li>";}
	
	if ((strstr($_GET["menu"],"tesouraria")) || (strstr($_POST["escolha"],"tesouraria"))){
		$link_tesour ="<li><span class='left'></span><span class='hlavny'><a href='./?escolha=tesouraria/agenda.php&menu=top_tesouraria'>Financeiro</a></span><span class='right'></span></li>";
		$link_home = "<li><span class='hlavny_'>$hom</span></li>";}
				
				
	foreach ($admin as $esc) {
		if (substr_count($_GET["escolha"], $esc)>0 || substr_count($_POST["escolha"], $esc)>0) {
				$link_admin = "<li><span class='left'></span><span class='hlavny'><a href='./?escolha=forms/manutencao.php'>Administra&ccedil;&atilde;o</a></span><span class='right'></span></li>";
				$link_home = "<li><span class='hlavny_'>$hom</span></li>";
				break;}				
	}
	
	if ((strstr($_GET["escolha"], $val_link) || strstr($_POST["escolha"],$val_link))) {
		echo "class='selected' style='border-top:0;'";
		//return "teste";
	}
?>

<div class="menu">
<ul>
	<?php echo $link_home;?>
	<li><img src="img/divider2.png" alt="" /></li>
	<?php
	if (isset($_SESSION['valid_user']))
	{
		if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50) {
			echo $link_tesour;?>
	<li><img src="img/divider2.png" alt="" /></li>
	<?php 
		}
	echo $link_admin;?>
	<li><img src="img/divider2.png" alt="" /></li>
	<?php 
	}
	echo $link_suporte;?>
</ul>
</div>