<?php

use Looper\Models\database\entities\Exercise;

/** @var Exercise[] $values */
/** @var Exercise $exercise */
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
    </section>
</header>
<main class="container">
    <ul class="ansering-list">
        <?php foreach ($values["exercises"] as $exercise): ?>
            <li class="row">
                <div class="column card">
                    <div class="title"><?= $exercise->title ?></div>
                    <a class="button" href="/take-exercise/<?= $exercise->id ?>">Take it</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

