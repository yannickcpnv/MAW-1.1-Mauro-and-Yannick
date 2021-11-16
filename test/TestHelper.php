<?php

namespace Looper\Test;

use PDO;

class TestHelper
{

    public static function createDatabase(): void
    {
        self::runScriptFromFile(__DIR__ . "/sql/looper_test.sql");
    }

    private static function runScriptFromFile(string $fileName): void
    {
        $connection = self::createConnection();
        $script = file_get_contents($fileName);
        $connection->exec($script);
    }

    private static function createConnection(): PDO
    {
        return new PDO(
            $_ENV["DB_TEST_ADMIN_DSN"],
            $_ENV["DB_USER_NAME"],
            $_ENV["DB_USER_PWD"]
        );
    }

    public static function createMiniDatabase(): void
    {
        self::runScriptFromFile(__DIR__ . "/sql/mini_test.sql");
    }

    public static function dropDatabase(string $dbName): void
    {
        $connection = self::createConnection();
        $connection->exec("DROP DATABASE $dbName");
    }
}
