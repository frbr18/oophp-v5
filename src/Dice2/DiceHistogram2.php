<?php

namespace Frbr18\Dice2;

class DiceHistogram2 extends Dice implements HistogramInterface
{

    use HistogramTrait2;

    public function getHistogramMax()
    {
        return $this->getSides();
    }

    public function roll()
    {
        $this->serie[] = parent::roll();
        return $this->getLastRoll();
    }
}
