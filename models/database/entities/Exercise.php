<?php

namespace Looper\Models\database\entities;

class Exercise extends AbstractEntity
{

    protected const TABLE_NAME = 'exercises';

    protected string $title;
    protected int    $exercise_status_id;

    public function __construct(array $fields = [])
    {
        parent::__construct($fields);
        $this->exercise_status_id = $this->exercise_status_id ?? ExerciseStatus::BUILDING;
    }

    /**
     * Get all exercises with status answering.
     *
     * @return Exercise[] All exercices with status Answering.
     */
    public static function getAllAnswering(): array
    {
        $query = "
            SELECT e.id, e.title, e.exercise_status_id
            FROM exercises e
                INNER JOIN exercise_statuses es on e.exercise_status_id = es.id
            WHERE exercise_status_id=:exercise_status_id
        ";
        $queryArray = ['exercise_status_id' => ExerciseStatus::ANSWERING];

        return self::createDatabase()->fetchRecords($query, __CLASS__, $queryArray);
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

        return self::createDatabase()->fetchRecords($query, __CLASS__, $queryArray);
    }

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

    /**
     * Get all takes of exercise from the database.
     *
     * @return Take[] Exercise takes.
     */
    public function getTakes(): array
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

        return self::createDatabase()->fetchRecords($query, Take::class, $queryArray);
    }

    /**
     * Check if the exercise has questions.
     *
     * @return bool True if exercise has questions, otherwise false.
     */
    public function hasQuestions(): bool
    {
        $query = "
            SELECT true
            FROM exercises e
                INNER JOIN questions q on e.id = q.exercise_id
            WHERE e.id=:id
        ";
        $queryArray = ['id' => $this->id];

        return self::createDatabase()->check($query, $queryArray);
    }

    /**
     * Update the status to the next state.
     */
    public function updateStatus(): void
    {
        $this->exercise_status_id = match ($this->exercise_status_id) {
            ExerciseStatus::BUILDING => ExerciseStatus::ANSWERING,
            ExerciseStatus::ANSWERING => ExerciseStatus::CLOSED,
        };
    }
}
