<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
?>
<h1><?= $computer->getName() ?></h1>
<p>Datorn slog:</p>
<ol>
    <?php foreach ($diceValues as $value) : ?>
    <li><?= $value ?></li>
    <?php endforeach; ?>
</ol>
<?php if ($gameState) : ?>
    <p>Datorn fick en etta!</p>
    <p>Datorn har totalt <?= $computer->getPoints() ?> poäng.</p>
    <a href="spara">Kör din runda.</a>
<?php else :?>
    <?php if (rand(1, 100) < $probability) : ?>
        <p>Datorn valde att slå igen.</p>
        <a href="computer">Slå för datorn.</a>
    <?php else :?>
        <p>Datorn valde att spara.</p>
        <p>Datorn har totalt <?= $computer->getPoints() ?> poäng.</p>
        <a href="spara">Kör din runda</a>
    <?php endif; ?>
<?php endif; ?>
<h2>Dices Histogram</h2>
<pre><?=  $computer->getHistogram()->getAsText() ?></pre>
