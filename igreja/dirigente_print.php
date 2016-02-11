<?PHP
if ($_GET["Submit"]=="Imprimir") {

	session_start();
	require_once ("../func_class/funcoes.php");
	require_once ("../func_class/classes.php");
	require_once ("classes.php");
	?>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="../aniv/style.css" />
	<?PHP
}else { ?>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
<?PHP
}

controle ("consulta");
$query = "SELECT * from igreja ORDER BY razao";

		$sql3 = mysql_query ($query) or die (mysql_error());
		$total = mysql_num_rows($sql3);

		 //inicia o cabeçalho de paginação

		{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tables</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<style type="text/css">
<!--

body {
  font: 75%/1.6 "Myriad Pro", Frutiger, "Lucida Grande", "Lucida Sans", "Lucida Sans Unicode", Verdana, sans-serif;
}

.clear {
  clear: both;
}

table {
  border-collapse: collapse;
  width: 50em;
  border: 1px solid #666;
}

caption {
  font-size: 1.2em;
  font-weight: bold;
  margin: 1em 0;
}

col {
  border-right: 1px solid #ccc;
}

col#albumCol {
  border: none;
}

thead {
  background: #ccc url(images/bar.gif) repeat-x left center;
  border-top: 1px solid #a5a5a5;
  border-bottom: 1px solid #a5a5a5;
}

th {
  font-weight: normal;
  text-align: left;
}

#playlistPosHead {
  text-indent: -1000em;
}

th, td {
  padding: 0.1em 1em;
}

.odd {
  background-color:#edf5ff;
}

tr:hover {
  background-color:#3d80df;
  color: #fff;
}

thead tr:hover {
  background-color: transparent;
  color: inherit;
}


-->
</style>
</head>
		<table style ="width:95%;cellspacing:1; border= 1px;" >

		<caption>Lista de Dirigentes - <?PHP  print data_extenso (conv_valor_br(date("Y-m-d")));?>
      </caption>

			<colgroup>
				<col id="Rol">
				<col id="Nome">
				<col id="Dirigente Atual">
				<col id="Novo Dirigente">
				<col id="albumCol"/>
			</colgroup>

			<thead>
				<tr>
				<th scope="col">Rol</th>
				<th scope="col">Dire&ccedil;&atilde;o - Atual</th>
				<th scope="col">Congre&ccedil;&atilde;o</th>
				<th width="200">Nova dire&ccedil;&atilde;o</th>
				<th scope="col">Cargo</th>
				</tr>
			</thead>
			<tbody>
		<?PHP

			while($coluna = mysql_fetch_array($sql3))
			{

			$ls+=1;
			if ($ls>1)
					{
					$cor="class='odd'";
					$ls=0;
					}
					else
					{$cor="class='od2'";
					}
			?>
            <tr "<?php echo "$cor";?>">

				<td><?php echo (int)$coluna["pastor"];?></td>

				<td><?php
					$rol_dirigente = (int) $coluna["pastor"];
					if ($rol_dirigente>0){
						$nome = new DBRecord ("membro",$coluna["pastor"],"rol");
						$nome_dirigente = $nome->nome();}
					else{
						$nome_dirigente = $coluna["pastor"];}

				 echo $nome_dirigente;?>
				 </td>
				<td><?php echo $coluna["razao"];?></td>
				<td></td>
				<td><?php
                    if (intval($coluna["pastor"])=='0') {
                        $funIgreja = '-o-';
                    } else {
                        $funIgreja = cargo ($coluna["pastor"])['0'];
                    }

                 echo $funIgreja;
                ?></td>

			<?PHP

			}//loop while produtos

	?>
		</tbody>
		</table>

	<?PHP
	}


	if ($total>"1")
	{
		if ($total>"100")
			printf("Com %s dirigentes!",number_format($total, 0, ',', '.'));
		else
			printf("Com %s dirigentes!",number_format($total, 0, ',', '.'));

	}elseif ($total=="1"){
		echo "Com apenas um dirigente!";
	}else{
		echo "N&atilde;o obtivemos nenhum resultado!";
	}
?>
</body>
</html>
