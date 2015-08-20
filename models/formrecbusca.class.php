<?php
class formrecbusca extends formularioalterar {

	public function getMostrar(){

		switch ($_GET['escolha']) {
			case 'tesouraria/receita.php':
				if ($_GET['rec']=='1' || $_GET['rec']=='3') {
					$idformulario = 3;
				}else {
					$idformulario = 2;
				}
			break;
			case 'tesouraria/rec_alterar.php':

				 if ($_GET['recebeu']!='') {
					$idformulario = 2;
				}else {
					$idformulario = ($_GET['campo']=='') ? 4:5;
				}
			break;
			case 'tesouraria/agenda.php':
				 $idformulario = 3;
			break;
			case 'controller/despesa.php':
				 $idformulario = 2;
			break;
			case 'controller/recibo.php':
				if ($_GET['rec']=='4') {
					$idformulario = 1;
				}else {
					$idformulario = 2;
				}
			break;
			case 'controller/limpeza.php':
				if ($_GET['rec']=='4') {
					$idformulario = 2;
				}else {
					$idformulario = 2;
				}
			break;
			default:
				 $idformulario = 2;
			break;

		}

		//echo $_GET['escolha'].' ** '.$idformulario;
	   		?>
				<form id="form1" name="form1" method="get" action="">
				<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receberá os dados -->
				<input type="hidden" name="menu" value="top_tesouraria" />
				<input type="hidden" name="campo" value="<?PHP echo "{$this->campo}";?>" />
						<label>Nome:</label>
						<input type="text" disabled="disabled" class="form-control" name="nomerecebeu" value="" />
				<div class="row">
					<div class="col-xs-5">
						<label>Rol:</label>
						<input type="text"name="recebeu" class="form-control" value="" required='required'/>
						</div>
					<div class="col-xs-4">
						<a href="javascript:lancarRecibo('campo=nomerecebeu&rol=recebeu&form=<?PHP echo $idformulario;?>')">
							<img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para consultar membros com recibos cadastrados!" />
							Membros...</a>

						<input type="submit" name="Submit" class="btn btn-primary btn-xs" value="Listar Recibos..."  />
					</div></div>

				</form>

			<?PHP

	}
}
?>
