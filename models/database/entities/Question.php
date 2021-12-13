<?php

namespace Looper\Models\database\entities;

class Question extends AbstractEntity
{

    protected const TABLE_NAME = 'questions';

    protected string $label;
    protected int    $question_type_id;
    protected int    $exercise_id;

    /**
     * Get all answers of Question form the database.
     *
     * @return Answer[]
     */
    public function getAnswers(): array
    {
        $query = "
            SELECT a.id, a.take_id, question_id, value
            FROM answers a
                INNER JOIN questions q on a.question_id = q.id
            WHERE q.id=:id
        ";
        $queryArray = ['id' => $this->id];

        return self::createDatabase()->fetchRecords($query, Answer::class, $queryArray);
    }

    public function getAnswerByTakeId(int $takeid): Answer
    {
        $query = "
            SELECT a.id, a.take_id, a.question_id, a.value
            FROM answers a
                inner join questions q on a.question_id = q.id
                inner join takes t on a.take_id = t.id
            WHERE q.id=:answerid and t.id=:takeid
        ";
        $queryArray = ['answerid' => $this->id, 'takeid' => $takeid];
        return self::createDatabase()->fetchOne($query, Answer::class, $queryArray);
    }
}
