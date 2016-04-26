<?php

//$m is string
//$s is the max height which is box height initially
//$h is the height of the box or rectangle
function fit($m,$s,$h){

	while($s>0){
		$font = new Imagick();
		$draw = new ImagickDraw();
		$draw->setFont('AvantGarde-Demi.ttf');
		$draw->setFontSize( $s );
		

		

		$font_metrics = $font->queryFontMetrics($draw, "$m");
		$text_height = $font_metrics['textHeight'] - $font_metrics['descender'];
		if($text_height<=$h){
			return $s;
			exit();
		}
		else{
			$s--;
		}
		
	}

}


?>