<?PHP
function conectar() {
	require_once("DB.php");
	if (file_exists("func_class/constantes.php")){
	 require('func_class/constantes.php');
	}elseif (file_exists('../func_class/constantes.php')){
	 require('../func_class/constantes.php');
	}elseif (file_exists('../../func_class/constantes.php')){
	 require('../../func_class/constantes.php');
	}
	//$dns = "mysql://igreja:G4Hd%VKC#yV5F!at8c@localhost/assembleia";
	$db =& DB::Connect ($dns, array());
	if (PEAR::isError($db)){ die ($db->getMessage()); }
}

function br_data ($dt,$cmp){
	//converte data no formato dd/mm/aaaa para aaaa-mmm-dd e em caso de erro e informado o campo $cmp

			list ($d,$m,$y) = explode('/',$dt);
			$res = checkdate($m,$d,$y);
			if ($res == 1 || $dt=="00/00/0000"){
				$dta="$y-$m-$d";
				return "$dta";
			}else{
				echo "<script> alert('data ou formato inválida! O formato é do tipo: 00/00/0000 (dd/mm/aaaa), Você digitou: $d/$m/$y, para o Campo: $cmp'); window.history.go(-1);</script>";
				echo "data ou formato inválida! O formato é do tipo: 00/00/0000 (dd/mm/aaaa), Você digitou: $d/$m/$y";
				exit;
			}
}

function checadata ($dt){
	//Valida a data no formato dd/mm/aaaa

			$dta = explode("/","$dt");
			$d = $dta[0];
			$m = $dta[1];
			$y = $dta[2];
			$res = checkdate($m,$d,$y);
			if ($res == 1 ){
				//Data válida
				return true;
			}else{
				//Data inválida
				return false;
			}
}

function conv_valor_br ($data) {
		//O exemplo seguinte pega uma data no padrï¿½o ISO (AAAA-MM-DD) e retorna valor no formato DD/MM/YYYY
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $data, $registros)) {
			$res="$registros[3]/$registros[2]/$registros[1]";
			return $res;
		} else {
			echo "<blink><strong>Formato de data inv&aacute;lido: $data</strong></blink>";
		}
}

function sele_uf ($valor,$campo) {
	//Lista para input select para UF, onde:
	//$valor traz a uf do Estado atual
	$for_num = new List_UF("estado", "nome", $campo);
	return $for_num->List_Selec ('1',$valor);
}


function cargo ($rol) {
	//Devolve o cargo do Membro
	if (isset($rol)){
		$opcao = $rol;
	}elseif (empty($_SESSION["rol"])){
		$opcao = $_POST["rol"];
	}else{
		$opcao = $_SESSION["rol"];
	}
	$rec = new DBRecord ("eclesiastico",$opcao,"rol");
		if ($rec->pastor()>"0000-00-00") {
			$cargo = "Pastor";
		}elseif ($rec->evangelista()>"0000-00-00") {
			$cargo = "Evangelista";
		}elseif ($rec->presbitero()>"0000-00-00") {
			$cargo = "Presb&iacute;tero";
		}elseif ($rec->diaconato()>"0000-00-00") {
			$cargo = "Di&aacute;cono";
		}elseif ($rec->auxiliar()>"0000-00-00") {
			$cargo = "Auxiliar";
		}else {
			$cargo = "Membro";
		}
	unset($_POST["rol"]);
	return $cargo;
}

function cargo_dt () {
	//Devolve a data do ultimo cargo do Membro

	$car_dt = new DBRecord ("eclesiastico",$_SESSION["rol"],"rol");
		if ($car_dt->pastor()>"0000-00-00") {
			$cargo_dt = $car_dt->pastor();
		}elseif ($car_dt->evangelista()>"0000-00-00") {
			$cargo_dt = $car_dt->evangelista();
		}elseif ($car_dt->presbitero()>"0000-00-00") {
			$cargo_dt = $car_dt->presbitero();
		}elseif ($car_dt->diaconato()>"0000-00-00") {
			$cargo_dt = $car_dt->diaconato();
		}elseif ($car_dt->auxiliar()>"0000-00-00") {
			$cargo_dt = $car_dt->auxiliar();
		}elseif ($car_dt->dat_aclam()<>"0000-00-00") {
				$cargo_dt = $car_dt->dat_aclam();
			}
	return $cargo_dt;
}

