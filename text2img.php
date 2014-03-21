<?
$string = base64_decode (@$_GET['text']);

$pointsize = 9;
$fontfile = 'extra/verdana.ttf';

$string_size = imageftbbox ($pointsize, 0, $fontfile, $string, array("linespacing" => 1));

$s_width  = $string_size [4];
$s_height = $string_size [5];

$im = imagecreate(250, 11);

$white = imagecolorallocate ($im, 255, 255, 255);
$black = imagecolorallocate ($im, 0, 0, 0);

imagefttext ($im, $pointsize, 0, 0,  0 - $s_height, $black, $fontfile, $string, array("linespacing" => 1));

header ('Content-type: image/png');

imagepng ($im);
imagedestroy ($im);
?>