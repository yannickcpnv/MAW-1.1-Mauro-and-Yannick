<?php

namespace Looper\Models\traits;

use ReflectionMethod;
use RuntimeException;
use ReflectionProperty;

trait HasAccessors
{

    public function __get(string $property): mixed
    {
        $this->checkIfMethodIsNotPublic('get' . ucfirst($property));

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
        $this->checkIfMethodIsNotPublic('set' . ucfirst($property));

        if (property_exists($this, $property)) {
            $reflectedProperty = new ReflectionProperty($this, $property);
            $reflectedProperty->setAccessible(true);
            $reflectedProperty->setValue($this, $value);
        }
    }

    /**
     * @param string $methodName Only values 'get' and 'set' are accepted.
     */
    private function checkIfMethodIsNotPublic(string $methodName): void
    {
        if (method_exists($this, $methodName)) {
            $reflection = new ReflectionMethod($this, $methodName);
            if (!$reflection->isPublic()) {
                throw new RuntimeException("The called method is not public.");
            }
        }
    }
}
