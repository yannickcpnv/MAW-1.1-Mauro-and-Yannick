<?php

namespace Looper\Models\database\entities;

use Looper\Models\traits\Arrayable;
use Looper\Models\traits\Hydratable;
use ICanBoogie\Accessor\AccessorCamelTrait;
use Looper\Models\database\DatabaseConnector;

/**
 * @property-read int $id
 */
abstract class AbstractEntity
{

    use AccessorCamelTrait, Hydratable, Arrayable;

    //region Fields
    protected const TABLE_NAME = '';

    protected int $id;

    //endregion

    //region Methods
    /**
     * Retrieve all models from database.
     *
     * @return static[] An array of all models.
     */
    public static function getAll(): array
    {
        $query = "SELECT * FROM " . static::TABLE_NAME;

        return self::createDatabase()->fetchRecords($query, static::class);
    }

    protected static function createDatabase(): DatabaseConnector
    {
        return new DatabaseConnector($_ENV['DB_DSN'], $_ENV['DB_USER_NAME'], $_ENV['DB_USER_PWD']);
    }

    /**
     * Retrieve an entity from the database.
     *
     * @param int $id - The ID.
     *
     * @return static The entity
     * @throws EntityNotFoundException If the entity is not found by its 'id' in the database.
     */
    public static function get(int $id): static
    {
        $query = "SELECT * FROM " . static::TABLE_NAME . " WHERE id= :id";
        $queryArray = ["id" => $id];
        $entityFound = self::createDatabase()->fetchOne($query, static::class, $queryArray);

        if (empty($entityFound)) {
            throw new EntityNotFoundException(static::class);
        }

        return $entityFound;
    }

    /**
     * Create a new entity in the database.
     * It's also set the instance 'id' property to the value of the new inserted id.
     */
    public function create(): void
    {
        $columns = [];
        $valueParams = [];

        foreach ($this->toArray() as $key => $value) {
            $columns[] = $key;
            $valueParams[] = ":$key";
        }

        $columns = implode(',', $columns);
        $valueParams = implode(',', $valueParams);

        $query = "INSERT INTO " . static::TABLE_NAME . " ($columns) VALUES ($valueParams)";

        $this->id = self::createDatabase()->insert($query, $this->toArray());
    }

    /**
     * Update the entity in the database.
     */
    public function save(): void
    {
        $keys = [];
        $entityArray = $this->toArray();

        foreach ($entityArray as $key => $value) {
            if ($key !== 'id') {
                $keys[] = "$key=:$key";
            }
        }

        $setLine = implode(',', $keys);
        $query = "UPDATE " . static::TABLE_NAME . " SET $setLine WHERE id=:id";

        self::createDatabase()->update($query, $entityArray);
    }

    /**
     * Delete the entity from the database.
     */
    public function delete(): void
    {
        $query = "DELETE FROM " . static::TABLE_NAME . " WHERE id=:id";
        $queryArray = ["id" => $this->id];

        self::createDatabase()->delete($query, $queryArray);
    }

    /** @noinspection PhpUnused */
    protected function getId(): int { return $this->id; }
    //endregion
}
