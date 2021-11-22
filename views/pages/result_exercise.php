<?php

use Looper\Models\database\entities\Exercise;

/** @var Exercise $values ["selectedExercises"] */
/** @var Questions[] $values ["questions"] */
/** @var Takes[] $values ["takes"] */
/** @var answers[] $values ["selectedExercises"] */
?>
<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">Exercise: <a
              href="/?action=exercise-results&id=<?= $values["selectedExercises"]->id ?>"><?= $values["selectedExercises"]->title ?></a></span>
    </section>
</header>
<main class="container">
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <?php
                array_map(function ($question) {
                    echo "<th><a href='/?action=questions-results&id=" . $question->id
                         . "'>$question->label</a></th>";
                }, $values["questions"]) ?>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($values["takes"] as $take): ?>
                <tr>
                    <td><a
                          href="/?action=takes-results&id=<?= $take->id ?>"><?= $take->timestamp ?></a>
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