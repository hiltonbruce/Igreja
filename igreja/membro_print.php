<?PHP

$cont_lin=0;
if ($_GET["Submit"]=="Imprimir") {

	session_start();
	require_once ("../func_class/funcoes.php");
	require_once ("../func_class/classes.php");
	require_once ("classes.php");
	$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Lista de Membros - Igreja: <?php echo $igreja->razao();?></title>
<link rel="stylesheet" type="text/css" media="print, screen"
	href="tabs.css" />
</head>
<body>


<?PHP
}else {
	$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
}

controle ("consulta");
$ordenar = new igreja ();

$query = "SELECT * from membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND e.situacao_espiritual<2 ".$ordenar->cargo()." ORDER BY ".$ordenar->ordenar();

$sql3 = mysql_query ($query) or die (mysql_error());
$total = mysql_num_rows($sql3) ; //Retorna o total de linha na tabela

{
	?>
	<table>
		<caption>
			Lista de Membros
			<?PHP

			if ($_GET["id"]!=="" && $_GET["id"]!=="0" && $igreja->razao()!==""){
				echo " - Igreja: {$igreja->razao()}";
			}

			?>
		</caption>

		<colgroup>
			<col id="Rol">
			<col id="Nome">
			<col id="Congrega&ccedil;&atilde;o">
			<col id="albumCol" />
		</colgroup>

		<thead>
			<tr>
				<th scope="col">Rol</th>
				<th scope="col">Nome</th>
				<?php 
				if ($_GET['ext']==1) {
				?>
				<th scope="col">Nascido em:</th>
				<th scope="col">Telefones</th>
				<?php 
				}else {
					
				?>
				<th scope="col">Congregação</th>
				<th scope="col">Cargo</th>
				<?php 
				}?>
			</tr>
		</thead>
		<tbody>
		<?PHP
			
		while($coluna = mysql_fetch_array($sql3))
		{

			$ls++;
			
			if ($ls>1)
			{
				$cor="class='dados'";
				$ls=0;
			}
			else
			{$cor="class='odd'";
			}
			
			if ($_GET['ext']=='1') {
				$bairro = new DBRecord( bairro, $coluna["bairro"], 'id');
				$cidade = new DBRecord(cidade, $coluna["cidade"], 'id');
			?>
			<tr <?php echo "$cor";?>>
				<td rowspan="2"><?php echo $coluna["rol"];?></td>
				<td><?php echo $coluna["nome"];
					$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
					echo ' - Cong.: '.$congregacao->razao();
					echo ', '.cargo ($coluna["rol"]);
				
				?></td>
				<td rowspan="2" style="text-align: center;"><?php
				echo conv_valor_br($coluna["datanasc"]);
				?></td>
				<td rowspan="2"><?php
				echo 'Fixo: '.$coluna["fone_resid"].', Cel.:'.$coluna["celular"];
				?></td>
			</tr>
			<tr <?php echo "$cor";?>>
				<td>Endereço: <?php echo $coluna["endereco"].', Nº '.
				$coluna["numero"].', Bairro: '.$bairro->bairro()
				.' - '.$cidade->nome().'-'.$cidade->coduf().
				', Complem.: '.$coluna["complemento"];?></td>
			</tr>
			<?PHP
		}else {
		?>
			<tr <?php echo "$cor";?>>
				<td><?php echo $coluna["rol"];?></td>
				<td><?php echo $coluna["nome"];				
				?></td>
				<td><?php
				$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
				echo $congregacao->razao();
				?></td>
				<td><?php
				echo cargo ($coluna["rol"]);;
				?></td>
			</tr>
			<?PHP	}

		}//loop while produtos

		?>
		</tbody>
	</table>

	<?PHP
}
echo "<br />";

if ($total>"1"){
	printf("Com %s membros!",number_format($total, 0, ',', '.'));
}elseif ($total=="1") {
	print "Apenas um membro!";
}else {
	print "N&atilde;o h&aacute; membros para esta pesquisa!";
}

if ($_GET["Submit"]=="Imprimir") {
?>
</body>
</html>
<?php }?>