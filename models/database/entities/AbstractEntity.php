<?php

namespace Looper\Models\database\entities;

use Looper\Models\traits\Arrayable;
use Looper\Models\traits\Hydratable;
use Looper\Models\traits\HasAccessors;

abstract class AbstractEntity
{

    use HasAccessors, Hydratable, Arrayable;

    //region Fields
    protected const TABLE_NAME = '';

    protected int $id;

    //endregion

    //region Constructors
    public function __construct(array $fields)
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
    public function getAll(): array
    {
        return [];
    }

    public function get(int $id): AbstractEntity
    {
        return $this;
    }

    public function create(): bool
    {
        return false;
    }

    public function save(): bool
    {
        return false;
    }

    public function delete(AbstractEntity $model): bool
    {
        return false;
    }
    //endregion
}
