<?PHP
setlocale( LC_ALL, 'pt_BR.ISO-8859-1', 'pt_BR', 'Portuguese_Brazil');
require_once ('../../func_class/funcoes.php');
require_once ('../../func_class/constantes.php');
$secretario = titleCase($_POST['secretario']);
$nome = titleCase($_POST['nome']);
$pastor = titleCase($_POST['pastor']);
list($y,$m,$d) = explode('-', $_POST['dtbatismo']);
$image = imagecreatefrompng('../../img/354.png');

$certifico = 'Certificamos que: ';
$sexo = ($_POST['sexo']=='M' || $_POST['sexo']=='m') ? 'batizado' : 'batizada' ;

$titleColor = imagecolorallocate($image, 0, 0, 0);
$certifColor = imagecolorallocate($image, 255, 255, 0);
$batismoColor = imagecolorallocate($image, 255, 255, 255);
$grey = imagecolorallocate($image, 100, 100, 100);

imagettftext($image, 40, 0, 770, 80, $certifColor, '../../fonts/Catamaran/Catamaran-Bold.ttf','CERTIFICADO');
imagettftext($image, 20, 0, 940, 110, $batismoColor, '../../fonts/Catamaran/Catamaran-Bold.ttf','DE BATISMO');
imagettftext($image, 32, 0, 410, 410, $titleColor, '../../fonts/Pinyon_Script/PinyonScript-Regular.ttf', $nome);

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

imagestring($image, 3, 750, 630, 'Emissão: '.data_extenso (date('d/m/Y')), $titleColor);
imagestring($image, 3, 420, 714, $secretario, $titleColor);
imagestring($image, 3, 420, 728,'Secretário', $titleColor);
imagestring($image, 3, 870, 714, $pastor, $titleColor);
imagettftext($image, 50, 0, 145, 590, $titleColor, '../../fonts/Catamaran/Catamaran-Bold.ttf', $y);
imagestring($image, 3, 870, 728,'Pastor da Igreja em '.CIDADEIG.'-'.UFIG, $titleColor);

header('Content-type: image/jpeg');

imagejpeg($image);

imagedestroy($image);
?>
