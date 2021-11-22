<?php

use Looper\Models\database\entities\Exercise;

/** @var Exercise[]  exercisesBuilding */
/** @var Exercise[]  exercisesAnswering */
/** @var Exercise[]  exercisesClosed */
/** @var \Looper\Models\database\entities\Question[] nbQuestions */
/** @var Exercise  exercise */
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
    </section>
</header>

<main class="container">
    <title>ExerciseLooper</title>
    <div class="row">
        <section class="column">
            <h1>Building</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($values["exercisesBuilding"] as $exercise) : ?>
                        <tr>
                            <td><?= $exercise->title ?></td>
                            <td><?php
                                if ($values["nbQuestions"][$exercise->id] > 0): ?>
                                    <a title="Be ready for answers" rel="nofollow" data-method="put"
                                       href="/?action=complete-exercise&id=<?= $exercise->id ?>"><i
                                          class="fa fa-comment"></i></a>
                                <?php
                                endif; ?>
                                <a title="Manage fields" href="/?action=edit-exercise&id=<?= $exercise->id ?>"><i
                                      class="fa fa-edit"></i></a>
                                <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                                   href="/?action=delete-exercise&id=<?= $exercise->id ?>"<i
                                  class="fa fa-trash popup-confirm"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>
        </section>
        <section class="column">
            <h1>Answering</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($values["exercisesAnswering"] as $exercise) : ?>
                        <tr>
                            <td><?= $exercise->title ?></td>
                            <td>
                                <a title="Show results" href="/?action=exercises-results&id=<?= $exercise->id ?>"><i
                                      class="fa fa-chart-bar"></i></a>
                                <a title="Close" rel="nofollow" data-method="put"
                                   href="/?action=close-exercise&id=<?= $exercise->id ?>"><i class="fa
                                   fa-minus-circle"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="column">
            <h1>Closed</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($values["exercisesClosed"] as $exercise) : ?>
                        <tr>
                            <td><?= $exercise->title ?></td>
                            <td>
                                <a title="Show results" href="/?action=exercises-results&id=<?= $exercise->id ?>"><i
                                      class="fa fa-chart-bar"></i></a>
                                <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                                   href="/?action=delete-exercise&id=<?= $exercise->id ?>"><i class="fa
                                   fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>
