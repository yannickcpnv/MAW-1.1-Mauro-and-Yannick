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

    /**
     * Retrieve all answers by the take ID.
     *
     * @param int $takeId The ID of the take. Used with the question ID to retrieve the answer.
     *
     * @return Answer|false
     */
    public function getAnswerByTakeId(int $takeId): Answer|false
    {
        $query = "
            SELECT a.id, a.take_id, a.question_id, a.value
            FROM answers a
                inner join questions q on a.question_id = q.id
                inner join takes t on a.take_id = t.id
            WHERE q.id=:questionId and t.id=:takeId
        ";
        $queryArray = ['questionId' => $this->id, 'takeId' => $takeId];
        return self::createDatabase()->fetchOne($query, Answer::class, $queryArray);
    }
}
