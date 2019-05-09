<?php

namespace Frbr18\Dice2;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    /**
     * Creates an dice with no arguments
     */
    public function testToCreateAnDiceWithNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Frbr18\Dice2\Dice", $dice);
    }

    /**
     * Creates an dice with with arguments
     */
    public function testToCreateAnDiceWithArguments()
    {
        $dice = new Dice(3);
        $this->assertInstanceOf("\Frbr18\Dice2\Dice", $dice);
    }
    /**
     * Test to get the sides of the dice
     */
    public function testToGetSides()
    {
        $dice = new Dice();
        $sides = $dice->getSides();
        $this->assertEquals($sides, 6);
    }
    /**
     * Test roll function if it rolls between 1 and total sides
     */
    public function testRollAndGetLastRoll()
    {
        $dice = new Dice();
        $this->assertGreaterThanOrEqual(1, $dice->roll());
        $this->assertLessThanOrEqual(6, $dice->roll());
    }
    /**
     * Test to ge lastRoll
     */
    public function testGetLastRoll()
    {
        $dice = new Dice();
        $roll = $dice->roll();
        $this->assertEquals($roll, $dice->getLastRoll());
    }
}
