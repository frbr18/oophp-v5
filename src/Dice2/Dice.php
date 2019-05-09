<?php

namespace Frbr18\Dice2;

class Dice
{
    private $throws = array();
    private $sides;
    private $lastRoll;
    /**
     * Constructor for the dice, default sides is 6
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }
    /**
     * Rolls the dice and asigns the result to lastRoll
     */
    public function roll()
    {
        $throw = rand(1, 6);
        $this->lastRoll = $throw;
        array_push($this->throws, $throw);
        return $throw;
    }
    /**
     * Return tha amount of sides the dice has
     */
    public function getSides()
    {
        return $this->sides;
    }
    /**
     * returns the sum of the last roll
     */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }
}
