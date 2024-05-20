<fieldset>
	<legend>Detalhar entradas</legend>
	<table class="table">
		<tr>
			<td>
				<div class="row">
					<div class="col-xs-2"><br />
						<a href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&direita=1&rec=12&ano=<?php echo $_GET['ano'];?>"><button
							class='btn btn-primary'>Listar Todas</button> </a>
						</div>
						<form method="get" name="" action="">
							<div class="col-xs-3">
								<label>M&ecirc;s:</label>
								<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
									<?php
									$mesLink = '';#Para anexar na variável $dadoLink
									$linha1 = '<option value="0">Selecione o m&ecirc;s...</option>';
									foreach(arrayMeses() as $mes => $meses) {
										$linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
										if ($_GET['mes']==$mes) {
											$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
											$mesLink = '&mes='.$mes;#Para anexar na variável $dadoLink
										}
									}
									echo $linha1.$linha2;
									?>
								</select><label></label>
							</div>
							<div class="col-xs-2">
								<label>Ano:</label><input type="text" name="ano" class="form-control"
								placeholder="Ano" size="5" value="<?php echo $_GET['ano'];?>"
								tabindex="<?PHP echo ++$ind; ?>" />
							</div>
							<div class="col-xs-3">
								<label>Congrega&ccedil;&atilde;o:</label>
								<?php
								$bsccredor = new List_sele('igreja', 'razao', 'igreja');
								$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control" autofocus="autofocus"');
								echo $listaIgreja;
								?>
							</div>
							<div class="col-xs-2"><label>&nbsp;</label>
								<input type="submit" class='btn btn-primary' name="Submit" value="Exibir..."
								tabindex="<?PHP echo ++$ind; ?>" />
								<input name="escolha" type="hidden" value="tesouraria/receita.php" />
								<input name="menu" type="hidden" value="top_tesouraria" />
								<input type="hidden" name="fin" value="<?php echo $fin;?>" />
								<input type="hidden" name="rec" value="11" />
								<input type="hidden" name="direita" value="1" />
							</div>
						</div>
					</form>
			</td>
			<td>
				<?php
				//	if (!empty($_GET['ano'])) {
				//		$dadoLink = 'tesouraria/receita.php?ano='.intval($_GET['ano']).'&fin=11&rec=18'.$mesLink;
				?>
					<!-- <p>&nbsp;</p> -->
					<!-- <a href=' -->
						<?php 
						// echo $dadoLink;
						?>
						<!-- ' target="_blank"> -->
						<!-- <button class="btn btn-primary" ><span class="glyphicon glyphicon-print" aria-hidden="true"></span>
						Imprimir</button></a> -->
				<?php
					// }
				?>
			</td>
		</tr>
	</table>
</fieldset>
