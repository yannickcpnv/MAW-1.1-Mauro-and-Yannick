<?php

namespace Looper\Models\database\entities;

use phpDocumentor\Reflection\Types\Self_;

class Exercise extends AbstractEntity
{

    protected const TABLE_NAME = 'exercises';

    protected string $title;
    protected int    $status;
    protected array  $questions;

    /**
     * Get all questions of exercise from the database.
     *
     * @return Question[] Exercise questions.
     */
    public function loadQuestions()
    {
        $query = "
            SELECT q.id, q.label, q.exercise_id, q.question_type_id
            FROM questions as q
                INNER JOIN exercises e on q.exercise_id = e.id
            WHERE e.id=:id
        ";
        $queryArray = ['id' => $this->id];

        $questions = self::createDatabase()->fetchRecords($query, Question::class, $queryArray);
    }
}
