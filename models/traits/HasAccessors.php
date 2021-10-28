<?php

namespace Looper\Models\traits;

use ReflectionMethod;
use RuntimeException;
use ReflectionProperty;

trait HasAccessors
{

    public function __get($property)
    {
        return $this->createAccessors($property);
    }

    public function __set($property, $value)
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
    private function createAccessors($property, $isSetter = false, $value = null)
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
