<?php

namespace Frbr18\Dice2;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HistogramTrait2Test extends TestCase
{
    /**
     * Test to get serie
     */
    public function testGetHistogramSerie()
    {
        $dice = new DiceHistogram2();
        $this->assertEquals($dice->getHistogramSerie(), []);
    }
    /**
     * Test to get max
     */
    public function testGetHistogramMax()
    {
        $dice = new DiceHistogram2();
        $this->assertEquals($dice->getHistogramMax(), 6);
    }
    /**
     * Test to get min
     */
    public function testGetHistogramMin()
    {
        $dice = new DiceHistogram2();
        $this->assertEquals($dice->getHistogramMin(), 1);
    }
}
