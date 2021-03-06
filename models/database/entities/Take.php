<?php

namespace Looper\Models\database\entities;

use DateTime;

/**
 * this class is designed to represent an {@link Exercise} take.
 *
 * @property-read DateTime|string $timestamp
 */
class Take extends AbstractEntity
{

    //region Constants
    protected const TABLE_NAME = 'takes';
    //endregion

    //region Fields
    protected DateTime|string $timestamp;
    //endregion

    //region Constructor
    public function __construct()
    {
        parent::__construct();
        if (isset($this->timestamp)) {
            if (is_string($this->timestamp)) {
                $this->timestamp = self::strToDateTime($this->timestamp);
            }
        } else {
            $this->timestamp = date("Y-m-d H:i:s");
        }
    }
    //endregion

    //region Methods
    /**
     * Create a new take in the database.
     *
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
     * Update the take in the database.
     *
     * @param Answer[] $answers
     */
    public function save(array $answers = []): void
    {
        foreach ($answers as $answer) {
            if (!isset($answers->take_id)) {
                $answer->take_id = $this->id;
            }
            $answer->save();
        }
    }

    /**
     * Retrieve all questions of the take.
     *
     * @return Question[]
     */
    public function getQuestions(): array
    {
        $query = "
            SELECT q.id, q.label, q.exercise_id, q.question_type_id
            FROM questions as q
                inner join answers a on q.id = a.question_id
                inner join takes t on a.take_id = t.id
            WHERE t.id=:id
        ";
        $queryArray = ['id' => $this->id];
        return self::createDatabase()->fetchRecords($query, Question::class, $queryArray);
    }

    /**
     * Get an answer from a question id and using the instantiated take.
     *
     * @param int $questionId The question ID
     *
     * @return Answer
     */
    public function getAnswerByQuestionId(int $questionId): Answer
    {
        $query = "
            SELECT id, take_id, question_id, value
            FROM answers
            WHERE take_id=:take_id AND question_id=:question_id
        ";
        $queryArray = ['take_id' => $this->id, 'question_id' => $questionId];
        return self::createDatabase()->fetchRecords($query, Answer::class, $queryArray)[0];
    }

    private static function strToDateTime($strTimestamp): DateTime|bool
    {
        return DateTime::createFromFormat("Y-m-d H:i:s", $strTimestamp);
    }
    //endregion

    //region Accessors
    protected function getTimestamp(): DateTime|string { return $this->timestamp; }
    //endregion
}

