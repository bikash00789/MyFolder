<?php
$rw=$_POST['w'];
$rh=$_POST['h'];
$fontSize=$rh;
$fontFile = 'AvantGarde-Demi.ttf';
$text = $_POST['t'];
$fontSize = fitTobounds($fontSize, 0, $fontFile, $text, $rw, $rh);


$wrapped = wrap($text, $rw, $fontSize, 0, $fontFile);
$image = new Imagick();
$pixel = new ImagickPixel( 'gray' );

$image->newImage($rw, $rh, $pixel);
$draw = new ImagickDraw();
$draw->setFillColor('black');
$draw->setFont('AvantGarde-Demi.ttf');
$draw->setFontSize( $fontSize );

$testbox = imagettfbbox($fontSize, 0, $fontFile, $wrapped);
$offsety = abs($testbox[7]);


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

function wrap($text, $width=100, $fontSize=12, $angle=0, $fontFile=null){
		if($fontFile === null){
			$fontFile = $this->fontFile;
		}
		$ret = "";
		$arr = explode(' ', $text);
		foreach ($arr as $word){
			$teststring = $ret . ' ' . $word;
			$testbox = imagettfbbox($fontSize, $angle, $fontFile, $teststring);

			if (($testbox[2]*3/4 )> $width){
				
				$ret .= ($ret == "" ? "" : "\n") . $word;
			} else {
				
				$ret .= ($ret == "" ? "" : ' ') . $word;
			}
		}
		return $ret;
}

?>