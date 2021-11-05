<?php

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\QuestionType;

/** @var array $values */
?>
<header class="heading managing">
    <section class="container">
        <a href="/">
            <img src="views/assets/logo/logo.png">
        </a>
        <span class="exercise-label">Exercise:
            <a
              href="/?action=edit-question&id=<?= $values["selectedExercise"]->id ?>">
                <?= $values["selectedExercise"]->name ?>
            </a>
        </span>
    </section>
</header>
<main class="container">
    <h1>Editing Field</h1>
    <form action="/?action=edit-question&id=<?= $values["selectedQuestion"]->id ?>" accept-charset="UTF-8"
          method="post">
        <div class="field">
            <label for="field_label">Label</label>
            <input type="text" value="<?= $values["selectedQuestion"]->label ?>" name="field_label" id="field_label">
        </div>
        <div class="field">
            <label for="field_value_kind">Value kind</label>
            <select name="field_value_kind" id="field_value_kind">
                <option
                    <?= $values["selectedQuestion"]->question_type_id == 0 ? 'selected' : '' ?>
                  value="0">Single line text
                </option>

                <option
                    <?= $values["selectedQuestion"]->question_type_id == 1 ? 'selected' : '' ?>
                  value="1">List of single lines
                </option>

                <option
                    <?= $values["selectedQuestion"]->question_type_id == 2 ? 'selected' : '' ?>
                  value="2">Multi-line text
                </option>

            </select>
        </div>
        <div class="actions">
            <input type="submit" name="commit" value="Update Field" data-disable-with="Update Field">
        </div>
    </form>
</main>
