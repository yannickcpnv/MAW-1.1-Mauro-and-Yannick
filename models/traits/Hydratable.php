<?php

namespace Looper\Models\traits;

trait Hydratable
{

    public function __construct(array $fields = [])
    {
        $this->hydrate($fields);
    }

    final public function hydrate(array $fields): void
    {
        foreach ($fields as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }
}
