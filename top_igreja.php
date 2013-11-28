<?PHP
	controle ("consulta");
	//unset($_SESSION["rol"]);
	require_once ("./igreja/classes.php");
	$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
?>
<div id="tabs">
		  <ul>
			<li><a <?PHP id_corrente ("_membro");?> href="./?escolha=igreja/list_membro.php&menu=top_igreja"><span>Membros</span></a></li>
			<li><a <?PHP id_corrente ("_ecles");?> href="./?escolha=igreja/list_membro.php&menu=top_igreja"><span>Dirigentes</span></a></li>
			<li><a <?PHP id_corrente ("_estrutura");?> href="./?escolha=igreja/cad_organica.php&menu=top_igreja"><span>Estrutura</span></a></li>
			<li><a <?PHP id_corrente ("_famil");?> href="./?escolha=igreja/cad_organica.php&menu=top_igreja"><span>Hor&aacute;rios</span></a></li>
			<li><a <?PHP id_corrente ("_cargos");?> href="./?escolha=igreja/cad_cargos.php&menu=top_igreja"><span>Cargos</span></a></li>
			<li><a <?PHP id_corrente ("_orgao");?> href="./?escolha=igreja/cad_orgaos.php&menu=top_igreja"><span>Org&auml;os</span></a></li>
		  </ul>
</div>
<table style ="width:auto;">
<thead>
  <tr>

	<?PHP
	if (!ver_nome("cad_organica")) {
	?>
	<form id="form2" name="form2" method="post" action="" >
	
	<td width="466">
	 <?PHP
	  if (empty($_GET["id"]))
		{
			$id_ig=1;
		}else{
			$id_ig=$_GET["id"];
		}
	
	//valor recebido do script index.php
	  $anterior=$id_ig-1;
	  $proximo=$id_ig+1;
	  if ($anterior<=0)
	  {
	  	$anterior=0;
	  }
	  
	  $link = "./?escolha={$_GET["escolha"]}&menu=top_igreja&ord={$_GET["ord"]}&cargo=";
	  $link_foto = "./?escolha=igreja/lst_memfoto.php&menu=top_igreja&ord={$_GET["ord"]}&id={$_GET["id"]}&cargo={$_GET["cargo"]}&foto=";
	  
	  ?>Escolha a Congrega&ccedil;&atilde;o:
	  <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
			<?PHP
				$congr = new List_sele ("igreja","razao","congregacao");
				$congr->List_Selec_pop ("escolha={$_GET["escolha"]}&menu={$_GET["menu"]}&foto={$_GET["foto"]}&ord={$_GET["ord"]}&cargo={$_GET["cargo"]}&id=",$_GET['id']);
			?>
	  </select>
	  </td>
	  <td>
	  <?php 
	  switch ($_GET['cargo']) {
	  	case 1:
	  	$linhaCargo = '<option value="<?PHP echo $link;?>1">Auxiliar de Trabalho</option>';
	  	break;
	  	case 2:
	  	$linhaCargo = '<option value="<?PHP echo $link;?>2">Di&aacute;cono</option>';
	  	break;
	  	case 3:
	  	$linhaCargo = '<option value="<?PHP echo $link;?>3">Presb&iacute;tero</option>';
	  	break;
	  	case 4:
	  	$linhaCargo = '<option value="<?PHP echo $link;?>4">Evangelista</option>';
	  	break;
	  	case 5:
	  	$linhaCargo = '<option value="<?PHP echo $link;?>5">Pastor</option>';
	  	break;
	  	case 6:
	  	$linhaCargo = '<option value="<?PHP echo $link;?>6">Dirigente de Congrega&ccedil;&atilde;o</option>';
	  	break;
	  	default:
	  		$linhaCargo = '';
	  	break;
	  }
	  ?>
	  <select name="cargo" onchange="MM_jumpMenu('parent',this,0)">
	  <?php echo $linhaCargo;?>
	    <option>--&gt;&gt;Lista por cargo&lt;&lt;-- </option>
	    <option value="<?PHP echo $link;?>0">--&gt;&gt;Listar todos&lt;&lt;--</option>
		<option value="<?PHP echo $link;?>1">Auxiliar de Trabalho</option>
		<option value="<?PHP echo $link;?>2">Di&aacute;cono</option>
		<option value="<?PHP echo $link;?>3">Presb&iacute;tero</option>
		<option value="<?PHP echo $link;?>4">Evangelista</option>
		<option value="<?PHP echo $link;?>5">Pastor</option>
		<option value="<?PHP echo $link;?>6">Dirigente de Congrega&ccedil;&atilde;o</option>
	  </select>
	  </td>
	  </tr>
	  <tr>
	  <td>
	 <select name="foto" onchange="MM_jumpMenu('parent',this,0)">
	    <option>--&gt;&gt;Listar com ou sem foto&lt;&lt;-- </option>
	    <option value="./?escolha=igreja/list_membro.php&menu=top_igreja&ord=<?php echo $_GET["ord"];?>&cargo=<?php echo $_GET["cargo"];?>">--&gt;&gt;Listar todos&lt;&lt;--</option>
		<option value="<?PHP echo $link_foto;?>1">Listar com fotos</option>
		<option value="<?PHP echo $link_foto;?>2">Listar sem fotos</option>
	  </select>
	  
    </form>
    </td>
    <td width="105">
    <?php if ($_GET["foto"]==1 || $_GET["foto"]==2) {?>
	<form id="form1" name="form1" method="get" action="igreja/lst_fotoprint.php">
      <input name="id" type="hidden" value="<?PHP echo $_GET["id"];?>" />
      <input name="ord" type="hidden" value="<?PHP echo $_GET["ord"];?>" />
      <input type="hidden" name="cargo" value="<?PHP echo $_GET["cargo"];?>" />
      <input name="foto" type="hidden" value="<?PHP echo $_GET["foto"];?>" />
      <input type="submit" name="Submit" value="Imprimir" />
    </form>
    
    <?php }
    elseif ($_GET["cargo"]>"5"){?>
	<form id="form1" name="form1" method="get" action="igreja/dirigente_print.php">
      <input type="submit" name="Submit" value="Imprimir" />
      Impressão extendida:<input type="radio" name="ext" value="1" />Sim
      <input type="radio" name="ext" value="0" checked="checked" />Não
    </form>
    <?php }
    else{ ?>    
	<form id="form1" name="form1" method="get" action="igreja/membro_print.php">
      <input name="id" type="hidden" value="<?PHP echo $_GET["id"];?>" />
      <input name="ord" type="hidden" value="<?PHP echo $_GET["ord"];?>" />
      <input type="hidden" name="cargo" value="<?PHP echo $_GET["cargo"];?>" />
      <input type="submit" name="Submit" value="Imprimir" /><br />
      Impressão extendida:<input type="radio" name="ext" value="1" />Sim
      <input type="radio" name="ext" value="0" checked="checked" />Não
    </form>
    <?php }?>
	</td>
  </tr></thead><?php } ?>
</table>
