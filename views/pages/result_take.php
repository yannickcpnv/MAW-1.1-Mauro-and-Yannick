<?php

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\Exercise;

//region Variables used in page
/** @var array $values */

/** @var Exercise $exercise */
$exercise = $values["exercise"];

/** @var Take $take */
$take = $values["take"];

/** @var Question[] $questions */
$questions = $values['questions'];
//endregion
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?= $exercise->id ?>">
                <?= $exercise->title ?>
            </a></span>
    </section>
</header>
<main class="container">
    <title>ExerciseLooper</title>
    <h1><?= $take->timestamp->format('Y-m-d H:i:s e') ?></h1>
    <dl class="answer">
        <?php foreach ($questions as $question): ?>
            <dt><?= $question->label ?></dt>
            <dd><?= $question->getAnswerByTakeId($take->id)->value ?></dd>
        <?php endforeach; ?>
    </dl>
</main>
