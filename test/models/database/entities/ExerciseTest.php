<?php

namespace Looper\Test\Models\database\entities;

use Looper\Test\TestHelper;
use PHPUnit\Framework\TestCase;
use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\ExerciseStatus;

class ExerciseTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        TestHelper::createDatabase();
    }

    public final function setUp(): void
    {
        TestHelper::createDatabase();
    }

    public function testGetQuestions()
    {
        /* Given */
        $exercise = Exercise::get(3);

        /* When */
        $questions = $exercise->getQuestions();

        /* Then */
        $this->assertContainsOnlyInstancesOf(Question::class, $questions);
        $this->assertNotNull($questions[0]->label);
    }

    public function testGetTakes()
    {
        /* Given */
        $exercise = Exercise::get(3);

        /* When */
        $takes = $exercise->getTakes();

        /* Then */
        $this->assertContainsOnlyInstancesOf(Take::class, $takes);
        $this->assertNotNull($takes[0]->timestamp);
    }

    public function testGetTakesWhenExerciseHasNotTakes()
    {
        /* Given */
        $exercise = Exercise::get(1);

        /* When */
        $takes = $exercise->getTakes();

        /* Then */
        $this->assertEmpty($takes);
    }

    public function testGetExercisesByStatus()
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
}
