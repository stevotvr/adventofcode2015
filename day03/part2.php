<?php

$input = file_get_contents('input.txt');
$grid = array();
$grid['0x0'] = true;
$santas = array(array(0, 0), array(0, 0));
$robo = false;
$i = 0;
foreach(str_split($input) as $move) {
    $i = $robo ? 1 : 0;
    switch($move) {
        case '^':
            $santas[$i][1]--;
            break;
        case 'v':
            $santas[$i][1]++;
            break;
        case '>':
            $santas[$i][0]++;
            break;
        case '<':
            $santas[$i][0]--;
    }
    $grid[$santas[$i][0] . 'x' . $santas[$i][1]] = true;
    $robo = !$robo;
}
echo 'Answer: ' . count($grid) . ' houses';
