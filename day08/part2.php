<?php

$lines = file('input.txt');
$input = '';
$output = '';

foreach($lines as $line) {
    $line = trim($line);
    $input .= $line . PHP_EOL;
    $output .= '"';
    foreach(str_split($line) as $char) {
        if($char === '"' || $char === '\\') {
            $output .= '\\';
        }
        $output .= $char;
    }
    $output .= '"' . PHP_EOL;
}

echo 'Answer: ' . (strlen($output) - strlen($input));
