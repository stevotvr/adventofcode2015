<?php

$lines = file('input.txt');
$grid = array_fill(0, 1000, array_fill(0, 1000, 0));
$regex = '/(turn on|turn off|toggle) ([0-9]+),([0-9]+) through ([0-9]+),([0-9]+)/i';
foreach($lines as $line) {
    if(preg_match($regex, $line, $matches)) {
        $action = $matches[1];
        $minX = $matches[2];
        $minY = $matches[3];
        $maxX = $matches[4];
        $maxY = $matches[5];
        for($x = $minX; $x <= $maxX; $x++) {
            for($y = $minY; $y <= $maxY; $y++) {
                switch($action) {
                    case 'turn on':
                        $grid[$x][$y]++;
                        break;
                    case 'turn off':
                        $grid[$x][$y] = max(array(0, $grid[$x][$y] - 1));
                        break;
                    case 'toggle':
                        $grid[$x][$y] += 2;
                }
            }
        }
    }
}

$brightness = 0;
foreach($grid as $row) {
    foreach($row as $col) {
        $brightness += $col;
    }
}

echo 'Answer: ' . $brightness . ' brightness';
