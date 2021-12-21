<?php

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;

//region Variables used in page
/** @var array $values */

/** @var Exercise $selectedExercise */
$selectedExercise = $values["selectedExercise"];

/** @var Question $questions */
$questions = $values['questions'];
//endregion
?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">Exercise: <a
              href="/?action=exercise-results&id=<?= $selectedExercise->id ?>"><?= $selectedExercise->title ?></a></span>
    </section>
</header>
<main class="container">
    <table>
        <thead>
            <tr>
                Use compact() function instead of associative array
                <th>Take</th>
                <?php foreach ($questions as $question): ?>
                    <th><a
                          href='/?action=question-results&id=<?= $question->id ?>&exerciseId=<?= $selectedExercise->id ?>'><?= $question->label ?></a>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($values["takes"] as $take): ?>
                <tr>
                    <td><a
                          href="/?action=take-results&takeid=<?= $take->id ?>&exerciseid=<?= $selectedExercise->id ?>"><?=
                            $take->timestamp->format('Y-m-d H:i:s e') ?></a>
                    </td>
                    <?php
                    foreach ($questions as $question): ?>
                        <?php $value = $question->getAnswerByTakeId($take->id)->value; ?>
                        <?php if (trim($value) === ''): ?>
                            <td class="answer"><i class="fa fa-times empty"></i></td>
                        <?php elseif (strlen($value) > 9): ?>
                            <td class="answer"><i class="fa fa-check-double filled"></i></td>
                        <?php else: ?>
                            <td class="answer"><i class="fa fa-check short"></i></td>
                        <?php endif; ?>
                    <?php
                    endforeach; ?>
                </tr>
            <?php
            endforeach; ?>
        </tbody>
    </table>
</main>
