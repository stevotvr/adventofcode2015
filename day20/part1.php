<?php

$input = 29000000;

// takes way too long...

set_time_limit(0);
for($i = 1;; $i++) {
    $total = $i * 10;
    for($j = 1, $l = $i / 2; $j <= $l; $j++) {
        if($i % $j === 0) {
            $total += $j * 10;
        }
    }
    if($total >= $input) {
        echo 'Answer: ' . $i;
        break 2;
    }
}
