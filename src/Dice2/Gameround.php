<?php

namespace Frbr18\Dice2;

class Gameround
{
    private $dices = [];
    private $lastRolls = [];
    private $gameState = false;
    private $points;

    public function __construct(int $dices = 5)
    {
        for ($i = 0; $i < $dices; $i++) {
            array_push($this->dices, new DiceHistogram2());
        }
    }

    public function newRound()
    {
        $this->points = 0;
        $this->gameState = false;
    }

    public function rollDices()
    {
        $rolls = [];
        $roll = 0;
        for ($i = 0; $i < count($this->dices); $i++) {
            $roll = $this->dices[$i]->roll();
            array_push($rolls, $roll);
            $this->points += $roll;
        }

        if (in_array(1, $rolls)) {
            $this->points = 0;
            $this->gameState = true;
        }
        
        array_push($this->lastRolls, $rolls);
        return $rolls;
    }

    public function getState()
    {
        return $this->gameState;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getLastRolls()
    {
        return $this->lastRolls;
    }

    public function getDices()
    {
        return $this->dices;
    }
}
