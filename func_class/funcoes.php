<?PHP
/*function conectar() {
	require_once("DB.php");

	if (file_exists("func_class/constantes.php")){
	 require_once('func_class/constantes.php');
	}elseif (file_exists('../func_class/constantes.php')){
	 require_once('../func_class/constantes.php');
	}elseif (file_exists('../../func_class/constantes.php')){
	 require_once('../../func_class/constantes.php');
	}
//	$dns = "mysql://DBUSER:DBPASS@DBPATH/DBNAME";

	$dsn = array(
    'phptype'  => 'mysql',
    'username' => DBUSER,
    'password' => DBPASS,
    'hostspec' => DBPATH,
    'database' => DBNAME,
);
$options = array(
    'debug'       => 2
);

$db =& DB::connect($dsn, $options);
if (PEAR::isError($db)) {
    die($db->getMessage());
}
	//$db =& DB::Connect ($dsn, array());
	//if (PEAR::isError($db)){ die ($db->getMessage()); }
}*/

function br_data ($dt,$cmp){
	//converte data no formato dd/mm/aaaa para aaaa-mmm-dd e em caso de erro e informado o campo $cmp
			list ($d,$m,$y) = explode('/',$dt);
			$res = checkdate($m,$d,$y);
			if ($res == 1 || $dt=="00/00/0000"){
				return $y.'-'.$m.'-'.$d;
			}else{
				echo "<script> alert('data ou formato inválida! O formato é do tipo: 00/00/0000 (dd/mm/aaaa), Você digitou: $d/$m/$y, para o Campo: $cmp'); window.history.go(-1);</script>";
				echo "data ou formato inv&aacute;lida! O formato &eacute; do tipo: 00/00/0000 (dd/mm/aaaa), Voc&ecirc; digitou: $d/$m/$y";
				exit;
			}
}

function condatabrus ($dt){
	//converte data no formato dd/mm/aaaa para aaaa-mmm-dd
	//em caso de erro ï¿½ informado o campo $cmp e retorna false
	//Sem alerta de erro
			list ($d,$m,$y) = explode('/',$dt);
			$res = checkdate($m,$d,$y);
			if ($res == 1){
				$dta="$y-$m-$d";
				return $dta;
			}else{
				return false;
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
				//Data vï¿½lida
				return true;
			}else{
				//Data invï¿½lida
				return false;
			}
}

function conv_valor_br ($data) {
		//O exemplo seguinte pega uma data no padrï¿½o ISO (AAAA-MM-DD) e retorna valor no formato DD/MM/YYYY
		if (strstr($data, ' ')) {
			list($data,$dataHora) = explode(' ', $data);
		}
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data)) {
			//ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $data, $registros)
			$registros = explode('-', $data);
			$res="$registros[2]/$registros[1]/$registros[0]";
			return $res;
		} else {
			echo "<blink><strong>Formato de data inv&aacute;lido: $data</strong> $num </blink>";
		}
}

function eventoFrequencia ($tipo,$data) {
		//Retorna a data adequda e a informaï¿½ï¿½o de periodo

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
			$cargo = array( 'Pastor', 'Pr');
		}elseif ($rec->evangelista()>"0000-00-00") {
			$cargo = array( 'Evangelista', 'Ev');
		}elseif ($rec->presbitero()>"0000-00-00") {
			$cargo = array( 'Presb&iacute;tero', 'Pb');
		}elseif ($rec->diaconato()>"0000-00-00") {
			$cargo = array( 'Di&aacute;cono', 'Dc');
		}elseif ($rec->auxiliar()>"0000-00-00") {
			$cargo = array( 'Auxiliar', 'Ax');
		}else {
			$cargo = array( 'Membro', 'Mb');
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
		return "<img src='$img' class='img-thumbnail thumb' alt='Foto do Membro' width='$width' height='$height' align='absmiddle' />";
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
		echo "<script> alert('Data não informada!');</script>";
		echo "<h1> Data n&atilde;o informada! </h1>";
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
			echo "<script> alert('Data inválida! Você digitou: $data');  location.href='$link';</script>";
			break;
		}elseif ($batismo<mktime()){
			echo "<script> alert('Data anterior a hoje! Você digitou: $data, e é alterior a data atual e deve ser hoje ou posterior! bat -> $batismo  ** atual->".mktime()."');  location.href='$link';</script>";
			break;
		}
	}else{
		echo "<script> alert('Data não informada!');</script>";
		echo "<h1> Data n&aatilde;o informada! </h1>";
	}
}

