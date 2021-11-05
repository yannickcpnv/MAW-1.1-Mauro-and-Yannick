<?php

namespace Looper\Models\database\entities;

class Exercise extends AbstractEntity
{

    protected const TABLE_NAME = 'exercises';

    protected string $title;
    protected int    $exercise_status_id;

    /**
     * @var \Looper\Models\database\entities\Question[]
     */
    protected array $questions;

    /**
     * Get all questions of exercise from the database.
     */
    public function loadQuestions(): void
    {
        $query = "
            SELECT q.id, q.label, q.exercise_id, q.question_type_id
            FROM questions as q
                INNER JOIN exercises e on q.exercise_id = e.id
            WHERE e.id=:id
        ";
        $queryArray = ['id' => $this->id];
        $this->questions = self::createDatabase()->fetchRecords($query, Question::class, $queryArray);
    }
}
