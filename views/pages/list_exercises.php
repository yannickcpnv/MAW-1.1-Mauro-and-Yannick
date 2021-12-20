<?php

use Looper\Models\database\entities\Exercise;

//region Variables used in page
/** @var array $values */

/** @var Exercise[] $exercises */
$exercises = $values["exercises"]
//endregion
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
    </section>
</header>
<main class="container">
    <ul class="ansering-list">
        <?php foreach ($exercises as $exercise): ?>
            <li class="row">
                <div class="column card">
                    <div class="title"><?= $exercise->title ?></div>
                    <a class="button" href="?action=take-exercise&exercise-id=<?= $exercise->id ?>">Take it</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

