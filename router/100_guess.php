<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session for the gamestart
    $game = new Frbr18\Guess\Guess();
    $_SESSION["game"] = $game;
    return $app->response->redirect("guess/play");
});


/**
* Showing message Hello World, rendered within the standard page layout.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game.";
    // Deal with incoming variables

    $game = $_SESSION["game"];
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    $number = $game->number();
    $tries = $game->tries();
    $_SESSION["guess"] = null;
    $_SESSION["res"] = null;
    $_SESSION["doCheat"] = null;

    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "number" => $number,
        "tries" => $tries
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game.";
    // Deal with incoming variables
    $guess = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $_SESSION["doCheat"] = $doCheat;
    $res = null;

    $game = $_SESSION["game"];

    if ($doGuess) {
        $res = $game->makeGuess($guess);
        $_SESSION["game"] = $game;
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    }

    return $app->response->redirect("guess/play");
});
