<?php

$lines = file('input.txt');
$grid = array_fill(0, 1000, array_fill(0, 1000, false));
$regex = '/(turn on|turn off|toggle) ([0-9]+),([0-9]+) through ([0-9]+),([0-9]+)/i';
foreach($lines as $line) {
    if(preg_match($regex, $line, $matches)) {
        $action = $matches[1];
        $minX = $matches[2];
        $minY = $matches[3];
        $maxX = $matches[4];
        $maxY = $matches[5];
        for($x = $minX; $x <= $maxX; $x++) {
            for($y = $minY; $y <= $maxY; $y++) {
                switch($action) {
                    case 'turn on':
                        $grid[$x][$y] = true;
                        break;
                    case 'turn off':
                        $grid[$x][$y] = false;
                        break;
                    case 'toggle':
                        $grid[$x][$y] = !$grid[$x][$y];
                }
            }
        }
    }
}

$draw = new ImagickDraw();
$draw->setfillcolor(new ImagickPixel('white'));
foreach($grid as $x => $col) {
    foreach($col as $y => $px) {
        if($px) {
            $draw->color($x, $y, Imagick::PAINT_POINT);
        }
    }
}
$image = new Imagick();
$image->newimage(count($grid), count($grid[0]), 'black', 'png');
$image->drawimage($draw);
$image->writeimage('output.png');
