<?php

namespace Looper\Models\database\entities;

use Exception;
use JetBrains\PhpStorm\Pure;

class EntityNotFoundException extends Exception
{

    #[Pure] public function __construct(string $entityClassName)
    {
        parent::__construct("The entity [$entityClassName] was not found in the database.");
    }
}
