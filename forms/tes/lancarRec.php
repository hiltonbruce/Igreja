<?php
$recibo = (empty($_GET['recibo'])) ? false : intval($_GET['recibo']) ;
if ($rec) {
	$recDados = new DBRecord('tes_recibo',$recibo,'id');
	$contas = new tes_conta();
	$ctaAces = $contas->ativosArray();
	$sldPgto = ($recDados->valor()<=$ctaAces[$recDados->fonte()]['saldo']) ? true : false ;
	$ctaAcessos = ($recDados->conta()>'0' && $recDados->fonte()>0) ? true : false ;
?>
<fieldset>
	<legend>Confirma Lan&ccedil;amento Cont&aacute;bil de Recibo</legend>
		<form method="post" name="recibo" action="">
		<table class='table table-condensed'>
			<tbody>
				<tr>
					<td>
						<label>Recibo N&ordm;</label>
						<input class="form-control" value="<?PHP echo $recibo;?>" disabled >
						<input type="hidden" name="recibo" value='<?PHP echo $recibo;?>'>
					</td>
					<td><label>Igreja:</label>
						<input class="form-control" disabled value='<?PHP echo $_GET['nIgr'];?>'/>
						<input name="rolIgreja" type="hidden" required = "required" value='<?PHP echo $recDados->igreja();?>'/>
					</td>
					<td><label>Valor (R$)</label>
						<input class="form-control" disabled value='<?PHP echo number_format($recDados->valor(),2,",",".");?>'/>
						<input name="valor" type="hidden" required = "required" value='<?PHP echo number_format($recDados->valor(),2,",",".");?>'/>
					</td>
				</tr>
		<tr>
			<td colspan="2"><label>Despesas com:</label>
			<input type="text" class="form-control" disabled
			value='<?PHP
					echo $ctaAces[$recDados->conta()]['codigo'];
					echo ' - '.$ctaAces[$recDados->conta()]['titulo'];
					echo ' -> Saldo '.$ctaAces[$recDados->conta()]['saldo'];
				?>'/>
			</td>
			<td><label>Acesso:</label>
			<input type="text" class="form-control"	value="<?PHP echo $recDados->conta(); ?>" disabled />
			<input type="hidden" name="acessoDebitar" value="<?PHP echo $recDados->conta(); ?>" required="required" />
			</td>
		</tr>
		<tr>
			<td colspan="3"><label>Descri&ccedil;&atilde;o:</label>
			<input type="text" size="78%" id="detalhe" disabled="disabled" class="form-control"
				value="<?PHP echo $ctaAces[$recDados->conta()]['descricao'];?>" />
			</td>
		</tr>
		<tr>
			<td colspan="2"><label>Pago pela Conta:</label>
			<input type="text" class="form-control" disabled
			value='<?PHP
					echo $ctaAces[$recDados->fonte()]['codigo'];
					echo ' - '.$ctaAces[$recDados->fonte()]['titulo'];
					echo ' -> Saldo '.$ctaAces[$recDados->fonte()]['saldo'];
				?>'/>
			</td>
			<td><label>Acesso:</label>
			<input type="text" value='<?PHP echo $recDados->fonte(); ?>' class="form-control" disabled  required="required" />
			<input type="hidden" name="acessoCreditar" value='<?PHP echo $recDados->fonte(); ?>' />
			</td>
		</tr>
			<td colspan="3"><label>Descri&ccedil;&atilde;o:</label>
				<input type="text" disabled class="form-control"
				value="<?PHP echo $ctaAces[$recDados->fonte()]['descricao'];?>"/>
			</td>
		</tr>
				</tr>
				<tr>
					<td colspan="2">
						<label>Hist&oacute;rico</label>
						   <textarea class="text_area" class="form-control" disabled rows="3"><?php
							 echo 'Pago: '.strip_tags($_GET['recebeu']).', ';
							 echo $recDados->motivo();
							 echo ', conf. rec: '.$recibo;
						   ?></textarea>
							<input type="hidden" name="referente" value='<?PHP
							 echo 'Pago: '.strip_tags($_GET['recebeu']).', ';
							 echo $recDados->motivo();
							 echo ', conf. rec: '.$recibo;
							 ?>'
							 required="required" />
					</td>
					<td>

					<div class="row">
					  <div class="col-xs-6">
						<label>Data
						(<?php
						echo conv_valor_br ($recDados->data());
						?>)</label>
						<input name="data" type="text" class="form-control dataclass"
						value="<?php echo conv_valor_br ($recDados->data());?>"
						tabindex='1'/>
					  </div>

					<?php
						if ($sldPgto && $ctaAcessos) {
					?>

					  <div class="co$ctaAcessosl-xs-3">
					    <label>&nbsp;</label>
						<input type="submit" name="Submit" value="Confirmar..." class="btn btn-primary btn-sm"
						tabindex="<?PHP echo ++$ind; ?>" />
						<input name="escolha" type="hidden" value="models/tes/lancamento.php" />
						<input type="hidden" name="transid" value="<?php echo (get_transid());?>">
					  </div>
					</div>


					<?php
					} else {
						if (!$ctaAcessos) {
							$titMens = 'Contas';
							$corpoMens = 'Todas as Contas devem ser informadas, verifique se todas est&atilde;o preenchidas';
							$btnMes = 'Erro Conta';
						} else {
							$titMens = 'Saldo insuficiente - '.$ctaAces[$recDados->fonte()]['titulo'];
							$corpoMens  = 'Voc&ecirc; deve alterar o caixa do pagamento deste recibo, ou refor&ccedil;a o ';
						    $corpoMens .= $ctaAces[$recDados->fonte()]['titulo'].' transferido de outro com saldo para ele! ';
						    $corpoMens .= 'E s&oacute; ent&atilde;o poder&aacute; confirmar este pagamento...';
							$btnMes = 'Caixa sem Saldo!';
						}

					?>

						<!-- Button trigger modal -->
						<label>&nbsp;</label>
						<button type="button" class="btn btn-danger  btn-sm" data-toggle="modal" data-target="#myModal">
						  <?php echo $btnMes;?>
						</button>

						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel"><?php echo $titMens;?></h4>
						      </div>
						      <div class="modal-body">
						        <h5><?php echo $corpoMens;?></h5>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						        <a href='./?escolha=tesouraria/rec_alterar.php&menu=top_tesouraria&id=<?php echo $recibo;?>&pag_mostra=1'>
						        <button type="button" class="btn btn-primary">Voltar</button>
						        </a>
						      </div>
						    </div>
						  </div>
						</div>
					<?php
					}
					?>

					</td>
				</tr>
			</tbody>
		</table>
	</form>
</fieldset>
<?php
	} else {
		echo 'Recibo não identificado';
	}
