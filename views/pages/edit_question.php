<?php

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\QuestionType;

/** @var array $values */
?>
>
<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/assets/logo-84d7d70645fbe179ce04c983a5fae1e6cba523d7cd28e0cd49a04707ccbef56e.png"></a>
        <span class="exercise-label">Exercise: <a
              href="/?action=edit<?= $values["selectedExercise"]->exercise->id ?>/fields">Mauro</a></span>
    </section>
</header>
<main class="container">
    <title>ExerciseLooper</title>
    <h1>Editing Field</h1>
    <form action="/exercises/519/fields/724" accept-charset="UTF-8" method="post">
        <div class="field">
            <label for="field_label">Label</label>
            <input type="text" value="Question 1" name="field_label" id="field_label">
        </div>
        <div class="field">
            <label for="field_value_kind">Value kind</label>
            <select name="field_value_kind" id="field_value_kind">
                <option selected="selected" value="0">Single line text</option>
                <option value="1">List of single lines</option>
                <option value="2">Multi-line text</option>
            </select>
        </div>
        <div class="actions">
            <input type="submit" name="commit" value="Update Field" data-disable-with="Update Field">
        </div>
    </form>

</main>