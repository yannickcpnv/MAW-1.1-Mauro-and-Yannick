<?php

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\QuestionType;

/** @var Take[] $values */
$take = $values['take'] ?? null;

/** @var Exercise $values */
$exercise = $values['exercise'];

/** @var Question[] $values */
$questions = $values['questions'];

/** @var Answer[] $answers */
$answers = $values['answers'];

/** @var string[] $values */
$pageMode = $values['mode'];
$isModeEdit = $pageMode == 'edit';
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png"></a>
        <span class="exercise-label">Exercise: <span class="exercise-title"><?= $exercise->title ?></span></span>
    </section>
</header>
<main class="container">
    <h1>Your take</h1>
    <?php if ($pageMode == 'edit'): ?>
        <p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>
    <?php else: ?>
        <p>If you'd like to come back later to finish, simply submit it with blanks</p>
    <?php endif; ?>
    <form accept-charset="UTF-8"
        <?php if ($pageMode == 'edit'): ?>
            action="/edit-take/<?= $exercise->id ?>/<?= $take->id ?>"
        <?php else: ?>
            action="/create-take/<?= $exercise->id ?>"
        <?php endif; ?>
          method="post"
    >
        <?php foreach ($questions as $key => $question): ?>
            <?php $value = $answers[$question->id]?->value ?? '' ?>
            <?php $id = $answers[$question->id]?->id ?? '' ?>
            <div class="field">
                <input name="take[answers][<?= $key ?>][questionId]" type="hidden" value="<?= $question->id ?>">
                <?php if ($id): ?>
                    <input name="take[answers][<?= $key ?>][id]" type="hidden" value="<?= $id ?>">
                <?php endif; ?>
                <label for="answer_<?= $key ?>"><?= $question->label ?></label>
                <?php if ($question->question_type_id == QuestionType::SINGLE_LINE_TEXT): ?>
                    <input id="answer_<?= $key ?>"
                           name="take[answers][<?= $key ?>][value]"
                           type="text"
                           value="<?= $value ?>"
                    >
                <?php else: ?>
                    <textarea rows="5"
                              cols="50"
                              id="answer_<?= $key ?>"
                              name="take[answers][<?= $key ?>][value]"
                    ><?= $value ?></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save">
        </div>
    </form>
</main>
