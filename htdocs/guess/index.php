<?php
/**
 * Guess my number, a post version
 */

require __DIR__ . "/autoloader.php";
require __DIR__ . "/config.php";

// Start the named session,
// the name is based on the path to this file.
$name = preg_replace("/[^a-z\d]/i", "", __DIR__);
session_name($name);
session_start();

// Deal with incoming variables


$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

$game = $_SESSION["game"] ?? new Guess();

//var_dump($game);

if ($doInit) {
    $game = new Guess();
    $_SESSION["game"] = $game;
} elseif ($doGuess) {
    $res = $game->makeGuess($guess);
    $_SESSION["game"] = $game;
}

// Render the page
require __DIR__ . "/view/guess_my_number_post.php";
?>
<pre>
<!-- <?= var_dump($_SESSION["game"]) ?>
<?= var_dump($_POST) ?>
<?= var_dump($doInit) ?>
<?= var_dump($doGuess) ?>
<?= var_dump($doCheat) ?> -->