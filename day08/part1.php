<?php

$input = file_get_contents('input.txt');
$output = '';

$quoteOpen = false;
$escape = false;
$escapeChars = '';
foreach(str_split($input) as $char) {
    if($escape) {
        if($char === '"' || $char === '\\') {
            $output .= $char;
            $escape = false;
        } elseif($char === 'x') {
            $escapeChars = '';
        } else {
            $escapeChars .= $char;
            if(strlen($escapeChars) === 2) {
                $output .= chr(hexdec($escapeChars));
                $escape = false;
            }
        }
    } else {
        if($char === '"') {
            $quoteOpen = !$quoteOpen;
        } elseif($char === '\\') {
            $escape = true;
        } else {
            $output .= $char;
        }
    }
}

echo 'Answer: ' . (strlen($input) - strlen($output)) . PHP_EOL;
