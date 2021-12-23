<?php

namespace Looper\Models\database\entities;

/**
 * This class is designed to represent a question of an exercise.
 *
 * @property-read int $exercise_id
 */
class Question extends AbstractEntity
{

    protected const TABLE_NAME = 'questions';

    public string $label;
    public int    $question_type_id;
    public int    $exercise_id;

    /**
     * @return int
     */
    public function getExerciseId(): int
    {
        return $this->exercise_id;
    }

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
