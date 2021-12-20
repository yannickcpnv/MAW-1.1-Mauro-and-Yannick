<?php

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;

/** @var Exercise $values ["selectedExercises"] */
/** @var Question[] $values ["questions"] */
/** @var Take[] $values ["takes"] */
/** @var Answer[] $values ["selectedExercises"] */
?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">Exercise: <a
              href="/exercise-results/<?= $values["selectedExercises"]->id ?>"><?=
                $values["selectedExercises"]->title ?></a></span>
    </section>
</header>
<main class="container">
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <?php
                foreach ($values['questions'] as $question): ?>
                    <th><a
                          href='/question-results/<?= $question->id ?>'><?= $question->label ?></a>
                    </th>
                <?php
                endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($values["takes"] as $take): ?>
                <tr>
                    <td><a
                          href="/take-results/<?= $values["selectedExercises"]->id ?>/<?= $take->id ?>"><?=
                            $take->timestamp->format('Y-m-d H:i:s e') ?></a>
                    </td>
                    <?php
                    foreach ($values["questions"] as $question): ?>
                        <td class="answer"><i class="fa <?= $values["answers"][$take->id][$question->id] ?>"></i></td>
                    <?php
                    endforeach; ?>
                </tr>
            <?php
            endforeach; ?>
        </tbody>
    </table>
</main>