function carta ($id){
	//Devolve o tipo de carta se Apresentaï¿½ï¿½o ou Mudanï¿½a

	switch ($id){
		case "1":
			return "de Recomenda&ccedil;&atilde;o";
			break;

		case "2":
			return "de Mudan&ccedil;a";
			break;

		case "3":
			return "em Tr&acirc;nsito";
			break;

		default:
			return "N&atilde;o Definida no Banco";
			break;
	}
}

function mostra_foto ($rol,$height,$width) {

	if (empty($width)) {$width = 114;}
	if (empty($height)) {$height = 149;}

	//Mostra a foto do membro
		 if (!empty($rol)){

		 if (file_exists("../img_membros/$rol.jpg")){
				$img="../img_membros/$rol.jpg";
			}elseif (file_exists("img_membros/$rol.jpg")){
				$img="img_membros/$rol.jpg";
			}elseif (file_exists("../img_membros/$rol.JPG")){
				$img="../img_membros/$rol.JPG";
			}elseif (file_exists("img_membros/$rol.JPG")){
				$img="img_membros/$rol.JPG";
			}elseif (file_exists("img_membros/ver_foto.jpg")){
				$img="img_membros/ver_foto.jpg";
			}else{
				$img="../img_membros/ver_foto.jpg";
			}
	} elseif (file_exists("../img_membros/".$_SESSION["rol"].".jpg")){
				$img="../img_membros/".$_SESSION["rol"].".jpg";
			}elseif (file_exists("img_membros/".$_SESSION["rol"].".jpg")){
				$img="img_membros/".$_SESSION["rol"].".jpg";
			}elseif (file_exists("../img_membros/".$_SESSION["rol"].".JPG")){
				$img="../img_membros/".$_SESSION["rol"].".JPG";
			}elseif (file_exists("img_membros/".$_SESSION["rol"].".JPG")){
				$img="img_membros/".$_SESSION["rol"].".JPG";
			}elseif (file_exists("img_membros/ver_foto.jpg")){
				$img="img_membros/ver_foto.jpg";
			}else{
				$img="../img_membros/ver_foto.jpg";
			}
		return "<img src='$img' class='img-thumbnail' alt='Foto do Membro' width='$width' height='$height' border='1' align='absmiddle' />";
}

