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

<link rel="stylesheet" type="text/css" href="../tesouraria/style.css" />
<link rel="stylesheet" type="text/css" href="../css/print.css" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.print.css" />

</head>
<body>

	<?PHP
}else {
	$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
}

controle ("consulta");
$ordenar = new igreja ();
$arrayIg =$ordenar->Arrayigreja();
$opCargo = (!empty($_GET["cargo"])) ? intval($_GET["cargo"]) : 0 ;
// $query  = 'SELECT * from membro AS m, eclesiastico AS e WHERE m.rol=e.rol ';
// $query .= 'AND e.situacao_espiritual <= 2 '.$ordenar->cargo();
// $query .= ' ORDER BY '.$ordenar->ordenar();

require_once ('../models/sec/listMembro.php');

$sql3 = mysql_query ($query) or die (mysql_error());
$total = mysql_num_rows($sql3) ; //Retorna o total de linha na tabela

{
	?>
	<table class='table table-striped table-hover'>
		<caption>
			<h4>
			<?PHP
			echo $_GET['titTabela'];

			require_once ('../views/secretaria/titTabIgreja.php');

			?>
			</h4>
		</caption>
		<colgroup>
			<col id="Rol">
				<col id="Nome">
					<col id="Congrega&ccedil;&atilde;o">
						<col id="albumCol" />

		</colgroup>
		<thead>
			<tr>
				<th class='text-center'><h6>Rol</h6></th>
				<th class='text-center'><h6>Nome</h6></th>
				<?php
				if ($_GET['ext']==1) {
					?>
				<th class='text-center'><h6>Nascido em:</h6></th>
				<th class='text-center'><h6>Telefones</h6></th>
				<?php
				}else {

					?>
				<th class='text-center'><h6>Congrega&ccedil;&atilde;o</h6></th>
				<th class='text-center'><h6>Cargo</h6></th>
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

				if (!empty($_GET['foto'])) {
					$foto = '<img src='.foto($coluna["membroRol"]).' class="thumb" width="'.$tamW.'" height="'.$tamH.'" /> ';
				}else {
					$foto = '';
				}
				?>
				<tr>
					<td class='text-center'><h6><?php echo $coluna["membroRol"];?></h6></td>
				<?php
				if ($_GET['ext']=='1') {
					$bairro = new DBRecord( bairro, $coluna["bairro"], 'id');
					$cidade = new DBRecord(cidade, $coluna["cidade"], 'id');
					?>
				<td><?php
				echo $foto;
				echo $coluna["nome"];
				// $congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
				echo ' - Cong.: '.$coluna["razao"];
				echo ', '.cargo ($coluna["membroRol"])['0'];

				?><p>
				Endere&ccedil;o: <?php echo $coluna["endereco"].', N&ordm; '.
				$coluna["numero"].', Bairro: '.$bairro->bairro()
				.' - '.$cidade->nome().'-'.$cidade->coduf().
				', Complem.: '.$coluna["complemento"];?>
			</p>
				</td>
				<td class="text-center"><?php
				echo conv_valor_br($coluna["datanasc"]);
				?></td>
				<td><?php
				echo 'Fixo: '.$coluna["fone_resid"].', Cel.:'.$coluna["celular"];
				?>
				</td>
			</tr>
			<?PHP
				}else {
					?>
				<td>
					<?php
					echo $foto;
				 	echo $coluna["nome"];
					?>
				</td>
				<td><?php
				// $congregacao = new DBRecord ("igreja",$coluna["congregacao"],"rol");
				echo $coluna["razao"];
				?></td>
				<td><?php
				echo cargo ($coluna["membroRol"])['0'];
				?></td>
			</tr>
			<?PHP	}

			}//loop while produtos

			?>
		</tbody>
	</table>
	<?PHP
}
echo '<br /><h4 class="bg-primary">';

if ($total>"1"){
	printf("%s registros!",number_format($total, 0, ',', '.'));
}elseif ($total=='1') {
	print 'Apenas um registro!';
}else {
	print 'N&atilde;o h&aacute; registros para esta pesquisa!';
}
echo '</h4>';
if ($_GET['Submit']=='Imprimir') {
	?>
</body>
</html>
<?php }?>
