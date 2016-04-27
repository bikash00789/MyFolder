<?php 
$m = $_POST['t'];
$fontSize = fitTobounds(75, 0, 'AvantGarde-Demi.ttf',$m ,700,75);


//$fontSize = fitToWidth($fontSize, 0, 'AvantGarde-Demi.ttf', $m, 700);


$image = new Imagick();

$pixel = new ImagickPixel( 'gray' );
$rectangle_width = 700;
$rectangle_height = 75;
$image->newImage(700, 75, $pixel);


$draw = new ImagickDraw();
$draw->setFillColor('black');
$draw->setFont('AvantGarde-Demi.ttf');

$draw->setFontSize( $fontSize );


$wrapped = wrap($m, 700, $fontSize, 0, 'AvantGarde-Demi.ttf');

	
	$image->annotateImage($draw, 0, $fontSize, 0, "$wrapped");
	




$image->setImageFormat('png');
header('Content-type: image/png');
echo $image;







function fitToBounds($fontSize, $angle, $fontFile, $text, $width, $height){
		while($fontSize > 0){
			$wrapped = wrap($text, $width, $fontSize, $angle, $fontFile);
			$testbox = imagettfbbox($fontSize, $angle, $fontFile, $wrapped);
			$actualHeight = abs($testbox[1] - $testbox[7]);
			if($actualHeight <= $height){
				
				return $fontSize;
			}else{
				$fontSize--;
			}
		}
		return $fontSize;
}

function wrap($text, $width, $fontSize, $angle, $fontFile){
		if($fontFile === null){
			$fontFile = $this->fontFile;
		}
		$ret = "";
		$arr = explode(' ', $text);
		foreach ($arr as $word){
			$teststring = $ret . ' ' . $word;
			$testbox = imagettfbbox($fontSize, $angle, $fontFile, $teststring);
			if ($testbox[2] > $width){
				$ret .= ($ret == "" ? "" : "\n") . $word;
			} else {
				$ret .= ($ret == "" ? "" : ' ') . $word;
			}
		}
		return $ret;
	}

?>