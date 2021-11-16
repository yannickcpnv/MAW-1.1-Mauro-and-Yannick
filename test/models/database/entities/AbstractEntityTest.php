<?php

namespace Looper\Test\Models\database\entities;

use PDOException;
use Looper\Test\TestHelper;
use PHPUnit\Framework\TestCase;
use Looper\Test\fake\FakeEntity;

class AbstractEntityTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        $_ENV['DB_DSN'] = "{$_ENV['DB_SQL_DRIVER']}:host={$_ENV['DB_HOSTNAME']};
                            dbname={$_ENV['DB_MINI_NAME']};port={$_ENV['DB_PORT']};
                            charset={$_ENV['DB_CHARSET']}";
        TestHelper::createMiniDatabase();
    }

    public final function setUp(): void
    {
        TestHelper::createMiniDatabase();
    }

    public function testGetAll()
    {
        /* Given */
        $expectedEntitiesQuantity = 50;

        /* When */
        $entityies = FakeEntity::getAll();

        /* Then */
        $this->assertCount($expectedEntitiesQuantity, $entityies);
    }

    public function testGet()
    {
        /* Given */
        $entityId = 12;
        $expectedClassInstance = FakeEntity::class;
        $expectedIpAddress = "122.88.122.26";

        /* When */
        $entity = FakeEntity::get($entityId);

        /* Then */
        $this->assertInstanceOf($expectedClassInstance, $entity);
        $this->assertEquals($expectedIpAddress, $entity->ip_address);
    }

    public function testCreate()
    {
        /* Given */
        $entity = new FakeEntity(
            [
                "first_name" => "James",
                "last_name"  => "Bond",
                "email"      => "james.bond@mi6.uk",
                "ip_address" => "172.67.134.131",
            ]
        );

        /* When */
        $entity->create();

        /* Then */
        try {
            $entity->create();
        } catch (PDOException $e) {
            $this->assertEquals(1062, $e->errorInfo[1]);
        }
    }

    /**
     * @depends testGet
     */
    public function testSave()
    {
        /* Given */
        $entityId = 8;
        $futurEntity = new FakeEntity(
            [
                "id" => $entityId,
                "first_name" => "Darth",
                "last_name" => "Vader",
                "email" => "vader@imperial.emp",
                "ip_address" => "255.255.255.255",
            ]
        );

        /* When */
        $futurEntity->save();

        /* Then */
        $this->assertEquals($futurEntity->firstname, FakeEntity::get($entityId)->firstname);
    }

    /**
     * @depends testGet
     */
    public function testDelete()
    {
        /* Given */
        $entityId = 1;
        $entity = new FakeEntity(['id' => $entityId]);

        /* When */
        $entity->delete();

        /* Then */
        $this->assertNull(FakeEntity::get($entityId));
    }

    public static function tearDownAfterClass(): void
    {
        TestHelper::dropDatabase('mini_test');
    }
}
