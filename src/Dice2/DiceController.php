<?php

namespace Frbr18\Dice2;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";

    //     // Use $this->app to access the framework services.
    // }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index";
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction()
    {
        // Init the session for the gamestart
        $session = $this->app->session;
        $this->app->session->set("who", true);
        $game = new Gameround(5, 1);
        $player = new Player("Player");
        $computer = new Computer("Computer");
        $computer->addRandomPoints();

        $session->set("game", $game);
        $session->set("player", $player);
        $session->set("computer", $computer);
        return $this->app->response->redirect("dice2/player");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playerActionGet()
    {
        // Play the game
        $title = "Play the game 2";
        $session = $this->app->session;
        $game = $session->get("game");
        $player = $session->get("player");
        $computer = $session->get("computer");
        $who = $session->get("who");

        $data = [
            "diceValues" => $game->rollDices(),
            "gameState" => $game->getState(),
            "player" => $player,
            "computer" => $computer
        ];
        $player->addDicesToHistogram($game->getDices());
        $this->app->page->add("dice2/player", $data);
        //$this->app->page->add("dice2/debug");
        $session->set("game", $game);
        $session->set("player", $player);
        $session->set("computer", $computer);
        $session->set("who", $who);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

     /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function computerActionGet()
    {
        // Play the game
        $title = "Play the game 2";
        $session = $this->app->session;
        $who = $session->get("who");
        $game = $session->get("game");
        $player = $session->get("player");
        $computer = $session->get("computer");
        $probability = 0;

        if ($player->getPoints() > $computer->getPoints()) {
            $probability = $player->getPoints() - $computer->getPoints();
        }

        $data = [
            "diceValues" => $game->rollDices(),
            "gameState" => $game->getState(),
            "player" => $player,
            "computer" => $computer,
            "probability" => $probability
        ];
        $computer->addDicesToHistogram($game->getDices());
        $this->app->page->add("dice2/computer", $data);
        //$this->app->page->add("dice2/debug");

        $session->set("game", $game);
        $session->set("player", $player);
        $session->set("computer", $computer);
        $session->set("who", $who);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function sparaAction() 
    {
        $session = $this->app->session;
        $game = $session->get("game");
        $player = $session->get("player");
        $computer = $session->get("computer");
        $who = $session->get("who");
        if ($who) {
            $who = false;
            $player->addPoints($game->getPoints());
        } else {
            $who = true;
            $computer->addPoints($game->getPoints());
        }
        

        if ($player->getPoints() >= 100) {
            $session->set("winner", $player->getName());
            return $this->app->response->redirect("dice2/end");
        } elseif ($computer->getPoints() >= 100) {
            $session->set("winner", $computer->getName());
            return $this->app->response->redirect("dice2/end");
        }

        $game->newRound();

        $session->set("game", $game);
        $session->set("player", $player);
        $session->set("computer", $computer);
        $session->set("who", $who);
        if ($who) {
            return $this->app->response->redirect("dice2/player");
        }
        return $this->app->response->redirect("dice2/computer");
    }
    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function endAction()
    {
        // Play the game
        $session = $this->app->session;
        $title = "Play the game";
        $data = [
            "winner" => $session->get("winner")
        ];

        $this->app->page->add("dice2/end", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
