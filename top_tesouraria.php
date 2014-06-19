<?php 
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
?>
<div id="tabs">
	<ul>
	  <li><a <?PHP id_corrente ("receita");?> href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=1"><span>Contabilidade</span></a></li>
	  <li><a <?PHP id_corrente ("despesa");?> href="./?escolha=tesouraria/despesa.php&menu=top_tesouraria&rec=1"><span>Despesas</span></a></li>
	  <li><a <?PHP id_corrente ("recibo");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=1"><span>Recibos</span></a></li>
	  <li><a <?PHP id_corrente ("prestacao");?> href="./?escolha=tesouraria/prestacao.php&menu=top_tesouraria"><span>Presta&ccedil;&atilde;o de Contas</span></a></li>
	  <li><a <?PHP id_corrente ("adiant");?> href="./?escolha=controller/limpeza.php&menu=top_tesouraria"><span>Mat. de Limpeza</span></a></li>
	  <li><a <?PHP id_corrente ("agenda");?> href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria"><span>Agenda</span></a></li>
	  <li><a <?PHP id_corrente ("envelope");?> href="./?escolha=tesouraria/envelope.php&menu=top_tesouraria"><span>Envelope</span></a></li>
	</ul>
</div>
<?php
}
?>