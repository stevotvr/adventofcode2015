<?php

$input = file_get_contents('input.txt');
$floor = 0;
foreach(str_split($input) as $char) {
    if($char == '(') {
        $floor++;
    } elseif($char == ')') {
        $floor--;
    }
}
echo 'Answer: floor ' . $floor;
