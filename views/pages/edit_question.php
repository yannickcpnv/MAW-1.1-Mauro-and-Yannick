<?php

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\QuestionType;

/** @var array $values */
?>
>
<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/assets/logo-84d7d70645fbe179ce04c983a5fae1e6cba523d7cd28e0cd49a04707ccbef56e.png"></a>
        <span class="exercise-label">Exercise: <a href="/exercises/519/fields">Mauro</a></span>
    </section>
</header>

<main class="container">


    <title>ExerciseLooper</title>
    <meta name="csrf-param" content="authenticity_token">
    <meta name="csrf-token"
          content="Z2FwAAs6k2iwTDkP0iMScy/rJ/yWiw3iFxqehMG/jaCcrzKpWibTjPjWO8meH3vNvphgtbwwagNJvQ1FiEHJ5Q==">


    <link rel="stylesheet" media="all"
          href="/assets/application-264507a893987846393b8514969b89293817c54265354e63e6ab61fb46193f89.css">
    <script src="/assets/application-212289bcba525f2374cdbd70755ea38f2cfdd35d479e9638fae0b2832fac5dac.js"></script>


    <h1>Editing Field</h1>

    <form action="/exercises/519/fields/724" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden"
                                                                                         value="✓"><input type="hidden"
                                                                                                          name="_method"
                                                                                                          value="patch"><input
          type="hidden" name="authenticity_token"
          value="Z2FwAAs6k2iwTDkP0iMScy/rJ/yWiw3iFxqehMG/jaCcrzKpWibTjPjWO8meH3vNvphgtbwwagNJvQ1FiEHJ5Q==">

        <div class="field">
            <label for="field_label">Label</label>
            <input type="text" value="Question 1" name="field[label]" id="field_label">
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
            <input type="submit" name="commit" value="Update Field" data-disable-with="Update Field">
        </div>
    </form>

</main>