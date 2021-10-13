<?php

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\QuestionType;

/** @var array $values */
?>
<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png" alt="Logo"></a>
        <span class="exercise-label">Exercise: <a
              href="/?action=create-exercise&id=<?= $values["selectedExercise"]->id ?>"><?=
                $values["selectedExercise"]->title ?></a></span>
    </section>
</header>
<main class="container">
    <title>ExerciseLooper</title>
    <div class="row">
        <section class="column">
            <h1>Fields</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Value kind</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($values["selectedExercise"]->questions as $question): ?>
                        <tr>
                            <td><?= $question->label ?></td>
                            <td><?= QuestionType::toString($question->question_type_id) ?></td>
                            <td>
                                <a title="Edit" href="/?action=editQuestion&id=<?= $question ?>"><i class="fa
                            fa-edit"></i></a>
                                <a data-confirm="Are you sure?" href="/exercises/384/fields/599"><i class="fa
                            fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>

            <a data-confirm="Are you sure? You won't be able to further edit this exercise" class="button"
               rel="nofollow" data-method="put" href="/exercises/384?exercise%5Bstatus%5D=answering"><i
                  class="fa fa-comment"></i> Complete and be ready for answers</a>

        </section>
        <section class="column">
            <h1>New Field</h1>
            <form action="/exercises/384/fields" accept-charset="UTF-8" method="post">
                <div class="field">
                    <label for="field_label">Label</label>
                    <input type="text" name="field[label]" id="field_label">
                </div>

                <div class="field">
                    <label for="field_value_kind">Value kind</label>
                    <select name="field[value_kind]" id="field_value_kind">
                        <option selected="selected" value="single_line">Single line text</option>
                        <option value="single_line_list">List of single lines</option>
                        <option value="multi_line">Multi-line text</option>
                    </select>
                </div>
                <div class="actions">
                    <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field">
                </div>
            </form>
        </section>
    </div>
</main>