<?php
$text="XyXXXXXXXXXXXXX";
$kk=100;
$yu=1000;
a($kk,$text,$kk,(80/100)*$kk,$yu);

function a($fontSize,$inString,$h,$l,$yu){
	
/* Create some objects */
$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );

/* New image */
$image->newImage(1000, $h, $pixel);

/* Black text */
$draw->setFillColor('black');

/* Font properties */

$draw->setFontSize( $fontSize );


//$s=  strlen(inString);
/* Create text */
$image->annotateImage($draw, 0, $l, 0, $inString);

/* Give image a format */
$image->setImageFormat('png');

/* Output the image with headers */
header('Content-type: image/png');
echo $image;
	
}

?>