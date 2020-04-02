<?php
    session_start();
    $numOne = rand(1, 9);

    // value2
    $numTwo = rand(1, 9);

    // total
    $numero = $numOne + $numTwo;

    // math string
    $display = $numOne . ' + ' . $numTwo . ' =';

    // set session variable to total
    $_SESSION['check'] = $numero;

    $my_img = imagecreate( 130, 40 );
    $background = imagecolorallocate( $my_img, 54, 166, 61 );
    $text_colour = imagecolorallocate( $my_img, 255, 255, 255 );
    $line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
    imagestring( $my_img, 100, 30, 15, "$display", $text_colour );
    imagesetthickness ( $my_img, 5 );
    

    header( "Content-type: image/png" );
    imagepng( $my_img );
    imagecolordeallocate( $line_color );
    imagecolordeallocate( $text_color );
    imagecolordeallocate( $background );
    imagedestroy( $my_img );
?>

