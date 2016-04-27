<?php







$message1 = "this is my \nstory in\n my way";


$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );
$rectangle_width = 800;
$rectangle_height = 75;
$image->newImage($rectangle_width, $rectangle_height, $pixel);
$draw->setFillColor('black');
$draw->setFont('AvantGarde-Demi.ttf');

var_dump($testbox = imagettfbbox(75, 0, 'AvantGarde-Demi.ttf', $message1));

$font_size = fit($message1, $rectangle_width, $rectangle_height);

// $fh = getHeight($message1,$rectangle_height,$rectangle_height);

// $newlinecount = explode("\n",$message1);

//  count($newlinecount);

// echo $fh*count($newlinecount);
// // $draw->setFontSize( $font_size );
// // $image->annotateImage($draw, 0, $rectangle_height -10, 0, "$message1");
// // $image->setImageFormat('png');
// // header('Content-type: image/png');
// // echo $image;

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
function getHeight($m,$s,$h){

	
		$font = new Imagick();
		$draw = new ImagickDraw();
		$draw->setFont('AvantGarde-Demi.ttf');
		$draw->setFontSize( $s );
		

		

		$font_metrics = $font->queryFontMetrics($draw, "$m");
		$text_height = $font_metrics['boundingBox']['y2'] - $font_metrics['boundingBox']['y1'];
		
			return $s;
		
	

}

?>