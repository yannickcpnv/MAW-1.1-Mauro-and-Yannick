<?php

namespace Looper\Test\Models\database\entities;

use PHPUnit\Framework\TestCase;
use Looper\Models\database\entities\QuestionType;

class QuestionTypeTest extends TestCase
{

    private string $expectedString;
    private string $value;

    protected function setUp(): void
    {
        $this->expectedString = '';
    }

    public function testToStringReturnsSingleLineText(): void
    {
        /* Given */
        $this->expectedString = 'SINGLE_LINE_TEXT';
        $this->value = QuestionType::SINGLE_LINE_TEXT;

        $this->whenAndThen();
    }

    public function testToStringReturnsSingleLineList(): void
    {
        /* Given */
        $this->expectedString = 'SINGLE_LINE_LIST';
        $this->value = QuestionType::SINGLE_LINE_LIST;

        $this->whenAndThen();
    }

    public function testToStringReturnsMultiLineText(): void
    {
        /* Given */
        $this->expectedString = 'MULTI_LINE_TEXT';
        $this->value = QuestionType::MULTI_LINE_TEXT;

        $this->whenAndThen();
    }

    public function testToStringReturnsDefaultValue(): void
    {
        /* Given */
        $this->expectedString = 'SINGLE_LINE_TEXT';
        $this->value = 123;

        $this->whenAndThen();
    }

    private function whenAndThen(): void
    {
        /* When */
        $actualString = QuestionType::toString($this->value);

        /* Then */
        $this->assertEquals($this->expectedString, $actualString);
    }
}
