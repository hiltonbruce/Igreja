<?PHP session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista de Membros</title>
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

<body>

<?PHP
require_once ("../func_class/funcoes.php");
require_once ("../func_class/classes.php");
require_once ("classes.php");

controle ("consulta");
$ordenar = new igreja ();

if ($_GET["foto"]=='1')
	$com_sem = "com";
	elseif ($_GET["foto"]=='2')
	$com_sem = "sem";

$_urlLi="?escolha=igreja/list_membro.php&menu=top_igreja&ord={$_GET["ord"]}&cargo={$_GET["cargo"]}&id=".($_GET["id"]);//Montando o Link para ser passada a classe

$query = "SELECT * from membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND e.situacao_espiritual<2 ".$ordenar->cargo()." ORDER BY ".$ordenar->ordenar();
				
		//Faz os calculos na paginação
		$sql2 = mysql_query ($query) or die (mysql_error());
		
		$contador_array = array ();
		
		?>
		<table cellspacing="0" >
		<caption>
		Lista de Membros <?php echo $com_sem;?> Fotos
			<?PHP
			$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
			
			if ($_GET["id"]>0) {
				echo " - Igreja: {$igreja->razao()}";
			}
			
			?>
		</caption>
		
			<colgroup>
				<col id="Rol">
				<col id="Nome">
				<col id="Congrega&ccedil;&atilde;o">
				<col id="albumCol"/>
			</colgroup>
			
			<thead>
				<tr>
				<th scope="col">Rol</th>
				<th scope="col">Nome</th>
				<th scope="col">Congrega&ccedil;&atilde;o</th>
				<th scope="col">Cargo</th>
				</tr>
			</thead>
			<tbody>
		<?PHP
	/*echo '<pre>';
      print_r ($contador_array);
    echo '</pre>';
	*/




	while($coluna = mysql_fetch_array($sql2)){
		
			if (!(file_exists("../img_membros/".$coluna["rol"].".jpg")) AND $_GET["foto"]=='2'){
				array_push($contador_array, array("rol" => $col_array["rol"],"nome"=>$col_array["nome"],"congrecao"=>$col_array["congrecao"]));
		    	
		//$contador_array = count($coluna);	
			
			$ls++;
			$cont_lin ++;
			
			if  ($cont_lin==47) {
				echo "<tr><td colspan='3'>***</td></tr><tr><td colspan='3'>***</td></tr>";
			}
			
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
				<td><?php echo $coluna["rol"];?></td>
				<td><?php echo $coluna["nome"]; ?></td>
				<td>
					<?php
						$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
						echo $congregacao->razao();
					?>					
				</td>
				<td>
					<?php
						echo cargo ($coluna["rol"]);
					?>				
				</td>
			</tr>
			<?PHP
			}
			elseif (file_exists("../img_membros/".$coluna["rol"].".jpg") AND $_GET["foto"]=='1'){
			array_push($contador_array, array("rol" => $col_array["rol"],"nome"=>$col_array["nome"],"congrecao"=>$col_array["congrecao"]));
		    	
		//$contador_array = count($coluna);	
			
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
				<td><?php echo $coluna["rol"];?></td>
				<td><?php echo $coluna["nome"];?></td>
				<td>
					<?php
						$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
						echo $congregacao->razao();
					?>					
				</td>
				<td>
					<?php
						echo cargo ($coluna["rol"]);
					?>				
				</td>
			</tr>
			<?PHP				
			}//Fim if file_exists fotos
			}//loop while produtos
			
	?>	
		</tbody>
		</table>

	<?PHP
	
	$total = mysql_num_rows($sql2);
	$contador_ = count($contador_array);	
	
	if ($contador_>1)
		echo "<h3>Temos $contador_ membros $com_sem foto nesta congrega&ccedil;&atilde;o! Num total de $total.</h3>";
	elseif ($contador_==1)
		echo "<h3>Temos um membro $com_sem foto! Num total de $total.</h3>";
	elseif ($contador_==0)
		echo "<h3>N&atilde;o Temos nenhum membro $com_sem foto nesta congrega&ccedil;&atilde;o! Num total de $total.</h3>";
	?>

</body>
</html>
