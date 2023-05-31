<?PHP
clearstatcache();
error_reporting(E_ALL);
ini_set('display_errors', 'off');
session_start();
setlocale( LC_ALL, 'pt_BR.ISO-8859-1', 'pt_BR', 'Portuguese_Brazil');

require_once ('../../func_class/funcoes.php');
require_once ('../../func_class/constantes.php');
require_once ('../../func_class/dbRecord.php');
// require "../../help/impressao.php";//Include de funcï¿½es, classes e conexï¿½es com o BD
$secretario_dados =  new DBRecord("membro", $_POST['secretario'], "rol");
$secretario =  utf8_decode($secretario_dados->nome());

if (isset($_POST['rol'])) {
  $dados_pessoais = new DBRecord("membro", $_POST['rol'], "rol");
  $nome = titleCase($dados_pessoais->nome);
  $dados_eclesiastico = new DBRecord("eclesiastico", $_POST['rol'], "rol");
  list($y,$m,$d) =  explode('-', $dados_eclesiastico->batismo_em_aguas);
  // $y = 2018;
  // var_dump($dt);
}else {
  $nome = utf8_decode($_POST['nome']);
  list($y,$m,$d) = explode('-', $_POST['dtbatismo']);
}
$pastor = utf8_decode($_POST['pastor']);
if ($y==2018) {
  // $image = imagecreatefrompng('../../img/354Cent.png');
  if (file_exists('../../img/certidaDeBatismoCentenario.png')) {
    $image = imagecreatefrompng('../../img/certidaDeBatismoCentenario.png');
  } else {
    $image = imagecreatefrompng('../../img/354Cent.png');
  }
} else {
  if (file_exists('../../img/certidaDeBatismo.png')) {
    $image = imagecreatefrompng('../../img/certidaDeBatismo.png');
  } else {
    $image = imagecreatefrompng('../../img/354.png');
  }
  
}


$certifico = 'Certificamos que: ';
$sexo = ($dados_pessoais->sexo()=='M' || $_POST['sexo']=='m') ? 'batizado' : 'batizada' ;

// $titleColor = imagecolorallocate($image, 0, 0, 0);
$certifColor = imagecolorallocate($image, 255, 255, 0);
$batismoColor = imagecolorallocate($image, 255, 255, 255);
$grey = imagecolorallocate($image, 100, 100, 100);

imagettftext($image, 40, 0, 770, 80, $certifColor, '../../fonts/Catamaran/Catamaran-Bold.ttf','CERTIFICADO');
imagettftext($image, 20, 0, 940, 110, $batismoColor, '../../fonts/Catamaran/Catamaran-Bold.ttf','DE BATISMO');
imagettftext($image, 32, 0, 410, 410, $titleColor, '../../fonts/Pinyon_Script/PinyonScript-Regular.ttf', $nome);
// imagepng($imgage, "../../img/Centenario2.png");

imagettftext($image, 14, 0, 500, 340, $titleColor, '../../fonts/Playfair_Display/PlayfairDisplay-Regular.ttf',$certifico);

$certCorpo = 'foi '.$sexo.' nas águas em '.$d.'/'.$m.'/'.$y.', conforme  mandamento do Senhor Jesus';
imagettftext($image, 14, 0, 400, 480, $titleColor, '../../fonts/Playfair_Display/PlayfairDisplay-Regular.ttf',$certCorpo);

$certCorpo = 'em Mateus 28.19 ';
imagettftext($image, 14, 0, 400, 520, $titleColor, '../../fonts/Playfair_Display/PlayfairDisplay-Regular.ttf',$certCorpo);

$certCorpo = '("Portanto, ide, ensinai todas as nações, batizando-as em nome';
imagettftext($image, 14, 0, 540, 520, $titleColor, '../../fonts/Playfair_Display/PlayfairDisplay-Italic.ttf',$certCorpo);
$certCorpo = 'do Pai, e  do Filho, e do Espírito Santo"). ARC';
imagettftext($image, 14, 0, 400, 560, $titleColor, '../../fonts/Playfair_Display/PlayfairDisplay-Italic.ttf',$certCorpo);
$certCorpo = '';
imagettftext($image, 14, 0, 400, 600, $titleColor, '../../fonts/Playfair_Display/PlayfairDisplay-Regular.ttf',$certCorpo);

imagestring($image, 3, 750, 630, 'Emissão: '.htmlspecialchars_decode(data_extenso (date('d/m/Y'))), $titleColor);
imagestring($image, 3, 420, 714, $secretario, $titleColor);
imagestring($image, 3, 420, 728,'Secretário', $titleColor);
imagestring($image, 3, 870, 714, $pastor, $titleColor);
if ($_POST['anoBatismo'] == 'true') {
  imagettftext($image, 50, 0, 145, 590, $titleColor, '../../fonts/Catamaran/Catamaran-Bold.ttf', $y);
}
imagestring($image, 3, 870, 728,'Pastor em '.html_entity_decode(CIDADEIG,ENT_QUOTES,'ISO-8859-1').' - '.UFIG, $titleColor);
// imagestring($image, 3, 310, 800, html_entity_decode(NOMEIGR,ENT_QUOTES,'ISO-8859-1') .' - '.html_entity_decode(CIDADEIG,ENT_QUOTES,'ISO-8859-1').' - '.UFIG, $titleColor);

header('Content-type: image/jpeg');

imagejpeg($image);

imagedestroy($image);
?>
