<?php 
	//Primeira fase para retirada da sessão como indece de acesso para listar os dados do membro
	require_once 'views/secretaria/menuTopDados.php';
?>
	
	<form id="form1" name="form1" method="get" action="">
	  <?PHP
	  echo "$campo_rol";//valor recebido do script index.php
	  $anterior=$bsc_rol-1;
	  $proximo=$bsc_rol+1;
	  if ($anterior<=0)
	  {
	  $anterior=0;
	  }
	  
	  ?>
	  <input name="bsc_rol" type="text" id="bsc_rol" title="Insira o Rol" value="<?PHP echo $bsc_rol; ?>"/>
	  <input name="escolha" type="hidden" id="escolha" value="adm/dados_pessoais.php" />
	  <input type="submit" name="Submit2" value="Listar..." title="Click aqui para listar os dados do Membro" />
	</form>	
	  <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&bsc_rol=<?PHP echo $anterior;?>" >Registro Anterior
	  	<img src="img/1910_32x32.png" alt="Registro Anterior" width="22" height="22" title="Registro Anterior" align="absmiddle" border="0" />
	  </a> 
	  <a href="./?escolha=<?PHP echo $_GET["escolha"];?>&bsc_rol=<?PHP echo $proximo;?>" >
	  	<img src="img/1967_32x32.png" width="22" height="22" title="Pr&oacute;ximo Registro" alt="Pr&oacute;ximo Registro" align="absmiddle" border="0"/>Pr&oacute;ximo Registro
	  </a>
	  <?PHP if ($_GET["escolha"]<>"adm/cartao.php" && $_GET["escolha"]<>"adm/dados_cartas.php") {//O script cartao_print.php possui opção própria para impressão ?> 
	    <a href="relatorio/ficha.php" title="Imprimir ficha completa">
	 		<button>Imprimir ficha tipo 1</button>
		</a>
		<a href="./views/fichamembro.php?rol=<?php echo $bsc_rol;?>" title="Imprimir ficha completa">
			<button>Imprimir ficha tipo 2</button>
		</a>
	  <?PHP }
	  
		require_once 'forms/autocompleta.php';
		
		if (!(strstr($_GET["escolha"], "dados_pessoais.php") || strstr($_GET["escolha"], "cartao.php")) && isset($_SESSION["membro"]))
		{
			echo "Membro: {$_SESSION["membro"]} - ";		
		}
			$ecles = new DBRecord ("eclesiastico",$bsc_rol,"rol");
			$igreja = new DBRecord ("igreja",$ecles->congregacao,"rol");
			echo "Cargo: ".cargo($bsc_rol)." - Congrega: {$igreja->razao}";		
		
		?>