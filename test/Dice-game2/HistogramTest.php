<?php

namespace Frbr18\Dice2;

use PHPUnit\Framework\TestCase;

/**
 * Histogram tests
 */
class HistogramTest extends TestCase
{
    /**
     * Test if able to get series
     */
    public function testGetSeries()
    {
        $histogram = new Histogram();
        $array = [];
        $this->assertEquals($histogram->getSerie(), $array);
    }
    /**
     * Test the get text function
     */
    public function testGetAsText()
    {
        $histogram = new Histogram();
        $histogram->getAsText();
        $array = [];
        for ($i = 1; $i <= 6; $i++) {
            $array[$i] = "";
        }
        $this->assertEquals($histogram->getForTest(), $array);
    }
}
