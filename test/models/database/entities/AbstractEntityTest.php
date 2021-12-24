<?php

namespace Looper\Test\Models\database\entities;

use PDOException;
use Looper\Test\TestHelper;
use Looper\Test\fake\FakeEntity;
use Looper\Models\database\entities\EntityNotFoundException;

/**
 * @coversDefaultClass \Looper\Models\database\entities\AbstractEntity
 */
class AbstractEntityTest extends AbstractDatabaseEntityTest
{

    private static string $defaultEnvDsn;

    public static function setUpBeforeClass(): void
    {
        self::$defaultEnvDsn = $_ENV['DB_DSN'];
        $_ENV['DB_DSN'] = "{$_ENV['DB_SQL_DRIVER']}:host={$_ENV['DB_HOSTNAME']};
                            dbname={$_ENV['DB_MINI_NAME']};port={$_ENV['DB_PORT']};
                            charset={$_ENV['DB_CHARSET']}";
        TestHelper::createMiniDatabase();
    }

    public function setUp(): void
    {
        TestHelper::createMiniDatabase();
    }

    public function testGetAll(): void
    {
        /* Given */
        $expectedEntitiesQuantity = 50;

        /* When */
        $entities = FakeEntity::getAll();

        /* Then */
        $this->assertCount($expectedEntitiesQuantity, $entities);
    }

    public function testGet(): void
    {
        /* Given */
        $entityId = 12;
        $expectedIpAddress = "122.88.122.26";

        /* When */
        $entity = FakeEntity::get($entityId);

        /* Then */
        $this->assertEquals($expectedIpAddress, $entity->ip_address);
    }

    public function testGetNoutFound(): void
    {
        /* Given */
        $entityId = 12345;

        /* Except */
        $this->expectException(EntityNotFoundException::class);

        /* When */
        FakeEntity::get($entityId);
    }

    public function testCreate(): void
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
    public function testSave(): void
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
        $this->assertEquals($futurEntity->first_name, FakeEntity::get($entityId)->first_name);
    }

    /**
     * @depends testGet
     */
    public function testDelete(): void
    {
        /* Given */
        $entityId = 1;
        $entity = new FakeEntity(['id' => $entityId]);

        /* When */
        $entity->delete();

        /* Then */
        $this->expectException(EntityNotFoundException::class);
        FakeEntity::get($entityId);
    }

    public static function tearDownAfterClass(): void
    {
        TestHelper::dropDatabase('mini_test');
        $_ENV['DB_DSN'] = self::$defaultEnvDsn;
    }
}
