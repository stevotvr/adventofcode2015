<?php

$input = file_get_contents('input.txt');
$grid = array();
$x = 0;
$y = 0;
$grid[$x . 'x' . $y] = true;
foreach(str_split($input) as $move) {
    switch($move) {
        case '^':
            $y--;
            break;
        case 'v':
            $y++;
            break;
        case '>':
            $x++;
            break;
        case '<':
            $x--;
    }
    $grid[$x . 'x' . $y] = true;
}
echo 'Answer: ' . count($grid) . ' houses';
