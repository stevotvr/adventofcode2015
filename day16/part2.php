<?php

$lines = file('input.txt');
$target = array(
    'children' => 3,
    'cats' => 7,
    'samoyeds' => 2,
    'pomeranians' => 3,
    'akitas' => 0,
    'vizslas' => 0,
    'goldfish' => 5,
    'trees' => 3,
    'cars' => 2,
    'perfumes' => 1
);

foreach($lines as $line) {
    list($name, $props) = explode(': ', $line, 2);
    foreach(explode(', ', $props) as $prop) {
        list($k, $v) = explode(': ', $prop);
        switch($k) {
            case 'cats':
            case 'trees':
                if($target[$k] >= $v) {
                    continue 3;
                }
                break;
            case 'pomeranians':
            case 'goldfish':
                if($target[$k] <= $v) {
                    continue 3;
                }
                break;
            default:
                if($target[$k] != $v) {
                    continue 3;
                }
        }
    }
    echo 'Answer: ' . $name;
    break;
}
