<?PHP
if ($_GET["Submit"]=="Imprimir") {

	session_start();
	require_once ("../func_class/funcoes.php");
	require_once ("../func_class/classes.php");
	require_once ("classes.php");
	?>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.print.css" />;
	<?PHP
}else { ?>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.print.css" />;
<?PHP
}

controle ("consulta");
$query = "SELECT * from igreja WHERE status='1' ORDER BY razao";

		$sql3 = mysql_query ($query) or die (mysql_error());
		$total = mysql_num_rows($sql3);

		 //inicia o cabeçalho de paginação

		{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dirigentes de Congregações</title>
</head>
	<table class='table table-striped table-bordered' >
		<caption>Lista de Dirigentes - <?PHP  print data_extenso (conv_valor_br(date("Y-m-d")));?>
      	</caption>
			<colgroup>
				<col id="Rol">
				<col id="Nome">
				<col id="Dirigente Atual">
				<col id="1 Dirigente">
				<col id="2 Dirigente">
				<col id="albumCol"/>
			</colgroup>
			<thead class='navbar-inverse' style='color:#FFF;'>
				<tr>
				<th scope="col">Rol</th>
				<th scope="col">Dire&ccedil;&atilde;o - Atual</th>
				<th scope="col">Congre&ccedil;&atilde;o</th>
				<th scope="col" width='20%'>1&ordm; Dirigente (Atualizar)</th>
				<th scope="col" width='20%'>2&ordm; Dirigente (Atualizar)</th>
				<th scope="col">Cargo</th>
				</tr>
			</thead>
			<tbody>
		<?PHP
			while($coluna = mysql_fetch_array($sql3))
			{

			?>
            <tr>
				<td><?php printf("%'05u",intval($coluna["pastor"]));?></td>
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
				<td></td>
				<td><?php
                    if (intval($coluna["pastor"])=='0') {
                        $funIgreja = '-o-';
                    } else {
                        $funIgreja = cargo ($coluna["pastor"]);
                    }

                 echo $funIgreja;
                ?></td>

			<?PHP

			}//loop while produtos

	?>
		</tbody>
		</table>
		<h4>
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
</h4>
</body>
</html>
