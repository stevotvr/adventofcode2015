<?php

$data = array(11, 30, 47, 31, 32, 36, 3, 1, 5, 3, 32, 36, 15, 11, 46, 26, 28, 1, 19, 3);
rsort($data);

function countCombinations(array $data, $total, &$count) {
    while(count($data) > 0) {
        $remaining = $total - array_shift($data);
        if($remaining > 0) {
            countCombinations($data, $remaining, $count);
        } elseif($remaining === 0) {
            $count++;
        }
    }
}

countCombinations($data, 150, $count);

echo 'Answer: ' . $count . PHP_EOL;
