<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="../menu.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="../style.css" />
<title>Untitled Document</title>
</head>
<body>
<?PHP
		//echo $_SESSION["nivel"]." - Nível - escolha ".$_GET["escolha"];
		if (($_SESSION["nivel"]>4))
		{
					//echo $_get["escolha"]."<h3> config_nupat </h3>";
			if (!empty($_POST["escolha"])){
			 
				$perfil_usu = $_POST["escolha"];
			
			}elseif (!empty($_GET["escolha"])){
					
				$perfil_usu = $_GET["escolha"];
			
			}else{
			
				$perfil_usu="noticias/painel.php";
			
			}

		?>
		<table border="0">
  <tr>
    <td>
		<div id="tabs">
		  <ul>
			<li><a <?PHP if ($_GET['escolha']=="adm/dados_pessoais.php") {?>id="current" <?PHP } ?> href="./?escolha=adm/dados_pessoais.php"><span>Dados Pessoais</span></a></li>
			<li><a <?PHP if ($_GET['escolha']=="adm/dados_ecles.php") {?>id="current"<?PHP } ?> href="./?escolha=adm/dados_ecles.php"><span>Eclesi&aacute;stico</span></a></li>
			<li><a <?PHP if ($_GET['escolha']=="adm/dados_profis.php") {?>id="current"<?PHP } ?> href="./?escolha=adm/dados_profis.php"><span>Profissional</span></a></li>
			<li><a <?PHP if ($_GET['escolha']=="adm/dados_famil.php") {?>id="current"<?PHP } ?> href="./?escolha=adm/dados_famil.php"><span>Familiar</span></a></li>
			<li><a <?PHP if ($_GET['escolha']=="adm/dados_cartas.php") {?>id="current"<?PHP } ?> href="./?escolha=adm/dados_cartas.php"><span>Cartas</span></a></li>
		  </ul>
		 </div>	</td>
    <td>
		<form action="" method="post">
		  <label>Procurar...
			<input type="image" src="img/lupa_32x32.png" height="16" width="16" name="Submit2" value="submit" alt="procurar" title="Click aqui para pesquisar Membro!" style="background:none"/>
			<input name="pesquisar" type="text" id="pesquisar" />
		  </label>
	  </form>	</td>
  </tr>
</table>

		
	<h1>
	<form id="form1" name="form1" method="get" action="">
	  <?PHP
	  if (!empty($_GET["bsc_rol"]))
		{
			$_SESSION["rol"]=(int)$_GET["bsc_rol"];
		}
		
	  echo "$campo_rol ".$_SESSION["rol"];
	  $anterior=$_SESSION["rol"]-1;
	  $proximo=$_SESSION["rol"]+1;
	  if ($anterior<=0)
	  {
	  $anterior=0;
	  }
	  
	  ?>
	  <input name="bsc_rol" class="btn btn-default btn-sm" type="text" id="bsc_rol" title="Insira o n&ordm; do Rol"/>
	  <input name="escolha" type="hidden" id="escolha" value="adm/dados_pessoais.php" />
	  <input type="submit" name="Submit2" value="Listar..." title="Click aqui para listar os dados do Membro"/>
	  <a href="./?escolha=adm/dados_pessoais.php&amp;bsc_rol=<?PHP echo $anterior;?>"><img src="img/1910_32x32.png" alt="Anterior Anterior" width="22" height="22" title="Registro Anterior" align="absmiddle" border="0" /></a> 
	  <a href="./?escolha=adm/dados_pessoais.php&amp;bsc_rol=<?PHP echo $proximo;?>"><img src="img/1967_32x32.png" width="22" height="22" title="Pr&oacute;ximo Registro" alt="Pr&oacute;ximo Registro" align="absmiddle" border="0"/></a>
	</form>
	</h1>
		<?PHP
		
		}else 
			{
				$perfil_usu="noticias/painel.php";
			}
		
		require_once "$perfil_usu";		
		
		?>
</body>
</html>
