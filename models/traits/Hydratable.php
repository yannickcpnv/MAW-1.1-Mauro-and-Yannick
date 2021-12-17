<?php

namespace Looper\Models\traits;

trait Hydratable
{

    final public function hydrate(array $fields): void
    {
        foreach ($fields as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }
}