function fun_igreja ($rol){
	//retorno o nome do membro de acordo com o rol
	$membro = new DBRecord ('membro',$rol,'rol');
	return  $membro->nome();
}

function quem_entregou ($cpf){
	//retorno o nome do membro de acordo com o cpf
	$membro = new DBRecord ('usuario',$cpf,'cpf');
	return  $membro->nome();
}

function validaCPF($cpf){
  // determina um valor inicial para o digito $d1 e $d2
  // pra manter o respeito ;)
	$d1 = 0;
	$d2 = 0;
  // remove tudo que nï¿½o seja nï¿½mero
  $cpf = preg_replace("/[^0-9]/", "", $cpf);
  // lista de cpf invï¿½lidos que serï¿½o ignorados
  $ignore_list = array(
    '00000000000',
    '01234567890',
    '11111111111',
    '22222222222',
    '33333333333',
    '44444444444',
    '55555555555',
    '66666666666',
    '77777777777',
    '88888888888',
    '99999999999'
  );
  // se o tamanho da string for dirente de 11 ou estiver
  // na lista de cpf ignorados jï¿½ retorna false
  if(strlen($cpf) != 11 || in_array($cpf, $ignore_list)){
      return false;
  } else {
    // inicia o processo para achar o primeiro
    // nï¿½mero verificador usando os primeiros 9 dï¿½gitos
    for($i = 0; $i < 9; $i++){
      // inicialmente $d1 vale zero e ï¿½ somando.
      // O loop passa por todos os 9 dï¿½gitos iniciais
      $d1 += $cpf[$i] * (10 - $i);
    }
    // acha o resto da divisï¿½o da soma acima por 11
    $r1 = $d1 % 11;
    // se $r1 maior que 1 retorna 11 menos $r1 se nï¿½o
    // retona o valor zero para $d1
    $d1 = ($r1 > 1) ? (11 - $r1) : 0;
    // inicia o processo para achar o segundo
    // nï¿½mero verificador usando os primeiros 9 dï¿½gitos
    for($i = 0; $i < 9; $i++) {
      // inicialmente $d2 vale zero e ï¿½ somando.
      // O loop passa por todos os 9 dï¿½gitos iniciais
      $d2 += $cpf[$i] * (11 - $i);
    }
    // $r2 serï¿½ o resto da soma do cpf mais $d1 vezes 2
    // dividido por 11
    $r2 = ($d2 + ($d1 * 2)) % 11;
    // se $r2 mair que 1 retorna 11 menos $r2 se nï¿½o
    // retorna o valor zeroa para $d2
    $d2 = ($r2 > 1) ? (11 - $r2) : 0;
    // retona true se os dois ï¿½ltimos dï¿½gitos do cpf
    // forem igual a concatenaï¿½ï¿½o de $d1 e $d2 e se nï¿½o
    // deve retornar false.
    return (substr($cpf, -2) == $d1 . $d2) ? true : false;
  }
}

function semana ($data) {
//Semana pertence o lanï¿½amento
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

function diaSem ($data) {
#Retorna a que ordem este dia pertence no mï¿½s
#Ex.: 07/08/2016 -> retorna 1 que refere-se ao 1ï¿½ dom do mï¿½s
	$dta = explode("/",$data);
		$d=$dta[0];
		$m=$dta[1];
		$y=$dta[2];
		//$res = ;
	if (checkdate($m,$d,$y)) {
		$semana = 0;
		$anoatual = date ('y');
		$diafim = date ('d',mktime(1,0,0,$m+1,0,$y));
		$dia = date ('w',mktime(0,0,1,$m,$d,$y));
		#$dia refere-se a: 1-dom,2-seg,3-ter,4-qua,5-qui,6-sex e 7-sab
		//echo '<h1>'.$d.'/'.$m.'<br/>'.date('w',mktime(0,0,1,$m,$i,$y)).'</h1>';
		//echo '<h2>'.$semana.'</h2>';
		for ($i = 1; $i <= $diafim; $i++) {//Verifica a q semana pertence o dia
			//echo $d.' ++++++++++ '.$i;
			if (date('w',mktime(0,0,1,$m,$i,$y))==$dia) {
				$semana++;
			} elseif ($d<$i) {
				break;
			}
		}
	}
	return $semana;
}

// VERFICA CNPJ
function validaCNPJ($cnpj) {
	if (strlen($cnpj) <> 14)
		{return false;}
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
		//	echo "id='current'";
			return 'active';
		}else {
			return '';
		}
}

