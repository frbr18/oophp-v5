<?php

namespace Frbr18\Dice2;

class Player
{
    private $points = 0;
    private $name;
    private $histogram;

    public function __construct($name = "")
    {
        $this->name = $name;
        $this->histogram = new Histogram();
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

    public function getHistogram()
    {
        return $this->histogram;
    }

    public function addDicesToHistogram($dices)
    {
        for ($i = 0; $i < count($dices); $i++) {
            $this->histogram->injectData($dices[$i]);
        }
    }
}
