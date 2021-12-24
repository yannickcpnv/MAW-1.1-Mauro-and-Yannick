<?php

namespace Looper\Models\database\entities;

/**
 * This class is designed to represent an answer between a take and a question.
 */
class Answer extends AbstractEntity
{

    //region Constants
    protected const TABLE_NAME = 'answers';
    //endregion

    //region Fields
    public int    $take_id;
    public int    $question_id;
    public string $value;
    //endregion

    //region Methods
    /**
     * Get a take by its id.
     *
     * @param int $takeId take id.
     *
     * @return Answer[]
     */
    public static function getByTakeId(int $takeId): array
    {
        $query = "
            SELECT a.id, a.take_id, question_id, value
            FROM answers a
            INNER JOIN takes t on a.take_id = t.id
            WHERE t.id=:takeId
        ";
        $queryArray = ['takeId' => $takeId];
        return self::createDatabase()->fetchRecords($query, __CLASS__, $queryArray);
    }
    //endregion
}
