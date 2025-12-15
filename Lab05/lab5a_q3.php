<?php
function calculateArea($length, $width) {
    return $length * $width;
}

$length = 10;
$width = 5;
$area = calculateArea($length, $width);

echo "The area of the rectangle with a width of $width and length of $length is $area";
?>
