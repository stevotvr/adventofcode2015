<?php

$items = array(
    'w' => array(
        new Item('Dagger', 8, 4, 0),
        new Item('Shortsword', 10, 5, 0),
        new Item('Warhammer', 25, 6, 0),
        new Item('Longsword', 40, 7, 0),
        new Item('Greataxe', 74, 8, 0)
    ),
    'a' => array(
        new Item('Leather', 13, 0, 1),
        new Item('Chainmail', 31, 0, 2),
        new Item('Splintmail', 53, 0, 3),
        new Item('Bandedmail', 75, 0, 4),
        new Item('Platemail', 102, 0, 5),
        new Item('Empty', 0, 0, 0)
    ),
    'r' => array(
        new Item('Damage +1', 25, 1, 0),
        new Item('Damage +2', 50, 2, 0),
        new Item('Damage +3', 100, 3, 0),
        new Item('Defense +1', 20, 0, 1),
        new Item('Defense +2', 40, 0, 2),
        new Item('Defense +3', 80, 0, 3),
        new Item('Empty', 0, 0, 0),
        new Item('Empty', 0, 0, 0)
    )
);

$bossStats = array(
    'h' => 103,
    'd' => 9,
    'a' => 2
);

class Item {

    private $name;
    private $cost;
    private $damage;
    private $armor;

    public function __construct($name, $cost, $damage, $armor) {
        $this->name = $name;
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

function getCombinations(array $items, $count, array &$combos, array $combo = array()) {
    if($count === 0) {
        $combos[] = $combo;
    }
    while(count($items) > 0) {
        $newCombo = $combo;
        $newCombo[] = array_pop($items);
        getCombinations($items, $count - 1, $combos, $newCombo);
    }
}

function isWinner(array $player, array $boss) {
    $playerDamage = max(array(1, $player['d'] - $boss['a']));
    $bossDamage = max(array(1, $boss['d'] - $player['a']));
    while(true) {
        if(($boss['h'] -= $playerDamage) <= 0) {
            return true;
        }
        if(($player['h'] -= $bossDamage) <= 0) {
            return false;
        }
    }
}

$ringCombos = array();
getCombinations($items['r'], 2, $ringCombos);

$combos = array();
foreach($items['w'] as $w) {
    foreach($items['a'] as $a) {
        foreach($ringCombos as $r) {
            $combo = array_merge(array($w, $a), $r);
            $combos[] = array(
                'items' => $combo,
                'cost' => calcCost($combo)
            );
        }
    }
}

usort($combos, function($a, $b) {
    return $a['cost'] - $b['cost'];
});
foreach($combos as $combo) {
    if(isWinner(calcStats($combo['items']), $bossStats)) {
        echo 'Answer: ' . $combo['cost'];
        break;
    }
}
