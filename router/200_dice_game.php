<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the dice game redirect to play the game
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the session for the gamestart
    $game = new Frbr18\Dice\Gameround(5, 1);
    $player = new Frbr18\Dice\Player("Player");
    $computer = new Frbr18\Dice\Computer("Computer");
    $computer->addRandomPoints();
    $_SESSION["game"] = $game;
    $_SESSION["player"] = $player;
    $_SESSION["computer"] = $computer;
    return $app->response->redirect("dice/play");
});



/**
 * Play the game
 */
$app->router->get("dice/play", function () use ($app) {
    // Play the game
    $title = "Play the game";
    $game = $_SESSION["game"];
    $player = $_SESSION["player"];
    $computer = $_SESSION["computer"];

    $data = [
        "diceValues" => $game->rollDices(),
        "gameState" => $game->getState(),
        "player" => $player,
        "computer" => $computer
    ];

    $app->page->add("dice/play", $data);
    $app->page->add("dice/debug");

    $_SESSION["game"] = $game;
    $_SESSION["player"] = $player;
    $_SESSION["computer"] = $computer;

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->get("dice/end", function () use ($app) {
    // Play the game
    $title = "Play the game";
    $data = [
        "winner" => $_SESSION["winner"]
    ];

    $app->page->add("dice/end", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->get("dice/spara", function () use ($app) {
    $game = $_SESSION["game"];
    $player = $_SESSION["player"];
    $computer = $_SESSION["computer"];

    $computer->addRandomPoints();
    $player->addPoints($game->getPoints());

    if ($player->getPoints() >= 100) {
        $_SESSION["winner"] = $player->getName();
        return $app->response->redirect("dice/end");
    } elseif ($computer->getPoints() >= 100) {
        $_SESSION["winner"] = $computer->getName();
        return $app->response->redirect("dice/end");
    }

    $game->newRound();

    $_SESSION["game"] = $game;
    $_SESSION["player"] = $player;
    $_SESSION["computer"] = $computer;
    return $app->response->redirect("dice/play");
});
