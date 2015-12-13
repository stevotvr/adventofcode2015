<?php

$input = '3113322113';
$iterations = 50;

for($i = 0; $i < $iterations; $i++) {
    $output = '';
    $counter = 0;
    $previous = null;
    for($j = 0, $len = strlen($input) + 1; $j < $len; $j++) {
        $char = substr($input, $j, 1);
        if($previous !== null && $char !== $previous) {
            $output .= $counter . $previous;
            $counter = 0;
        }
        $previous = $char;
        $counter++;
    }
    $input = $output;
}

echo 'Answer: ' . strlen($input);
