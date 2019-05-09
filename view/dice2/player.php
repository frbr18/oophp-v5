<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
?>
<h1><?= $player->getName() ?></h1>
<p>Du slog:</p>
<ol>
    <?php foreach ($diceValues as $value) : ?>
    <li><?= $value ?></li>
    <?php endforeach; ?>
</ol>
<?php if ($gameState) : ?>
    <p>Ledsen du fick en etta!</p>
    <p>Du har totalt <?= $player->getPoints() ?> poäng.</p>
    <a href="spara">Simulera datorn</a>
<?php else :?>
    <p>Slå igen eller spara poängen</p>
    <p>Du har totalt <?= $player->getPoints() ?> poäng.</p>
    <a href="player">Slå tärningarna</a>
    <a href="spara">Spara, kör nästa runda</a>
<?php endif; ?>
<h2>Dices Histogram</h2>
<pre><?=  $player->getHistogram()->getAsText() ?></pre>