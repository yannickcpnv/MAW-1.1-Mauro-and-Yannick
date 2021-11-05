<?php

namespace Looper\Models\database\entities;

use PDOException;
use Looper\Models\traits\Arrayable;
use Looper\Models\traits\Hydratable;
use Looper\Models\traits\HasAccessors;
use Looper\Models\database\DatabaseConnector;

abstract class AbstractEntity
{
    use HasAccessors, Hydratable, Arrayable;

    //region Fields
    protected const TABLE_NAME = '';

    protected int $id;

    //endregion

    //region Constructors
    /**
     * Instantiate an Entity class -- can only be used in child classes.
     *
     * @param string[] $fields
     */
    public function __construct(array $fields = [])
    {
        self::hydrate($fields);
    }
    //endregion

    //region Methods
    /**
     * Retrieve all models from database.
     *
     * @return AbstractEntity[] An array of all models.
     */
    public static function getAll(): array
    {
        $query = "SELECT * FROM " . static::TABLE_NAME;

        return self::createDatabase()->fetchRecords($query, static::class);
    }

    /**
     * Retrieve an entity from the database.
     *
     * @param int $id - The ID.
     *
     * @return AbstractEntity|null The entity
     */
    public static function get(int $id): ?AbstractEntity
    {
        $query = "SELECT * FROM " . static::TABLE_NAME . " WHERE id= :id";
        $queryArray = ["id" => $id];
        $entityFound = self::createDatabase()->fetchOne($query, static::class, $queryArray);

        return $entityFound ?: null;
    }

    /**
     * Create a new entity in the database.
     *
     * @return bool True if success, otherwise false.
     */
    public function create(): bool
    {
        $columns = [];
        $valueParams = [];
        foreach ($this->toArray() as $key => $value) {
            array_push($columns, $key);
            array_push($valueParams, ":$key");
        }
        $columns = implode(',', $columns);
        $valueParams = implode(',', $valueParams);
        $query = "INSERT INTO " . static::TABLE_NAME . " ($columns) VALUES ($valueParams)";

        try {
            $this->id = self::createDatabase()->insert($query, $this->toArray());
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update the entity in the database.
     *
     * @return bool True if success, otherwise false.
     */
    public function save(): bool
    {
        $array = [];
        foreach ($this->toArray() as $key => $value) {
            if ($key != 'id') {
                array_push($array, "$key=:$key");
            }
        }
        $setLine = implode(',', $array);
        $query = "UPDATE " . static::TABLE_NAME . " SET $setLine WHERE id=:id";

        try {
            self::createDatabase()->update($query, $this->toArray());
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Delete the entity from the database.
     *
     * @param AbstractEntity $model
     *
     * @return bool
     */
    public function delete(): bool
    {
        $query = "DELETE FROM " . static::TABLE_NAME . " WHERE id=:id";
        $queryArray = ["id" => $this->id];

        try {
            self::createDatabase()->delete($query, $queryArray);
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    protected static function createDatabase(): DatabaseConnector
    {
        return new DatabaseConnector($_ENV['DB_DSN'], $_ENV['DB_USER_NAME'], $_ENV['DB_USER_PWD']);
    }
    //endregion
}
