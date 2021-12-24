<?php

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;

//region Variables used in page
/** @var array $values */

/** @var Exercise $selectedExercise */
$selectedExercise = $values['selectedExercise'];

/** @var Take $takes */
$takes = $values['takes'];

/** @var Question $selectedQuestion */
$selectedQuestion = $values['selectedQuestion'];
//endregion
?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">
            Exercise: <a href="/exercises/<?= $selectedExercise->id ?>">
                <?= $selectedExercise->title ?>
            </a>
        </span>
    </section>
</header>
<main class="container">
    <title>ExerciseLooper</title>
    <h1><?= $values['selectedQuestion']->label ?></h1>
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($takes as $key => $take): ?>
                <tr>
                    <td><a
                          href="/exercises/<?= $selectedExercise->id ?>/takes/<?= $take->id ?>">
                            <?= $take->timestamp->format('Y-m-d H:i:s e') ?>
                        </a>
                    </td>
                    <td><?= $take->getAnswerByQuestionId($selectedQuestion->id)->value ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
