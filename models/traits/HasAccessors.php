<?php

namespace Looper\Models\traits;

use ReflectionProperty;

trait HasAccessors
{

    public function __get(string $property): mixed
    {
        if (property_exists($this, $property)) {
            $reflectedProperty = new ReflectionProperty($this, $property);
            $reflectedProperty->setAccessible(true);

            if ($reflectedProperty->isInitialized($this)) {
                return $reflectedProperty->getValue($this);
            }
        }

        return null;
    }

    public function __set(string $property, mixed $value): void
    {
        if (property_exists($this, $property)) {
            $reflectedProperty = new ReflectionProperty($this, $property);
            $reflectedProperty->setAccessible(true);
            $reflectedProperty->setValue($this, $value);
        }
    }
}