function foto ($rol) {
	//Mostra a foto do membro

	if (!empty($rol)){

		 if (file_exists("../img_membros/$rol.jpg")){
				$img="../img_membros/$rol.jpg";
			}elseif (file_exists("img_membros/$rol.jpg")){
				$img="img_membros/$rol.jpg";
			}elseif (file_exists("../img_membros/$rol.JPG")){
				$img="../img_membros/$rol.JPG";
			}elseif (file_exists("img_membros/$rol.JPG")){
				$img="img_membros/$rol.JPG";
			}elseif (file_exists("img_membros/ver_foto.jpg")){
				$img="img_membros/ver_foto.jpg";
			}else{
				$img="../img_membros/ver_foto.jpg";
			}
	} elseif (file_exists("../img_membros/".$_SESSION["rol"].".jpg")){
				$img="../img_membros/".$_SESSION["rol"].".jpg";
			}elseif (file_exists("img_membros/".$_SESSION["rol"].".jpg")){
				$img="img_membros/".$_SESSION["rol"].".jpg";
			}elseif (file_exists("../img_membros/".$_SESSION["rol"].".JPG")){
				$img="../img_membros/".$_SESSION["rol"].".JPG";
			}elseif (file_exists("img_membros/".$_SESSION["rol"].".JPG")){
				$img="img_membros/".$_SESSION["rol"].".JPG";
			}elseif (file_exists("img_membros/ver_foto.jpg")){
				$img="img_membros/ver_foto.jpg";
			}else{
				$img="../img_membros/ver_foto.jpg";
			}
		return $img;
}
function data_venc($data){
	//acrescenta 30 dias apartir da data fornecida
	if (isset ($data)){
		$dta = explode("/",$data);
		$d=$dta[0];
		$m=$dta[1];
		$y=$dta[2];
		$res = checkdate($m,$d,$y);
		if ($res == 1 ){
			return date("d/m/Y",(mktime(0, 1, 0, $m, $d+30, $y)));
			}else{
				echo "<script> alert('data ou formato invï¿½lida! O formato ï¿½ do tipo: 00/00/0000 (dd/mm/aaaa), Vocï¿½ digitou: $d/$m/$y');</script>";
				echo "data ou formato invï¿½lida! O formato ï¿½ do tipo: 00/00/0000 (dd/mm/aaaa), Vocï¿½ digitou: $d/$m/$y";
				break;
			}
	}else{
		echo "<script> alert('Data nï¿½o informada!');</script>";
		echo "<h1> Data nï¿½o informada! </h1>";

	}
}

function data_batismo($data,$link){
	//Verifica se a data ï¿½ vï¿½lida e se ï¿½ posterior a atual
	if (isset ($data)){
		$dta = explode("/",$data);
		$d=$dta[0];
		$m=$dta[1];
		$y=$dta[2];
		$res = checkdate($m,$d,$y);
		$batismo = mktime(23, 59, 59, $m, $d, $y);

		echo "bat -> $batismo  ** atual->".mktime();

		if ($res != 1 ){
			echo "<script> alert('Data invï¿½lida! Vocï¿½ digitou: $data');  location.href='$link';</script>";
			break;
		}elseif ($batismo<mktime()){
			echo "<script> alert('Data anterior a hoje! Vocï¿½ digitou: $data, e ï¿½ alterior a data atual e deve ser hoje ou posterior! bat -> $batismo  ** atual->".mktime()."');  location.href='$link';</script>";
			break;
		}

	}else{
		echo "<script> alert('Data nï¿½o informada!');</script>";
		echo "<h1> Data nï¿½o informada! </h1>";

	}
}

function fun_igreja ($rol){
	//retorno o nome do membro de acordo com o rol
	$membro = new DBRecord ("membro",$rol,"rol");
	return  $membro->nome();
}

function quem_entregou ($cpf){
	//retorno o nome do membro de acordo com o rol
	$membro = new DBRecord ("usuario",$cpf,"cpf");
	return  $membro->nome();
}


function validaCPF($cpf) {
	$soma = 0;

	//verifica se cpf tem um formato valido (000.000.000-00)
	if (ereg("^([0-9]){3}.([0-9]){3}.([0-9]){3}-([0-9]){2}",$cpf)){
		//echo "<script> alert('CPF formato Verdadeiro!');</script>";

		$cpf = str_replace(array(".","-"), "", $cpf);//remove caracteres para tratar a string como nï¿½mero


		if (strlen($cpf) <> 11 || ($cpf == '11111111111') || ($cpf == '22222222222') ||
			($cpf == '33333333333') || ($cpf == '44444444444') ||
			($cpf == '55555555555') || ($cpf == '66666666666') ||
			($cpf == '77777777777') || ($cpf == '88888888888') ||
			($cpf == '99999999999') || ($cpf == '00000000000'))
			return false;

		// Verifica 1ï¿½ digito
		for ($i = 0; $i < 9; $i++) {
			$soma += (($i+1) * $cpf[$i]);
		}

		$d1 = ($soma % 11);

		if ($d1 == 10) {
			$d1 = 0;
		}

		$soma = 0;

		// Verifica 2ï¿½ digito
		for ($i = 9, $j = 0; $i > 0; $i--, $j++) {
			$soma += ($i * $cpf[$j]);
		}

		$d2 = ($soma % 11);

		if ($d2 == 10) {
			$d2 = 0;
		}

		if ($d1 == $cpf[9] && $d2 == $cpf[10]) {
			return true;
		}
		else {
			return false;
		}

	}elseif ($_POST["submit"]=="Alterar CPF ..."){
		echo "<script> alert('CPF com formato INVï¿½LIDO!');</script>";
	}

}

