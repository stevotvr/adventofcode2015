<?php

$input = 'bgvyzdsv';
$number = 0;
while(true) {
    $hash = md5($input . ++$number);
    if(substr($hash, 0, 5) === '00000') {
        break;
    }
}

echo 'Answer: ' . $number . PHP_EOL;
