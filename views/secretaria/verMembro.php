<table class='table table-striped table-condensed'>
    <tr>
      <td colspan="2">
				<strong>Nome:</strong><h4><?PHP echo $arr_dad["nome"]; ?></h4>
		</td>
		<td rowspan="3" class="text-center">
		<?PHP
				//echo " - Idade: ";
		$mes = date ('m') - date('m',$arr_dad["nasc"]);
		$dia = date ('d') - $arr_dad["dia"];
		/*
		 *
		 * Calcular a idade do membro
		 *
		 * */
		$dataAtual = new DateTime('NOW');
		$dataNasc  = new DateTime($arr_dad["nasc"]);
		$diferenca = $dataNasc->diff($dataAtual);
		//print_r($dataNasc);
		//echo '<br/>'.$dataAtual->format('Y-m').' FormatoAtual<br/>';
		if ($diferenca->y>1) {
			echo $diferenca->y.' Anos, ';
		}elseif ($diferenca->y>0){
			echo $diferenca->y.' ano, ';
		}
		if ($diferenca->m>1) {
			echo $diferenca->m.' meses, ';
		}elseif ($diferenca->m>0){
			echo $diferenca->m.' mes, ';
		}
		if ($diferenca->d>1) {
			echo $diferenca->d.' dias<br/>';
		}elseif ($diferenca->d>0) {
			echo $diferenca->d.' dia<br/>';
		}
		//echo $dataNasc->format('Y-m').' FormatoNasc<br/>';
	?>
		<div>
			<?PHP print mostra_foto($bsc_rol);?>
		</div>
		</td>
  </tr>
  <tr>
      <td>
				<strong>Pai:</strong><h6><?PHP echo $arr_dad["pai"];?></h6>
			</td>
      <td>
				<strong>Rol do Pai:</strong><h6><?PHP echo $arr_dad["rol_pai"];?></h6>
			</td>
    </tr>
    <tr>
      <td>
				<strong>M&atilde;e:</strong><h6><?PHP echo $arr_dad["mae"];?></h6>
			</td>
        <td>
					<strong>Rol da M&atilde;e:</strong>
          <h6><?PHP echo $arr_dad["rol_mae"];?></h6>
			</td>
      </tr>
	  <tr>
			<td>
				<strong>Sexo:</strong><h6><?PHP echo $arr_dad["sexo"];?></h6>
			</td>
			<td>
				<strong>Data Nascimento:</strong><h6><?PHP echo $arr_dad["br_datanasc"];?></h6>
			</td>
			<td colspan="2">
				<strong>Nacionalidade:</strong><h6><?PHP echo $arr_dad["nacionalidade"];?></h6>
			</td>
    </tr>
    <tr>
      <td colspan="2">
				<strong>Naturalidade:</strong>
				<?PHP
					$cidade = new DBRecord ("cidade",$arr_dad["naturalidade"],"id");
					echo $arr_dad["naturalidade"];
					echo '<h6>'.$cidade->nome().'</h6>';
				?>
		</td>
	  <td colspan="2">
			<strong>UF:</strong><h6><?PHP echo $arr_dad["uf_nasc"];?></h6>
		</td>
  </tr>
  <tr>
    <td colspan="2">
			<strong>Endere&ccedil;o:</strong><h6><?PHP echo $arr_dad["endereco"];?></h6>
		</td>
    <td colspan="2">
			<strong>N&uacute;mero:</strong>
			<h6>
				<?PHP echo (($arr_dad['numero']!='0') ? $arr_dad['numero'] : 'N&atilde;o informado!');?>
			</h6>
		</td>
  </tr>
  <tr>
    <td>
			<strong>Complementos:</strong><h6><?PHP echo $arr_dad["complemento"];?></h6>
		</td>
    <td>
			<strong>Cidade:</strong>
      <?PHP
			$cidade = new DBRecord ("cidade",$arr_dad["cidade"],"id");
			echo '<h6>'.$cidade->nome().'</h6>';
			?>
		</td>
		<td colspan="2">
			<strong>Bairro:</strong><h6>
			<?PHP
			 $bairro = new DBRecord ("bairro",$arr_dad["bairro"],"id");
			echo $bairro->bairro();
			?></h6>
		</td>
  </tr>
  <tr>
    <td>
			<strong>UF Resid&ecirc;ncia:</strong>
			<h6><?PHP echo $arr_dad["uf_resid"];?></h6>
		</td>
    <td >
			<strong>Celular:</strong><h6><?PHP echo $arr_dad["celular"]?></h6>
		</td>
		<td>
			<strong>Telefone:</strong><h6><?PHP echo $arr_dad["fone_resid"];?></h6>
		</td>
  </tr>
  <tr>
	  <td>
			<strong>CEP:</strong><h6><?PHP echo $arr_dad["cep"]; ?></h6>
		</td>
		<td>
			<strong>Doador de Sangue:</strong><h6>
				<?PHP
				echo (($arr_dad['doador']!='') ? $arr_dad['doador'] : 'N&atilde;o informado!');
				?></h6>
		</td>
	  <td><strong>Tipo de Sangu&iacute;neo:</strong>
	      <h6><?PHP
				echo (($arr_dad['sangue']!='') ? $arr_dad['sangue'] : 'N&atilde;o informado!');
			?></h6>
		</td>
  </tr>
  <tr>
    <td><strong>Email:</strong><h6><?PHP echo $arr_dad["email"];?></h6>
		</td>
    <td><strong>Gradua&ccedil;&atilde;o:</strong>
		<h6><?PHP echo $arr_dad["graduacao"];?></h6>
	</td>
  <td colspan="2"><strong>Escolaridade:</strong>
		<h6><?PHP echo $arr_dad["escolaridade"];?></h6>
	</td>
  </tr>
  <tr>
    <td colspan="4"><strong>Pend&ecirc;ncias:</strong>
      <h6><?PHP echo $arr_dad["mobs"];?></h6>
	</td>
  </tr>
</table>
