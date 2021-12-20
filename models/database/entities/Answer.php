<?php

namespace Looper\Models\database\entities;

class Answer extends AbstractEntity
{

    protected const TABLE_NAME = 'answers';

    protected string $value;
    protected int    $take_id;
    protected int    $question_id;

    /**
     * @param $takeId
     *
     * @return Answer[]
     */
    public static function getByTakeId($takeId): array
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
}
