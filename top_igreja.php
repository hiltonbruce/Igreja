<?PHP
	controle ("consulta");
	//unset($_SESSION["rol"]);
	//require_once ("./igreja/classes.php");
	$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
?>
<div>
<a <?PHP $b=id_corrente ("_membro");?> href="./?escolha=igreja/list_membro.php&menu=top_igreja">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Membros</button>
</a>
<a <?PHP $b=link_ativo($_GET["cargo"], "6");?> href="./?escolha=igreja/list_membro.php&menu=top_igreja&cargo=6">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Dirigentes</button>
</a>
<a <?PHP $b=id_corrente ("_estrutura");?> href="./?escolha=igreja/cad_organica.php&menu=top_igreja">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Estrutura</button>
</a>
<a <?PHP $b=id_corrente ("_famil");?> href="./?escolha=igreja/cad_organica.php&menu=top_igreja">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Hor&aacute;rios</button>
</a>
<a <?PHP $b=id_corrente ("_cargos");?> href="./?escolha=igreja/cad_cargos.php&menu=top_igreja">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Cargos</button>
</a>
<a <?PHP $b=id_corrente ("_orgao");?> href="./?escolha=igreja/cad_orgaos.php&menu=top_igreja">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Org&auml;os</button>
</a>
</div>
<table class="table">
<tbody>
  <tr>

	<?PHP
	if (!ver_nome("cad_organica")) {
	?>
	<form id="form2" name="form2" method="post" action="" >

	<td>
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

	  $link = "./?escolha={$_GET["escolha"]}&menu=top_igreja&id={$_GET["id"]}&ord={$_GET["ord"]}&cargo=";
	  $link_foto = "./?escolha=igreja/lst_memfoto.php&menu=top_igreja&ord={$_GET["ord"]}&id={$_GET["id"]}&cargo={$_GET["cargo"]}&foto=";

	  ?><label>Escolha a Congrega&ccedil;&atilde;o:</label>
	  <select name="menu1" onchange="MM_jumpMenu('parent',this,0)"  class="form-control" >
			<?PHP
				$congr = new List_sele ("igreja","razao","congregacao");
				$congr->List_Selec_pop ("escolha={$_GET["escolha"]}&menu={$_GET["menu"]}&foto={$_GET["foto"]}&ord={$_GET["ord"]}&cargo={$_GET["cargo"]}&id=",$_GET['id']);
			?>
	  </select>
	  </td>
	  <td>
	  <?php
	  switch ($_GET['cargo']) {
	  	//Define a 1ª linha do proximo form
	  	case 1:
	  		$linhaCargo = '<option value="'.$link.'1">Auxiliar de Trabalho</option>';
	  		$titTabela = 'Auxiliares de Trabalho';
	  	break;
	  	case 2:
	  		$linhaCargo = '<option value="'.$link.'2">Di&aacute;cono</option>';
	  		$titTabela = 'Di&aacute;conos';
	  	break;
	  	case 3:
	  		$linhaCargo = '<option value="'.$link.'3">Presb&iacute;tero</option>';
	  		$titTabela = 'Presb&iacute;teros';
	  	break;
	  	case 4:
	  		$linhaCargo = '<option value="'.$link.'4">Evangelista</option>';
	  		$titTabela = 'Evangelistas';
	  	break;
	  	case 5:
	  		$linhaCargo = '<option value="'.$link.'5">Pastor</option>';
	  		$titTabela = 'Pastores';
	  	break;
	  	case 6:
	  		$linhaCargo = '<option value="'.$link.'6">Dirigente de Congrega&ccedil;&atilde;o</option>';
	  		$titTabela = 'Dirigentes de Congrega&ccedil;&atilde;o';
	  	break;
	  	default:
	  		$linhaCargo = '';
	  		$titTabela = 'Membros';
	  	break;
	  }
	  ?><label>Cargo</label>
	  <select name="cargo" onchange="MM_jumpMenu('parent',this,0)" class="form-control">
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
	  <?php
	  	//1ª Linha do form (filtro)
	  	switch ($_GET['foto']) {
	  		case '1':
	  		$linha1 = '<option value="'.$link.'1">Com fotos</option>';
	  		break;
	  		case '2':
	  		$linha1 = '<option value="'.$link.'2">Sem fotos</option>';
	  		break;

	  		default:
	  			$linha1 = '';
	  		break;
	  	}
	  ?>
	  <label>Membros com ou sem foto</label>
	 <select name="foto" onchange="MM_jumpMenu('parent',this,0)" class="form-control">
	 <?php echo $linha1;?>
	    <option value="./?escolha=igreja/list_membro.php&menu=top_igreja&ord=<?php echo $_GET["ord"].'&cargo='.$_GET["cargo"];?>">--&gt;&gt;Listar todos&lt;&lt;--</option>
		<option value="<?PHP echo $link_foto;?>1">Listar com fotos</option>
		<option value="<?PHP echo $link_foto;?>2">Listar sem fotos</option>
	  </select>

    </form>
    </td>
    <td>
    <?php if ($_GET["foto"]==1 || $_GET["foto"]==2) {?>
	<form id="form1" name="form1" method="get" action="igreja/lst_fotoprint.php">
      <input name="id" type="hidden" value="<?PHP echo $_GET["id"];?>" />
      <input name="ord" type="hidden" value="<?PHP echo $_GET["ord"];?>" />
      <input type="hidden" name="cargo" value="<?PHP echo $_GET["cargo"];?>" />
      <input name="foto" type="hidden" value="<?PHP echo $_GET["foto"];?>" />
      <input name="titTabela" type="hidden" value="<?PHP echo $titTabela;?>" />
      <label>&nbsp;</label>
      <input type="submit" class="btn btn-primary" name="Submit" value="Imprimir" />
    </form>

    <?php }
    elseif ($_GET["cargo"]>"5"){
    ?>
    <fieldset>
    <legend> Impressão com dados pessoais:</legend>
	<form id="form1" name="form1" method="get" action="igreja/dirigente_print.php" target="_blank">

	<div class="radio-inline">
	<label>
     <input type="radio" name="ext" value="1" />Sim </label>
    </div>
	<div class="radio-inline">
	<label>
      <input type="radio" name="ext" value="0" />Não </label>
     </div>
      <input type="submit" class="btn btn-primary" name="Submit" value="Imprimir" />
      <input name="titTabela" type="hidden" value="<?PHP echo $titTabela;?>" />
    </form></fieldset>
    <?php
    } else{
    ?>
	<form id="form1" name="form1" method="get" action="igreja/membro_print.php" target="_blank">
    <fieldset>
    <legend> Impressão com dados pessoais:</legend>
      <input name="id" type="hidden" value="<?PHP echo $_GET["id"];?>" />
      <input name="ord" type="hidden" value="<?PHP echo $_GET["ord"];?>" />
      <input type="hidden" name="cargo" value="<?PHP echo $_GET["cargo"];?>" />

	<div class="radio-inline">
	<label><input type="radio" name="ext" value="1" />Sim</label>
    </div>
	<div class="radio-inline">
	<label>
      <input type="radio" name="ext" value="0" />Não </label>
     </div>
      <input type="submit" class="btn btn-primary" name="Submit" value="Imprimir" />
      <input name="titTabela" type="hidden" value="<?PHP echo $titTabela;?>" />
    </form></fieldset>
    <?php
    }
    ?>
	</td>
  </tr></thead><?php } ?>
</table>