function semana ($data) {

	$dta = explode("/",$data);
		$d=$dta[0];
		$m=$dta[1];
		$y=$dta[2];
		//$res = ;
	if (checkdate($m,$d,$y)) {

		$semana = 1;
		$anoatual = date ('y');
		$diafim = date ('d',mktime(1,0,0,$m+1,0,$y));

		//echo '<h1>'.$d.'/'.$m.'<br/>'.date('w',mktime(1,0,0,$m,$i,$y)).'</h1>';

		//echo '<h2>'.$semana.'</h2>';
		for ($i = 1; $i <= $diafim; $i++) {//Verifica a q semana pertence o lanï¿½amento
			//echo $d.' ++++++++++ '.$i;
			if (date('w',mktime(1,0,0,$m,$i,$y))=='1' && $semana<5) {
				$semana++;
				//echo '<h2>'.$semana.'</h2>';
			}
				if ($d==$i) {
				$sem=$semana;}
			//echo(date('d/M/Y',mktime(1,0,0,$m,$i,$y)).' <--> '.date('w',mktime(1,0,0,$m,$i,y)).' ********** ');
		}
	}
	return $sem;
}

// VERFICA CNPJ
function validaCNPJ($cnpj) {

	if (strlen($cnpj) <> 14)
		return false;

	$soma = 0;
	$soma += ($cnpj[0] * 5);
	$soma += ($cnpj[1] * 4);
	$soma += ($cnpj[2] * 3);
	$soma += ($cnpj[3] * 2);
	$soma += ($cnpj[4] * 9);
	$soma += ($cnpj[5] * 8);
	$soma += ($cnpj[6] * 7);
	$soma += ($cnpj[7] * 6);
	$soma += ($cnpj[8] * 5);
	$soma += ($cnpj[9] * 4);
	$soma += ($cnpj[10] * 3);
	$soma += ($cnpj[11] * 2);

	$d1 = $soma % 11;
	$d1 = $d1 < 2 ? 0 : 11 - $d1;

	$soma = 0;
	$soma += ($cnpj[0] * 6);
	$soma += ($cnpj[1] * 5);
	$soma += ($cnpj[2] * 4);
	$soma += ($cnpj[3] * 3);
	$soma += ($cnpj[4] * 2);
	$soma += ($cnpj[5] * 9);
	$soma += ($cnpj[6] * 8);
	$soma += ($cnpj[7] * 7);
	$soma += ($cnpj[8] * 6);
	$soma += ($cnpj[9] * 5);
	$soma += ($cnpj[10] * 4);
	$soma += ($cnpj[11] * 3);
	$soma += ($cnpj[12] * 2);


	$d2 = $soma % 11;
	$d2 = $d2 < 2 ? 0 : 11 - $d2;

	if ($cnpj[12] == $d1 && $cnpj[13] == $d2) {
		return true;
	}
	else {
		return false;
	}
}

function link_corrent ($link) {
	//
	if ($link=="top_dados") {
		echo "class='selected'";
	}elseif ($_GET["menu"]==$link) {
		echo "class='selected'";
	}
}

function link_ativo ($val_link,$variavel) {
	/*	Define se este botï¿½o ou limk ï¿½ o corrente e o define para tal com mudanï¿½a
	*	da cor de fundo. Isto deve ser definido no script de CSS
	*/
	if ($variavel==$val_link) {
			echo "id='current'";
			return 'active';
		}else {
			return '';
		}
}

