<?php
$razao = new DBRecord ("credores",(int)$_POST["id"],"id");

list($d,$m,$y) = explode('/', $_POST['venc']);
if (checkdate($m,$d,$y)) {
	//Verifica se é uma data válida

	$errcredor = true;
	if ($_POST['confirma']!=1) {
		//Exibe os dados para confirmação de valor
		//Concluir a verificação e a divisão das parcelas e mostrar para confirmação
		$parctotal 	= 0; //Zera variável
		$valor 		= str_replace(array("."), "", $_POST['valor']);//remove caracteres para tratar a string como número
		$valor		= strtr($valor, ',','.');//Transforma p/ sistema númerico americano
		$congr 		= new DBRecord ("igreja",(int)$_POST['congregacao'],"rol");
		?>

<form method="post" name="agendar" action="">
	<caption>
		Confirmar Agenda de Pagamento:
		<?php echo $congr->razao();?>
	</caption>
	<table style="background-color: #F3F3F3;">
		<colgroup>
			<col id="Igreja" />
			<col id="Vencimento" />
			<col id="Valor total" />
			<col id="albumCol" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">Igreja</th>
				<th scope="col">Vencimento</th>
				<th scope="col">Valor</th>
				<th scope="col">Parcela</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$parc 		= (int)$_POST['parc'];
		$loopTab 	= $parc;
		$valoint100 =  ($valor/$parc)*100;
		list($inte,$decim) = explode('.',"$valoint100");
		list($valortrun,$dvlrt) = explode('.',$valor*100);
		$valortrun 	= $valortrun/100;
		$mot 		= $_POST['motivo'];
		if ($parc>1) {
			//Agendamento com quantidade definida
			$parctrun = $inte/100;
			$valores = "<input name='frequencia' type='hidden' id='frequencia' value='2' />";
		}elseif ($parc=='0' || $parc=='' ){
			//Agendamento automático para todos os meses
			$parctrun = $valortrun;
			$parc = 0; $loopTab = 1;
			$valores = "<input name='frequencia' type='hidden' id='frequencia' value='0' />";
		}else {
			//Agendamento único
			$valores = "<input name='frequencia' type='hidden' id='frequencia' value='1' />";
		}

		$valores .= "<input name='motivo' type='hidden' id='motivo' value='$mot' />";

		//Concluir inserindo o cadastro no banco script models/cadagendapgto.php...

		for ($j = 0; $j < $loopTab; $j++) {

			if (($m+$j)=='2' && $d>'28') {
				$dia = '28';
			}elseif ($d>'30'){
				$dia ='30';
			}else {
				$dia = $d;
			}
			$vencimento = date("d/m/Y",(mktime(0, 1, 0, $m+$j, $dia, $y)));

			if ($j%2=='0') {
			 ?>
			<tr style='text-align: center;'>
			<?php
			} else{
				echo '<tr class="odd" style="text-align: center;">';
			}
			?>
				<td><?PHP
				echo $congr->razao();
				?>
				</td>
				<td><?php
				echo $vencimento;
				?> <input name='vencimento<?php echo $j;?>' type='text'
					tabindex="<?PHP echo $ind++;?>" maxlength="10"
					id='data' required='required'
					value='<?php echo $vencimento;?>' />
				</td>
				<td style='text-align: right;'><?php

				// <select name="$this->campo;" tabindex=$ind++>
				$par = $j+1;
				$ajustparc .= "<option value='$j'>Ajuste na: $par &ordf; - Parcela</option>";
					
				if ($parc==$par) {
					$diferenca = $parctrun;
					$parctrun = $valortrun - $parctotal;
					$ajustparc = "<option value='$j'>Ajuste na: $par &ordf; - Parcela</option>".$ajustparc;
				}


				$parctotal += $parctrun;
				$diferenca1 = $parctotal - $valor;
				echo number_format($parctrun,2,',', '.');
				
				?> <input name='valor<?php echo $j;?>' type='hidden'
					id='valor<?php echo $j;?>' value='<?php echo $parctrun;?>' />
				</td>
				<td style='text-align: right;'><?php 
				if ($parc==($j+1)) {
					if ($_POST['parc']=='0' || $_POST['parc']=='') {
						$motparc = 'Agendamento mensal e automático';
					}elseif ($parc==1 && $_POST['parc']=='1'){
						$motparc = 'Pgto. Único';
					}else {
						$motparc = ($j+1).' de '.$parc.' - Última parcela';
					}
				}elseif($_POST['parc']=='0' || $_POST['parc']=='') {
						$motparc = 'Agendamento mensal e automático';
				}else {
					$motparc =  'Parcela: '.($j+1).' de '.$parc;
				}
				echo $motparc;
				echo "<input name='motivo$j' type='hidden' id='motivo$j' value='$mot - $motparc' />";
				?>
				</td>
			</tr>
			<?php
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" style="background-color: #F0E68C; font-size: 120%">
					Beneficiado: <?php
					$dadosEmpresa  = '<input type="submit" name="submit"
				tabindex="<?PHP echo $ind++;?>" value="Agendar..." />';
					if ($_POST['rol']!='') {
						$memb = new DBRecord('membro',$_POST['rol'] ,'rol');
						echo $memb->rol().' - '.$memb->nome().' - Valor Total: ---> R$ '.number_format($valortrun,2,',','.');
					}elseif ($_POST['id']!='') {
						echo $_POST['id'].' - '.$_POST['nome'].' - Valor Total: ---> R$ '.number_format($valortrun,2,',','.');
					}elseif ($_POST['nome']!='' &$ $_POST['']!='sigla' ) {
						echo 'Será cadastrado - '.$_POST['nome'].' - Valor Total: ---> R$ '.number_format($valortrun,2,',','.');
						$dadosEmpresa .= '<input type="hidden" name="alias" value="'.$_POST['alias'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="cnpj" value="'.$_POST['sigla'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="resp" value="'.$_POST['resp'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="cpf" value="'.$_POST['cpf'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="telefone" value="'.$_POST['telefone'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="celular" value="'.$_POST['celular'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="endereco" value="'.$_POST['estado'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="bairro" value="'.$_POST['bairro'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="cidade" value="'.$_POST['cidade'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="uf" value="'.$_POST['uf'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="desp1" value="'.$_POST['desp1'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="desp2" value="'.$_POST['desp2'].'"/>';
						$dadosEmpresa .= '<input type="hidden" name="desp3" value="'.$_POST['desp3'].'"/>';
					}else {
						echo 'Você deve informar o nome do credor! - Valor Total: ---> R$ '.number_format($valortrun,2,',','.');
						$errcredor = false;
						$dadosEmpresa  = '';
					}

					?>
				</td>
			</tr>
		</tfoot>
		<tr style="background: #C8E8F7;">
			<td colspan='2'><?php //echo $valores;?> <!-- 
					
						Completar o restante dos input's para o caso de cadastro de novo credor
					
					 --> <input type="hidden" name="id"
				value='<?php echo $_POST['id'];?>' /> <?php 
				if ($errcredor) {
					if ("$diferenca"!="$parctrun" && $parc>1) {
						echo '<select name="ajusteparc" tabindex="'.$ind++.'">';
						echo $ajustparc;
						echo '</select>';
					}
					echo $dadosEmpresa;
					?> <input type="hidden" name="parc" id="parc"
				value='<?php echo $_POST['parc'];?>' /> <input type="hidden"
				name="nome" value='<?php echo $_POST['nome'];?>' /> <input
				type="hidden" name="igreja"
				value='<?php echo $_POST['congregacao'];?>' /> <input type="hidden"
				name="age" value="5" /> <input type="hidden" name="tabela"
				value="agenda" /> <input type="hidden" name="rol"
				value="<?php echo $_POST['rol'];?>" /> <input type="hidden"
				name="escolha" value="tesouraria/despesa.php" /> <input
				type="hidden" name="menu" value="top_tesouraria" /> <?php							
				}else {
					echo 'Click no botão voltar e informe o Credor!';
				}
				?>
			</td>
			<td colspan='2'><?php 
			$linkvoltar  = "&congregacao=".$_POST['congregacao'];
			$linkvoltar .= "&venc=".$_POST['venc'];
			$linkvoltar .= "&valor=".number_format($valortrun,2,',','.');
			$linkvoltar .= "&parc=".$_POST['parc'];
			$linkvoltar .= "&nome=".$_POST['nome'];
			$linkvoltar .= "&id=".$_POST['id'];
			$linkvoltar .= "&motivo=".$_POST['motivo'];
			$linkvoltar .= "&rol=".$_POST['rol'];
			?>
			</td>
		</tr>
	</table>
</form> <a
				href="./?escolha=tesouraria/despesa.php&menu=top_tesouraria&age=3<?php echo $linkvoltar;?>">
					<button>Voltar...!</button> </a>
Referente a:
<br />
<span style="font-size: 150%;"><?php echo $_POST['motivo'];?> </span>

			<?php
	}elseif ($_POST['confirma']==1 && $razao->razao()!=''){
		//Chama o script de cadastro

	}else {
		echo 'Dados alterados indevidamente!';
	}
}else {
	echo '<a href:./?escolha=tesouraria/despesa.php&menu=top_tesouraria&age=3'.$linkvoltar.'><button>Voltar...</button></a> Você digitou uma data inválida para o vencimento! -> '.$_POST['venc']." - Dia: $d, Mês: $m, Ano: $y";
}
?>