<?php

$lines = file('input.txt');
$reindeer = array();

foreach($lines as $line) {
    if(preg_match('/(\w+) can fly (\d+) km\/s for (\d+) seconds, but then must rest for (\d+) seconds/i', $line, $matches)) {
        $reindeer[$matches[1]] = new Reindeer($matches[2], $matches[3], $matches[4]);
    }
}

class Reindeer {

    private $speed;
    private $sprintTime;
    private $restTime;
    private $resting = false;
    private $counter = 0;
    private $distance = 0;

    public function __construct($speed, $sprintTime, $restTime) {
        $this->speed = (int)$speed;
        $this->sprintTime = (int)$sprintTime;
        $this->restTime = (int)$restTime;
    }

    public function tick() {
        if(!$this->resting) {
            $this->distance += $this->speed;
            if(++$this->counter >= $this->sprintTime) {
                $this->counter = 0;
                $this->resting = true;
            }
        } elseif(++$this->counter >= $this->restTime) {
            $this->counter = 0;
            $this->resting = false;
        }
    }

    public function getDistance() {
        return $this->distance;
    }

}

$time = 2503;
$farthest = 0;
for($i = 0; $i < $time; $i++) {
    foreach($reindeer as $r) {
        $r->tick();
        $farthest = max(array($farthest, $r->getDistance()));
    }
}

echo 'Answer: ' . $farthest;
