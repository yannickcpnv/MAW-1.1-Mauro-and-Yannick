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
    <form accept-charset="UTF-8"
          action="?action=save-take&exercise-id=<?= $exercise->id ?>"
          method="post"
    >
        <?php foreach ($exercise->questions as $key => $question): ?>
            <div class="field">
                <label for="answer_<?= $key ?>"><?= $question->label ?></label>
                <?php if ($question->question_type_id == QuestionType::SINGLE_LINE_TEXT): ?>
                    <input id="answer_<?= $key ?>"
                           name="take[answers][<?= $key ?>][value]"
                           type="text"
                    >
                <?php else: ?>
                    <textarea id="answer_<?= $key ?>"
                              name="take[answers][<?= $key ?>][value]"
                    ></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input data-disable-with="Save" type="submit" value="Save">
        </div>
    </form>
</main>
