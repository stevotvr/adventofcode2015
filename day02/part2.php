<?php

$lines = file('input.txt');
$length = 0;
foreach($lines as $line) {
    list($l, $w, $h) = explode('x', $line);
    $sides = array((int)$l, (int)$w, (int)$h);
    sort($sides);
    $length += 2 * $sides[0] + 2 * $sides[1];
    $length += $l * $w * $h;
}
echo 'Answer: ' . $length . ' ft' . PHP_EOL;
