<?php

namespace Frbr18\Dice2;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GamroundTest extends TestCase
{
    /**
     * Test to create an gameround object
     */
    public function testCreateGameRoundObject()
    {
        $game = new Gameround();
        $this->assertInstanceOf("\Frbr18\Dice2\Gameround", $game);
    }
    /**
     * test to get the gamestate
     */
    public function testGetGameState()
    {
        $game = new Gameround();
        $state = $game->getState();
        $this->assertEquals($state, false);
    }
    /**
     * test to get the points
     */
    public function testGetPoints()
    {
        $game = new Gameround();
        $points = $game->getPoints();
        $this->assertEquals(0, $points);
    }
    /**
     * test to make a new round
     */
    public function testMakeNewRound()
    {
        $game = new Gameround();
        $game->newRound();
        $state = $game->getState();
        $this->assertEquals($state, false);
        $points = $game->getPoints();
        $this->assertEquals(0, $points);
    }
    /**
     * Test to roll som dices
     */
    public function testRollDices()
    {
        $game = new Gameround();
        $rolls = [];
        array_push($rolls, $game->rollDices());
        $this->assertEquals($rolls, $game->getLastRolls());
    }

    public function testGetDices()
    {
        $game = new Gameround();
        $dices = [];
        for ($i = 0; $i < 5; $i++) {
            array_push($dices, new DiceHistogram2());
        }
        $this->assertEquals($game->getDices(), $dices);
    }
}
