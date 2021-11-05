<?php

namespace Looper\Models\database\entities;

class Question extends AbstractEntity
{

    protected const TABLE_NAME = 'questions';

    protected string $label;
    protected int    $question_type_id;
    protected int    $exercise_id;
    /** @var Answer[] */
    protected array $answers;

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
