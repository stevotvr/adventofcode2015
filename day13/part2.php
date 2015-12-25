<?php

$lines = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$data = array();

foreach($lines as $line) {
    if(preg_match('/(\w+) would (gain|lose) (\d+) happiness units by sitting next to (\w+)/i', $line, $matches)) {
        $value = $matches[2] === 'gain' ? (int)$matches[3] : -(int)$matches[3];
        $data[$matches[1]][$matches[4]] = $value;
    }
}

$me = 'Steve';
foreach(array_keys($data) as $key) {
    $data[$me][$key] = $data[$key][$me] = 0;
}

function getPermutations(array $items, &$result, array $perms = array()) {
    if(empty($items)) {
        $result[] = implode('|', $perms);
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
    $perm = explode('|', $permutation);
    $happiness = 0;
    for($i = 0, $count = count($perm); $i < $count; $i++) {
        $subject = $data[$perm[$i]];
        $left = $perm[($i === 0 ? $count : $i) - 1];
        $right = $perm[$i === $count - 1 ? 0 : $i + 1];
        $happiness += $subject[$left] + $subject[$right];
    }
    $totalHappiness = max(array($totalHappiness, $happiness));
}

echo 'Answer: ' . $totalHappiness . PHP_EOL;
