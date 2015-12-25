<?php

$input = file_get_contents('input.txt');
$floor = 0;
$step = 1;
foreach(str_split($input) as $char) {
    if($char == '(') {
        $floor++;
    } elseif($char == ')') {
        $floor--;
    }
    if($floor == -1) {
        break;
    }
    $step++;
}
echo 'Answer: step ' . $step . PHP_EOL;
