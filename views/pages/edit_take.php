<?php

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\QuestionType;

//region Variables used in page
/** @var array $values */

/** @var Take $take */
$take = $values['take'] ?? null;

/** @var Exercise $exercise */
$exercise = $values['exercise'];

/** @var Question[] $questions */
$questions = $values['questions']
//endregion
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
          action="?action=edit-take&exercise-id=<?= $exercise->id ?>&take-id=<?= $take->id ?>"
          method="post"
    >
        <?php foreach ($questions as $key => $question): ?>
            <?php $answer = $question->getAnswerByTakeId($take->id) ?>
            <div class="field">
                <input name="take[answers][<?= $key ?>][questionId]" type="hidden" value="<?= $question->id ?>">
                <input name="take[answers][<?= $key ?>][id]" type="hidden" value="<?= $answer->id ?>">
                <label for="answer_<?= $key ?>"><?= $question->label ?></label>
                <?php if ($question->question_type_id === QuestionType::SINGLE_LINE_TEXT): ?>
                    <input id="answer_<?= $key ?>"
                           name="take[answers][<?= $key ?>][value]"
                           type="text"
                           value="<?= $answer->value ?>"
                    >
                <?php else: ?>
                    <textarea rows="5"
                              cols="50"
                              id="answer_<?= $key ?>"
                              name="take[answers][<?= $key ?>][value]"
                    ><?= $answer->value ?></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save">
        </div>
    </form>
</main>
