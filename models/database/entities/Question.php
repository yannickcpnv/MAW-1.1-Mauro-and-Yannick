<?php

namespace Looper\Models\database\entities;

class Question extends AbstractEntity
{

    protected const TABLE_NAME = 'questions';

    protected string   $label;
    protected int      $question_type_id;
    protected Exercise $exercise;
    /** @var Answer[] */
    protected array $answers;

    /**
     * Get all questions of exercise from the database.
     */
    public function loadExercise()
    {
        $query = "
            SELECT e.id, e.exercise_status_id, e.title
            FROM exercises as e
                INNER JOIN questions q on q.exercise_id = e.id
            WHERE q.id=:id
        ";
        $queryArray = ['id' => $this->id];
        $this->exercise = self::createDatabase()->fetchRecords($query, Exercise::class, $queryArray);
    }

    /**
     * Get all answers of Question form the database.
     */
    public function loadAnswers(): void
    {
        $query = "
            SELECT a.value, a.question_id, a.take_id
            FROM answers a
                INNER JOIN questions q on a.question_id = q.id
            WHERE q.id=:id
        ";
        $queryArray = ['id' => $this->id];
        $this->answers = self::createDatabase()->fetchRecords($query, Answer::class, $queryArray);
    }
}
