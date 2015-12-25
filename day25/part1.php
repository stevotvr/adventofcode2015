<?php

$input = array(
    'row' => 2947,
    'col' => 3029
);

$output = 20151125;
for($i = 2;; $i++) {
    for($j = 1, $k = $i; $k > 0; $j++, $k--) {
        $output = ($output * 252533) % 33554393;
        if($k === $input['row'] && $j === $input['col']) {
            break 2;
        }
    }
}

echo 'Answer: ' . $output . PHP_EOL;
