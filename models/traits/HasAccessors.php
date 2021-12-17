<?php

namespace Looper\Models\traits;

use ReflectionMethod;
use RuntimeException;
use ReflectionProperty;

trait HasAccessors
{

    public function __get(string $property): mixed
    {
        return $this->createAccessors($property);
    }

    public function __set(string $property, mixed $value): void
    {
        $this->createAccessors($property, true, $value);
    }

    /**
     * Create accessors for gets and sets
     *
     * @throws ReflectionMethod
     * @throws ReflectionProperty
     * @throws RuntimeException
     */
    private function createAccessors(string $property, bool $isSetter = false, mixed $value = null): mixed
    {
        $method = $isSetter ? 'set' : 'get' . ucfirst($property); //camelCase() method name
        if (method_exists($this, $method)) {
            $reflection = new ReflectionMethod($this, $method);
            if (!$reflection->isPublic()) {
                throw new RuntimeException("The called method is not public.");
            }
        }

        if (property_exists($this, $property)) {
            $reflectedProperty = new ReflectionProperty($this, $property);
            $reflectedProperty->setAccessible(true);
            if ($isSetter) {
                $reflectedProperty->setValue($this, $value);
            } elseif ($reflectedProperty->isInitialized($this)) {
                return $reflectedProperty->getValue($this);
            }
        }

        return null;
    }
}
