<?php

$lines = file('input.txt');
$data = array();

foreach($lines as $line) {
    list($name, $props) = explode(': ', $line, 2);
    foreach(explode(', ', $props) as $prop) {
        list($k, $v) = explode(': ', $prop);
        $data[$name][$k] = (int)$v;
    }
}

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

foreach($data as $aunt => $props) {
    foreach($props as $k => $v) {
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
                if($target[$k] !== $v) {
                    continue 3;
                }
        }
    }
    echo 'Answer: ' . $aunt;
    break;
}
