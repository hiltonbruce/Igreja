<?PHP
	controle ("consulta");
	$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
	require_once ("./cetad/classes.php");
?>
<div id="tabs">
		  <ul>
			<li><a <?PHP id_corrente ("matricula");?> href="./?escolha=cetad/matricula.php&menu=top_cetad"><span>M&aacute;tricular</span></a></li>
			<li><a <?PHP id_corrente ("pgto");?> href="./?escolha=cetad/pgto.php&menu=top_cetad"><span>Lan&ccedil;ar Pagto</span></a></li>
			<li><a <?PHP id_corrente ("cad_curso");?> href="./?escolha=cetad/cad_curso.php&menu=top_cetad" title="Cadastrar Curso"><span>Cad. Curso</span></a></li>
			<li><a <?PHP id_corrente ("caixa");?> href="./?escolha=cetad/caixa.php&menu=top_cetad"><span>B&aacute;sico - S&aacute;bado</span></a></li>
			<!--

			<li><a <?PHP id_corrente ("_famil");?> href="#"><span>Hor&aacute;rios</span></a></li>
			-->
		  </ul>
</div>
