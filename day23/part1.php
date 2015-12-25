<?php

$input = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$r = array(
    'a' => 0,
    'b' => 0
);
$i = 0;
while($i < count($input)) {
    list($cmd, $param) = explode(' ', $input[$i], 2);
    switch($cmd) {
        case 'hlf':
            $r[$param] = (int)($r[$param] / 2);
            $i++;
            break;
        case 'tpl':
            $r[$param] *= 3;
            $i++;
            break;
        case 'inc':
            $r[$param]++;
            $i++;
            break;
        case 'jmp':
            $i += intval($param);
            break;
        case 'jie':
            list($p1, $p2) = explode(', ', $param, 2);
            if($r[$p1] % 2 === 0) {
                $i += intval($p2);
            } else {
                $i++;
            }
            break;
        case 'jio':
            list($p1, $p2) = explode(', ', $param, 2);
            if($r[$p1] === 1) {
                $i += intval($p2);
            } else {
                $i++;
            }
            break;
    }
}

echo 'Answer: ' . $r['b'] . PHP_EOL;
