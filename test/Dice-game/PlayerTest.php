<?php

namespace Frbr18\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class PlayerTest extends TestCase
{
    /**
     * Test if able to create an player with no arguments
     */
    public function testCreatePlayerWithNoArguments()
    {
        $player = new Player();
        $this->assertInstanceOf("\Frbr18\Dice\Player", $player);
    }
    /**
     * test if able to create a player withh argument
     */
    public function testCreatePlayerWithArgument()
    {
        $player = new Player("player");
        $this->assertInstanceOf("\Frbr18\Dice\Player", $player);
    }
    /**
     * Tests if able to add points to the player
     */
    public function testAddPointsAndGetPoints()
    {
        $player = new Player();
        $player->addPoints(20);
        $points = $player->getPoints();
        $this->assertEquals($points, 20);
    }
    /**
     * Test if able to get the player name
     */
    public function testGetPlayerName()
    {
        $player = new Player("namn");
        $name = $player->getName();
        $this->assertEquals($name, "namn");
    }
}