function id_corrente ($val_link) {
	/*	Define se este botï¿½o ou limk ï¿½ o corrente e o define para tal com mudanï¿½a
	*	da cor de fundo. Isto deve ser definido no script de CSS
	*/
	if ((strstr($_GET["escolha"], $val_link) || strstr($_POST["escolha"],$val_link))) {
		echo "id='current'";
		return 'active';
	}else {
		return '';
	}
}

function id_left ($val_link) {
	/*	Define se este botï¿½o ou limk ï¿½ o corrente e o define para tal com mudanï¿½a
	*	da cor de fundo. Isto deve ser definido no script de CSS
	*/
	if ((strstr($_GET["escolha"], $val_link) || strstr($_POST["escolha"],$val_link))) {
		echo "class='selected' style='border-top:0;'";
		//return "teste";
	}
}

function prox_ant_ano (){
//cria link para o próximo ou o ano anterior

     if (empty($_GET["ano"]))
	  $y = date("Y");
	  else
	  $y = (int)$_GET["ano"];

     if (!empty($_GET["prox_ant"])){
     $prox_ant = (int) $_GET["prox_ant"];
     $y += $prox_ant;
     }
     $pro = $y+1;
     $ant = $y-1;
     //echo "<a href='".$_GET["escolha"]."&ano=".$y+1."'>Prï¿½ximo Ano</a>";
     echo "<div  align='center' >";
     echo "<table class='tabela' >";

     echo "<tr>";
     echo '<td colspan="3">';
     echo '<label>Congrega&ccedil;&atilde;o: </label>';
     $estnatal = new List_Igreja('igreja', 'razao','id');
     $estnatal->igreja_pop('',$_GET["id"],'escolha='.$_GET["escolha"].'&ano='.$_GET['ano'].'&id=');
     echo '</td><td><label>&nbsp;</label>';
     echo "<a href='".$_GET["escolha"]."?ano=".$_GET['ano']."&id={$_GET["id"]}&imp=2'>";
     echo '<button type="button" class="btn btn-primary btn-sm"> Imprimir Todas ';
     echo 'as Igrejas&nbsp;&nbsp;&nbsp;</button></a></td></td></tr></tr><td class="td_marcado7">';
     echo "<a href='./?escolha=".$_GET["escolha"]."&ano=".$ant."&id={$_GET["id"]}'>";
     echo "<<&nbsp;&nbsp;Ano Anterior</a>";
     echo "<td class='cabecalho'>";
     echo "Santa Ceia</td><td class='td_marcado7' >";
     echo "<a href='./?escolha=".$_GET["escolha"]."&ano=".$pro."&id={$_GET["id"]}'>";
     echo "Proximo&nbsp;Ano&nbsp;&nbsp;>></a></td>";
     echo '<td>';
     echo "<a href='".$_GET["escolha"]."?ano=".$_GET['ano']."&id={$_GET["id"]}&imp=1'>";
     echo '<button type="button" class="btn btn-primary btn-sm">Imprimir Calend&aacute;rio';
     echo '&nbsp;&nbsp;&nbsp;</button></a></td></td>';
     echo "</tr>";
     echo "</table>";
     echo "</div>";

}

function ver_nome ($val_link) {
	/*	retorna verdadeiro se link possui esta string em qualquer parte
	*/
	if (strstr($_GET["menu"], $val_link) || strstr($_POST["menu"], $val_link)) {
	 	$tes = true;
	}else {
		$tes = false;
	}

	if ((strstr($_GET["escolha"], $val_link) || strstr($_POST["escolha"],$val_link)) || $tes) {
		return true;
	}else{
		return false;
	}
}

function sim_nao ($sn) {
	if ($sn==1) {
		return "Sim";
	}else {
		return "N&atilde;o";
	}
}

