<?php

namespace Looper\Models\database\entities;

use RuntimeException;
use JetBrains\PhpStorm\Pure;

class EntityNotFoundException extends RuntimeException
{

    #[Pure] public function __construct(string $entityClassName)
    {
        parent::__construct("The entity [$entityClassName] was not found in the database.");
    }
}
