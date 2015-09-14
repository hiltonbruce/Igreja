<h1><img src="img/loading2.gif" width="30" height="30"></h1>
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICENÇA
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa Bruce (http://)
 * @license    http://
 * Insere dados no banco do form cad_usuario.php na tabela:usuario
 */
controle ("tes");

if ((((!empty($_POST['rol']) || (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['rg'])))))
	&& $_GET['remover']=='' ) {
	if ($_POST['id']!='') {
		$atualCargo = new DBRecord ('cargoigreja',$_POST['id'],'id');
		$atualCargo->igreja = $_POST['rolIgreja'];
		$atualCargo->rol = $_POST['rol'];
		$atualCargo->naomembro = $_POST['nome'].',CPF: '.$_POST['cpf'].',RG: '.$_POST['rg'];
		$atualCargo->hierarquia = $_POST['hierarquia'];
		$atualCargo->pgto = $_POST['valor'];
		$atualCargo->diapgto = $_POST['diapgto'];
		$atualCargo->tipo = $_POST['fonte'];
		$atualCargo->Update();
	} else {
		$cadMembro = new tes_ativaCargo ($_POST['rolIgreja'],$_POST['idfunc'],$_POST['hierarquia']);
		$ativarCad = $cadMembro->cadMembroCargo($_POST['rol'],$_POST['nome'].',CPF: '.$_POST['cpf'].',RG: '.$_POST['rg'],$_POST['valor'],$_POST['diapgto'],$_POST['fonte'],$_POST['acesso']);

	//print_r ($ativarCad);
	if ($ativarCad['Desativado']=='1') {
		$atualCad = 'uma atualização!';
	}elseif ($ativarCad['Desativado']>'1'){
		$atualCad = $ativarCad['Desativado'].' atualizações!';
	}else {
		$atualCad = '';
	}

	if ($ativarCad['Cadastro']>'0') {
		$insertCad = ' Um cadastro!';
	}else {
		$insertCad = ' Erro! Nenhumm cadastro realizado!';
	}
	}
	}elseif (!empty($_GET['remover'])) {

		$desativa = new DBRecord ('cargoigreja',$_GET['id'],'id');
		if ($_GET['remover']=='2') {
			$desativa->status = '0'; //Aqui é atribuido a esta variável um valor para UpDate
			$atualCad = 'Desativado!';
		} else {
			$desativa->status = '1'; //Aqui é atribuido a esta variável um valor para UpDate
			$atualCad = 'Ativado!';
		}
		$desativa->Update();
	}else {
		$insertCad = 'Erro! Nenhumm cadastro realizado! Você não informou o benefiaciado! Rol ou Nome com CPF e RG';
	}
	echo '<script> alert("Houve: '.$atualCad.$insertCad.'");</script>';//recupera o id do último insert no mysql

		echo "<script>window.history.go(-1);</script>";
		echo "<a href='./?escolha=controller/despesa.php&menu=top_tesouraria&age=7'>Continuar...<a>";

?>
