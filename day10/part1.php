<?php

$input = '3113322113';
$iterations = 40;

for($i = 0; $i < $iterations; $i++) {
    $output = '';
    $counter = 0;
    $previous = null;
    $chars = str_split($input);
    $chars[] = ' ';
    foreach($chars as $char) {
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
