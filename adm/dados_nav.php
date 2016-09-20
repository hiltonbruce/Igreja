<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>


<?PHP
if ($_SESSION['nivel']>4){
$dad_cad = mysql_query ("SELECT * FROM membro WHERE rol='".$_SESSION["rol"]."'");
$arr_dad = mysql_fetch_array ($dad_cad);
?>
<div id="lst_cad">
	<?PHP
	if (!empty($_SESSION["rol"]))
	{
	?>
	<form enctype="multipart/form-data" method="post" action="adm/salvar_foto.php">
	  <input type="hidden" name="MAX_FILE_SIZE" value="200000">
	  Salvar foto no banco:
	  <input name="userfile" type="file" id="userfile" size="40">

	  <input type="submit" name="Submit" value="Enviar...">

	</form>

	<label><span style="padding-right:150px">Nome:</span></label>
	  <?PHP echo $arr_dad["nome"];?>

	  <label>Sexo:</label><p>

	  <?PHP
	  switch ($arr_dad["sexo"])
	  {
		case "M":
			echo "Masculino";break;
		case "F":
			echo "Femino";break;
		default:
			echo "O campo para sexo n&atilde;o foi preenchido. Por favor atualize.";
	  }
	  ?>
	</p>

	  <label><span style="padding-right:80px">Nacionalidade:</span>Naturalidade:</label><p>
		<?PHP echo $arr_dad["nacionalidade"]." *-* ".$arr_dad["naturalidade"];?>

	  UF:
	  <?PHP echo $arr_dad["uf_resid"];?></p>

	  <label>Nascimento:</label><p>
	  <?PHP echo $arr_dad["data_nasc"];?></p>

	  <label>Pai:</label>
	  <?PHP echo $arr_dad["pai"];?>
	  Rol:<p>
	  <?PHP echo $arr_dad["rol_pai"];?>
	  <a href="javascript:lancarSubmenu('campo=pai&amp;rol=rol_pai')"></a></p>

	  <label>M&atilde;e:</label>
	  <?PHP echo $arr_dad["mae"];?>
	  Rol:<p>
	  <?PHP echo $arr_dad["rol_mae"];?>
	  <a href="javascript:lancarSubmenu('campo=mae&amp;rol=rol_mae')"></a></p>

	  <label>Endere&ccedil;o:</label>
	  <?PHP echo $arr_dad["endereco"];?>
	  N&ordm;<p>
	  <?PHP echo $arr_dad["numero"];?>
	</p>

	  <label><span style="padding-right:75px">Complementos:</span>Bairro:</label><p>
	  <?PHP echo $arr_dad["complemento"];?>
	  <?PHP echo $arr_dad["bairro"];?>
	</p>

	  <label>Cidade:</label>
	<?PHP echo $arr_dad["cidade"];?>
	  UF:<p><?PHP echo $arr_dad["uf_resid"];?></p>

	  <label><span>CEP:</span><span style="padding-right:100px">Telefone:</span>Escolaridade:</label><p><?PHP echo $arr_dad["cep"];?>
		<?PHP echo $arr_dad["fone_resid"];?>
		<?PHP echo $arr_dad["escolaridade"];?>
	</p>

	  <label>Email:</label><p><?PHP echo $arr_dad["email"];?></p>

	<?PHP
	}}
	?>
</div>
</body>
</html>
