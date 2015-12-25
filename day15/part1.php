<?php

$lines = file('input.txt');
$data = array();
$properties = array();

foreach($lines as $line) {
    list($ing, $props) = explode(': ', $line);
    foreach(explode(', ', $props) as $prop) {
        list($name, $val) = explode(' ', $prop);
        $data[$ing][$name] = (int)$val;
        $properties[$name] = true;
    }
}
unset($properties['calories']);
$properties = array_keys($properties);

function getScore(array $data, array $props, array $amounts) {
    $score = 1;
    foreach($props as $prop) {
        $sub = 0;
        foreach($data as $name => $ing) {
            $sub += $amounts[$name] * $ing[$prop];
        }
        if($sub <= 0) {
            return 0;
        }
        $score *= $sub;
    }
    return $score;
}

function getBestRecipe($total, array $ings, array $props, &$best, array $amounts = array()) {
    $level = count($amounts);
    if($level < count($ings)) {
        $ing = array_keys($ings)[$level];
        for($i = $total; $i > 0; $i--) {
            $amounts[$ing] = $i;
            getBestRecipe($total - $i, $ings, $props, $best, $amounts);
        }
    } elseif($total === 0) {
        $best = max(array($best, getScore($ings, $props, $amounts)));
    }
}

getBestRecipe(100, $data, $properties, $best);

echo 'Answer: ' . $best . PHP_EOL;
