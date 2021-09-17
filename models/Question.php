<?php

namespace Looper\Models;

class Question
{

    private int      $id;
    private string   $label;
    private int      $questionType;
    private Exercise $exercise;
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
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return int
     */
    public function getQuestionType(): int
    {
        return $this->questionType;
    }

    /**
     * @param int $questionType
     */
    public function setQuestionType(int $questionType): void
    {
        $this->questionType = $questionType;
    }

    /**
     * @return \Looper\Models\Exercise
     */
    public function getExercise(): Exercise
    {
        return $this->exercise;
    }

    /**
     * @param \Looper\Models\Exercise $exercise
     */
    public function setExercise(Exercise $exercise): void
    {
        $this->exercise = $exercise;
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
