<?php

class Game {

    public static function getLowestWinCost() {
        $lowest = PHP_INT_MAX;
        self::runAllScenarios($lowest, new GameState());
        return $lowest;
    }

    private static function runAllScenarios(&$lowest, GameState $state) {
        for($i = 0; $i < count($state->spellsAvailable); $i++) {
            $newState = clone $state;
            $outcome = self::takeTurns($newState, $newState->spellsAvailable[$i]);
            if($outcome === false || $newState->getManaSpent() >= $lowest) {
                continue;
            }
            if($outcome === true) {
                $lowest = min(array($lowest, $newState->getManaSpent()));
                continue;
            }
            self::runAllScenarios($lowest, $newState);
        }
    }

    private static function takeTurns(GameState $state, Spell $spell) {
        $state->playerHealth--;
        $state->applyEffects();
        if($state->isBossDead()) {
            return true;
        }
        if(!$state->isSpellAvailable($spell)) {
            return false;
        }
        $state->castSpell($spell);
        $state->applyEffects();
        if($state->isBossDead()) {
            return true;
        }
        $state->takeDamage();
        if($state->isPlayerDead()) {
            return false;
        }
        return null;
    }

}

class GameState {

    public $bossHealth = 58;
    public $bossDamage = 9;
    public $playerHealth = 50;
    public $playerMana = 500;
    public $playerArmor = 0;
    public $spellsAvailable = array();
    private $manaSpent = 0;

    public function __construct() {
        $this->spellsAvailable = array(
            new MagicMissile(),
            new Drain(),
            new Shield(),
            new Poison(),
            new Recharge()
        );
    }

    public function __clone() {
        foreach($this->spellsAvailable as $i => $spell) {
            $this->spellsAvailable[$i] = clone $spell;
        }
    }

    public function applyEffects() {
        foreach($this->spellsAvailable as $effect) {
            if($effect instanceof Effect && $effect->isActive()) {
                $effect->apply($this);
            }
        }
    }

    public function castSpell(Spell $spell) {
        if($spell instanceof Effect) {
            $spell->activate();
        } else {
            $spell->apply($this);
        }
        $this->playerMana -= $spell->getCost();
        $this->manaSpent += $spell->getCost();
    }

    public function takeDamage() {
        $this->playerHealth -= max(array(1, $this->bossDamage - $this->playerArmor));
    }

    public function isSpellAvailable(Spell $spell) {
        if($spell instanceof Effect && $spell->isActive()) {
            return false;
        }
        return $spell->getCost() <= $this->playerMana;
    }

    public function isBossDead() {
        return $this->bossHealth <= 0;
    }

    public function isPlayerDead() {
        return $this->playerHealth <= 1;
    }

    public function getManaSpent() {
        return $this->manaSpent;
    }

}

abstract class Spell {

    public abstract function getCost();

    public abstract function apply(GameState $state);
}

abstract class Effect extends Spell {

    private $turns = 0;

    protected abstract function getDuration();

    public function activate() {
        $this->turns = $this->getDuration();
    }

    public function isActive() {
        return $this->turns > 0;
    }

    public function apply(GameState $state) {
        $this->turns--;
    }

}

class MagicMissile extends Spell {

    public function getCost() {
        return 53;
    }

    public function apply(GameState $state) {
        $state->bossHealth -= 4;
    }

}

class Drain extends Spell {

    public function getCost() {
        return 73;
    }

    public function apply(GameState $state) {
        $state->bossHealth -= 2;
        $state->playerHealth += 2;
    }

}

class Shield extends Effect {

    public function getCost() {
        return 113;
    }

    protected function getDuration() {
        return 6;
    }

    public function apply(GameState $state) {
        parent::apply($state);
        $state->playerArmor = $this->isActive() ? 7 : 0;
    }

}

class Poison extends Effect {

    public function getCost() {
        return 173;
    }

    protected function getDuration() {
        return 6;
    }

    public function apply(GameState $state) {
        parent::apply($state);
        $state->bossHealth -= 3;
    }

}

class Recharge extends Effect {

    public function getCost() {
        return 229;
    }

    protected function getDuration() {
        return 5;
    }

    public function apply(GameState $state) {
        parent::apply($state);
        $state->playerMana += 101;
    }

}

echo 'Answer: ' . Game::getLowestWinCost() . PHP_EOL;