function sit_espiritual ($se) {
		  switch ($se){
		  	case "1":
				return "Em Comunh&atilde;o"; break;
			case "2":
				return "Disciplinado"; break;
			default:
				return "Situa&ccedil;&atilde;o n&atilde;o definida!"; break;
		  }
}

function sexo ($sexo) {
	if (strtoupper($sexo)=="F"){
		return "feminino";
	}elseif (strtoupper($sexo)=="M"){
		return "masculino";
	}else {
		return "N&atilde;o Informado";
	}
}

function a_ou_o ($sexo) {
	if ($sexo=="F"){
		return "a";
	}elseif ($sexo=="M"){
		return "o";
	}else {
		return "N&atilde;o Informado";
	}
}

function data_extenso ($data) {
	//Fluxo para atribuir nome por extenso do dia e mï¿½s na impressï¿½o para o perï¿½odo
	$dta = explode("/","$data");
			$d = $dta[0];
			$m = $dta[1];
			$y = $dta[2];
			$ver_data = checkdate($m,$d,$y);

	if (!$ver_data){
				echo "<script> alert('data ou formato inválida! O formato ï¿½ do tipo: 00/00/0000 (dd/mm/aaaa), Você digitou: $d/$m/$y'); window.history.go(-2);</script>";
				echo "data ou formato inválida! O formato é do tipo: 00/00/0000 (dd/mm/aaaa), Você digitou: $d/$m/$y";
				break;
			}

	$dia=date("w",mktime (0,0,0,$m,$d,$y));
	switch	($dia){
		case 0: $dia_extenso="Domingo";
				break;
		case 1: $dia_extenso="Segunda-feira";
				break;
		case 2: $dia_extenso="Ter&ccedil;a-feira";
				break;
		case 3: $dia_extenso="Quarta-feira";
				break;
		case 4: $dia_extenso="Quinta-feira";
				break;
		case 5: $dia_extenso="Sexta-feira";
				break;
		case 6: $dia_extenso="S&aacute;bado";
				break;
		default: echo $dia_extenso="Dia inv&aacute;lido";
	}//fim do case para o dia

	switch	($m){
		case 1: $mes_extenso="Janeiro";
				break;
		case 2: $mes_extenso="Fevereiro";
				break;
		case 3: $mes_extenso="Março";
				break;
		case 4: $mes_extenso="Abril";
				break;
		case 5: $mes_extenso="Maio";
				break;
		case 6: $mes_extenso="Junho";
				break;
		case 7: $mes_extenso="Julho";
				break;
		case 8: $mes_extenso="Agosto";
				break;
		case 9: $mes_extenso="Setembro";
				break;
		case 10: $mes_extenso="Outubro";
				break;
		case 11: $mes_extenso="Novembro";
				break;
		case 12: $mes_extenso="Dezembro";
				break;
		default: echo $mes_extenso="Mês incorreto";
	}//fim do case para o mï¿½s

	return $dia_extenso.", ".$d." de ".$mes_extenso." de ".$y.".";
}

function arrayMeses () {
	$meses = array(
			'01' => 'Janeiro',
			'02' => 'Fevereiro',
			'03' => 'Mar&ccedil;o',
			'04' => 'Abril',
			'05' => 'Maio',
			'06' => 'Junho',
			'07' => 'Julho',
			'08' => 'Agosto',
			'09' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro'
	);
	return $meses;
}

