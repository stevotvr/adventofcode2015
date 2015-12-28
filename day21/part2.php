<?php

$items = array(
    'w' => array(
        new Item(8, 4, 0),
        new Item(10, 5, 0),
        new Item(25, 6, 0),
        new Item(40, 7, 0),
        new Item(74, 8, 0)
    ),
    'a' => array(
        new Item(13, 0, 1),
        new Item(31, 0, 2),
        new Item(53, 0, 3),
        new Item(75, 0, 4),
        new Item(102, 0, 5),
        new Item(0, 0, 0)
    ),
    'r' => array(
        new Item(25, 1, 0),
        new Item(50, 2, 0),
        new Item(100, 3, 0),
        new Item(20, 0, 1),
        new Item(40, 0, 2),
        new Item(80, 0, 3),
        new Item(0, 0, 0),
        new Item(0, 0, 0)
    )
);

$bossStats = array(
    'h' => 103,
    'd' => 9,
    'a' => 2
);

class Item {

    private $cost;
    private $damage;
    private $armor;

    public function __construct($cost, $damage, $armor) {
        $this->cost = $cost;
        $this->damage = $damage;
        $this->armor = $armor;
    }

    public function __get($name) {
        return $this->$name;
    }

}

function calcCost(array $items) {
    $cost = 0;
    foreach($items as $item) {
        $cost += $item->cost;
    }
    return $cost;
}

function calcStats(array $inv) {
    $d = 0;
    $a = 0;
    foreach($inv as $item) {
        $d += $item->damage;
        $a += $item->armor;
    }
    return array(
        'h' => 100,
        'a' => $a,
        'd' => $d
    );
}

function isWinner(array $player, array $boss) {
    $playerDamage = max(array(1, $player['d'] - $boss['a']));
    $bossDamage = max(array(1, $boss['d'] - $player['a']));
    return ceil($player['h'] / $bossDamage) >= ceil($boss['h'] / $playerDamage);
}

$highestCost = 0;
foreach($items['w'] as $w) {
    foreach($items['a'] as $a) {
        foreach($items['r'] as $r1) {
            foreach($items['r'] as $r2) {
                if($r1 === $r2) {
                    continue;
                }
                $playerItems = array($w, $a, $r1, $r2);
                if(!isWinner(calcStats($playerItems), $bossStats)) {
                    $highestCost = max(array($highestCost, calcCost($playerItems)));
                }
            }
        }
    }
}

echo 'Answer: ' . $highestCost;
