<?php

namespace Looper\Test\Models\database\entities;

use Looper\Test\TestHelper;
use PHPUnit\Framework\TestCase;

/**
 * This test class is used to be inherited by entities that use the database `looper`.
 */
abstract class AbstractDatabaseEntityTest extends TestCase
{

    public function setUp(): void
    {
        TestHelper::createDatabase();
    }

    public function tearDown(): void
    {
        TestHelper::dropDatabase('looper_test');
    }
}