function controle ($tipo){ //O tipo ï¿½ definido como consulta, atualizaï¿½ï¿½o, inserir, administraï¿½ï¿½o de usuï¿½rio

	$alerta = "<script> alert('Desculpe mas você não tem autorização para $tipo!');location.href='./';</script>";
	$autoriza = 0;
	if ($_POST["tabela"]=="usuario" || $_GET["tabela"]=="usuario") {

		$id = ($_POST["id"]=="") ? $_GET["id"]:$_POST["id"];
		$dados = new DBRecord("usuario", $id, "id");
		$autoriza = $_SESSION['nivel'] >= $dados->nivel ? 0 : 1;

	}

	switch ($tipo) {
		case "consulta":
			if ($_SESSION["nivel"]<5){
				echo $alerta;
				return exit;
			}
			break;
		case "atualizar":
			if ($_SESSION["nivel"]<8 || $autoriza==1){
				echo $alerta;
				return exit;
			}
			break;
		case "inserir":
			if ($_SESSION["nivel"]<7 ){
				echo $alerta;
				return exit;
			}
			break;
		case "deletar":
			if ($_SESSION["nivel"]<9 || $autoriza==1){
				echo $alerta;
				return exit;
			}
			break;
		case "admin_user":
			if ($_SESSION["nivel"]<10){
				echo $alerta;
				return exit;
			}
			break;
		case "tes":
			if ($_SESSION["setor"]<50 && $_SESSION["setor"]!=2){
				echo $alerta;
				echo "Ative o JavaScript em seu navegador!";
				return exit;
			}
			break;
		default:
			echo $alerta;
			return exit;
			break;

	}
}

function ver_cad (){
	//Verifica se o rol selecionado tem cadastro
	$ver_cadastro = new DBRecord ("membro",$_SESSION['rol'],"rol"); //Aqui serï¿½ selecionado a informaï¿½ï¿½o do campo
	if ($ver_cadastro->rol()=="" ) {
	echo "<h3>N&atilde;o h&aacute; cadastro para o Rol: {$_SESSION["rol"]}.</h3>";
	unset ($_SESSION["rol"]);
	exit;
	}
}

function form_preenchido($form_vars)
	{
		//Testa se cada variï¿½vel tem um valor
	  foreach ($form_vars as $key => $value)
	  {
		 if (!isset($key) || ($value == ''))
			return false;
	  }
	  return true;

	}

function situacao ($situacao,$rol){
	$rol = ($rol>'0') ? $rol:$_SESSION["rol"];
	switch ($situacao)
	{
		case "1":
			$estilo="Em Comunh&atilde;o";
			break;
		case "2":
			$result = mysql_query("SELECT DATE_FORMAT(data_fim,'%d/%m/%Y') AS dt_fim FROM disciplina WHERE rol = '$rol' ORDER BY id DESC LIMIT 1");

			$data = mysql_fetch_array($result);

			if ($data ["dt_fim"]!="00/00/0000")
				$estilo = "<span style='color:#FF0000'><blink>Disciplinado at&eacute;: </blink></span>".$data ["dt_fim"];
			else
				$estilo = "<span style='color:#FF0000'><blink>Disciplinado por prazo indeterminado </blink></span>";

			break;
		case "3":
			$estilo="<h1><span style='color:#FF0000'><blink>Falecido</blink></span></h1>";
			break;
		case "4":
			$estilo="<span style='color:#FF0000'><blink>Mudou de Igreja</blink></span>";
			break;
		case "5":
			$estilo="<span style='color:#FF0000'><blink>Afastou-se</blink></span>";
			break;
		case "6":
			$estilo="<span style='color:#FF0000'><blink>Transferido</blink></span>";
			break;
		default:
			$estilo="<span style='color:#006633'><blink>Corrija a comunh&atilde;o com a Igreja. Use bot&atilde;o Eclesi&aacute;stico acima!</blink></span>";
			break;

	}

	return $estilo;
	}

function toUpper($string) {
	//Converte para maï¿½uscula as vogais acentuadas
    return (strtoupper(strtr($string, 'áàãâéêíóõôúüç','ÁÀÃÂÉÊÍÓÕÔÚÜÇ' )));
    };


function extenso($valor = 0, $maiusculas = false) {

$singular = array("centavo", "real", "mil", "milh&atilde;o", "bilh&atilde;o", "trilh&atilde;o", "quatrilh&atilde;o");
$plural = array("centavos", "reais", "mil", "milh&otilde;es", "bilh&otilde;es", "trilh&otilde;es",
"quatrilh&otilde;es");

$c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
"quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
"sessenta", "setenta", "oitenta", "noventa");
$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
"dezesseis", "dezesete", "dezoito", "dezenove");
$u = array("", "um", "dois", "tr&ecirc;s", "quatro", "cinco", "seis",
"sete", "oito", "nove");

