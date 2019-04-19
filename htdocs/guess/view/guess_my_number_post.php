<h1>Guess my number!</h1>
<p>Guess a number between 1 and 100, you have <?= $game->tries() ?> left.</p>

<form method="post">
    <input type="number" name="guess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <?= $res ?></p>

<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: the Current number is  <?= $game->number() ?>.</p>

<?php endif; ?>
<!-- <pre>
GET
<?= var_dump($_GET) ?>

SESSION
<?= var_dump($_SESSION) ?>

POST
<?= var_dump($_POST) ?> -->
