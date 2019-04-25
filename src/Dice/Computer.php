<?php

namespace Frbr18\Dice;

class Computer extends Player
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function addRandomPoints()
    {
        $points = 0;

        if (rand(1, 100) > 70) {
            $points = rand(10, 20);
            $this->addPoints($points);
        }
    }
}
