<?php

namespace Looper\Test\Models\database\entities;

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\ExerciseStatus;

class ExerciseTest extends AbstractDatabaseEntityTest
{

    public function testConstruct(): void
    {
        /* Given */
        $expectedStatus = ExerciseStatus::BUILDING;

        /* When */
        $exercise = new Exercise();

        /* Then */
        $this->assertEquals($expectedStatus, $exercise->exercise_status_id);
    }

    public function testAllAnswering(): void
    {
        /* Given */
        $status = ExerciseStatus::ANSWERING;

        /* When */
        $exercises = Exercise::getAllAnswering();

        /* Then */
        $filtered = array_filter($exercises, static fn($ex) => $ex->exercise_status_id === $status);
        $this->assertEquals($exercises, $filtered);
    }

    public function testGetQuestions(): void
    {
        /* Given */
        $exercise = Exercise::get(3);

        /* When */
        $questions = $exercise->getQuestions();

        /* Then */
        $this->assertContainsOnlyInstancesOf(Question::class, $questions);
        $this->assertNotNull($questions[0]->label);
    }

    public function testGetTakes(): void
    {
        /* Given */
        $exercise = Exercise::get(3);

        /* When */
        $takes = $exercise->getTakes();

        /* Then */
        $this->assertContainsOnlyInstancesOf(Take::class, $takes);
        $this->assertNotNull($takes[0]->timestamp);
    }

    public function testGetTakesWhenExerciseHasNotTakes(): void
    {
        /* Given */
        $exercise = Exercise::get(1);

        /* When */
        $takes = $exercise->getTakes();

        /* Then */
        $this->assertEmpty($takes);
    }

    public function testGetExercisesByStatus(): void
    {
        /* Given */
        $exerciseStatus = ExerciseStatus::BUILDING;

        /* When */
        $exercisesBuilding = Exercise::getExercisesByStatus($exerciseStatus);

        /* Then */
        foreach ($exercisesBuilding as $exercise) {
            $this->assertEquals($exerciseStatus, $exercise->exercise_status_id);
        }
    }

    public function testHasQuestionsWithQuestions(): void
    {
        /* Given */
        $exercise = Exercise::get(2);

        /* When */
        $result = $exercise->hasQuestions();

        /* Then */
        $this->assertTrue($result);
    }

    public function testHasQuestionsWithoutQuestions(): void
    {
        /* Given */
        $exercise = Exercise::get(1);

        /* When */
        $result = $exercise->hasQuestions();

        /* Then */
        $this->assertFalse($result);
    }

    public function testUpdateStatusFromBuilding(): void
    {
        /* Given */
        $nextStatus = ExerciseStatus::ANSWERING;
        $exercise = Exercise::get(1);

        /* When */
        $exercise->updateStatus();

        /* Then */
        $this->assertEquals($nextStatus, $exercise->exercise_status_id);
    }

    public function testUpdateStatusFromAnswering(): void
    {
        /* Given */
        $nextStatus = ExerciseStatus::CLOSED;
        $exercise = Exercise::get(2);

        /* When */
        $exercise->updateStatus();

        /* Then */
        $this->assertEquals($nextStatus, $exercise->exercise_status_id);
    }
}
