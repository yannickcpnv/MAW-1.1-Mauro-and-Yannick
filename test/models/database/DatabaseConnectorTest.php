<?php /** @noinspection SqlResolve */

namespace Looper\Test\Models\database;

use Looper\Test\TestHelper;
use PHPUnit\Framework\TestCase;
use Looper\Test\fake\FakeEntity;
use Looper\Models\database\DatabaseConnector;

class DatabaseConnectorTest extends TestCase
{

    private DatabaseConnector $databaseConnector;
    private string            $query;
    private string            $fakeClass;

    public static function setUpBeforeClass(): void
    {
        TestHelper::createMiniDatabase();
    }

    public final function setUp(): void
    {
        TestHelper::createMiniDatabase();
        $this->databaseConnector = new DatabaseConnector(
            $_ENV['DB_MINI_DSN'],
            $_ENV['DB_USER_NAME'],
            $_ENV['DB_USER_PWD']
        );
        $this->fakeClass = FakeEntity::class;
    }

    public final function testFetchRecords(): void
    {
        /* Given */

        $this->query = "SELECT id FROM users_test";

        /* When */
        $entities = $this->databaseConnector->fetchRecords($this->query, $this->fakeClass);

        /* Then */
        self::assertContainsOnlyInstancesOf($this->fakeClass, $entities);
    }

    public final function testFetchOne(): void
    {
        /* Given */
        $this->query = "SELECT id FROM users_test WHERE id=:id";
        $entityId = 5;
        $queryArray = ['id' => $entityId];

        /* When */
        $entity = $this->databaseConnector->fetchOne($this->query, $this->fakeClass, $queryArray);

        /* Then */
        self::assertInstanceOf($this->fakeClass, $entity);
    }

    public final function testInsert(): void
    {
        /* Given */
        $this->query = "
            INSERT INTO users_test (first_name, last_name, email, ip_address)
            VALUES (:first_name, :last_name, :email, :ip_address)
        ";
        $queryArray = [
            'first_name' => 'Yannick',
            'last_name'  => 'Baudraz',
            'email'      => 'yannick.baudraz@cpnv.ch',
            'ip_address' => '192.168.140.115',
        ];
        $expectedNewId = 51;

        /* When */
        $lastInsertedId = $this->databaseConnector->insert($this->query, $queryArray);

        /* Then */
        self::assertEquals($expectedNewId, $lastInsertedId);
    }

    /**
     * @depends testFetchOne
     */
    public final function testUpdate(): void
    {
        /* Given */
        $this->query = "UPDATE users_test set first_name = :first_name WHERE id=:id";
        $entityId = 1;
        $entityFirstName = 'James';
        $queryArray = ['id' => $entityId, 'first_name' => $entityFirstName];

        /* When */
        $affectedRows = $this->databaseConnector->update($this->query, $queryArray);

        /* Then */
        self::assertEquals(1, $affectedRows);
        $entity = $this->databaseConnector->fetchOne(
            "SELECT first_name FROM users_test WHERE id=$entityId",
            $this->fakeClass
        );
        self::assertEquals($entityFirstName, $entity->first_name);
    }

    public final function testDelete(): void
    {
        /* Given */
        $this->query = "DELETE FROM users_test WHERE id=:id";

        /* When */
        $isSuccess = $this->databaseConnector->delete($this->query, ['id' => 1]);

        /* Then */
        self::assertTrue($isSuccess);
    }

    public static function tearDownAfterClass(): void
    {
        TestHelper::dropDatabase('mini_test');
    }
}
