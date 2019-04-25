<?php

namespace Frbr18\Dice;

class Dice
{
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
        $this->lastRoll = rand(1, $this->sides);
        return $this->lastRoll;
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
