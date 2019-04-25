<?php

namespace Frbr18\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class ComputerTest extends TestCase
{
    /**
     * Test to create an computer object
     */
    public function testCreateComputerObject()
    {
        $computer = new Computer("computer");
        $this->assertInstanceOf("Frbr18\Dice\Computer", $computer);
    }
    /** Bad attempt to test addRandomPoints */
    public function testAddRandomPoints()
    {
        $computer = new Computer("computer");
        $computer->addRandomPoints();
        $this->assertGreaterThanOrEqual(0, $computer->getPoints());
    }
}
