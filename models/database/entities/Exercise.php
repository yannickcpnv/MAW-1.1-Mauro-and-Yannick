<?php

namespace Looper\Models\database\entities;

class Exercise extends AbstractEntity
{

    protected const TABLE_NAME = 'exercises';

    protected string $title;
    protected int    $exercise_status_id;

    /**
     * Get all questions of exercise from the database.
     *
     * @return Question[] Exercise questions.
     */
    public function getQuestions(): array
    {
        $query = "
            SELECT q.id, q.label, q.exercise_id, q.question_type_id
            FROM questions as q
                INNER JOIN exercises e on q.exercise_id = e.id
            WHERE e.id=:id
        ";
        $queryArray = ['id' => $this->id];
        return self::createDatabase()->fetchRecords($query, Question::class, $queryArray);
    }

    public function getTakes()
    {
        $query = "
            SELECT t.id, t.timestamp
            FROM takes as t
                inner join answers a on t.id = a.take_id
                inner join questions q on a.question_id = q.id
                inner join exercises e on q.exercise_id = e.id
            WHERE e.id=:id
            GROUP BY t.id
        ";
        $queryArray = ['id' => $this->id];
        $var = self::createDatabase()->fetchRecords($query, Take::class, $queryArray);
        return $var;
    }

    /**
     * Retrieve all exercises that have the status given.
     *
     * @param int $statusId The ID status to search.
     *
     * @return Exercise[] Exercises from the given status.
     */
    public static function getExercisesByStatus(int $statusId): array
    {
        $query = "
            SELECT e.id, e.title, e.exercise_status_id
            FROM exercises as e
            WHERE e.exercise_status_id=:status
        ";
        $queryArray = ['status' => $statusId];
        return self::createDatabase()->fetchRecords($query, Exercise::class, $queryArray);
    }
}
