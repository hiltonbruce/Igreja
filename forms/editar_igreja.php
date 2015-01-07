<div id="lst_cad"><?PHP
if ($_SESSION['nivel']>4){

//ver_cad();

	$igreja = new DBRecord('igreja',$_GET['rol'], 'rol');

	if ($igreja->pastor()>0) {
		$congregacao = new DBRecord('membro',$igreja->pastor(),'rol');
		$dirigente = $congregacao->nome();
	}elseif ($igreja->pastor()!='') {
		$dirigente=$igreja->pastor();
	}else {
		$dirigente = 'Informe o Rol do dirigente';
	}

$tabela = "igreja";
$tab="sistema/atualizar_rol.php";//link q informa o script quem receber� os dados do form para atualizar
$tab_edit="forms/editar_igreja.php&tabela=$tabela&rol={$igreja->rol()}&campo=";//Link de chamada da mesma p�gina para abrir o form de edi��o do item

$ind = 1;


	if (!empty($_GET["rol"]))
	{
		?>
	<fieldset>
	<legend>Editar dados da Igreja: <?php echo $igreja->razao();?> </legend>
	<table  style="text-align: left; width: 100%;">
      <tr>
      	<td>
			<form>
		     <label>Alterar Igreja: </label>
		     <select name='id' id='id' onchange="MM_jumpMenu('parent',this,0)" tabindex='++$ind' class="form-control" >
		     <?php
			     $estnatal = new List_sele('igreja', 'razao','id');
			     echo $estnatal->List_Selec_pop('escolha='.$_GET["escolha"].'&tabela='.$_GET['tabela'].'&rol=',$_GET["rol"]);
		     ?>
		     </select>
		     </form>
     	</td>
     	</tr>
     	<tr>
        <td colspan="2" >Dire&ccedil;&atilde;o:
        <?PHP
			$nome = new editar_form("pastor",$igreja->pastor(),$tab,$tab_edit);
			echo '<p><a title="Click aqui para alaterar este campo!"';
			echo 'href="./?escolha='.$tab_edit.'pastor" autofocus="autofocus" >'.$dirigente.'</a></p>';

		echo '</td><td>';


		echo 'Rol: <p>'.$igreja->pastor().'</p>';

		?></td>
		<?php

			if (!empty($_GET['campo']) && $_GET['campo']=='pastor') {

				$cong = (empty($_GET["rol"])) ? (INT)$_GET['id']:(int)$_GET['rol'];

				echo '<form id="form1" name="form1" method="post" action="">';
				echo '<input type="hidden" name="escolha" value="sistema/atualizar_rol.php">';
				echo '<input type="hidden" name="campo" value="pastor">';
				echo '<input type="hidden" name="tabela" value="igreja">';
				echo '<input type="hidden" name="id" value="'.$cong.'">';
				require_once 'forms/igreja/dirigenteAuto.php';
				echo '</form>';

			}

		?>
      </tr>
      <tr>
        <td >Rol 1 &ordm; Secret&aacute;rio: :
        <?PHP
			$nome = new editar_form("secretario1",$igreja->secretario1(),$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>Rol 2&ordm; Secret&aacute;rio:
        <?PHP
			$nome = new editar_form("secretario2",$igreja->secretario2(),$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>Setor:
        <?PHP
			$nome = new editar_form("setor",$igreja->setor(),$tab,$tab_edit);
			$nome->getMostrar();
			if ($_GET['campo']=='setor'){
				echo "
						<form method='post' action='' id='formbairro'>
							<input name='escolha' type='hidden' value='sistema/atualizar_rol.php' />
							<input name='id' type='hidden' id='id' value='{$igreja->rol}'  />
							<input name='tabela' type='hidden' value='igreja' />
							<input name='campo' type='hidden' value='setor' />";
				$setor = new setor(++$ind);
				echo "
							<input type='submit' name='Submit' value='Alterar' tabindex='{++$ind}' />
						</form>
						";
			}
		?></td>
      </tr>
      <tr>
        <td >CNPJ
        <?PHP
			$nome = new editar_form("cnpj",$igreja->cnpj(),$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Site
          <?PHP
			$nome = new editar_form("site",$igreja->site(),$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
		?></td>
		<td>Email:
        <?PHP
		$nome = new editar_form("email",$igreja->email(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>

      <tr>
        <td colspan="2">Endere&ccedil;o:
		<?PHP
		$nome = new editar_form("rua",$igreja->rua(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
        <td colspan="2">N&uacute;mero:
        <?PHP
		$nome = new editar_form("numero",$igreja->numero(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>
      <tr>
        <td>Bairro:
          <?PHP
		//inicio
		$bairro = new DBRecord('bairro',$igreja->bairro(), 'id');
		echo '<p><a title="Click aqui para alaterar este campo!"';
		echo 'href="./?escolha='.$tab_edit.'bairro" autofocus="autofocus" >* '.$bairro->bairro().' *</a></p>';

		if ($_GET["campo"]=="bairro"){
		?>
          <form id="form3" name="form3" method="post" action="">
            <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "sistema/atualizar_rol.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
            <?PHP
			$lst_bairro = new sele_cidade("bairro",$igreja->cidade(),"idcidade","bairro","bairro");
			$vlr_bairro=$lst_bairro->ListDados ($ind++);
		?>
            <input name="tabela" type="hidden" id="tabela" value="igreja" />
            <input name="id" type="hidden" id="tabela" value="<?php echo $igreja->rol();?>" />
            <input name="Submit3" type="submit" class="btn btn-primary btn-sm" id="Submit2" value="Alterar..." tabindex="<?PHP echo $ind++;?>" />
          </form>
        <?PHP
		}

		//fim
		?></td>
        <td>Cidade:
          <?PHP
		//inicio
		$cidade = new DBRecord ("cidade",$igreja->cidade(),"id");

		echo $igreja->cidade;
		$nome = new editar_form("cidade",$cidade->nome(),$tab,$tab_edit);
		$nome->getMostrar();

		if ($_GET["campo"]=="cidade"){
		?>
          <form id="form3" name="form3" method="post" action="">
            <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "sistema/atualizar_rol.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
            <?PHP
				$lst_cid = new sele_cidade("cidade",$igreja->uf,"coduf","nome","cidade");
				$vlr_linha=$lst_cid->ListDados ($ind++);
			?>
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "igreja";?>" />
            <input name="id" type="hidden" id="id" value="<?PHP echo $_GET["rol"];?>" />
            <input name="Submit" type="submit" class="btn btn-primary btn-sm" id="Submit" value="Alterar..." tabindex="<?PHP echo $ind++;?>" />
          </form>
        <?PHP
		}

		//fim
		?></td>
		<td colspan="2">UF:

          <p><a href="./?escolha=<?PHP echo $tab_edit;?>uf"><?PHP print " > {$igreja->uf()} < ";?></a>
              <?PHP
		if ($_GET["campo"]=="uf"){
		?>
          </p>
          <form id="form2" name="form2" method="post" action="">
            <?PHP
			echo sele_uf ($igreja->uf(),'uf');
		?>
            <label>
            <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "sistema/atualizar_rol.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "igreja";?>" />
            <input name="id" type="hidden" id="id" value="<?PHP echo $_GET["rol"];?>" />
            <input name="Submit" type="submit" class='btn btn-primary btn-sm' id="Submit" value="Alterar..." tabindex="<?PHP echo $ind++;?>"/>
            </label>
          </form>
          <?PHP } ?></td>
      </tr>
      <tr>
        <td>CEP:
          <?PHP
		$nome = new editar_form("cep",$igreja->cep,$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
        <td>Telefone:
        <?PHP
		$nome = new editar_form("fone",$igreja->fone,$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
        <td colspan="2">Fax:
        <?PHP
		$nome = new editar_form("fax",$igreja->fax,$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar();
		?></td>
      </tr>


      <tr>
        <td colspan="4">C&iacute;rculo de Ora&ccedil;&atilde;o:
            <?PHP
                require_once 'forms/igreja/alterarDiaOracao.php'
            ?>
        </td>
      </tr>
      <tr>
      	<td colspan="3">
    Santa Ceia:
   	  <?PHP
		$ceia = new formceia($igreja->rol());
		?>
		<p><a href="./?escolha=<?PHP echo $tab_edit;?>ceia"><?PHP print $ceia->mostradiasemana();?></a></p>
		</td></tr><td colspan="3">
  Dias de Cultos
        <table class='table'>
            <tbody>
            <tr class="primary">
                <?PHP
                    require_once 'forms/igreja/alterarDiaCulto.php'
                ?>
            </tr>
            </tbody>
        </table>
        </td></tr>

    </table>

    </fieldset>
	        <?PHP
			if ($_GET['campo']=='ceia'){
				echo "<form method='post' action='' id='formceia'>";
				$ceia->formulario(++$ind);
				?>
			  	<input name='escolha' type='hidden' value='sistema/atualizar_rol.php' />
			  	<input name='tabela' type='hidden' value='igreja' />
			  	<input name='id' type='hidden' value='<?php echo $igreja->rol();?>' />
			  	<input name='campo' type='hidden' value='ceia' />
			  	<input type='submit' class='btn btn-primary btn-sm' name='Submit' value='Alterar' tabindex='{++$ind}' />
		<?PHP
			echo "</form>";
			}
	}}
	?>
</div>
