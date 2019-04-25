<?php

namespace Frbr18\Dice;

class Player
{
    private $points = 0;
    private $name;

    public function __construct($name = "")
    {
        $this->name = $name;
    }

    public function addPoints($points)
    {
        $this->points += $points;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getName()
    {
        return $this->name;
    }
}
