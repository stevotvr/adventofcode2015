<?php

$input = file_get_contents('input.txt');
$json = json_decode($input, true);

function sumInts(array $array) {
    $sum = 0;
    foreach($array as $value) {
        if(is_array($value)) {
            $sum += sumInts($value);
        } elseif(is_int($value)) {
            $sum += $value;
        }
    }
    return $sum;
}

echo 'Answer: ' . sumInts($json);
