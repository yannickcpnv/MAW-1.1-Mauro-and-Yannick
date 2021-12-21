<?php

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\QuestionType;

//region Variables used in page
/** @var array $values */
/** @var Take $take */
$take = $values['take'];
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
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>
    <form accept-charset="UTF-8"
          action="?action=create-take&exercise-id=<?= $exercise->id ?>"
          method="post"
    >
        <?php foreach ($questions as $index => $question): ?>
            <div class="field">
                <input name="take[answers][<?= $index ?>][question_id]" type="hidden" value="<?= $question->id ?>">
                <label for="answer_<?= $index ?>"><?= $question->label ?></label>
                <?php if ($question->question_type_id === QuestionType::SINGLE_LINE_TEXT): ?>
                    <input id="answer_<?= $index ?>"
                           name="take[answers][<?= $index ?>][value]"
                           type="text"
                    >
                <?php else: ?>
                    <textarea rows="5"
                              cols="50"
                              id="answer_<?= $index ?>"
                              name="take[answers][<?= $index ?>][value]"
                    ></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" value="Save">
        </div>
    </form>
</main>
