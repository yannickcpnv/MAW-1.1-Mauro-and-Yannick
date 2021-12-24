<?php

namespace Looper\Models\traits;

/**
 * This trait give the possibility to convert to instantiate object to an assoc array.
 */
trait Arrayable
{

    /**
     * Convert the actual object to an assoc array.
     *
     * @return array
     */
    final public function toArray(): array
    {
        return get_object_vars($this);
    }
}
