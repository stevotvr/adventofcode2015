<?php

$lines = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$map = array();
$input = array_pop($lines);

foreach($lines as $line) {
    list($k, $v) = explode(' => ', $line);
    if(!array_key_exists($k, $map)) {
        $map[$k] = array();
    }
    $map[$k][] = $v;
}

$output = array();
foreach($map as $el => $reps) {
   $len = strlen($el);
   foreach($reps as $rep) {
        $offset = 0;
        while(($offset = strpos($input, $el, $offset)) !== false) {
            $new = substr_replace($input, $rep, $offset, $len);
            $output[$new] = true;
            $offset += $len;
        }
    }
}

echo 'Answer: ' . count($output) . PHP_EOL;
