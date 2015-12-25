<?php

$input = file_get_contents('input.txt');
$json = json_decode($input, true);

function sumInts(array $array) {
    if(empty($array)) {
        return 0;
    }
    $assoc = !is_int(array_keys($array)[0]);
    $sum = 0;
    foreach($array as $value) {
        if(is_array($value)) {
            $sum += sumInts($value);
        } elseif(is_int($value)) {
            $sum += $value;
        } elseif($assoc && $value === 'red') {
            return 0;
        }
    }
    return $sum;
}

echo 'Answer: ' . sumInts($json) . PHP_EOL;
