<?php 
$m = $_POST['t'];
$rw = $_POST['w'];
$rh = $_POST['h'];



$fontSize = fitTobounds($rh, 0, 'AvantGarde-Demi.ttf',$m ,$rw,$rh);
$image = new Imagick();
$pixel = new ImagickPixel( 'gray' );
$image->newImage($rw, $rh, $pixel);

$draw = new ImagickDraw();
$draw->setFillColor('black');
$draw->setFont('AvantGarde-Demi.ttf');
$draw->setFontSize( $fontSize );


$wrapped = wrap($m, $rw, $fontSize, 0, 'AvantGarde-Demi.ttf');


$testbox = imagettfbbox($fontSize, 0, 'AvantGarde-Demi.ttf', $wrapped);

$offsety = abs($testbox[7]);
$offsetx = 0;


$image->annotateImage($draw, 0, $offsety, 0, "$wrapped");
	
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