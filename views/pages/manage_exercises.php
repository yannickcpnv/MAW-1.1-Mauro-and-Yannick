<?php

use Looper\Models\database\entities\Exercise;

//region Variables used in page
/** @var array $values */

/** @var Exercise[] $exercisesBuilding */
$exercisesBuilding = $values["exercisesBuilding"];

/** @var Exercise[] $exercisesAnswering */
$exercisesAnswering = $values["exercisesAnswering"];

/** @var Exercise[] $exercisesClosed */
$exercisesClosed = $values["exercisesClosed"];
//endregion
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
                    foreach ($exercisesBuilding as $exercise) : ?>
                        <tr>
                            <td><?= $exercise->title ?></td>
                            <td><?php
                                if ($exercise->hasQuestions()): ?>
                                    <a title="Be ready for answers" rel="nofollow" data-method="put"
                                       href="/exercises/<?= $exercise->id ?>/complete"><i
                                          class="fa fa-comment"></i></a>
                                <?php
                                endif; ?>
                                <a title="Manage fields" href="/exercises/<?= $exercise->id ?>/edit"><i
                                      class="fa fa-edit"></i></a>
                                <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                                   class="popup-confirm"
                                   href="/exercises/<?= $exercise->id ?>/delete">
                                    <i class="fa fa-trash"></i>
                                </a>
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
                    foreach ($exercisesAnswering as $exercise) : ?>
                        <tr>
                            <td><?= $exercise->title ?></td>
                            <td>
                                <a title="Show results" href="/exercises/<?= $exercise->id ?>"><i
                                      class="fa fa-chart-bar"></i></a>
                                <a title="Close" rel="nofollow" data-method="put"
                                   href="/exercises/<?= $exercise->id ?>/close"><i class="fa
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
                    foreach ($exercisesClosed as $exercise) : ?>
                        <tr>
                            <td><?= $exercise->title ?></td>
                            <td>
                                <a title="Show results" href="/exercises/<?= $exercise->id ?>"><i
                                      class="fa fa-chart-bar"></i></a>
                                <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                                   class="popup-confirm"
                                   href="/exercises/<?= $exercise->id ?>/delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>
