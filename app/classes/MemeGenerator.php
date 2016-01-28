<?php 

class MemeGenerator{

	public static function imagettftextoutline(&$im,$size,$angle,$x,$y,&$col,&$outlinecol,$fontfile,$text,$width, $pos, $fixsize=false) {
	    // For every X pixel to the left and the right
        $text = htmlspecialchars_decode($text, ENT_QUOTES);
	    $tb = imagettfbbox($size, $angle, $fontfile, $text);
        $w = $tb[2]-$tb[0];
        $imw = imagesx($im);
        //var_dump($w, $imw);
        if(!$fixsize){
            //reduce font size until it fits image but not less than 14px
            while($imw < $w+35){
                $size --;
                if($size < 14) break;
                $tb = imagettfbbox($size, $angle, $fontfile, $text);
                $w = $tb[2]-$tb[0];
            }
            //increase font size until it fills image, but no more than 35px
            while($imw > $w+35){
                if($size >= 35) break;
                $size ++;
                $tb = imagettfbbox($size, $angle, $fontfile, $text);
                $w = $tb[2]-$tb[0]; 
            }
            if($size > 35) {
                $size=35;
                $tb = imagettfbbox($size, $angle, $fontfile, $text);
                $w = $tb[2]-$tb[0]; 
            }    

            //Stick text to bottom of image
            if($pos == "down"){
                $imy = imagesy($im);
                $y = $imy-($size/1.6);
            }
            //Stick text to top of image
            if($pos == "up"){
                $y = $size+15;
            }
        }
        
        //centering text to image
        $x = ($imw - $w)/2;
        //split text to two lines if it cannot fit to image according to conditions above
        if($size < 14){
            $size=14;

            $firsthalf = substr($text, 0, 40);
            $posit = strrpos($firsthalf, " ");
            $firsthalf = substr($text, 0, $posit);
            $secondhalf = substr($text, $posit);
            if($pos == "up"){
                self::imagettftextoutline($im,$size,$angle,$x,$y,$col,$outlinecol,$fontfile,$firsthalf,$width, $pos, true);
                self::imagettftextoutline($im,$size,$angle,$x,$y+$size+10,$col,$outlinecol,$fontfile,$secondhalf,$width, $pos, true);    
            }
            else{
                self::imagettftextoutline($im,$size,$angle,$x,$y-$size-10,$col,$outlinecol,$fontfile,$firsthalf,$width, $pos, true);
                self::imagettftextoutline($im,$size,$angle,$x,$y,$col,$outlinecol,$fontfile,$secondhalf,$width, $pos, true);       
            }
            return;
        }
        else{
            //Draw the text
            for ($xc=$x-abs($width);$xc<=$x+abs($width);$xc++) {
                // For every Y pixel to the top and the bottom
                for ($yc=$y-abs($width);$yc<=$y+abs($width);$yc++) {
                    // Draw the text in the outline color
                    $text1 = imagettftext($im,$size,$angle,$xc,$yc,$outlinecol,$fontfile,$text);
                }
            }
            // Draw the main text
            $text2 = imagettftext($im,$size,$angle,$x,$y,$col,$fontfile,$text);    
        }
	}

    public static function addwatermark(&$im, $color, $outline, $fontfile, $width){
            $tb = imagettfbbox(10, 0, $fontfile, "http://puskice.org");
            $w = $tb[2]-$tb[0];
            $imw = imagesx($im);
            $imy = imagesy($im);
            $y = $imy-5;
            $x = $imw-$w-10;
            for ($xc=$x-abs($width);$xc<=$x+abs($width);$xc++) {
            // For every Y pixel to the top and the bottom
            for ($yc=$y-abs($width);$yc<=$y+abs($width);$yc++) {
                // Draw the text in the outline color
                $text1 = imagettftext($im,10,0,$xc,$yc,$outline,$fontfile,"http://puskice.org");
            }
        }
        // Draw the main text
        $text2 = imagettftext($im,10,0,$x,$y,$color,$fontfile,"http://puskice.org");
    }
}