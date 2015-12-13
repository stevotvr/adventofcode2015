<?php

$lines = file('input.txt');
$area = 0;
foreach($lines as $line) {
    list($l, $w, $h) = explode('x', $line);
    $area += 2 * $l * $w;
    $area += 2 * $w * $h;
    $area += 2 * $h * $l;
    $area += min(array($l * $w, $w * $h, $h * $l));
}
echo 'Answer: ' . $area . ' sq. ft';
