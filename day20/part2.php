<?php

$input = 29000000;

// way faster than part1 but uses too much memory

$limit = $input / 11;
$houses = array_fill(1, $limit, 0);
for($i = 1; $i < $limit; $i++) {
    for($j = $i, $k = 0; $j < $limit && $k < 50; $j += $i, $k++) {
        $houses[$j] += $i * 11;
    }
}

foreach($houses as $num => $count) {
    if($count >= $input) {
        echo 'Answer: ' . $num;
        break;
    }
}
