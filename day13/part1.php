<?php

$lines = file('input.txt');
$data = array();

foreach($lines as $line) {
    if(preg_match('/(\w+) would (gain|lose) (\d+) happiness units by sitting next to (\w+)/i', $line, $matches)) {
        $value = $matches[2] === 'gain' ? (int)$matches[3] : -(int)$matches[3];
        $data[$matches[1]][$matches[4]] = $value;
    }
}

function getPermutations(array $items, &$result, array $perms = array()) {
    if(empty($items)) {
        $result[] = $perms;
    } else {
        for($i = 0; $i < count($items); $i++) {
            $newItems = $items;
            $newPerms = $perms;
            list($item) = array_splice($newItems, $i, 1);
            $newPerms[] = $item;
            getPermutations($newItems, $result, $newPerms);
        }
    }
}

getPermutations(array_keys($data), $permutations);
$totalHappiness = -PHP_INT_MAX;
foreach($permutations as $permutation) {
    $happiness = 0;
    for($i = 0, $count = count($permutation); $i < $count; $i++) {
        $subject = $data[$permutation[$i]];
        $left = $permutation[($i === 0 ? $count : $i) - 1];
        $right = $permutation[$i === $count - 1 ? 0 : $i + 1];
        $happiness += $subject[$left] + $subject[$right];
    }
    $totalHappiness = max(array($totalHappiness, $happiness));
}

echo 'Answer: ' . $totalHappiness . PHP_EOL;
