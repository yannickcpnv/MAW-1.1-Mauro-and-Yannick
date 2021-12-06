<?php

use Looper\Models\database\entities\Exercise;

/** @var Exercise $values ["selectedExercises"] */
/** @var Questions[] $values ["questions"] */
/** @var Take[] $values ["takes"] */
/** @var answers[] $values ["selectedExercises"] */
?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">Exercise: <a href="/?action=exercise-results&id=<?= $values["exercise"]->id ?>">voila</a></span>
    </section>
</header>
<main class="container">
    <title>ExerciseLooper</title>
    <h1><?= $values["take"]->timestamp->format('Y-m-d H:i:s e') ?></h1>
    <dl class="answer">
        <?php
        foreach ($values['questions'] as $question): ?>
            <dt><?= $question->label ?></dt>
            <dd><?= $values['answers'][$question->id]->value ?></dd>
        <?php
        endforeach; ?>
    </dl>
</main>