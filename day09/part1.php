<?php

$lines = file('input.txt');
$map = array();

foreach($lines as $line) {
    if(!preg_match('/(\w+) to (\w+) = (\d+)/i', $line, $matches)) {
        continue;
    }
    $l1 = $matches[1];
    $l2 = $matches[2];
    $d = (int)$matches[3];
    $map[$l1][$l2] = $d;
    $map[$l2][$l1] = $d;
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

getPermutations(array_keys($map), $permutations);
$longest = PHP_INT_MAX;
foreach($permutations as $route) {
    $distance = 0;
    for($i = 0; $i < count($route) - 1; $i++) {
        $distance += $map[$route[$i]][$route[$i + 1]];
    }
    $longest = min(array($longest, $distance));
}

echo 'Answer: ' . $longest;
