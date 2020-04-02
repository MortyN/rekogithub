<?php
    session_start();
    $num1 = rand(1,9);
    $num2 = rand(1,9);
    
    $_SESSION['captchaCheck'] =$num1 + $num2;
    $display = $num1."+".$num2."=";

    $my_img = imagecreate( 130, 40 );
    $background = imagecolorallocate( $my_img, 54, 166, 61 );
    $text_colour = imagecolorallocate( $my_img, 255, 255, 255 );
    $line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
    imagestring( $my_img, 10, 30, 0, "$num1 + $num2 =", $text_colour );
    imagesetthickness ( $my_img, 5 );
    

    header( "Content-type: image/png" );
    imagepng( $my_img );
    imagecolordeallocate( $line_color );
    imagecolordeallocate( $text_color );
    imagecolordeallocate( $background );
    imagedestroy( $my_img );
?>

