<?php $ind=1;

if (date("n")>='10')
	$ano = date("Y")+1;
else
	$ano = date("Y");
?>
<fieldset>
	<legend>Emitir Envelopes</legend>
	<form id="form1" name="form1" method="post"
		action="tesouraria/envelope_dizimo.php">
		Nome <input type="text" name="nome" size="40"
			tabindex="<?PHP echo $ind++;?>" /> Rol: <input name="rol" type="text"
			value="" size="10" tabindex="<?PHP echo $ind++;?>" /> <a
			href="javascript:lancarSubmenu('campo=nome&rol=rol&form=0')"><img
			border="0" src="img/lupa_32x32.png" width="18" height="18"
			title="Click aqui para pesquisar membros!" /> </a> Ano: <input
			name="ano" type="text" value="<?PHP echo $ano;?>" size="4"
			tabindex="<?PHP echo $ind++;?>" />
		<table>
			<thead>
			</thead>
			<tbody>
				<tr>
					<td>
						<h2>Janeiro</h2>
						<p>
							Dia:<input name="diaJan" type="text"
								value="<?PHP echo $diaJan;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorJan" type="text"
								value="<?PHP echo $valorJan;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>
					</td>
					<td>
						<h2>Fevereiro</h2>
						<p>
							Dia:<input name="diaFev" type="text"
								value="<?PHP echo $diaFev;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorFev" type="text"
								value="<?PHP echo $valorJan;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>					
					</td>
				</tr>
				<tr>
					<td>
						<h2>Mar&ccedil;o</h2>
						<p>
							Dia:<input name="diaMar" type="text"
								value="<?PHP echo $diaMar;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorMar" type="text"
								value="<?PHP echo $valorMar;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>
					</td>
					<td>
						<h2>Abril</h2>
						<p>
							Dia:<input name="diaAbr" type="text"
								value="<?PHP echo $diaAbr;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorAbr" type="text"
								value="<?PHP echo $valorAbr;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>					
					</td>
				</tr>
				<tr>
					<td>
						<h2>Maio</h2>
						<p>
							Dia:<input name="diaMai" type="text"
								value="<?PHP echo $diaMai;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorMai" type="text"
								value="<?PHP echo $valorMai;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>
					</td>
					<td>
						<h2>Junho</h2>
						<p>
							Dia:<input name="diaJun" type="text"
								value="<?PHP echo $diaJun;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorJun" type="text"
								value="<?PHP echo $valorJun;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>					
					</td>
				</tr>
				<tr>
					<td>
						<h2>Julho</h2>
						<p>
							Dia:<input name="diaJul" type="text"
								value="<?PHP echo $diaJul;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorJul" type="text"
								value="<?PHP echo $valorJul;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>
					</td>
					<td>
						<h2>Agosto</h2>
						<p>
							Dia:<input name="diaAgo" type="text"
								value="<?PHP echo $diaAgo;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorAgo" type="text"
								value="<?PHP echo $valorAgo;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>					
					</td>
				</tr>
				<tr>
					<td>
						<h2>Setembro</h2>
						<p>
							Dia:<input name="diaSet" type="text"
								value="<?PHP echo $diaSet;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorSet" type="text"
								value="<?PHP echo $valorSet;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>
					</td>
					<td>
						<h2>Outubro</h2>
						<p>
							Dia:<input name="diaOut" type="text"
								value="<?PHP echo $diaOut;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorOut" type="text"
								value="<?PHP echo $valorOut;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>					
					</td>
				</tr>
				<tr>
					<td>
						<h2>Novembro</h2>
						<p>
							Dia:<input name="diaNov" type="text"
								value="<?PHP echo $diaNov;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorNov" type="text"
								value="<?PHP echo $valorNov;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>
					</td>
					<td>
						<h2>Dezembro</h2>
						<p>
							Dia:<input name="diaDez" type="text"
								value="<?PHP echo $diaDez;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
							Valor:<input name="valorDez" type="text"
								value="<?PHP echo $valorDez;?>" tabindex="<?PHP echo $ind++;?>" size="10" />
						</p>					
					</td>
				</tr>	
			</tbody>
		</table>
		
		<input type="submit" name="Submit" value="Emitir envelope..."
			tabindex="<?PHP echo ++$ind; ?>" />
	</form>
</fieldset>

<fieldset>
	<legend>Personalizar impressão</legend>
	Tamanho do Papel<br /> &nbsp;&nbsp;Largura...........210,0 mm<br />
	&nbsp;&nbsp;Altura............297,0 mm<br /> <br /> Margens do Papel<br />
	&nbsp;&nbsp;Acima..............6,30 mm<br />
	&nbsp;&nbsp;Abaixo............14,20 mm<br />
	&nbsp;&nbsp;Esquerda...........6,30 mm<br />
	&nbsp;&nbsp;Direita........... 6,30 mm<br /> <br /> <br /> Modo
	paissagem<br /> <br /> <br /> Para Envelope de Tamaho ..... 119mm x
	169mm

</fieldset>
