<?php

$lines = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$grid = array();
$steps = 100;

foreach($lines as $line) {
    $row = array();
    foreach(str_split($line) as $cell) {
        $row[] = $cell === '#' ? 1 : 0;
    }
    $grid[] = $row;
}

function countNeighbors(array $grid, $r, $c) {
    $n = 0;
    $n += get($grid, $r - 1, $c - 1);
    $n += get($grid, $r - 1, $c);
    $n += get($grid, $r - 1, $c + 1);
    $n += get($grid, $r, $c - 1);
    $n += get($grid, $r, $c + 1);
    $n += get($grid, $r + 1, $c - 1);
    $n += get($grid, $r + 1, $c);
    $n += get($grid, $r + 1, $c + 1);
    return $n;
}

function get(array $grid, $r, $c) {
    return isset($grid[$r][$c]) ? $grid[$r][$c] : 0;
}

function getLightState(array $grid, $r, $c) {
    if(($r === 0 || $r === count($grid) - 1) && ($c === 0 || $c === count($grid[$r]) - 1)) {
        return 1;
    }
    $neighbors = countNeighbors($grid, $r, $c);
    if($grid[$r][$c] === 1) {
        return ($neighbors === 2 || $neighbors === 3) ? 1 : 0;
    }
    return $neighbors === 3 ? 1 : 0;
}

$num = 0;
for($i = 0; $i < $steps; $i++) {
    $newGrid = array();
    $num = 0;
    foreach($grid as $r => $row) {
        foreach($row as $c => $cell) {
            $num += $newGrid[$r][$c] = getLightState($grid, $r, $c);
        }
    }
    $grid = $newGrid;
}

echo 'Answer: ' . $num . PHP_EOL;
