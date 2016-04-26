<?php
/* Create some objects */
$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );

/* New image */
$image->newImage(800, 75, $pixel);

/* Black text */
$draw->setFillColor('black');

/* Font properties */
$draw->setFont('AvantGarde-Demi.ttf');
$draw->setFontSize( 75 );

/* Create text */



$message1 = "Biyash is just a simple";

$font = new Imagick();
$font_metrics = $font->queryFontMetrics($draw, "$message1");

echo "x1 height :".$font_metrics['boundingBox']['x1']."x2 height :".$font_metrics['boundingBox']['x2'];




?>