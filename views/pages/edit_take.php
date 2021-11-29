<?php

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\QuestionType;

/** @var Take[] $values */
$take = $values['take'];

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
    <p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>
    <form accept-charset="UTF-8"
          action="?action=update-take&take-id=<?= $take->id ?>"
          method="post"
    >
        <?php foreach ($exercise->questions as $key => $question): ?>
            <div class="field">
                <input name="take[answers][<?= $key ?>][questionId]" type="hidden" value="<?= $question->id ?>">
                <input name="take[answers][<?= $key ?>][id]" type="hidden" value="<?= $question->answer[0]->id ?>">
                <label for="answer_<?= $key ?>"><?= $question->label ?></label>
                <?php if ($question->question_type_id == QuestionType::SINGLE_LINE_TEXT): ?>
                    <input id="answer_<?= $key ?>"
                           name="take[answers][<?= $key ?>][value]"
                           type="text"
                           value="<?= $question->answers[0]->value ?>"
                    >
                <?php else: ?>
                    <textarea id="answer_<?= $key ?>"
                              name="take[answers][<?= $key ?>][value]"
                    ><?= $question->answers[0]->value ?></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save">
        </div>
    </form>
</main>
