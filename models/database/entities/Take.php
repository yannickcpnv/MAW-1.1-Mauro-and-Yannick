<?php

namespace Looper\Models\database\entities;

use DateTime;

class Take extends AbstractEntity
{

    protected const TABLE_NAME = 'takes';

    protected DateTime|string $timestamp;

    /**
     * @param Answer[]|null $answers
     */
    public function create(array $answers = null): void
    {
        parent::create();

        foreach ($answers as $answer) {
            if (!isset($answer->take_id)) {
                $answer->take_id = $this->id;
            }
            $answer->create();
        }
    }

    /**
     * Retrieve all takes from database.
     *
     * @return Take[] An array of all takes.
     */
    public
    static function getAll(): array
    {
        $takes = parent::getAll();
        foreach ($takes as $take) {
            $take->timestamp = self::strToDateTime($take->timestamp);
        }

        return $takes;
    }

    /**
     * Retrieve a take from the database.
     *
     * @param int $id - The ID.
     *
     * @return Take|null The take
     */
    public
    static function get(
        int $id
    ): ?Take {
        $take = parent::get($id);
        $take->timestamp = self::strToDateTime($take->timestamp);

        return $take;
    }

    private
    static function strToDateTime(
        $strTimestamp
    ): DateTime|bool {
        return DateTime::createFromFormat("Y-m-d H:i:s", $strTimestamp);
    }
}
