<?php

namespace Looper\Models\database\entities;

use phpDocumentor\Reflection\Types\Self_;

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
    public function getQuestions()
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

    public static function getExercisesByStatus(int $statusId)
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
