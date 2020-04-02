<?php
    session_start();
    $num1 = rand(1,9);
    $num2 = rand(1,9);
    
    $_SESSION['captchaCheck'] =$num1 + $num2;
    $display = $num1."+".$num2."=";

    $img = imagecreate( 75, 38 );

    // choose a bg color, you can play with the rgb values
    // imagecolorallocate( [image], [red], [green], [blue] )
    $background = imagecolorallocate( $img, 54, 166, 61 );

    //chooses the text color
    // imagecolorallocate( [image], [red], [green], [blue] )
    $text_colour = imagecolorallocate( $img, 255, 255, 255);

    //pulls the value passed in the URL
    $text = $display;

    // place the font file in the same dir level as the php file
    putenv('GDFONTPATH=' . realpath('.'));
    $font = "Vogue.ttf";
    

    //this function sets the font size, places to the co-ords
    // imagettftext( [image], [size], [angle], [x], [y], [color], [fontfile], [text] )
    imagettftext($img, 16, 0, 0, 26, $text_colour, $font, $text);

    //alerts the browser abt the type of content i.e. png image
    header( 'Content-type: image/png' );
    //now creates the image
    imagepng( $img );

    //destroys used resources
    imagecolordeallocate( $text_color );
    imagecolordeallocate( $background );
    imagedestroy( $img );
?>