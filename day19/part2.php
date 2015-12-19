<?php

$lines = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$map = array();
$input = array_pop($lines);

foreach($lines as $line) {
    list($k, $v) = explode(' => ', $line);
    $map[$v] = $k;
}

// I thought this would help but it just broke it
//uksort($map, function($a, $b) {
//    return strlen($b) - strlen($a);
//});

// Is this supposed to work?
$steps = 0;
while($input !== 'e') {
    foreach($map as $el => $rep) {
        $pos = strpos($input, $el);
        if($pos !== false) {
            $input = substr_replace($input, $rep, $pos, strlen($el));
            $steps++;
        }
    }
}

echo 'Answer: ' . $steps;