function li_ativo ($val_link,$variavel) {
	/*	Define se este botï¿½o ou limk ï¿½ o corrente e o define para tal com mudanï¿½a
	*	da cor de fundo. Isto deve ser definido no script de CSS
	*/
	if ($variavel==$val_link) {
			return 'class="selected" style="border-top:0;"';
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
//cria link para o prï¿½ximo ou o ano anterior
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
	$menuGet = (empty($_GET["menu"])) ? '' : $_GET["menu"] ;
	$menuPost = (empty($_POST["menu"])) ? '' : $_POST["menu"] ;
	if (strstr($menuGet, $val_link) || strstr($menuPost, $val_link)) {
	 	$tes = true;
	}else {
		$tes = false;
	}
	$escGet = (empty($_GET["escolha"])) ? '' : $_GET["escolha"] ;
	$escPost = (empty($_POST["escolha"])) ? '' : $_POST["escolha"] ;
	if ((strstr($escGet, $val_link) || strstr($escPost,$val_link)) || $tes) {
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
				echo "<script> alert('data ou formato inválida! O formato é do tipo: 00/00/0000 (dd/mm/aaaa), Você digitou: $d/$m/$y'); window.history.go(-2);</script>";
				echo "data ou formato inv&aacute;lida! O formato &eacute; do tipo: 00/00/0000 (dd/mm/aaaa), Voc&ecirc; digitou: $d/$m/$y";
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
		case 3: $mes_extenso="Mar&ccedil;o";
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
		default: echo $mes_extenso="M&ecirc;s incorreto";
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

function arrayDia ($dia) {
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
	return $dia_extenso;
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
			case "sec":
				if ($_SESSION["setor"]<9 || $autoriza==1){
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

function ver_cad ($rol){
	//Verifica se o rol selecionado tem cadastro
	$ver_cadastro = new DBRecord ("membro",$rol,"rol"); //Aqui serï¿½ selecionado a informaï¿½ï¿½o do campo
	if ($ver_cadastro->rol()=="" ) {
	echo "<h3>N&atilde;o h&aacute; cadastro para o Rol: $rol.</h3>";
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
    return (strtoupper(strtr($string, 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' )));
    }

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
			$periodo = 'Dez/'.$anoAnterior.' e Jan/';
			$anterio1 = '10/'.$anoAnterior;
			$anterio2 = '08/'.$anoAnterior;
			break;
		default:
			$periodo = '';
			break;
	}
	if ($periodo!='') {
		$periodos = array($periodo.$aref,$anterio1,$anterio2);
		return $periodos;
	}else {
		$periodos = array('Nenhum per&iacute;odo definido!');
		return $periodos;
	}
}

#Formata nï¿½mero de telefones de 8 a acima de 11 dï¿½gitos
function formatPhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);
    if(strlen($phoneNumber) > 11) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-11);
        $areaCode = substr($phoneNumber, -11, 2);
        $nonoDig = substr($phoneNumber, -9, 1);
        $nextThree = substr($phoneNumber, -8, 4);
        $lastFour = substr($phoneNumber, -4, 4);
        $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nonoDig.' '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 11) {
        $areaCode = substr($phoneNumber, 0, 2);
        $nonoDig = substr($phoneNumber, 2, 1);
        $nextThree = substr($phoneNumber, 1, 4);
        $lastFour = substr($phoneNumber, 3, 4);
        $phoneNumber = ' ('.$areaCode.') '.$nonoDig.' '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 2);
        $nextThree = substr($phoneNumber, 3, 4);
        $lastFour = substr($phoneNumber, 6, 4);
        $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 9) {
        $nonoDig = substr($phoneNumber, 0, 1);
        $nextThree = substr($phoneNumber, 1, 4);
        $lastFour = substr($phoneNumber, 3, 4);
        $phoneNumber = $nonoDig.' '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 8) {
        $nextThree = substr($phoneNumber, 0, 4);
        $lastFour = substr($phoneNumber, 3, 4);
        $phoneNumber = $nextThree.'-'.$lastFour;
    }
    return $phoneNumber;
}

#Formata nï¿½mero de CPF para exibiï¿½ï¿½o
function formatCPFNumber ($cpfNumber){
 	$cpfNumber= wordwrap($cpfNumber, 3, '.', true);
  $numero = substr($cpfNumber, 0, -3);
  $controle = substr($cpfNumber, 12, 2);
	return $numero.'-'.$controle;
}

/***************************************************************************
 * Gerador de calendï¿½rio em PHP
 * ï¿½ltima alteraï¿½ï¿½o: 28/02/2005 ï¿½s 17:37                                   *
 * Autor: Raphael Araï¿½jo e Silva - khaotix_@hotmail.com                    *
 *                                                                         *
 * ATENï¿½ï¿½O: VOCï¿½ TEM A COMPLETA PERMISSï¿½O PARA ALTERAï¿½ï¿½O E REDISTRIBUIï¿½ï¿½O  *
 *          DO Cï¿½DIGO NESTE E EM QUALQUER ARQUIVO ACOMPANHANTE DESDE QUE O *
 *          AUTOR ORIGINAL SEJA CITADO.                                    *
 ***************************************************************************/

function calcDiaSemana($dia,$mes,$ano){
  $s=(int)($ano / 100);
  $a=$ano % 100;
  if($mes<=2)
  {
   $mes+=10;
   $a--;
  }
  else $mes-=2;
  $ival=(int)(2.6*$mes-0.1);
  $q1=(int)($s / 4);
  $q2=(int)($a / 4);
  $dia_semana=($ival + $dia + $a + $q1 + $q2 - 2 * $s) % 7;
  if($dia_semana<0) $dia_semana+=7;
  	return($dia_semana);
 }

 function gerarCalend($mes,$ano,$nmeses,$ncols,$datas,$rodapes,$leg)//$feriados,$marcados,$rodapes)
 {
  if(!($mes>0 && $mes<=12 && ($nmeses>0 && $nmeses<=12) &&
      ($ncols>0 && $ncols<=12) && ($mes+$nmeses<=13)))
  {
   	$tabela="Erro ao gerar calendï¿½rio: [mï¿½s=".$mes."] [ano=".$ano.
           "] [n&uacute;mero de meses=".$nmeses."] [tabelas por linha=".$ncols."]<br>";
  }else {
   //Carrega o css do calendï¿½rio e armazena em $dados
   $arq=fopen("calendario.css","r");
   $tam=filesize("calendario.css");
   $dados=fread($arq,$tam);
   fclose($arq);
   //Coloca o css carregado no cï¿½digo do calendï¿½rio
   echo "<style type='text/css'>".$dados."</style>";

   //Calcula em que dia da semana ï¿½ o dia 1/$mes/$ano
   $dia_semana=calcDiaSemana(1,$mes,$ano);
   $bisexto=(($ano % 4 ==0) || ($ano % 100==0)); //Verifica se o ano ï¿½ bisexto
   $ndias=array(31,($bisexto ? 29 : 28),31,30,31,30,31,31,30,31,30,31); //Vetor com o nï¿½mero de dias de cada mï¿½s
   $meses=array("Janeiro","Fevereiro","Mar&ccedil;o","Abril","Maio","Junho",
                "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
   $dias=array("Dom","Seg","Ter","Qua","Qui","Sex","S&aacute;b");
   $idx=$mes-1;
   $total=$idx+$nmeses; //Total de meses a serem considerados
   $dia=$daux=$dia_semana;
    for($i=0;$i<count($datas);$i++)
     $qtd[$i]=count($datas[$i]);
   $nq=count($qtd);
   $tabela="<table class='table table-bordered'>"; //Inicia a tabela geral (que suportarï¿½ as demais tabelas de meses)
   while($idx<$total)
   {
    $tabela=$tabela."<tr>";
    for($ms=0; $ms<$ncols && $idx<$total; $ms++)
    {
     $temp_tb="<td valign='top'><table class='table'>
              <tr><td colspan=7  class='cabecalho'>".$meses[$idx].'/'.$ano.
              "</td></tr><tr>"; //Cria uma tabela para o mï¿½s atual
     for($idx2=0;$idx2<7;$idx2++) //Gera o cabeï¿½alho da tabela do mï¿½s atual
     $temp_tb=$temp_tb."<td class='td_semana'>".$dias[$idx2]."</td>";
     $temp_tb=$temp_tb."</tr>"; //Fecha o cabeï¿½alho
     $cnt_dias=1; //Inicializa o contador de dias
     $temp_ln="";
     $nl=0;
     while($cnt_dias<=$ndias[$idx]) {
      $temp_ln=$temp_ln."<tr>"; //Cria uma linha da tabela do mï¿½s atual
      for($d=0;$d<7 && $cnt_dias<=$ndias[$idx];$d++) {
			if($d>=$dia || $dia==0) {
		    $classe="";
				$maux=$idx+1;
			//A rotina abaixo verifica se o dia atual ï¿½ um feriado ou um dia marcado
			//onde $datas contï¿½m os dois vetores $feriados e $marcados
			for($i=0;$i<$nq && $classe=="";$i++)
			{
				 for($i1=0;$i1<$qtd[$i] && $classe=="";$i1++)
				 {
					  //Caso seja um intervalo de dias
					  if(strpos($datas[$i][$i1],"-")==2) {
					   $d1=substr($datas[$i][$i1],0,2); //Obtï¿½m o primeiro dia
					   $d2=substr($datas[$i][$i1],3,2); //Obtï¿½m o segundo dia
					   $m=substr($datas[$i][$i1],6,2); //Obtï¿½m o mï¿½s do intervalo
					  } else /*Caso seja um dia */ {
					   $d1=substr($datas[$i][$i1],0,2); //Obtï¿½m o dia
				  	   $d2=0;
					   $m=substr($datas[$i][$i1],3,2); //Obtï¿½m o mï¿½s
					  }
					  //Atribui uma classe CSS ï¿½ cï¿½lula (dia) atual da tabela caso
					  //o mï¿½s atual $maux seja igual ao mï¿½s obtido de um dos vetores $m ($feriado
					  // ou $marcado)
					  //Verifica se o dia atual $cnt_dias estï¿½ no intervalo de dias ou se ï¿½ igual
					  //ao dia obtido
				   	  if($m==$maux && (($cnt_dias>=$d1 && $cnt_dias<=$d2) ||
					    ($cnt_dias==$d1))) {
					    $classe="td_marcado".($i+1);//$valor[$i];
						$marcaDia .= '<span class="'.$classe.'" >&bull;</span>';
						}
				 }
			}
			if($classe=="") //Caso a classe ainda nï¿½o esteja definida apï¿½s o for acima
			 $classe=($d==0) ? "td_dia":"td_marcado0" ;
			//Cria a cï¿½lula referente ao dia atual
			if ($marcaDia!='') {
				$diaAtual = '<a href="data='.$cnt_dias.'"><strong>'.$cnt_dias++.'</strong></a>';
			} else {
				$diaAtual = $cnt_dias++;
			}
			$temp_ln=$temp_ln."<td class='td_marcado0'>".$diaAtual.'<br />'.$marcaDia.'</td>';
			$marcaDia = '';
	        $daux++;
	        if($daux>6) $daux=0;
       }
       else $temp_ln=$temp_ln."<td>&nbsp</td>";
      }
      $nl++;
      $temp_ln=$temp_ln."</tr>";
      $dia=0;
     }
     if($nl==5) $temp_ln=$temp_ln."<tr><td colspan=7>&nbsp;</td></tr>";
     $temp_tb=$temp_tb.$temp_ln;
     $k=$idx-($mes-1);
     if($rodapes[$k]!="") //Gera um rodapï¿½ para a tabela de mï¿½s
     {
      $temp_tb=$temp_tb."<tr><td colspan=7 class='rodape'>".$rodapes[$k].
               "</td></tr></table><br></td>";
     }
     else $temp_tb=$temp_tb."</table></td>";
     $tabela=$tabela.$temp_tb;
     $dia=$daux;
     $idx++; //Passa para o prï¿½ximo mï¿½s
    }
    $tabela=$tabela."</tr>";
   }
   #Legenda
  /* $legenda="<table class='table'><tr><td class='cabecalho' colspan=2>Legenda</td></tr>";
   for($i=1;$i<=$nq;$i++)
    $legenda  =$legenda."<tr><td class='td_marcado".$i."'>&nbsp;</td><td class='td_leg'>";
	$legenda .=$leg[$i-1]."</td></tr>";
   $tabela=$tabela.$legenda."</table>";*/
   $tabela=$tabela."</table>";
  }
  return($tabela);
 }

 function formataNumBanco ($numero) {
 	//Fomata nï¿½mero retirando a virgula e substituido por ponto
 	//Dando prioridade para a vï¿½rgula. Verificando no final da string
 	$numero = trim($numero);
	$fileVirg  = substr(strrchr($numero, ","), 0);
		//echo $fileVirg . "  fileVirg <br>";
	$virgula = strlen($fileVirg);
	$filePonto  = substr(strrchr($numero, "."), 0);
	//	echo $filename . "  filename <br>";
	$ponto = strlen($filePonto);
			//echo $quantRetira . " quantRetira <br>";
	$listCar = array('.',',');
	$texto = "programador";
	if ($virgula <='3' && $virgula >'1') {
		//echo substr($texto, 0,-$quantRetira) . " ** substr <br>";
		$file3 = substr($numero, 0,-$virgula);
		//echo $file3. " ** file3  <br>";
		$filename2  = substr(strrchr($numero, ","), 1);
		$listCar = array('.',',');
		$file4 = str_replace($listCar, '', $file3);
		//echo $filename2. " ** filename2  <br>";
		return $file4.'.'.$filename2;
	} elseif ($ponto<='3' && $ponto>'1') {
		//echo substr($texto, 0,-$quantRetira) . " ** substr <br>";
		$file3 = substr($numero, 0,-$ponto);
		//echo $file3. " ** file3  <br>";
		$filename2  = substr(strrchr($numero, "."), 1);
		$file4 = str_replace($listCar, '', $file3);
		//echo $filename2. " ** filename2  <br>";
		return $file4.'.'.$filename2;
	} else {
		$file4 = str_replace($listCar, '', $numero );
		return $file4;
	}
}
/**
 * Converte de numero arabico para romano
 * @param int $numero numero arabico
 * @return string numero romano em letras maiusculas
 * Autor Rubens Takiguti Ribeiro - http://rubsphp.blogspot.com.br
 */
function nRomano($numero) {
    if ($numero <= 0 || $numero > 3999) {
        return $numero;
    }
    $n = (int)$numero;
    $y = '';
    // Nivel 1
    while (($n / 1000) >= 1) {
        $y .= 'M';
        $n -= 1000;
    }
    if (($n / 900) >= 1) {
        $y .= 'CM';
        $n -= 900;
    }
    if (($n / 500) >= 1) {
        $y .= 'D';
        $n -= 500;
    }
    if (($n / 400) >= 1) {
        $y .= 'CD';
        $n -= 400;
    }
    // Nivel 2
    while (($n / 100) >= 1) {
        $y .= 'C';
        $n -= 100;
    }
    if (($n / 90) >= 1) {
        $y .= 'XC';
        $n -= 90;
    }
    if (($n / 50) >= 1) {
        $y .= 'L';
        $n -= 50;
    }
    if (($n / 40) >= 1) {
        $y .= 'XL';
        $n -= 40;
    }
    // Nivel 3
    while (($n / 10) >= 1) {
        $y .= 'X';
        $n -= 10;
    }
    if (($n / 9) >= 1) {
        $y .= 'IX';
        $n -= 9;
    }
    if (($n / 5) >= 1) {
        $y .= 'V';
        $n -= 5;
    }
    if (($n / 4) >= 1) {
        $y .= 'IV';
        $n -= 4;
    }
    // Nivel 4
    while ($n >= 1) {
        $y .= 'I';
        $n -= 1;
    }
    return $y;
}
?>
