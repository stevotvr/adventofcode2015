<?php

$input = 'cqjxxyzz';

function increment($input) {
    $base10 = base_convert($input, 36, 10);
    $base10++;
    $output = base_convert($base10, 10, 36);
    return str_replace('0', 'a', $output);
}

function isValid($password) {
    $has3Consecutive = false;
    $numConsecutive = 1;
    $numPairs = 0;
    $numRepeats = 0;
    $prev = '';
    foreach(str_split($password) as $char) {
        if(!$has3Consecutive) {
            if(ord($char) - ord($prev) === 1) {
                $numConsecutive++;
                if($numConsecutive >= 3) {
                    $has3Consecutive = true;
                }
            } else {
                $numConsecutive = 1;
            }
        }
        if($numPairs < 2) {
            if($char === $prev) {
                $numRepeats++;
                if($numRepeats % 2 === 1) {
                    $numPairs++;
                }
            } else {
                $numRepeats = 0;
            }
        }
        $prev = $char;
    }
    return $has3Consecutive && $numPairs >= 2;
}

function getNext($input) {
    $next = $input;
    do {
        $next = increment($next);
        while(($validLen = strcspn($next, 'iol')) !== strlen($next)) {
            $next = increment(substr($next, 0, $validLen + 1)) . substr($next, $validLen + 1);
        }
    } while(!isValid($next));
    return $next;
}

echo 'Answer: ' . getNext($input) . PHP_EOL;
