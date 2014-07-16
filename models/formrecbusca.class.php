<?php 
class formrecbusca extends formularioalterar {
	
	public function getMostrar(){
		
		switch ($_GET['escolha']) {
			case 'tesouraria/receita.php':
				 $idformulario = 3;
				//echo 'teste1';
			break;
			case 'tesouraria/rec_alterar.php':
				//echo 'teste2';
				 $idformulario = ($_GET['campo']=='') ? 4:5;
			break;
			case 'tesouraria/agenda.php':
				 $idformulario = 3;
				//echo 'teste1';
			break;
			case 'tesouraria/agenda.php':
				 $idformulario = 2;
				//echo 'teste1';
			break;
			default:
				 $idformulario = 3;
			break;
		 	
		}
	   		?>
				<form id="form1" name="form1" method="get" action="">
				<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receberá os dados -->
				<input type="hidden" name="menu" value="top_tesouraria" />
				<input type="hidden" name="campo" value="<?PHP echo "{$this->campo}";?>" />
				<input type="text" disabled="disabled" name="nomerecebeu" value="" />
				<label>Rol:</label>
				<input type="text"name="recebeu" value="" size="5" />
				<a href="javascript:lancarRecibo('campo=nomerecebeu&rol=recebeu&form=<?PHP echo $idformulario;?>')">
					<img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para consultar membros com recibos cadastrados!" />
					Pesquisar membro...</a>
				<input type="submit" name="Submit" value="Listar Recibos..."  />
				</form>
			<?PHP

	}
}
?>