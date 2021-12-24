<?php

namespace Looper\Models\traits;

/**
 * This trait give the possibility to instantiate a new object with an assoc array of fields passed in parameter.
 */
trait Hydratable
{

    /**
     * Instantiate a new object with the fields passed in parameter.
     *
     * @param array $fields Array of fields to initialize. The fields need to have the EXACT name that the ones in
     *                      the classe.
     */
    public function __construct(array $fields = [])
    {
        $this->hydrate($fields);
    }

    private function hydrate(array $fields): void
    {
        foreach ($fields as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }
}
