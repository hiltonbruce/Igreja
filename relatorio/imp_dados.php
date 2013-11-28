<?PHP
	session_start();
	if ($_GET["escolha"]=="adm/cadastro.php" || $_POST["escolha"]=="adm/cadastro.php")
	{
		unset($_SESSION['rol']);//se for cadastrar um novo membro a variável é limpa e define a legenda para o form listar dados do membro pelo rol
		$campo_rol="Insira o Rol:";
	}else{
		$campo_rol="Rol nº :"; //Quando a variável de sessão rol existir define 'Rol nº :' como legenda para o form listar dados do membro pelo rol
	}
	
	require_once ("../func_class/funcoes.php");
	require_once ("../func_class/classes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Assembleia de Deus - Bayeux - PB</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="../menu.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="../style.css" />

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

		
		}else 
			{
				$perfil_usu="noticias/painel.php";
			}
		
		require_once "../adm/$perfil_usu";
		
		?>

</body>
</html>
