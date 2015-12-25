<?php

$words = file('input.txt');
$vowels = array('a', 'e', 'i', 'o', 'u');
$badPairs = array('ab', 'cd', 'pq', 'xy');
$good = 0;
foreach($words as $word) {
    $numVowels = 0;
    $hasPair = false;
    $isBad = false;
    $prevLetter = '';
    foreach(str_split($word) as $letter) {
        if(in_array($prevLetter . $letter, $badPairs)) {
            $isBad = true;
            break;
        }
        if(in_array($letter, $vowels)) {
            $numVowels++;
        }
        if(!$hasPair && $letter === $prevLetter) {
            $hasPair = true;
        }
        $prevLetter = $letter;
    }
    if(!$isBad && $hasPair && $numVowels >= 3) {
        $good++;
    }
}

echo 'Answer: ' . $good . PHP_EOL;
