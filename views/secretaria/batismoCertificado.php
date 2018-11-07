<?PHP
setlocale( LC_ALL, 'pt_BR.ISO-8859-1', 'pt_BR', 'Portuguese_Brazil');
require_once ('../../func_class/funcoes.php');
$secretario = titleCase($_POST['secretario']);
$nome = titleCase($_POST['nome']);
$pastor = titleCase($_POST['pastor']);
$image = imagecreatefrompng('../../img/354.png');

$titleColor = imagecolorallocate($image, 0, 0, 0);
$certifColor = imagecolorallocate($image, 255, 255, 0);
$batismoColor = imagecolorallocate($image, 255, 255, 255);
$grey = imagecolorallocate($image, 100, 100, 100);

imagettftext($image, 45, 0, 120, 150, $certifColor, '../../fonts/Catamaran/Catamaran-Bold.ttf','CERTIFICADO');
imagettftext($image, 25, 0, 120, 190, $batismoColor, '../../fonts/Catamaran/Catamaran-Bold.ttf','DE BATISMO');
imagettftext($image, 32, 0, 430, 480, $titleColor, '../../fonts/Pinyon_Script/PinyonScript-Regular.ttf', $nome);
imagestring($image, 3, 840, 630, 'Desceu as águas em: '.date('d/m/Y'), $titleColor);
imagestring($image, 3, 420, 714, $secretario, $titleColor);
imagestring($image, 3, 420, 728,'Secretário', $titleColor);
imagestring($image, 3, 870, 714, $pastor, $titleColor);
imagettftext($image, 50, 0, 145, 590, $titleColor, '../../fonts/Catamaran/Catamaran-Bold.ttf', date('Y'));
imagestring($image, 3, 870, 728,'Pastor da Igreja', $titleColor);

header('Content-type: image/jpeg');

imagejpeg($image);

imagedestroy($image);
?>
