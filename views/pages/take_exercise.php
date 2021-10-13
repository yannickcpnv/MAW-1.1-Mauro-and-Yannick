<?php

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\QuestionType;

/** @var Exercise[] $values */
$exercise = $values['exercise'];
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">Exercise: <span class="exercise-title"><?= $exercise->title ?></span></span>
    </section>
</header>
<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>
    <form action="?action=save-take" accept-charset="UTF-8" method="post">
        <?php foreach ($exercise->questions as $key => $question): ?>
            <div class="field">
                <label for="answer_<?= $key ?>"><?= $question->label ?></label>
                <?php if ($question->question_type_id == QuestionType::SINGLE_LINE_TEXT): ?>
                    <input type="text"
                           name="answers[][value]"
                           id="answer_<?= $key ?>"
                    >
                <?php else: ?>
                    <textarea name="answers[][value]"
                              id="answer_<?= $key ?>"
                    ></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save" data-disable-with="Save">
        </div>
    </form>
</main>
