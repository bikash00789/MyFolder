<?php



$message1 = $_POST['t'];





$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );
$rectangle_width = 800;
$rectangle_height = 75;
$image->newImage($rectangle_width, $rectangle_height, $pixel);
$draw->setFillColor('black');
$draw->setFont('AvantGarde-Demi.ttf');
$font_size = fit($message1, $rectangle_width, $rectangle_height);
$draw->setFontSize( $font_size );
$image->annotateImage($draw, 0, $rectangle_height -10, 0, "$message1");
$image->setImageFormat('png');
header('Content-type: image/png');
echo $image;

function fit($text, $actual_width, $font_size)
{
	$font = new Imagick();
	while($font_size>0){
		$draw = new ImagickDraw();
		$draw->setFont('AvantGarde-Demi.ttf');
		$draw->setFontSize( $font_size );
		$font_metrics = $font->queryFontMetrics($draw, $text);
		$text_width =  abs($font_metrics['textWidth']);
		if($text_width<=$actual_width)
			return $font_size;
		else
			$font_size--;
	}
}

?>