<?php
if ($_SESSION["nivel"]>9){
	require_once 'forms/manutencao.php';
?>
<ul class="list-inline">
	<li>
	<a <?PHP $b = id_corrente('cad_usuario');?> href="./?escolha=tab_auxiliar/cad_usuario.php&menu=top_admusuario"
		><button class='btn btn-info btn-sm <?PHP echo $b;?>'
		 >Cadastrar  Usu&aacute;rio</button</a>
	</li>
	<li>
		<a <?PHP $b = id_corrente ("inic_usuario");?> href="./?escolha=tab_auxiliar/inic_usuario.php&menu=top_admusuario"
			><button class='btn btn-info btn-sm <?PHP echo $b;?>'>Apagar / Inicializar Us&aacute;urio</button></a>
	</li>
</ul>
<?php
}
?>
