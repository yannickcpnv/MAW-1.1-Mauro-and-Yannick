<?php

use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\Exercise;

/** @var Exercise $values ["selectedExercises"] */
/** @var Question $values ["selectedQuestion] */
?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">
            Exercise: <a href="/exercises/156/results"><?= $values['selectedExercise']->title ?></a>
        </span>
    </section>
</header>
<main class="container">
    <title>ExerciseLooper</title>
    <h1>ad</h1>
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($values['takes'] as $key => $take): ?>
                <tr>
                    <td><a href="/exercises/156/fulfillments/155"><?= $take->timestamp->format('Y-m-d H:i:s e') ?></a>
                    </td>
                    <td><?= $take->getAnswerFromQuestionId($values['selectedQuestion']->id)->value ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
