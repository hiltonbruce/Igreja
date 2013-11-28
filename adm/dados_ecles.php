<?PHP
if ($_SESSION['nivel']>4){
	$query="SELECT *,DATE_FORMAT(batismo_em_aguas,'%d/%m/%Y') AS batismo_em_aguas,";
	$query.="DATE_FORMAT(dt_mudanca_denominacao,'%d/%m/%Y') AS dt_mudanca_denominacao,";
	$query.="DATE_FORMAT(diaconato,'%d/%m/%Y') AS diaconato,DATE_FORMAT(presbitero,'%d/%m/%Y') AS presbitero,";
	$query.="DATE_FORMAT(evangelista,'%d/%m/%Y') AS evangelista,DATE_FORMAT(pastor,'%d/%m/%Y') AS pastor,";
	$query.="DATE_FORMAT(c_impresso,'%d/%m/%Y') AS c_impresso,DATE_FORMAT(c_entregue,'%d/%m/%Y') AS c_entregue,";
	$query.="DATE_FORMAT(dt_muda_assembleia,'%d/%m/%Y') AS dt_muda_assembleia,DATE_FORMAT(data,'%d/%m/%Y') AS data,";
	$query.="DATE_FORMAT(auxiliar,'%d/%m/%Y') AS auxiliar,DATE_FORMAT(dat_aclam,'%d/%m/%Y') AS dat_aclam ";
	$query.="FROM eclesiastico WHERE rol='".$_SESSION["rol"]."'";
	
	$tabela = "eclesiastico";
	ver_cad();
	$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
	$tab_edit="adm/dados_ecles.php&tabela=$tabela&bsc_rol=$bsc_rol&campo=";//Link de chamada da mesma página para abrir o form de edição do item
	$dad_cad = mysql_query ($query);
	$arr_dad = mysql_fetch_array ($dad_cad);
	$igreja = new DBRecord ("igreja",$arr_dad["congregacao"],"rol");
	$cidade = new DBRecord ("cidade",$arr_dad["local_batismo"],"id");
	$ind=1;

?>
	<?PHP
	if (!empty($_SESSION["rol"]))
	{
	if (!empty($arr_dad["rol"])) {
	controle ("consulta");
	?>
	<div id="lst_cad">
	<table width="100%">
      <tr>
        <td>Onde congrega:<p><a href="./?escolha=adm/dados_ecles.php&bsc_rol=<?php echo $bsc_rol;?>&campo=congregacao" ><?PHP print $arr_dad["congregacao"]." - ".$igreja->razao();?></a></p>
        <?PHP
		if ($_GET["campo"]=="congregacao"){
		?>
		  <form id="form1" name="form1" method="post" action="">
         <?PHP
			$lst_cid = new sele_cidade("cidade","$vl_uf","{$arr_dad["uf"]}","nome","cid_nasc");
		 	$congr = new List_sele ("igreja","razao","congregacao");
		 	echo $congr->List_Selec (++$ind,$igreja->rol());
		 ?>
		 <input name="escolha" type="hidden" id="escolha" value="adm/atualizar_dados.php" />
		  <input name="tabela" type="hidden" id="tabela" value="eclesiastico" />
			<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
		  <input name="campo" type="hidden" id="campo" value="congregacao" />
		  <input name="Alterar..." type="submit" id="Alterar..." value="Alterar..." tabindex="2" />
		  </form>
		<?PHP
		}
		?></td>
        <td>Situa&ccedil;&atilde;o espiritual:
        <?PHP
			$nome = new editar_form("situacao_espiritual",situacao ($arr_dad["situacao_espiritual"]),$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		  ?></td>
        <td>Ano  Batismo  Esp. Santo:
        <?PHP
		$nome = new editar_form("batismo_espirito_santo",$arr_dad["batismo_espirito_santo"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Data Batismo &Aacute;guas:
        <?PHP
		$nome = new editar_form("batismo_em_aguas",$arr_dad["batismo_em_aguas"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
        <td colspan="2">Denomina&ccedil;&atilde;o que veio:
        <?PHP
		$nome = new editar_form("veio_qual_denominacao",$arr_dad["veio_qual_denominacao"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>UF:
          <p><a href="./?escolha=adm/dados_ecles.php&bsc_rol=<?php echo $bsc_rol;?>&campo=uf"><?PHP print " > {$arr_dad["uf"]} < ";?></a>
              <?PHP
		if ($_GET["campo"]=="uf"){	
		?>
          </p>
          <form id="form2" name="form2" method="post" action="">
            <?PHP
				echo sele_uf ($arr_dad["uf"],"uf");
			?>
            <label>
            <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "eclesiastico";?>" />
				<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
            <input name="Submit" type="submit" id="Submit" value="Alterar..." tabindex="2"/>
            </label>
          </form>
          <?PHP } ?></td>
		<td>Local de Batismo:
          <?PHP
		echo $arr_dad["local_batismo"];
		$nome = new editar_form("local_batismo",$cidade->nome(),$tab,$tab_edit);
		$nome->getMostrar();

		
		if ($_GET["campo"]=="local_batismo"){
		?>
          <form id="form3" name="form3" method="post" action="">
            <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
				<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
            <?PHP
			$lst_cid = new sele_cidade("cidade",$arr_dad["uf"],"coduf","nome","local_batismo");	
			$vlr_linha=$lst_cid->ListDados ($ind++);
		?>
            <input name="Submit" type="submit" id="Submit" value="Alterar..." tabindex="<?PHP echo $ind++;?>"/>
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "eclesiastico";?>" />
          </form>
          <?PHP
		}
		?></td>
        <td>Mudou da denomina&ccedil;&atilde;o:
        <?PHP
		$nome = new editar_form("dt_mudanca_denominacao",$arr_dad["dt_mudanca_denominacao"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Auxiliar de trabalho em:
        <?PHP
		$nome = new editar_form("auxiliar",$arr_dad["auxiliar"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
        <td>Diácono em:
        <?PHP
		$nome = new editar_form("diaconato",$arr_dad["diaconato"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
		<td >Presbitéro em:
        <?PHP
		$nome = new editar_form("presbitero",$arr_dad["presbitero"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Evangelista em:
        <?PHP
		$nome = new editar_form("evangelista",$arr_dad["evangelista"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
        <td>Pastor em:
        <?PHP
		$nome = new editar_form("pastor",$arr_dad["pastor"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
        <td>Data:
        <?PHP
		$nome = new editar_form("data",$arr_dad["data"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Cidade e UF de onde veio:
        <?PHP
		$nome = new editar_form("lugar",$arr_dad["lugar"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
        <td>Data da mudan&ccedil;a da outra Assembleia:
        <?PHP
		$nome = new editar_form("dt_muda_assembleia",$arr_dad["dt_muda_assembleia"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>Data da aclama&ccedil;&atilde;o:
        <?PHP
		$nome = new editar_form("dat_aclam",$arr_dad["dat_aclam"],$tab,$tab_edit);
		$nome->getMostrar();
		$nome->getEditar();
		?></td>
      </tr>
      
      <tr>
        <td>Cart&atilde;o Impresso em:
        <?PHP
		$nome = new editar_form("c_impresso",$arr_dad["c_impresso"],$tab,$tab_edit);
		$nome->getMostrar();
		?></td>
        <td>Cart&atilde;o Impresso por:
          <p><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?PHP echo $arr_dad["quem_imprimiu"];?>" title="<?PHP echo  "Rol: ".$arr_dad["quem_imprimiu"];?> - Click aqui para dados completos">
            <?PHP
		
		echo substr (fun_igreja ($arr_dad["quem_imprimiu"]),0,25);
		
		?>
          </a></p></td>
        <td><p>&nbsp;</p></td>
      </tr>
      <tr>
        <td>Cartão Entregue em:
        <?PHP
		$nome = new editar_form("c_entregue",$arr_dad["c_entregue"],$tab,$tab_edit);
		$nome->getMostrar();
		?></td>
        <td>Cartão Recebido por:
        <p><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?PHP echo $arr_dad["quem_recebeu"];?>" title="<?PHP echo  "Rol: ".$arr_dad["quem_recebeu"];?> - Click aqui para dados completos">
          <?PHP
		
		echo substr (fun_igreja ($arr_dad["quem_recebeu"]),0,25);
		
		?>
        </a></p></td>
        <td>Cartão Entregue por:
		<p><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?PHP echo $arr_dad["quem_entregou"];?>" title="<?PHP echo  "Rol: ".$arr_dad["quem_entregou"];?> - Click aqui para dados completos">
         <?PHP
		
		echo substr (fun_igreja ($arr_dad["quem_entregou"]),0,25);
		
		?>
        </a></p>        </td>
      </tr>
      <tr>
      <td colspan="4">Observa&ccedil;&otilde;es:
          <p>
		<?PHP
		$nome = new editar_form("obs",$arr_dad["obs"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></p></td>
		</tr>    
	  <tr>
	  	<td>Recibo de entrega N&ordm;:	  </td>
	  	<td colspan="3"><p>
	  	
	    <?PHP
	    	if ($arr_dad["rec_entrega"]>"0") {
	    		printf ("<a href='relatorio/recibo_print.php?recibo={$arr_dad["rec_entrega"]}' 
				title='Click aqui para re-impress&atilde;o do recibo'> %'05u &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Visualizar Recibo</a>",$arr_dad["rec_entrega"]) ;
	    	}else {
	    		echo "Sem recibo de entrega";	
	    	}
		?></p>
		</td>
	  </tr>
    </table>
	</div>
	<?PHP
	}//Fim do if !empty($arr_dad["rol"]) quando não existe cadastro para este rol é aberto um form para preenchimento
	else {
		require_once ("adm/form_eclesiastico.php");
	}
	}//Fim do if de SESSION["rol"]
	}//Fim do if de nível
	
	?>
