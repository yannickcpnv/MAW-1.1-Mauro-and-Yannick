<?php

namespace Looper\Models;

class Answer
{

    private string   $value;
    private Take     $take;
    private Question $question;

    public function __construct(int $id)
    {
        //TODO
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return \Looper\Models\Take
     */
    public function getTake(): Take
    {
        return $this->take;
    }

    /**
     * @param \Looper\Models\Take $take
     */
    public function setTake(Take $take): void
    {
        $this->take = $take;
    }

    /**
     * @return \Looper\Models\Question
     */
    public function getQuestion(): Question
    {
        return $this->question;
    }

    /**
     * @param \Looper\Models\Question $question
     */
    public function setQuestion(Question $question): void
    {
        $this->question = $question;
    }
}
