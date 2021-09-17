<?php

namespace Looper\Models;

use DateTime;

class Take
{

    private int      $id;
    private DateTime $timestamp;
    private array    $answers;

    public function __construct(int $id)
    {
        //TODO
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     */
    public function setTimestamp(DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @param array $answers
     */
    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }
}
