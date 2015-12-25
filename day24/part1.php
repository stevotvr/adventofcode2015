<?php

$input = array();
foreach(file("input.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $value) {
    $input[] = (int)$value;
}

function getAllValidSets($targetWeight, array $packages, array &$sets, &$smallest, $weight = 0, array $set = array(), array $skipped = array()) {
    while(!empty($packages)) {
        $package = array_pop($packages);
        $newWeight = $weight + $package;
        if($newWeight > $targetWeight) {
            $skipped[] = $package;
            continue;
        }
        $newSet = $set;
        $newSet[] = $package;
        if($newWeight < $targetWeight) {
            getAllValidSets($targetWeight, $packages, $sets, $smallest, $newWeight, $newSet, $skipped);
        } else {
            $count = count($newSet);
            if($count > $smallest) {
                $skipped[] = $package;
                continue;
            }
            if(isSetValid(array_merge($packages, $skipped), $targetWeight)) {
                if($count < $smallest) {
                    $smallest = $count;
                    $sets = array();
                }
                $sets[] = $newSet;
            }
        }
        $skipped[] = $package;
    }
}

function isSetValid(array $set, $targetWeight, $weight = 0) {
    while(!empty($set)) {
        $item = array_pop($set);
        $newWeight = $weight + $item;
        if($newWeight === $targetWeight) {
            return true;
        }
        if($newWeight < $targetWeight && isSetValid($set, $targetWeight, $newWeight)) {
            return true;
        }
    }
    return false;
}

$targetWeight = array_sum($input) / 3;
$sets = array();
$smallest = PHP_INT_MAX;
getAllValidSets($targetWeight, $input, $sets, $smallest);

$lowestQE = min(array_map('array_product', $sets));

echo 'Answer: ' . $lowestQE . PHP_EOL;
