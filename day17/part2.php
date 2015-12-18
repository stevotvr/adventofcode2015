<?php

$data = array(11, 30, 47, 31, 32, 36, 3, 1, 5, 3, 32, 36, 15, 11, 46, 26, 28, 1, 19, 3);
rsort($data);

function countCombinations(array $data, $total, array &$counts, $num = 1) {
    while(count($data) > 0) {
        $remaining = $total - array_shift($data);
        if($remaining > 0) {
            countCombinations($data, $remaining, $counts, $num + 1);
        } elseif($remaining === 0) {
            $counts[$num]++;
        }
    }
}

$counts = array_fill(1, count($data), 0);
countCombinations($data, 150, $counts);

foreach($counts as $count) {
    if($count > 0) {
        echo 'Answer: ' . $count;
        break;
    }
}