$z = 0;
$rt = "";

$valor = number_format($valor, 2, ".", ".");
$inteiro = explode(".", $valor);
for($i=0;$i<count($inteiro);$i++)
for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
$inteiro[$i] = "0".$inteiro[$i];

$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
for ($i=0;$i<count($inteiro);$i++) {
$valor = $inteiro[$i];
$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
$ru) ? " e " : "").$ru;
$t = count($inteiro)-1-$i;
$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
if ($valor == "000")$z++; elseif ($z > 0) $z--;
if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) &&
($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
}

if(!$maiusculas){
return($rt ? $rt : "zero");
} else {

if ($rt) $rt=ereg_replace(" E "," e ",ucwords($rt));
return (($rt) ? ($rt) : "Zero");
}

}

function check_transid ($id)
{
	global $db;
	$res = $db->query ("SELECT COUNT(transid) FROM transcheck WHERE transid=?",
		array($id));
	$res->fetchInto($row);
	return $row[0];
}

function add_transid ($id)
{
	global $db;
	$sth = $db->prepare ("INSERT INTO transcheck VALUE (?,now())");
	$db->execute ($sth, array($id));
}

function get_transid ()
{
	$id = mt_rand();
	while (check_transid($id)) {$id = mt_rand();}
	return $id;
}

function material ()
{
	$material = array (1=>"El&eacute;trico",2=>"Escrit&oacute;rio",3=>"Limpeza",
				4=>"M&eacute;dico",5=>"Constru&ccedil;&atilde;o Civil",6=>"Eletr&ocirc;nico",
				7=>"Som e V&iacute;deo",8=>"Inform&aacute;tica",9=>"Vestu&aacute;rio",
				10=>"Eclesi&aacute;stico",11=>"Decora&ccedil;&aatilde;o");

	return $material;

}

function periodoLimp ($mesRef) {
	/*
	 * Devolve o periodo da listagem do material de limpeza
	 */

	$mesref = ($mesRef!='') ? $mesRef:$_GET['mes'].'/'.$_GET['ano'];

	//$data = (checadata($_GET['data'])) ? $_GET['data']:date('d/m/Y');

	list($mref,$aref) = explode('/', $mesref);
	$linkperido = 'mes='.$mref.'&ano='.$aref;
	$anoAnterior = $aref-1;
	switch ($mref) {
		case 2:
			$periodo = 'Fev e Mar/';
			$anterio1 = '12/'.$anoAnterior;
			$anterio2 = '10/'.$anoAnterior;
			break;
		case 4:
			$periodo = 'Abr e Mai/';
			$anterio1 = '02/'.$aref;
			$anterio2 = '12/'.$anoAnterior;
			break;
		case 6:
			$periodo = 'Jun e Jul/';
			$anterio1 = '04/'.$aref;
			$anterio2 = '02/'.$aref;
			break;
		case 8:
			$periodo = 'Ago e Set/';
			$anterio1 = '06/'.$aref;
			$anterio2 = '04/'.$aref;
			break;
		case 10:
			$periodo = 'Out e Nov/';
			$anterio1 = '08/'.$aref;
			$anterio2 = '06/'.$aref;
			break;
		case 12:
			$periodo = 'Dez e Jan/';
			$anterio1 = '10/'.$aref;
			$anterio2 = '08/'.$aref;
			break;
		default:
			$periodo = '';
			break;
	}

	if ($periodo!='') {
		$periodos = array($periodo.$aref,$anterio1,$anterio2);
		return $periodos;
	}else {
		$periodos = array('Nenhum período definido!');
		return $periodos;
	}
}
?>
