<style type="text/css">
<!--
.dados {  background:#CCCCCC;
}
.odd {  background-color:#E9E9E9;
}
col#albumCol {  border: none;
}
-->
</style>
<table width="540" cellspacing="0" id="playlistTable" summary="Dados das congregações e Sede da Assembleia de Deus - Bayeux-PB" >
  <caption>
   <?PHP
   		$igreja = new DBRecord ("igreja",$_GET["id"],"rol");
		print "<h2> Igreja: {$igreja->razao()} - CNPJ: {$igreja->cnpj()}</h2>";
		$membro = new DBRecord ("membro",$igreja->pastor(),"rol");
   ?>
  </caption>
  <colgroup>
  <col id="PlaylistCol" />
  <col id="trackCol" />
  <col id="artistCol" />
  <col id="albumCol" />
  </colgroup>
  <thead>
    <tr>
      <th height="41" scope="col">Dire&ccedil;&atilde;o:
          <p>
		  <?PHP
		if ($membro->nome()){
			$_POST["rol"]=$membro->rol();
			echo $membro->nome();
			$cargo = cargo($membro->rol());
		}else {
			$igreja_sede = new DBRecord ("igreja",1,"rol");
			echo htmlentities($igreja_sede->pastor());
			$cargo = "Pastor";			
		}
		?>
		  </p></th>
      <th scope="col">Cargo:
          <p>
		  <?PHP
		  	echo $cargo;
		  ?>
		  </p></th>
    </tr>
  </thead>
  <tbody>
    <tr class="odd">
      <td colspan="2">Endere&ccedil;o:
        <p>
		<?PHP 
		
		echo "{$igreja->rua()}, N&ordm; {$igreja->numero()}, {$igreja->bairro()}, {$igreja->cidade()}-{$igreja->uf()}"; 
		
		echo ", CEP: {$igreja->cep()}, Telefone: {$igreja->fone()}, Fax: {$igreja->fax()}"; 
		?>
        </p></td>
    </tr>
    <tr>
      <td>1&ordm; Secret&aacute;rio:
        <p>
          <?PHP 
		$secretario1 = new DBRecord("membro",$igreja->secretario1(),"rol");
		echo $secretario1->nome(); 
		?>
        </p></td>
      <td>2&ordm; Secret&aacute;rio:
        <p>
          <?PHP 
		$secretario2 = new DBRecord("membro",$igreja->secretario2(),"rol");
		echo $secretario2->nome(); 
		?>
        </p></td>
    </tr>
    <tr class="odd">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><p>&nbsp;</p>
          <p>&nbsp;</p></td>
      <td><p>&nbsp;</p>
          <p>&nbsp;</p></td>
    </tr>
  </tbody>
</table>
