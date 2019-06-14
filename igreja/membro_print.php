<?PHP
$cont_lin=0;
if ($_GET["Submit"]=="Imprimir") {

	session_start();
	if (empty($_SESSION['valid_user'])) {
		exit;
	}
	require_once ("../func_class/funcoes.php");
	require_once ("../func_class/classes.php");
	date_default_timezone_set('America/Recife');
	function __autoload ($classe) {

		list($dir,$nomeClasse) = explode('_', $classe);
		//$dir = strtr( $classe, '_','/' );
		if (file_exists("../models/$dir/$classe.class.php")){
			require_once ("../models/$dir/$classe.class.php");
		}elseif (file_exists("../models/$classe.class.php")){
			require_once ("../models/$classe.class.php");
		}
	}
	$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Lista de Membros - Igreja: <?php echo $igreja->razao();?>
</title>
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
$opCargo = (!empty($_GET["cargo"])) ? intval($_GET["cargo"]) : 0 ;
$query  = 'SELECT * from membro AS m, eclesiastico AS e WHERE m.rol=e.rol ';
$query .= 'AND e.situacao_espiritual <= 2 '.$ordenar->cargo();
$query .= ' ORDER BY '.$ordenar->ordenar();

$sql3 = mysql_query ($query) or die (mysql_error());
$total = mysql_num_rows($sql3) ; //Retorna o total de linha na tabela

{
	?>
	<table>
		<caption>

			<?PHP
			echo $_GET['titTabela'];

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
				<th scope="col">Congrega&ccedil;&atilde;o</th>
				<th scope="col">Cargo</th>
				<?php
				}?>
			</tr>
		</thead>
		<tbody>
			<?PHP

			if (!empty($_GET['tamanho'])) {
				$tamW = intval($_GET ['tamanho']);
				$tamH = ($tamW/2)*3;
			}else {
				$tamW = 24;
				$tamH = 36;
			}

			while($coluna = mysql_fetch_array($sql3))
			{

				$ls++;
				if (!empty($_GET['foto'])) {
					$foto = '<img src='.foto($coluna["rol"]).' class="thumb" width="'.$tamW.'" height="'.$tamH.'" />';
				}else {
					$foto = '';
				}

				if ($ls>1){
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
				<td><?php
				echo $foto;
				echo $coluna["nome"];
				$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
				echo ' - Cong.: '.$congregacao->razao();
				echo ', '.cargo ($coluna["rol"])['0'];

				?>
				</td>
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
						', Complem.: '.$coluna["complemento"];?>
				</td>
			</tr>
			<?PHP
				}else {
					?>
			<tr <?php echo "$cor";?>>
				<td><?php echo $coluna["rol"];?></td>
				<td>
					<?php
					echo $foto;
				 	echo $coluna["nome"];
					?>
				</td>
				<td><?php
				$congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
				echo $congregacao->razao();
				?></td>
				<td><?php
				echo cargo ($coluna["rol"])['0'];
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
	printf("Com %s registros!",number_format($total, 0, ',', '.'));
}elseif ($total=="1") {
	print "Apenas um registro!";
}else {
	print "N&atilde;o h&aacute; registros para esta pesquisa!";
}

if ($_GET["Submit"]=="Imprimir") {
	?>
</body>
</html>
<?php }?>
